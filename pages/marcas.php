<?php
require_once __DIR__ . '/../funciones/dashboard.php';
require_once __DIR__ . '/../funciones/admin_marcas.php';
requiere_admin();

$mensaje = '';
$tipo = 'ok';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'] ?? '';
    if ($accion === 'crear') {
        [$ok, $mensaje] = admin_crear_marca($_POST['nombreMarc'] ?? '');
        $tipo = $ok ? 'ok' : 'error';
    } elseif ($accion === 'actualizar') {
        [$ok, $mensaje] = admin_actualizar_marca((int)($_POST['idMarca'] ?? 0), $_POST['nombreMarc'] ?? '');
        $tipo = $ok ? 'ok' : 'error';
    } elseif ($accion === 'eliminar') {
        [$ok, $mensaje] = admin_eliminar_marca((int)($_POST['idMarca'] ?? 0));
        $tipo = $ok ? 'ok' : 'error';
    }
}

$editarId = (int)($_GET['editar'] ?? 0);
$marcaEditar = $editarId > 0 ? admin_obtener_marca($editarId) : null;
$marcas = admin_listar_marcas_panel();

render_admin_layout_inicio('marcas', 'TechVision | Marcas');
?>
<?php if ($mensaje !== ''): ?><div class="admin-alert <?= escapar($tipo); ?>"><?= escapar($mensaje); ?></div><?php endif; ?>
<div class="admin-page-head">
  <div>
    <small>Administrador / Marcas</small>
    <h2>Gestión de marcas</h2>
    <p>Nueva página para administrar las marcas de los productos del sistema.</p>
  </div>
</div>
<div class="admin-grid-2">
  <div class="admin-form-card">
    <h3 style="margin-top:0;"><?= $marcaEditar ? 'Editar marca' : 'Nueva marca'; ?></h3>
    <form method="post">
      <input type="hidden" name="accion" value="<?= $marcaEditar ? 'actualizar' : 'crear'; ?>">
      <?php if ($marcaEditar): ?><input type="hidden" name="idMarca" value="<?= escapar((string)$marcaEditar['idMarca']); ?>"><?php endif; ?>
      <div class="admin-form-grid">
        <div class="admin-form-field full">
          <label>Nombre de la marca</label>
          <input type="text" name="nombreMarc" value="<?= escapar($marcaEditar['nombreMarc'] ?? ''); ?>" required>
        </div>
      </div>
      <div class="admin-form-actions">
        <button class="admin-btn" type="submit"><?= $marcaEditar ? 'Guardar cambios' : 'Crear marca'; ?></button>
        <?php if ($marcaEditar): ?><a class="admin-btn-outline" href="marcas.php">Cancelar edición</a><?php endif; ?>
      </div>
    </form>
  </div>
  <div class="analysis-card">
    <h3>Resumen de marcas</h3>
    <div class="admin-simple-list">
      <?php foreach (array_slice($marcas, 0, 4) as $marca): ?>
        <div class="admin-simple-item">
          <div>
            <strong><?= escapar($marca['nombreMarc']); ?></strong>
            <span><?= escapar((string)$marca['totalProductos']); ?> productos</span>
          </div>
          <div style="text-align:right;">
            <strong><?= escapar(admin_formato_moneda((float)$marca['valorInventario'])); ?></strong>
            <span><?= escapar((string)$marca['stockTotal']); ?> und.</span>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>

<div class="product-table-card">
  <div class="table-wrap">
    <table>
      <thead><tr><th>Marca</th><th>Productos</th><th>Stock</th><th>Valor</th><th>Acciones</th></tr></thead>
      <tbody>
      <?php foreach ($marcas as $marca): ?>
        <tr>
          <td><div class="product-cell"><img class="product-thumb" src="<?= escapar(admin_ruta_imagen($marca['imagenReferencia'] ?? null)); ?>" alt="<?= escapar($marca['nombreMarc']); ?>"><div><div class="product-name"><?= escapar($marca['nombreMarc']); ?></div><span class="product-meta">ID marca: <?= escapar((string)$marca['idMarca']); ?></span></div></div></td>
          <td><?= escapar((string)$marca['totalProductos']); ?></td>
          <td><?= escapar((string)$marca['stockTotal']); ?> und.</td>
          <td><?= escapar(admin_formato_moneda((float)$marca['valorInventario'])); ?></td>
          <td>
            <div class="admin-small-actions">
              <a class="admin-link-btn" href="marcas.php?editar=<?= escapar((string)$marca['idMarca']); ?>">Editar</a>
              <form method="post" onsubmit="return confirm('¿Eliminar esta marca?');">
                <input type="hidden" name="accion" value="eliminar"><input type="hidden" name="idMarca" value="<?= escapar((string)$marca['idMarca']); ?>">
                <button class="admin-link-btn danger" type="submit">Eliminar</button>
              </form>
            </div>
          </td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
<?php render_admin_layout_fin(); ?>
