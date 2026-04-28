<?php
require_once __DIR__ . '/../funciones/dashboard.php';
require_once __DIR__ . '/../funciones/admin_productos.php';
requiere_admin();

$mensaje = '';
$tipo = 'ok';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'] ?? '';
    if ($accion === 'crear') {
        [$ok, $mensaje] = admin_crear_producto($_POST);
        $tipo = $ok ? 'ok' : 'error';
    } elseif ($accion === 'actualizar') {
        [$ok, $mensaje] = admin_actualizar_producto((int)($_POST['idProducto'] ?? 0), $_POST);
        $tipo = $ok ? 'ok' : 'error';
    } elseif ($accion === 'eliminar') {
        [$ok, $mensaje] = admin_eliminar_producto((int)($_POST['idProducto'] ?? 0));
        $tipo = $ok ? 'ok' : 'error';
    }
}

$buscar = trim($_GET['buscar'] ?? '');
$editarId = (int)($_GET['editar'] ?? 0);
$productoEditar = $editarId > 0 ? admin_obtener_producto($editarId) : null;
$resumen = admin_resumen_inventario();
$productos = admin_listar_productos($buscar);
$categorias = obtener_categorias();
$marcas = obtener_marcas();

render_admin_layout_inicio('productos', 'TechVision | Productos');
?>
<?php if ($mensaje !== ''): ?>
  <div class="admin-alert <?= escapar($tipo); ?>"><?= escapar($mensaje); ?></div>
<?php endif; ?>
<div class="admin-page-head">
  <div>
    <small>Administrador / Productos</small>
    <h2>Gestión de productos</h2>
    <p>Consulta, crea, actualiza y elimina productos usando la base de datos real.</p>
  </div>
</div>

<div class="stats-grid">
  <div class="stat-card"><span>Valor total</span><strong><?= escapar(admin_formato_moneda($resumen['valor_total'])); ?></strong><em>Inventario valorizado</em></div>
  <div class="stat-card"><span>Stock total</span><strong><?= escapar(number_format($resumen['stock_total'])); ?></strong><em>Unidades disponibles</em></div>
  <div class="stat-card"><span>Categorías</span><strong><?= escapar((string) $resumen['categorias_total']); ?></strong><em>Se usan en el formulario</em></div>
  <div class="stat-card"><span>Alertas</span><strong><?= escapar((string) $resumen['alertas_total']); ?></strong><em>Productos con stock bajo</em></div>
</div>

