<?php
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/carrito.php';

function asegurar_tarjetas_demo(): void
{
    $pdo = conexion_db();
    $total = (int) $pdo->query('SELECT COUNT(*) FROM tarjeta')->fetchColumn();
    if ($total > 0) {
        return;
    }

    $stmt = $pdo->prepare('INSERT INTO tarjeta (tipo, digitos, fechaVence, codSeguridad, saldo, saldoMaximo) VALUES (?, ?, ?, ?, ?, ?)');
    $stmt->execute(['visa', '4111111111111111', '2030-12-31', '123', 5000.00, 5000.00]);
    $stmt->execute(['mastercard', '5555555555554444', '2030-12-31', '456', 5000.00, 5000.00]);
}

function limpiar_numero_tarjeta(string $numero): string
{
    return preg_replace('/\D+/', '', $numero) ?? '';
}

function buscar_tarjeta(string $tipo, string $digitos, string $cvv, string $vence): ?array
{
    $pdo = conexion_db();
    // Extraer año y mes de la fecha de vencimiento proporcionada
    $vence_ano = substr($vence, 0, 4);
    $vence_mes = substr($vence, 5, 2);
    $stmt = $pdo->prepare('SELECT * FROM tarjeta WHERE LOWER(tipo) = ? AND digitos = ? AND codSeguridad = ? AND YEAR(fechaVence) = ? AND MONTH(fechaVence) = ? LIMIT 1');
    $stmt->execute([
        strtolower($tipo),
        $digitos,
        $cvv,
        $vence_ano,
        $vence_mes
    ]);
    $tarjeta = $stmt->fetch();
    return $tarjeta ?: null;
}

function procesar_pago_carrito(string $tipo, string $numero, string $mes, string $anio, string $cvv): array
{
    asegurar_tarjetas_demo();

    $items = obtener_items_carrito();
    if (empty($items)) {
        return ['ok' => false, 'mensaje' => 'Tu carrito está vacío.'];
    }

    $tipo = strtolower(trim($tipo));
    $numero = limpiar_numero_tarjeta($numero);
    $mes = str_pad(preg_replace('/\D+/', '', $mes) ?? '', 2, '0', STR_PAD_LEFT);
    $anio = preg_replace('/\D+/', '', $anio) ?? '';
    $cvv = preg_replace('/\D+/', '', $cvv) ?? '';

    if (!in_array($tipo, ['visa', 'mastercard'], true)) {
        return ['ok' => false, 'mensaje' => 'Selecciona Visa o Mastercard.'];
    }
    if (strlen($numero) !== 16) {
        return ['ok' => false, 'mensaje' => 'El número de tarjeta debe tener 16 dígitos.'];
    }
    if ((int) $mes < 1 || (int) $mes > 12 || strlen($anio) !== 4) {
        return ['ok' => false, 'mensaje' => 'La fecha de vencimiento no es válida.'];
    }
    if (strlen($cvv) < 3 || strlen($cvv) > 4) {
        return ['ok' => false, 'mensaje' => 'El código de seguridad no es válido.'];
    }

    $vence = sprintf('%04d-%02d-%02d', (int) $anio, (int) $mes, 28);
    $tarjeta = buscar_tarjeta($tipo, $numero, $cvv, $vence);
    if (!$tarjeta) {
        return ['ok' => false, 'mensaje' => 'La tarjeta no fue encontrada. Usa una tarjeta registrada en la base de datos o las tarjetas demo.'];
    }

    $total = total_carrito();
    if ((float) $tarjeta['saldo'] < $total) {
        return ['ok' => false, 'mensaje' => 'La tarjeta no tiene saldo suficiente.'];
    }

    $pdo = conexion_db();
    try {
        $pdo->beginTransaction();

        foreach ($items as $item) {
            $producto = $item['producto'];
            if ((int) $producto['stock'] < (int) $item['cantidad']) {
                throw new RuntimeException('No hay suficiente stock para ' . $producto['nombre'] . '.');
            }
        }

        $itbms = round($total * 0.07, 4);
        $granTotal = round($total + $itbms, 4);

        if ((float) $tarjeta['saldo'] < $granTotal) {
            throw new RuntimeException('La tarjeta no tiene saldo suficiente para cubrir el total con impuesto.');
        }

        $stmtFactura = $pdo->prepare('INSERT INTO factura (idTarjeta, subtotal, itbms, total) VALUES (?, ?, ?, ?)');
        $stmtFactura->execute([(int) $tarjeta['idTarjeta'], $total, $itbms, $granTotal]);
        $idFactura = (int) $pdo->lastInsertId();

        $stmtDetalle = $pdo->prepare('INSERT INTO factura_detalle (idFactura, idProducto, cantidad, precio_unitario) VALUES (?, ?, ?, ?)');
        $stmtStock = $pdo->prepare('UPDATE productos SET stock = stock - ? WHERE idProducto = ?');
        foreach ($items as $item) {
            $producto = $item['producto'];
            $stmtDetalle->execute([$idFactura, $producto['idProducto'], $item['cantidad'], $item['precio']]);
            $stmtStock->execute([$item['cantidad'], $producto['idProducto']]);
        }

        $stmtSaldo = $pdo->prepare('UPDATE tarjeta SET saldo = saldo - ? WHERE idTarjeta = ?');
        $stmtSaldo->execute([$granTotal, (int) $tarjeta['idTarjeta']]);

        guardar_carrito([]);
        $pdo->commit();

        return ['ok' => true, 'mensaje' => 'Pago realizado correctamente.', 'idFactura' => $idFactura, 'subtotal' => $total, 'itbms' => $itbms, 'total' => $granTotal];
    } catch (Throwable $e) {
        if ($pdo->inTransaction()) {
            $pdo->rollBack();
        }
        return ['ok' => false, 'mensaje' => $e->getMessage()];
    }
}
