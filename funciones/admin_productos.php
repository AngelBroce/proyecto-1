<?php
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/productos.php';

function admin_listar_productos(string $buscar = ''): array
{
    $pdo = conexion_db();
    $sql = "SELECT p.*, c.nombreCat, m.nombreMarc
            FROM productos p
            INNER JOIN categoria c ON c.idCategoria = p.idCategoria
            INNER JOIN marca m ON m.idMarca = p.idMarca";
    $params = [];

    if ($buscar !== '') {
        $sql .= " WHERE p.nombre LIKE ? OR p.descripcion LIKE ? OR m.nombreMarc LIKE ? OR c.nombreCat LIKE ?";
        $like = '%' . $buscar . '%';
        $params = [$like, $like, $like, $like];
    }

    $sql .= ' ORDER BY p.idProducto ASC';
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll();
}

function admin_obtener_producto(int $idProducto): ?array
{
    return obtener_producto_por_id($idProducto);
}

function admin_siguiente_id_producto(): int
{
    $pdo = conexion_db();
    return (int) $pdo->query('SELECT COALESCE(MAX(idProducto), 7701000000000) + 1 FROM productos')->fetchColumn();
}

function admin_validar_producto(array $data): array
{
    $errores = [];
    if (trim((string)($data['nombre'] ?? '')) === '') $errores[] = 'El nombre del producto es obligatorio.';
    if (trim((string)($data['descripcion'] ?? '')) === '') $errores[] = 'La descripción del producto es obligatoria.';
    if ((int)($data['idCategoria'] ?? 0) <= 0) $errores[] = 'Seleccione una categoría válida.';
    if ((int)($data['idMarca'] ?? 0) <= 0) $errores[] = 'Seleccione una marca válida.';
    if (!is_numeric($data['stock'] ?? null) || (int)$data['stock'] < 0) $errores[] = 'El stock debe ser un número válido.';
    if (!is_numeric($data['precioCosto'] ?? null) || (float)$data['precioCosto'] < 0) $errores[] = 'El precio de costo debe ser válido.';
    if (!is_numeric($data['precioVenta'] ?? null) || (float)$data['precioVenta'] < 0) $errores[] = 'El precio de venta debe ser válido.';
    return $errores;
}

function admin_crear_producto(array $data): array
{
    $errores = admin_validar_producto($data);
    if ($errores) return [false, implode(' ', $errores)];

    $pdo = conexion_db();
    $id = admin_siguiente_id_producto();
    $stmt = $pdo->prepare('INSERT INTO productos (idProducto, nombre, unidad, descripcion, stock, precioCosto, precioVenta, imagen, idCategoria, idMarca) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
    $ok = $stmt->execute([
        $id,
        trim($data['nombre']),
        trim($data['unidad'] ?? 'UND') ?: 'UND',
        trim($data['descripcion']),
        (int)$data['stock'],
        (float)$data['precioCosto'],
        (float)$data['precioVenta'],
        trim($data['imagen'] ?? ''),
        (int)$data['idCategoria'],
        (int)$data['idMarca'],
    ]);
    return [$ok, $ok ? 'Producto creado correctamente.' : 'No se pudo crear el producto.'];
}

function admin_actualizar_producto(int $idProducto, array $data): array
{
    $errores = admin_validar_producto($data);
    if ($errores) return [false, implode(' ', $errores)];

    $pdo = conexion_db();
    $stmt = $pdo->prepare('UPDATE productos SET nombre = ?, unidad = ?, descripcion = ?, stock = ?, precioCosto = ?, precioVenta = ?, imagen = ?, idCategoria = ?, idMarca = ? WHERE idProducto = ?');
    $ok = $stmt->execute([
        trim($data['nombre']),
        trim($data['unidad'] ?? 'UND') ?: 'UND',
        trim($data['descripcion']),
        (int)$data['stock'],
        (float)$data['precioCosto'],
        (float)$data['precioVenta'],
        trim($data['imagen'] ?? ''),
        (int)$data['idCategoria'],
        (int)$data['idMarca'],
        $idProducto,
    ]);
    return [$ok, $ok ? 'Producto actualizado correctamente.' : 'No se pudo actualizar el producto.'];
}

function admin_eliminar_producto(int $idProducto): array
{
    $pdo = conexion_db();
    try {
        $stmt = $pdo->prepare('DELETE FROM productos WHERE idProducto = ?');
        $ok = $stmt->execute([$idProducto]);
        return [$ok, $ok ? 'Producto eliminado correctamente.' : 'No se pudo eliminar el producto.'];
    } catch (Throwable $e) {
        return [false, 'No se puede eliminar el producto porque está relacionado con otros registros.'];
    }
}