<div class="admin-form-card">
  <h3 style="margin-top:0;"><?= $productoEditar ? 'Editar producto' : 'Nuevo producto'; ?></h3>
  <form method="post" enctype="multipart/form-data">
    <input type="hidden" name="accion" value="<?= $productoEditar ? 'actualizar' : 'crear'; ?>">
    <?php if ($productoEditar): ?>
      <input type="hidden" name="idProducto" value="<?= escapar((string)$productoEditar['idProducto']); ?>">
    <?php endif; ?>
    <div class="admin-form-grid cols-3">
      <div class="admin-form-field">
        <label>Nombre</label>
        <input type="text" name="nombre" value="<?= escapar($productoEditar['nombre'] ?? ''); ?>" required>
      </div>
      <div class="admin-form-field">
        <label>Unidad</label>
        <input type="text" name="unidad" value="<?= escapar($productoEditar['unidad'] ?? 'UND'); ?>" required>
      </div>
      <div class="admin-form-field">
        <label>Imagen</label>
        <div class="input-file-wrapper" style="position: relative; width: 100%; max-width: 350px;">
          <input type="file" name="imagen" id="input-imagen" class="input-file" accept="image/*" style="opacity:0;position:absolute;left:0;top:0;width:100%;height:100%;z-index:2;cursor:pointer;">
          <label for="input-imagen" class="input-file-label" style="display:flex;align-items:center;gap:12px;background:#f4f0ff;color:#5c33f6;border:2px solid #e7e6f2;border-radius:12px;padding:10px 18px;font-weight:500;cursor:pointer;transition:border 0.2s,background 0.2s;min-height:44px;width:100%;box-sizing:border-box;position:relative;z-index:1;">
            <span class="icon material-symbols-outlined" style="font-size:22px;margin-right:8px;">upload</span>
            <span id="input-file-name" class="input-file-name" style="color:#333;font-size:15px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:180px;">Seleccionar imagen...</span>
          </label>
        </div>
        <?php if (!empty($productoEditar['imagen'])): ?>
          <div style="margin-top:8px;">
            <span style="font-size:13px;">Imagen actual:</span><br>
            <img src="<?= escapar(admin_ruta_imagen($productoEditar['imagen'])); ?>" alt="Imagen actual" style="max-width:100px;max-height:100px;border-radius:8px;border:1px solid #eee;">
            <div style="font-size:12px;color:#888;word-break:break-all;">(<?= escapar($productoEditar['imagen']); ?>)</div>
          </div>
        <?php endif; ?>
      </div>
      <script>
        function formatPriceInput(input) {
          let v = input.value.replace(/[^0-9.]/g, '');
          let parts = v.split('.');
          if (parts.length > 2) {
            parts.pop();
            v = parts.join('.') + '.';
          }
          if (v.startsWith('.')) {
            v = '0' + v;
          }
          if (v.length > 1 && v.startsWith('0') && !v.startsWith('0.')) {
            v = v.replace(/^0+/, '');
            if (v === '') v = '0';
            if (v.startsWith('.')) v = '0' + v;
          }
          if (v.includes('.')) {
            let p = v.split('.');
            if (p[1].length > 2) {
              v = p[0] + '.' + p[1].substring(0, 2);
            }
          }
          input.value = v;
        }

        function formatPriceBlur(input) {
          if (input.value !== '' && !isNaN(input.value)) {
            input.value = parseFloat(input.value).toFixed(2);
          }
        }

        function formatStockInput(input) {
          let v = input.value.replace(/[^0-9]/g, '');
          if (v.length > 1 && v.startsWith('0')) {
            v = v.replace(/^0+/, '');
            if (v === '') v = '0';
          }
          input.value = v;
        }

        // Mostrar el nombre del archivo seleccionado
        document.addEventListener('DOMContentLoaded', function() {
          var input = document.getElementById('input-imagen');
          var fileName = document.getElementById('input-file-name');
          if(input && fileName) {
            input.addEventListener('change', function() {
              if (input.files.length > 0) {
                fileName.textContent = input.files[0].name;
              } else {
                fileName.textContent = 'Seleccionar imagen...';
              }
            });
          }
        });
      </script>
      <div class="admin-form-field full">
        <label>Descripción</label>
        <textarea name="descripcion" required><?= escapar($productoEditar['descripcion'] ?? ''); ?></textarea>
      </div>
      <div class="admin-form-field">
        <label>Stock</label>
        <input type="text" inputmode="numeric" name="stock" value="<?= escapar((string)($productoEditar['stock'] ?? 0)); ?>" required oninput="formatStockInput(this)">
      </div>
      <div class="admin-form-field">
        <label>Precio costo</label>
        <input type="text" inputmode="decimal" name="precioCosto" value="<?= isset($productoEditar['precioCosto']) ? number_format((float)$productoEditar['precioCosto'], 2, '.', '') : ''; ?>" required oninput="formatPriceInput(this)" onblur="formatPriceBlur(this)">
      </div>
      <div class="admin-form-field">
        <label>Precio venta</label>
        <input type="text" inputmode="decimal" name="precioVenta" value="<?= isset($productoEditar['precioVenta']) ? number_format((float)$productoEditar['precioVenta'], 2, '.', '') : ''; ?>" required oninput="formatPriceInput(this)" onblur="formatPriceBlur(this)">
      </div>
      <div class="admin-form-field">
        <label>Categoría</label>
        <select name="idCategoria" required>
          <option value="">Seleccione</option>
          <?php foreach ($categorias as $categoria): ?>
            <option value="<?= escapar((string)$categoria['idCategoria']); ?>" <?= ((string)($productoEditar['idCategoria'] ?? '') === (string)$categoria['idCategoria']) ? 'selected' : ''; ?>><?= escapar($categoria['nombreCat']); ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="admin-form-field">
        <label>Marca</label>
        <select name="idMarca" required>
          <option value="">Seleccione</option>
          <?php foreach ($marcas as $marca): ?>
            <option value="<?= escapar((string)$marca['idMarca']); ?>" <?= ((string)($productoEditar['idMarca'] ?? '') === (string)$marca['idMarca']) ? 'selected' : ''; ?>><?= escapar($marca['nombreMarc']); ?></option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>
    <div class="admin-form-actions">
      <button class="admin-btn" type="submit"><?= $productoEditar ? 'Guardar cambios' : 'Crear producto'; ?></button>
      <?php if ($productoEditar): ?><a class="admin-btn-outline" href="productos.php">Cancelar edición</a><?php endif; ?>
    </div>
  </form>
