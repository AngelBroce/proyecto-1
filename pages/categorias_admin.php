<?php
require_once __DIR__ . '/../funciones/dashboard.php';
require_once __DIR__ . '/../funciones/admin_categorias.php';
requiere_admin();

$mensaje = '';
$tipo = 'ok';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'] ?? '';
    if ($accion === 'crear') {
        [$ok, $mensaje] = admin_crear_categoria($_POST['nombreCat'] ?? '');
        $tipo = $ok ? 'ok' : 'error';
    } elseif ($accion === 'actualizar') {
        [$ok, $mensaje] = admin_actualizar_categoria((int)($_POST['idCategoria'] ?? 0), $_POST['nombreCat'] ?? '');
        $tipo = $ok ? 'ok' : 'error';
    } elseif ($accion === 'eliminar') {
        [$ok, $mensaje] = admin_eliminar_categoria((int)($_POST['idCategoria'] ?? 0));
        $tipo = $ok ? 'ok' : 'error';
    }
}

$editarId = (int)($_GET['editar'] ?? 0);
$categoriaEditar = $editarId > 0 ? admin_obtener_categoria_admin($editarId) : null;
$categorias = admin_categorias_resumen();
$resumen = admin_resumen_inventario();
$principal = $categorias[0] ?? null;
$secundarias = array_slice($categorias, 1, 3);
$porcentajeBase = max(array_column($categorias, 'valor_inventario') ?: [1]);

render_admin_layout_inicio('categorias', 'TechVision | Categorías');
?>
<?php if ($mensaje !== ''): ?><div class="admin-alert <?= escapar($tipo); ?>"><?= escapar($mensaje); ?></div><?php endif; ?>
<div class="admin-page-head">
  <div>
    <small>Administrador / Categorías</small>
    <h2>Gestión de categorías</h2>
    <p>Crea, edita y revisa la distribución de los productos por categoría.</p>
  </div>
</div>

<div class="admin-form-card">
  <h3 style="margin-top:0;"><?= $categoriaEditar ? 'Editar categoría' : 'Nueva categoría'; ?></h3>
  <form method="post">
    <input type="hidden" name="accion" value="<?= $categoriaEditar ? 'actualizar' : 'crear'; ?>">
    <?php if ($categoriaEditar): ?><input type="hidden" name="idCategoria" value="<?= escapar((string)$categoriaEditar['idCategoria']); ?>"><?php endif; ?>
    <div class="admin-form-grid">
      <div class="admin-form-field full">
        <label>Nombre de la categoría</label>
        <input type="text" name="nombreCat" value="<?= escapar($categoriaEditar['nombreCat'] ?? ''); ?>" required>
      </div>
    </div>
    <div class="admin-form-actions">
      <button class="admin-btn" type="submit"><?= $categoriaEditar ? 'Guardar cambios' : 'Crear categoría'; ?></button>
      <?php if ($categoriaEditar): ?><a class="admin-btn-outline" href="categorias_admin.php">Cancelar edición</a><?php endif; ?>
    </div>
  </form>
</div>

<div class="category-grid">
  <div class="category-main-card">
    <?php if ($principal): ?>
      <div class="hero-admin-card">
        <img src="<?= escapar(admin_ruta_imagen($principal['imagen_referencia'] ?? null)); ?>" alt="<?= escapar($principal['nombreCat']); ?>">
        <div class="category-overlay">
          <span class="count"><?= escapar((string)$principal['productos']); ?> items</span>
          <h3><?= escapar(admin_nombre_corto_categoria($principal['nombreCat'])); ?></h3>
          <p>Inventario valorizado en <?= escapar(admin_formato_moneda((float)$principal['valor_inventario'])); ?> con <?= escapar((string)$principal['stock_total']); ?> unidades disponibles.</p>
        </div>
      </div>
    <?php endif; ?>
  </div>
  <div class="category-stack">
    <?php foreach ($secundarias as $categoria): ?>
      <div class="hero-admin-card category-mini-card">
        <img src="<?= escapar(admin_ruta_imagen($categoria['imagen_referencia'] ?? null)); ?>" alt="<?= escapar($categoria['nombreCat']); ?>">
        <div class="mini-content">
          <h4><?= escapar(admin_nombre_corto_categoria($categoria['nombreCat'])); ?></h4>
          <p><?= escapar((string)$categoria['productos']); ?> productos registrados</p>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<div class="admin-grid-2">
  <div class="growth-panel" style="background:#fff;color:var(--text);border:1px solid var(--border);">
    <h4 style="color:#7d8192;">Listado editable</h4>
    <?php foreach ($categorias as $categoria): $porcentaje = $porcentajeBase > 0 ? max(12, (int)round(((float)$categoria['valor_inventario'] / $porcentajeBase) * 100)) : 12; ?>
      <div class="growth-row">
        <div class="top"><span><?= escapar($categoria['nombreCat']); ?></span><span><?= $porcentaje; ?>%</span></div>
        <div class="growth-bar"><span style="width: <?= $porcentaje; ?>%"></span></div>
        <div class="admin-small-actions" style="margin-top:8px;">
          <a class="admin-link-btn" href="categorias_admin.php?editar=<?= escapar((string)$categoria['idCategoria']); ?>">Editar</a>
          <form method="post" onsubmit="return confirm('¿Eliminar esta categoría?');">
            <input type="hidden" name="accion" value="eliminar"><input type="hidden" name="idCategoria" value="<?= escapar((string)$categoria['idCategoria']); ?>">
            <button class="admin-link-btn danger" type="submit">Eliminar</button>
          </form>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
  <div class="dark-panel">
    <h3>Resumen</h3>
    <p>Tienes <?= escapar((string)$resumen['categorias_total']); ?> categorías activas y <?= escapar((string)$resumen['productos_total']); ?> productos distribuidos en la tienda.</p>
    <div class="panel-numbers">
      <div><strong><?= escapar((string)$resumen['productos_total']); ?></strong><span>Productos</span></div>
      <div><strong><?= escapar((string)$resumen['categorias_total']); ?></strong><span>Categorías</span></div>
    </div>
  </div>
</div>
<?php render_admin_layout_fin(); ?>
