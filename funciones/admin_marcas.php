<?php
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/productos.php';

function admin_listar_marcas_panel(): array
{
    $pdo = conexion_db();
    $sql = "SELECT m.idMarca, m.nombreMarc,
                   COUNT(p.idProducto) AS totalProductos,
                   COALESCE(SUM(p.stock),0) AS stockTotal,
                   COALESCE(SUM(p.stock * p.precioVenta),0) AS valorInventario,
                   MIN(p.imagen) AS imagenReferencia
            FROM marca m
            LEFT JOIN productos p ON p.idMarca = m.idMarca
            GROUP BY m.idMarca, m.nombreMarc
            ORDER BY m.nombreMarc ASC";
    return $pdo->query($sql)->fetchAll();
}

function admin_obtener_marca(int $idMarca): ?array
{
    $pdo = conexion_db();
    $stmt = $pdo->prepare('SELECT * FROM marca WHERE idMarca = ? LIMIT 1');
    $stmt->execute([$idMarca]);
    return $stmt->fetch() ?: null;
}

function admin_siguiente_id_marca(): int
{
    $pdo = conexion_db();
    return (int) $pdo->query('SELECT COALESCE(MAX(idMarca), 0) + 1 FROM marca')->fetchColumn();
}

function admin_crear_marca(string $nombre): array
{
    $nombre = trim($nombre);
    if ($nombre === '') return [false, 'El nombre de la marca es obligatorio.'];
    $pdo = conexion_db();
    $stmt = $pdo->prepare('INSERT INTO marca (idMarca, nombreMarc) VALUES (?, ?)');
    $ok = $stmt->execute([admin_siguiente_id_marca(), mb_strtoupper($nombre)]);
    return [$ok, $ok ? 'Marca creada correctamente.' : 'No se pudo crear la marca.'];
}

function admin_actualizar_marca(int $idMarca, string $nombre): array
{
    $nombre = trim($nombre);
    if ($nombre === '') return [false, 'El nombre de la marca es obligatorio.'];
    $pdo = conexion_db();
    $stmt = $pdo->prepare('UPDATE marca SET nombreMarc = ? WHERE idMarca = ?');
    $ok = $stmt->execute([mb_strtoupper($nombre), $idMarca]);
    return [$ok, $ok ? 'Marca actualizada correctamente.' : 'No se pudo actualizar la marca.'];
}

function admin_eliminar_marca(int $idMarca): array
{
    $pdo = conexion_db();
    $enUso = $pdo->prepare('SELECT COUNT(*) FROM productos WHERE idMarca = ?');
    $enUso->execute([$idMarca]);
    if ((int)$enUso->fetchColumn() > 0) {
        return [false, 'No se puede eliminar la marca porque tiene productos asociados.'];
    }
    $stmt = $pdo->prepare('DELETE FROM marca WHERE idMarca = ?');
    $ok = $stmt->execute([$idMarca]);
    return [$ok, $ok ? 'Marca eliminada correctamente.' : 'No se pudo eliminar la marca.'];
}