</div>

<div class="product-table-card">
  <div style="display:flex;justify-content:space-between;gap:16px;align-items:center;margin-bottom:16px;flex-wrap:wrap;">
    <h3 style="margin:0;">Listado de productos</h3>
    <form method="get" style="display:flex;gap:10px;flex-wrap:wrap;">
      <input type="text" name="buscar" value="<?= escapar($buscar); ?>" placeholder="Buscar producto" style="border:1px solid #e7e6f2;background:#fafaff;border-radius:14px;padding:12px 14px;min-width:240px;">
      <button class="admin-btn-outline" type="submit">Buscar</button>
      <?php if ($buscar !== ''): ?><a class="admin-btn-outline" href="productos.php">Limpiar</a><?php endif; ?>
    </form>
  </div>
  <div class="table-wrap">
    <table>
      <thead>
        <tr><th>Producto</th><th>Categoría</th><th>Stock</th><th>Precio</th><th>Estado</th><th>Acciones</th></tr>
      </thead>
      <tbody>
      <?php foreach ($productos as $producto): ?>
        <tr>
          <td><div class="product-cell"><img class="product-thumb" src="<?= escapar(admin_ruta_imagen($producto['imagen'] ?? null)); ?>" alt="<?= escapar($producto['nombre']); ?>"><div><div class="product-name"><?= escapar($producto['nombre']); ?></div><span class="product-meta">SKU: <?= escapar((string)$producto['idProducto']); ?> · <?= escapar($producto['nombreMarc']); ?></span></div></div></td>
          <td><span class="badge-soft"><?= escapar(admin_nombre_corto_categoria($producto['nombreCat'])); ?></span></td>
          <td><?= escapar((string)$producto['stock']); ?> und.</td>
          <td>$<?= escapar(number_format((float)$producto['precioVenta'],2)); ?></td>
          <td><span><span class="status-dot <?= ((int)$producto['stock'] > 5) ? 'status-ok' : 'status-low'; ?>"></span><?= ((int)$producto['stock'] > 5) ? 'ACTIVO' : 'BAJO'; ?></span></td>
          <td>
            <div class="admin-small-actions">
              <a class="admin-link-btn" href="productos.php?editar=<?= escapar((string)$producto['idProducto']); ?>">Editar</a>
              <a class="admin-link-btn" href="detalle_producto.php?id=<?= escapar((string)$producto['idProducto']); ?>">Detalle</a>
              <form method="post" onsubmit="return confirm('¿Eliminar este producto?');">
                <input type="hidden" name="accion" value="eliminar"><input type="hidden" name="idProducto" value="<?= escapar((string)$producto['idProducto']); ?>">
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
