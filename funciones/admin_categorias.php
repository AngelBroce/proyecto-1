<?php
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/productos.php';

function admin_listar_categorias(): array
{
    return obtener_categorias();
}

function admin_obtener_categoria_admin(int $idCategoria): ?array
{
    $pdo = conexion_db();
    $stmt = $pdo->prepare('SELECT * FROM categoria WHERE idCategoria = ? LIMIT 1');
    $stmt->execute([$idCategoria]);
    return $stmt->fetch() ?: null;
}

function admin_siguiente_id_categoria(): int
{
    $pdo = conexion_db();
    return (int) $pdo->query('SELECT COALESCE(MAX(idCategoria), 0) + 1 FROM categoria')->fetchColumn();
}

function admin_crear_categoria(string $nombre): array
{
    $nombre = trim($nombre);
    if ($nombre === '') return [false, 'El nombre de la categoría es obligatorio.'];
    $pdo = conexion_db();
    $stmt = $pdo->prepare('INSERT INTO categoria (idCategoria, nombreCat) VALUES (?, ?)');
    $ok = $stmt->execute([admin_siguiente_id_categoria(), $nombre]);
    return [$ok, $ok ? 'Categoría creada correctamente.' : 'No se pudo crear la categoría.'];
}

function admin_actualizar_categoria(int $idCategoria, string $nombre): array
{
    $nombre = trim($nombre);
    if ($nombre === '') return [false, 'El nombre de la categoría es obligatorio.'];
    $pdo = conexion_db();
    $stmt = $pdo->prepare('UPDATE categoria SET nombreCat = ? WHERE idCategoria = ?');
    $ok = $stmt->execute([$nombre, $idCategoria]);
    return [$ok, $ok ? 'Categoría actualizada correctamente.' : 'No se pudo actualizar la categoría.'];
}

function admin_eliminar_categoria(int $idCategoria): array
{
    $pdo = conexion_db();
    $enUso = $pdo->prepare('SELECT COUNT(*) FROM productos WHERE idCategoria = ?');
    $enUso->execute([$idCategoria]);
    if ((int)$enUso->fetchColumn() > 0) {
        return [false, 'No se puede eliminar la categoría porque tiene productos asociados.'];
    }
    $stmt = $pdo->prepare('DELETE FROM categoria WHERE idCategoria = ?');
    $ok = $stmt->execute([$idCategoria]);
    return [$ok, $ok ? 'Categoría eliminada correctamente.' : 'No se pudo eliminar la categoría.'];
}
