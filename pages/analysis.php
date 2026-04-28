<?php
require_once __DIR__ . '/../funciones/dashboard.php';
require_once __DIR__ . '/../funciones/admin_analisis.php';
requiere_admin();

$categorias = admin_analisis_categorias();
$premium = admin_productos_premium(5);
$maxValor = max(array_map(fn($item) => (float) $item['valor_total'], $categorias) ?: [1]);
$marcaLider = admin_metrica_marca_lider();
$topStock = admin_metrica_mayor_stock();

render_admin_layout_inicio('analisis', 'TechVision | Análisis');
?>
<div class="admin-page-head">
  <div>
    <small>Análisis</small>
    <h2>Análisis de inventario</h2>
    <p>Vista analítica del valor por categoría, marcas y productos más relevantes.</p>
  </div>
</div>
<div class="stats-grid">
  <div class="stat-card"><span>Marca líder</span><strong><?= escapar($marcaLider['nombreMarc'] ?? 'N/D'); ?></strong><em><?= escapar(admin_formato_moneda((float)($marcaLider['valorInventario'] ?? 0))); ?></em></div>
  <div class="stat-card"><span>Mayor stock</span><strong><?= escapar((string)($topStock['stock'] ?? 0)); ?></strong><em><?= escapar($topStock['nombre'] ?? 'N/D'); ?></em></div>
  <div class="stat-card"><span>Categorías</span><strong><?= escapar((string)count($categorias)); ?></strong><em>Con datos analizados</em></div>
  <div class="stat-card"><span>Premium</span><strong><?= escapar((string)count($premium)); ?></strong><em>Productos de mayor valor</em></div>
</div>
<div class="analysis-layout">
  <div class="analysis-card">
    <h3>Rendimiento por categoría</h3>
    <div class="category-bars">
      <?php foreach ($categorias as $categoria): $ancho = $maxValor > 0 ? max(10, (int) round(((float) $categoria['valor_total'] / $maxValor) * 100)) : 10; ?>
        <div class="category-bar-row">
          <div class="labels"><strong><?= escapar(admin_nombre_corto_categoria($categoria['nombreCat'])); ?></strong><span><?= escapar(admin_formato_moneda((float)$categoria['valor_total'])); ?></span></div>
          <div class="category-bar"><span style="width: <?= $ancho; ?>%"></span></div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
  <div class="analysis-card">
    <h3>Productos premium</h3>
    <div class="analysis-list">
      <?php foreach ($premium as $producto): ?>
        <div class="analysis-item">
          <img class="analysis-thumb" src="<?= escapar(admin_ruta_imagen($producto['imagen'] ?? null)); ?>" alt="<?= escapar($producto['nombre']); ?>">
          <div class="analysis-title"><strong><?= escapar($producto['nombre']); ?></strong><span><?= escapar($producto['nombreMarc']); ?> · <?= escapar($producto['nombreCat']); ?></span></div>
          <div class="analysis-meta"><strong>$<?= escapar(number_format((float)$producto['precioVenta'], 2)); ?></strong><span><?= escapar((string)$producto['stock']); ?> und.</span></div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>
<?php render_admin_layout_fin(); ?>
