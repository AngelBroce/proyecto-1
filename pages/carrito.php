<?php
require_once __DIR__ . '/../funciones/general.php';
require_once __DIR__ . '/../funciones/carrito.php';

if (isset($_GET['add'])) {
    agregar_producto_carrito((int) $_GET['add'], 1);
    header('Location: carrito.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'] ?? '';
    $idProducto = (int) ($_POST['idProducto'] ?? 0);

    if ($accion === 'agregar' && $idProducto > 0) {
        agregar_producto_carrito($idProducto, 1);
    } elseif ($accion === 'actualizar' && $idProducto > 0) {
        $cantidad = max(0, (int) ($_POST['cantidad'] ?? 1));
        actualizar_cantidad_carrito($idProducto, $cantidad);
    } elseif ($accion === 'eliminar' && $idProducto > 0) {
        eliminar_producto_carrito($idProducto);
    } elseif ($accion === 'vaciar') {
        guardar_carrito([]);
    }

    header('Location: carrito.php');
    exit;
}

$items = obtener_items_carrito();
$total = total_carrito();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <title>TechVision | Carrito</title>
  <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;700;800&amp;family=Inter:wght@400;500;600&amp;display=swap" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
  <link href="../css/styles.css" rel="stylesheet"/>
  <script src="../js/tailwindcss.js"></script>
  <script src="../js/tailwind-config.js"></script>
