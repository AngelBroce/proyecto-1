<?php
require_once __DIR__ . '/../funciones/general.php';
require_once __DIR__ . '/../funciones/productos.php';
require_once __DIR__ . '/../funciones/carrito.php';

$idProducto = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$producto = $idProducto ? obtener_producto_por_id($idProducto) : null;

if (!$producto) {
    $productos = obtener_productos();
    $producto = $productos[0] ?? null;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $producto) {
    $cantidad = max(1, (int) ($_POST['cantidad'] ?? 1));
    agregar_producto_carrito((int) $producto['idProducto'], $cantidad);
    header('Location: carrito.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <title>TechVision | Detalle de producto</title>
  <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200;400;500;700;800&amp;family=Inter:wght@300;400;500;600&amp;display=swap" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
  <link href="../css/styles.css" rel="stylesheet"/>
  <script src="../js/tailwindcss.js"></script>
  <script src="../js/tailwind-config.js"></script>
</head>
<body class="bg-surface text-on-surface font-body">
<?php render_header('catalogo'); ?>
<main class="pt-24 pb-20">
  <?php if ($producto): ?>
  <section class="max-w-7xl mx-auto px-8 lg:pt-12 grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
    <div class="lg:col-span-7 relative group">
      <div class="bg-surface-container-low rounded-xl overflow-hidden aspect-[4/3] flex items-center justify-center p-12">
        <img alt="<?= escapar($producto['nombre']); ?>" class="w-full h-full object-contain transition-transform duration-700 group-hover:scale-105" src="<?= escapar(ruta_imagen_producto($producto)); ?>"/>
      </div>
    </div>
    <div class="lg:col-span-5 flex flex-col gap-8 lg:pl-8">
      <div class="space-y-2">
        <p class="text-primary font-bold tracking-widest uppercase text-xs"><?= escapar(nombre_categoria_visual($producto)); ?></p>
        <h1 class="font-headline font-extrabold text-5xl tracking-tight text-on-surface leading-tight"><?= escapar($producto['nombre']); ?></h1>
      </div>
      <div class="space-y-6">
        <div class="flex flex-col">
          <span class="font-headline font-black text-6xl text-on-surface tracking-tighter">$<?= number_format((float) $producto['precioVenta'], 2); ?></span>
        </div>
        <p class="text-on-surface-variant leading-relaxed font-light text-lg"><?= escapar($producto['descripcion']); ?></p>
        <p class="text-sm text-on-surface-variant">Stock disponible: <?= escapar($producto['stock']); ?> unidades</p>
      </div>
      <form method="post" class="flex gap-4 flex-wrap items-center">
        <label class="flex items-center gap-2 bg-surface-container-highest rounded-lg px-4 py-3">
          <span class="text-sm font-semibold">Cantidad</span>
          <input type="number" name="cantidad" min="1" max="<?= max(1, (int) ($producto['stock'] ?? 1)); ?>" value="1" class="w-20 bg-transparent outline-none text-center font-bold">
        </label>
        <button type="submit" class="px-8 py-4 bg-primary text-on-primary rounded-lg font-bold hover:shadow-xl transition-all">Añadir al carrito</button>
        <a href="cat_logo.php?categoria=<?= escapar((string) $producto['idCategoria']); ?>" class="px-8 py-4 bg-surface-container-highest text-primary rounded-lg font-bold">Volver al catálogo</a>
      </form>
    </div>
  </section>
  <?php endif; ?>
</main>
</body>
</html>
