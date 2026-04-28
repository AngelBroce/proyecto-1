<?php
require_once __DIR__ . '/general.php';
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/productos.php';
require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/admin_marcas.php';

function admin_resumen_inventario(): array
{
    $pdo = conexion_db();

    $totales = $pdo->query("SELECT COALESCE(SUM(stock * precioVenta),0) AS valor_total, COALESCE(SUM(stock),0) AS stock_total, COUNT(*) AS productos_total FROM productos")->fetch();
    $categorias = $pdo->query("SELECT COUNT(*) AS total FROM categoria")->fetch();
    $alertas = $pdo->query("SELECT COUNT(*) AS total FROM productos WHERE stock <= 5")->fetch();
    $precioPromedio = $pdo->query("SELECT COALESCE(AVG(precioVenta),0) AS promedio FROM productos")->fetch();

    return [
        'valor_total' => (float) ($totales['valor_total'] ?? 0),
        'stock_total' => (int) ($totales['stock_total'] ?? 0),
        'productos_total' => (int) ($totales['productos_total'] ?? 0),
        'categorias_total' => (int) ($categorias['total'] ?? 0),
        'alertas_total' => (int) ($alertas['total'] ?? 0),
        'precio_promedio' => (float) ($precioPromedio['promedio'] ?? 0),
    ];
}

function admin_productos_tabla(int $limite = 4): array
{
    $pdo = conexion_db();
    $sql = "SELECT p.*, c.nombreCat, m.nombreMarc
            FROM productos p
            INNER JOIN categoria c ON c.idCategoria = p.idCategoria
            INNER JOIN marca m ON m.idMarca = p.idMarca
            ORDER BY p.idProducto ASC
            LIMIT " . (int) $limite;
    return $pdo->query($sql)->fetchAll();
}

function admin_categorias_resumen(): array
{
    $pdo = conexion_db();
    $sql = "SELECT c.idCategoria, c.nombreCat, COUNT(p.idProducto) AS productos,
                   COALESCE(SUM(p.stock),0) AS stock_total,
                   COALESCE(SUM(p.stock * p.precioVenta),0) AS valor_inventario,
                   MIN(p.imagen) AS imagen_referencia
            FROM categoria c
            LEFT JOIN productos p ON p.idCategoria = c.idCategoria
            GROUP BY c.idCategoria, c.nombreCat
            ORDER BY c.idCategoria ASC";
    return $pdo->query($sql)->fetchAll();
}

function admin_analisis_categorias(): array
{
    $pdo = conexion_db();
    $sql = "SELECT c.nombreCat,
                   COUNT(p.idProducto) AS total_productos,
                   COALESCE(SUM(p.stock),0) AS stock_total,
                   COALESCE(SUM(p.stock * p.precioVenta),0) AS valor_total,
                   COALESCE(AVG(p.precioVenta),0) AS precio_promedio,
                   MIN(p.imagen) AS imagen_referencia
            FROM categoria c
            LEFT JOIN productos p ON p.idCategoria = c.idCategoria
            GROUP BY c.idCategoria, c.nombreCat
            ORDER BY valor_total DESC, stock_total DESC";
    return $pdo->query($sql)->fetchAll();
}

function admin_productos_premium(int $limite = 5): array
{
    $pdo = conexion_db();
    $sql = "SELECT p.*, c.nombreCat, m.nombreMarc
            FROM productos p
            INNER JOIN categoria c ON c.idCategoria = p.idCategoria
            INNER JOIN marca m ON m.idMarca = p.idMarca
            ORDER BY p.precioVenta DESC
            LIMIT " . (int) $limite;
    return $pdo->query($sql)->fetchAll();
}


function contar_empleados_admin(): int
{
    $pdo = conexion_db();
    return (int) $pdo->query('SELECT COUNT(*) FROM empleado')->fetchColumn();
}