</head>
<body class="bg-surface text-on-surface min-h-screen flex flex-col">
<?php render_header(''); ?>
<main class="flex-grow pt-32 pb-20 px-8 max-w-7xl mx-auto w-full">
  <div class="flex flex-col lg:flex-row gap-12">
    <div class="lg:w-2/3">
      <div class="flex items-baseline gap-4 flex-wrap">
        <a href="cat_logo.php" class="w-11 h-11 rounded-full bg-[#f4f0ff] text-[#5c33f6] flex items-center justify-center hover:bg-[#edeafd] transition-colors shrink-0" aria-label="Volver al carrito">
         <span class="material-symbols-outlined">arrow_back</span>
        </a>
        <h1 class="text-4xl font-extrabold tracking-tight text-on-surface">Carrito</h1>
        <span class="text-on-surface-variant font-medium"><?= cantidad_carrito(); ?> producto(s)</span>
      </div>

      <?php if (empty($items)): ?>
        <div class="rounded-2xl bg-surface-container-lowest p-10 text-center">
          <p class="text-2xl font-bold mb-3">Tu carrito está vacío</p>
          <p class="text-on-surface-variant mb-6">Selecciona cualquier producto del catálogo y agrégalo al carrito.</p>
          <a href="cat_logo.php" class="inline-flex items-center justify-center px-6 py-3 rounded-xl bg-[#451ebb] text-white font-bold">Ir al catálogo</a>
        </div>
      <?php else: ?>
        <div class="space-y-8">
          <?php foreach ($items as $item): $producto = $item['producto']; ?>
          <div class="flex flex-col sm:flex-row items-center gap-6 p-6 rounded-xl bg-surface-container-lowest transition-all hover:shadow-lg group">
            <a href="detalle_producto.php?id=<?= escapar((string) $producto['idProducto']); ?>" class="w-32 h-32 bg-surface-variant rounded-lg overflow-hidden flex-shrink-0 p-2 flex items-center justify-center">
              <img class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-500" src="<?= escapar(ruta_imagen_producto($producto)); ?>" alt="<?= escapar($producto['nombre']); ?>"/>
            </a>
            <div class="flex-grow w-full">
              <a href="detalle_producto.php?id=<?= escapar((string) $producto['idProducto']); ?>" class="text-xl font-bold text-on-surface mb-1 block"><?= escapar($producto['nombre']); ?></a>
              <p class="text-on-surface-variant text-sm mb-4"><?= escapar(nombre_categoria_visual($producto)); ?></p>
              <div class="flex flex-wrap items-center gap-3">
                <form method="post" class="flex items-center gap-2 bg-surface-container-low rounded-full px-3 py-2">
                  <input type="hidden" name="accion" value="actualizar">
                  <input type="hidden" name="idProducto" value="<?= escapar((string) $producto['idProducto']); ?>">
                  <span class="text-sm font-semibold">Cant.</span>
                  <input type="number" name="cantidad" min="1" max="<?= max(1, (int) ($producto['stock'] ?? 1)); ?>" value="<?= (int) $item['cantidad']; ?>" class="w-16 bg-transparent outline-none text-center font-bold">
                  <button type="submit" class="text-primary text-sm font-bold">Actualizar</button>
                </form>
                <a href="detalle_producto.php?id=<?= escapar((string) $producto['idProducto']); ?>" class="text-primary text-sm font-medium">Ver detalles</a>
                <form method="post">
                  <input type="hidden" name="accion" value="eliminar">
                  <input type="hidden" name="idProducto" value="<?= escapar((string) $producto['idProducto']); ?>">
                  <button type="submit" class="text-red-500 text-sm font-medium">Eliminar</button>
                </form>
              </div>
            </div>
            <div class="text-right sm:ml-auto min-w-[140px]">
              <p class="text-sm text-on-surface-variant">$<?= number_format((float) $item['precio'], 2); ?> c/u</p>
              <p class="text-2xl font-black text-on-surface tracking-tight">$<?= number_format((float) $item['subtotal'], 2); ?></p>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </div>
    <div class="lg:w-1/3">
      <div class="bg-surface-container-low p-8 rounded-2xl sticky top-32 border border-outline-variant/10">
        <h2 class="text-2xl font-bold text-on-surface mb-8">Resumen de compra</h2>
        <div class="space-y-4 mb-8">
          <div class="flex justify-between text-on-surface-variant font-medium"><span>Subtotal</span><span>$<?= number_format($total, 2); ?></span></div>
          <div class="flex justify-between text-on-surface-variant font-medium"><span>Envío</span><span class="text-primary font-bold">Gratis</span></div>
          <div class="flex justify-between text-on-surface font-black text-xl border-t pt-4"><span>Total</span><span>$<?= number_format($total, 2); ?></span></div>
        </div>
        <a href="<?= empty($items) ? 'cat_logo.php' : 'checkout.php'; ?>" class="w-full block text-center py-4 rounded-xl bg-[#451ebb] text-white font-bold mb-3"><?= empty($items) ? 'Explorar productos' : 'Continuar al pago'; ?></a>
        <?php if (!empty($items)): ?>
          <a href="cat_logo.php" class="w-full block text-center py-3 rounded-xl bg-[#f4f0ff] text-[#451ebb] font-bold mb-3 hover:bg-[#edeafd] transition-colors">Seguir comprando</a>
          <form id="form-cancelar-pedido" method="post">
            <input type="hidden" name="accion" value="vaciar">
            <button type="button" id="btn-cancelar-pedido" class="w-full block text-center py-3 rounded-xl bg-red-50 text-red-600 font-bold hover:bg-red-100 transition-colors">Cancelar pedido</button>
          </form>
        <?php endif; ?>
      </div>
    </div>
  </div>
</main>

<!-- Modal personalizado para cancelar pedido -->
<div id="modal-cancelar" class="modal-cancelar hidden">
  <div class="modal-content">
    <h2>¿Estás seguro?</h2>
    <p>¿Deseas cancelar el pedido y vaciar el carrito?</p>
    <div class="modal-actions">
      <button id="btn-aceptar-cancelar" class="btn-aceptar">Aceptar</button>
      <button id="btn-cerrar-cancelar" class="btn-cerrar">Cancelar</button>
    </div>
  </div>
</div>

<script>
  // Mostrar el modal al hacer clic en "Cancelar pedido"
  document.getElementById('btn-cancelar-pedido').addEventListener('click', function(e) {
    e.preventDefault();
    document.getElementById('modal-cancelar').classList.remove('hidden');
  });

  // Cerrar el modal
  document.getElementById('btn-cerrar-cancelar').addEventListener('click', function() {
    document.getElementById('modal-cancelar').classList.add('hidden');
  });

  // Acción de aceptar: enviar el formulario
  document.getElementById('btn-aceptar-cancelar').addEventListener('click', function() {
    document.getElementById('form-cancelar-pedido').submit();
  });
</script>

</body>
</html>
