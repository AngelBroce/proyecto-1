<?php
require_once __DIR__ . '/general.php';
require_once __DIR__ . '/productos.php';

function obtener_carrito(): array
{
    if (!isset($_SESSION['carrito']) || !is_array($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }

    return $_SESSION['carrito'];
}

function guardar_carrito(array $carrito): void
{
    $_SESSION['carrito'] = $carrito;
}

function agregar_producto_carrito(int $idProducto, int $cantidad = 1): bool
{
    if ($idProducto <= 0 || $cantidad <= 0) {
        return false;
    }

    $producto = obtener_producto_por_id($idProducto);
    if (!$producto) {
        return false;
    }

    $stockDisponible = max(1, (int) ($producto['stock'] ?? 1));
    $carrito = obtener_carrito();
    $cantidadActual = (int) ($carrito[$idProducto]['cantidad'] ?? 0);
    $nuevaCantidad = min($cantidadActual + $cantidad, $stockDisponible);

    $carrito[$idProducto] = [
        'idProducto' => $idProducto,
        'cantidad' => $nuevaCantidad,
    ];

    guardar_carrito($carrito);
    return true;
}

function actualizar_cantidad_carrito(int $idProducto, int $cantidad): bool
{
    $carrito = obtener_carrito();

    if (!isset($carrito[$idProducto])) {
        return false;
    }

    if ($cantidad <= 0) {
        unset($carrito[$idProducto]);
        guardar_carrito($carrito);
        return true;
    }

    $producto = obtener_producto_por_id($idProducto);
    if (!$producto) {
        unset($carrito[$idProducto]);
        guardar_carrito($carrito);
        return false;
    }

    $stockDisponible = max(1, (int) ($producto['stock'] ?? 1));
    $carrito[$idProducto]['cantidad'] = min($cantidad, $stockDisponible);
    guardar_carrito($carrito);
    return true;
}

function eliminar_producto_carrito(int $idProducto): void
{
    $carrito = obtener_carrito();
    unset($carrito[$idProducto]);
    guardar_carrito($carrito);
}

function cantidad_carrito(): int
{
    $cantidad = 0;
    foreach (obtener_carrito() as $item) {
        $cantidad += (int) ($item['cantidad'] ?? 0);
    }
    return $cantidad;
}

function obtener_items_carrito(): array
{
    $items = [];
    foreach (obtener_carrito() as $item) {
        $idProducto = (int) ($item['idProducto'] ?? 0);
        $cantidad = max(1, (int) ($item['cantidad'] ?? 1));
        $producto = obtener_producto_por_id($idProducto);

        if (!$producto) {
            continue;
        }

        $precio = (float) ($producto['precioVenta'] ?? 0);
        $subtotal = $precio * $cantidad;

        $items[] = [
            'producto' => $producto,
            'cantidad' => $cantidad,
            'precio' => $precio,
            'subtotal' => $subtotal,
        ];
    }

    return $items;
}

function total_carrito(): float
{
    $total = 0.0;
    foreach (obtener_items_carrito() as $item) {
        $total += (float) $item['subtotal'];
    }
    return $total;
}
