<?php
require_once __DIR__ . '/dashboard.php';

function admin_metrica_mayor_stock(): ?array
{
    $pdo = conexion_db();
    $sql = "SELECT p.nombre, p.stock, p.precioVenta, c.nombreCat, m.nombreMarc, p.imagen
            FROM productos p
            INNER JOIN categoria c ON c.idCategoria = p.idCategoria
            INNER JOIN marca m ON m.idMarca = p.idMarca
            ORDER BY p.stock DESC, p.precioVenta DESC
            LIMIT 1";
    $fila = $pdo->query($sql)->fetch();
    return $fila ?: null;
}

function admin_metrica_marca_lider(): ?array
{
    $pdo = conexion_db();
    $sql = "SELECT m.nombreMarc, COUNT(p.idProducto) AS totalProductos, COALESCE(SUM(p.stock * p.precioVenta),0) AS valorInventario
            FROM marca m
            LEFT JOIN productos p ON p.idMarca = m.idMarca
            GROUP BY m.idMarca, m.nombreMarc
            ORDER BY valorInventario DESC, totalProductos DESC
            LIMIT 1";
    $fila = $pdo->query($sql)->fetch();
    return $fila ?: null;
}
