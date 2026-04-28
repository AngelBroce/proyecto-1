<?php
require_once __DIR__ . '/../funciones/dashboard.php';
require_once __DIR__ . '/../funciones/admin_analisis.php';
requiere_admin();

$datos = admin_resumen_inventario();
$marcaLider = admin_metrica_marca_lider();
$productoMayorStock = admin_metrica_mayor_stock();
$flash = admin_flash_desde_query();

render_admin_layout_inicio('dashboard', 'TechVision | Dashboard');
?>
<?php if ($flash): ?>
  <div class="admin-alert <?= escapar($flash['tipo']); ?>"><?= escapar($flash['mensaje']); ?></div>
<?php endif; ?>

<div class="admin-page-head">
  <div>
    <small>Dashboard</small>
    <h2>Dashboard</h2>
    <p>Panel exclusivo del administrador con accesos rápidos y resumen del inventario.</p>
  </div>
</div>

<div class="stats-grid">
  <div class="stat-card"><span>Valor total</span><strong><?= escapar(admin_formato_moneda((float) $datos['valor_total'])); ?></strong><em>Valor del inventario actual</em></div>
  <div class="stat-card"><span>Productos</span><strong><?= escapar((string) $datos['productos_total']); ?></strong><em>Productos registrados</em></div>
  <div class="stat-card"><span>Categorías</span><strong><?= escapar((string) $datos['categorias_total']); ?></strong><em>Categorías activas</em></div>
  <div class="stat-card"><span>Empleados</span><strong><?= escapar((string) contar_empleados_admin()); ?></strong><em>Usuarios del sistema</em></div>
</div>

<div class="admin-grid-2">
  <div class="analysis-card" style="padding: 28px;">
    <h3 style="margin-top:0;">Accesos rápidos</h3>
    <p style="color: var(--muted); margin-bottom: 22px;">Cada módulo del panel ya tiene sus funciones listas para administrar productos, categorías, marcas y análisis.</p>
    <div class="admin-actions">
      <a href="productos.php" class="admin-btn">Ir a productos</a>
      <a href="categorias_admin.php" class="admin-btn-outline">Categorías</a>
      <a href="marcas.php" class="admin-btn-outline">Marcas</a>
      <a href="analysis.php" class="admin-btn-outline">Análisis</a>
    </div>
  </div>

  <div class="analysis-card" style="padding: 28px;">
    <h3 style="margin-top:0;">Resumen destacado</h3>
    <div class="admin-simple-list">
      <div class="admin-simple-item">
        <div>
          <strong><?= escapar($marcaLider['nombreMarc'] ?? 'Sin datos'); ?></strong>
          <span>Marca con mayor valor de inventario</span>
        </div>
        <div style="text-align:right;">
          <strong><?= escapar(admin_formato_moneda((float)($marcaLider['valorInventario'] ?? 0))); ?></strong>
          <span><?= escapar((string)($marcaLider['totalProductos'] ?? 0)); ?> productos</span>
        </div>
      </div>
      <div class="admin-simple-item">
        <div>
          <strong><?= escapar($productoMayorStock['nombre'] ?? 'Sin datos'); ?></strong>
          <span>Producto con mayor stock</span>
        </div>
        <div style="text-align:right;">
          <strong><?= escapar((string)($productoMayorStock['stock'] ?? 0)); ?> und.</strong>
          <span><?= escapar($productoMayorStock['nombreMarc'] ?? ''); ?></span>
        </div>
      </div>
    </div>
  </div>
</div>
<?php render_admin_layout_fin(); ?>
