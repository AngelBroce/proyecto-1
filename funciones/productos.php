<?php
require_once __DIR__ . '/general.php';
require_once __DIR__ . '/db.php';

function obtener_productos(): array
{
    $pdo = conexion_db();
    $stmt = $pdo->query('SELECT p.*, c.nombreCat, m.nombreMarc FROM productos p INNER JOIN categoria c ON c.idCategoria = p.idCategoria INNER JOIN marca m ON m.idMarca = p.idMarca ORDER BY p.idProducto ASC');
    return $stmt->fetchAll();
}

function obtener_producto_por_id($idProducto): ?array
{
    $pdo = conexion_db();
    $stmt = $pdo->prepare('SELECT p.*, c.nombreCat, m.nombreMarc FROM productos p INNER JOIN categoria c ON c.idCategoria = p.idCategoria INNER JOIN marca m ON m.idMarca = p.idMarca WHERE p.idProducto = ? LIMIT 1');
    $stmt->execute([$idProducto]);
    $producto = $stmt->fetch();
    return $producto ?: null;
}

function obtener_categorias(): array
{
    $pdo = conexion_db();
    $stmt = $pdo->query('SELECT c.*, COUNT(p.idProducto) AS totalProductos FROM categoria c LEFT JOIN productos p ON p.idCategoria = c.idCategoria GROUP BY c.idCategoria, c.nombreCat ORDER BY c.idCategoria ASC');
    return $stmt->fetchAll();
}

function obtener_marcas(): array
{
    $pdo = conexion_db();
    $stmt = $pdo->query('SELECT m.*, COUNT(p.idProducto) AS totalProductos FROM marca m INNER JOIN productos p ON p.idMarca = m.idMarca GROUP BY m.idMarca, m.nombreMarc ORDER BY m.nombreMarc ASC');
    return $stmt->fetchAll();
}

function obtener_productos_por_categoria(int $idCategoria, int $limite = 50): array
{
    $pdo = conexion_db();
    $stmt = $pdo->prepare('SELECT p.*, c.nombreCat, m.nombreMarc FROM productos p INNER JOIN categoria c ON c.idCategoria = p.idCategoria INNER JOIN marca m ON m.idMarca = p.idMarca WHERE p.idCategoria = ? ORDER BY p.idProducto ASC LIMIT ' . (int) $limite);
    $stmt->execute([$idCategoria]);
    return $stmt->fetchAll();
}

function obtener_productos_destacados(int $limite = 4): array
{
    $pdo = conexion_db();
    $stmt = $pdo->query('SELECT p.*, c.nombreCat, m.nombreMarc FROM productos p INNER JOIN categoria c ON c.idCategoria = p.idCategoria INNER JOIN marca m ON m.idMarca = p.idMarca ORDER BY p.precioVenta DESC LIMIT ' . (int) $limite);
    return $stmt->fetchAll();
}

function obtener_productos_filtrados(int $idCategoria = 0, array $marcas = [], string $rangoPrecio = '', string $busqueda = ''): array
{
    $pdo = conexion_db();

    $sql = 'SELECT p.*, c.nombreCat, m.nombreMarc
            FROM productos p
            INNER JOIN categoria c ON c.idCategoria = p.idCategoria
            INNER JOIN marca m ON m.idMarca = p.idMarca
            WHERE 1=1';

    $params = [];

    if ($idCategoria > 0) {
        $sql .= ' AND p.idCategoria = ?';
        $params[] = $idCategoria;
    }

    $marcas = array_values(array_filter(array_map('intval', $marcas)));
    if (!empty($marcas)) {
        $placeholders = implode(',', array_fill(0, count($marcas), '?'));
        $sql .= ' AND p.idMarca IN (' . $placeholders . ')';
        foreach ($marcas as $marca) {
            $params[] = $marca;
        }
    }

    $rangos = obtener_rangos_precio();
    if ($rangoPrecio !== '' && isset($rangos[$rangoPrecio])) {
        $rango = $rangos[$rangoPrecio];
        if ($rango['min'] !== null) {
            $sql .= ' AND p.precioVenta >= ?';
            $params[] = $rango['min'];
        }
        if ($rango['max'] !== null) {
            $sql .= ' AND p.precioVenta <= ?';
            $params[] = $rango['max'];
        }
    }

    if ($busqueda !== '') {
        $sql .= ' AND (p.nombre LIKE ? OR p.idProducto LIKE ?)';
        $params[] = '%' . $busqueda . '%';
        $params[] = '%' . $busqueda . '%';
    }

    $sql .= ' ORDER BY p.precioVenta DESC, p.idProducto ASC';

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll();
}

function obtener_rangos_precio(): array
{
    return [
        '0-100' => ['label' => 'Hasta $100', 'min' => 0, 'max' => 100],
        '101-250' => ['label' => '$101 a $250', 'min' => 101, 'max' => 250],
        '251-500' => ['label' => '$251 a $500', 'min' => 251, 'max' => 500],
        '501+' => ['label' => 'Más de $500', 'min' => 501, 'max' => null],
    ];
}

function ruta_imagen_producto(array $producto): string
{
    $imagen = $producto['imagen'] ?? '';
    if ($imagen !== '' && file_exists(__DIR__ . '/../productos/' . $imagen)) {
        return '../productos/' . rawurlencode($imagen);
    }
    return '../assets/screenshots/placeholder.png';
}

function nombre_categoria_visual(array $producto): string
{
    return ucfirst((string) ($producto['nombreCat'] ?? 'Producto'));
}

function obtener_categoria_por_id(int $idCategoria): ?array
{
    foreach (obtener_categorias() as $categoria) {
        if ((int) $categoria['idCategoria'] === $idCategoria) {
            return $categoria;
        }
    }

    return null;
}