function admin_formato_moneda(float $valor): string
{
    if ($valor >= 1000000) {
        return '$' . number_format($valor / 1000000, 1) . 'M';
    }
    if ($valor >= 1000) {
        return '$' . number_format($valor / 1000, 1) . 'K';
    }
    return '$' . number_format($valor, 2);
}

function admin_nombre_corto_categoria(string $nombre): string
{
    return ucwords($nombre);
}

function admin_ruta_imagen(?string $imagen): string
{
    if ($imagen && file_exists(__DIR__ . '/../productos/' . $imagen)) {
        return '../productos/' . rawurlencode($imagen);
    }
    return 'https://via.placeholder.com/400x300?text=Producto';
}

function render_admin_layout_inicio(string $pagina, string $titulo = ''): void
{
    $usuario = obtener_usuario_actual();
    $nombre = trim((string) ($usuario['nombre'] ?? 'Administrador'));
    $iniciales = '';
    foreach (preg_split('/\s+/', $nombre) as $parte) {
        if ($parte !== '') {
            $iniciales .= mb_strtoupper(mb_substr($parte, 0, 1));
        }
    }
    $iniciales = mb_substr($iniciales ?: 'A', 0, 2);

    $menus = [
        'dashboard' => ['Dashboard', 'dashboard.php'],
        'productos' => ['Productos', 'productos.php'],
        'categorias' => ['Categorías', 'categorias_admin.php'],
        'marcas' => ['Marcas', 'marcas.php'],
        'analisis' => ['Análisis', 'analysis.php'],
    ];
    ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title><?= escapar($titulo !== '' ? $titulo : 'TechVision Admin'); ?></title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
  <link href="../css/admin.css" rel="stylesheet"/>
</head>
<body class="admin-body">
  <div class="admin-shell">
    <aside class="admin-sidebar">
      <div>
        <div class="admin-brand">
          <div class="admin-brand-mark">TV</div>
          <div>
            <h1>TechVision</h1>
            <p>Digital curator</p>
          </div>
        </div>
        <nav class="admin-nav">
          <?php foreach ($menus as $clave => [$texto, $href]): ?>
            <a href="<?= escapar($href); ?>" class="<?= $pagina === $clave ? 'active' : ''; ?>">
              <span class="material-symbols-outlined"><?= $clave === 'dashboard' ? 'dashboard' : ($clave === 'productos' ? 'deployed_code' : ($clave === 'categorias' ? 'category' : ($clave === 'marcas' ? 'sell' : 'analytics'))); ?></span>
              <span><?= escapar($texto); ?></span>
            </a>
          <?php endforeach; ?>
        </nav>
      </div>
      <div class="admin-sidebar-bottom">
        <a href="productos.php" class="admin-entry-btn">+ New Entry</a>
        <a href="logout.php" class="admin-logout"><span class="material-symbols-outlined">logout</span> Logout</a>
      </div>
    </aside>
    <main class="admin-main">
      <header class="admin-topbar">
        <div class="admin-topbar-icons">
          <span class="material-symbols-outlined">notifications</span>
          <span class="material-symbols-outlined">settings</span>
        </div>
        <div class="admin-user">
          <div class="admin-user-text">
            <strong><?= escapar($nombre); ?></strong>
            <span><?= escapar(($usuario['rol'] ?? 'admin') === 'admin' ? 'Administrador del sistema' : 'Empleado'); ?></span>
          </div>
          <div class="admin-avatar"><?= escapar($iniciales); ?></div>
        </div>
      </header>
      <section class="admin-content">
    <?php
}

function render_admin_layout_fin(): void
{
    ?>
      </section>
    </main>
  </div>
</body>
</html>
    <?php
}


function admin_flash_desde_query(): ?array
{
    $mensaje = trim((string)($_GET['mensaje'] ?? ''));
    if ($mensaje === '') return null;
    $tipo = (($_GET['tipo'] ?? 'ok') === 'error') ? 'error' : 'ok';
    return ['tipo' => $tipo, 'mensaje' => $mensaje];
}
