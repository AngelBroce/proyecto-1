<?php
require_once __DIR__ . '/../funciones/general.php';
require_once __DIR__ . '/../funciones/productos.php';

$productos = obtener_productos();
$destacados = obtener_productos_destacados(4);
$productoHero = $destacados[0] ?? ($productos[0] ?? null);
$categorias = obtener_categorias();
?>
<!DOCTYPE html>
<html class="light" lang="es">
<head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <title>TechVision | Inicio</title>
  <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;700;800&amp;family=Inter:wght@400;500;600&amp;display=swap" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
  <link href="../css/styles.css" rel="stylesheet"/>
  <script src="../js/tailwindcss.js"></script>
  <script src="../js/tailwind-config.js"></script>
</head>
<body class="bg-surface text-on-surface selection:bg-primary-fixed selection:text-on-primary-fixed">
<?php render_header('inicio'); ?>
<main class="pt-24">
  <?php if ($productoHero): ?>
  <section class="px-8 py-12">
    <div class="relative overflow-hidden rounded-xl hero-gradient min-h-[520px] flex items-center">
      <div class="grid lg:grid-cols-2 w-full px-12 gap-12 z-10 items-center">
        <div class="flex flex-col justify-center text-on-primary">
          <span class="font-label uppercase tracking-widest text-primary-fixed mb-4">Producto destacado</span>
          <h1 class="font-headline font-extrabold text-5xl md:text-6xl mb-6 leading-tight"><?= escapar($productoHero['nombre']); ?></h1>
          <p class="font-body text-lg text-primary-fixed/80 max-w-md mb-8"><?= escapar($productoHero['descripcion']); ?></p>
          <div class="flex gap-4 flex-wrap">
            <a href="detalle_producto.php?id=<?= escapar($productoHero['idProducto']); ?>" class="bg-surface-container-lowest text-primary px-8 py-4 rounded-lg font-bold shadow-lg hover:scale-105 transition-transform active:scale-95">Ver detalles</a>
            <a href="carrito.php?add=<?= escapar((string) $productoHero['idProducto']); ?>" class="border border-primary-fixed/30 text-primary-fixed px-8 py-4 rounded-lg font-bold hover:bg-primary-container/50 transition-colors">Añadir al carrito</a>
          </div>
        </div>
        <div class="relative flex justify-center items-center">
          <div class="absolute inset-0 bg-white/10 blur-3xl rounded-full scale-75"></div>
          <img alt="<?= escapar($productoHero['nombre']); ?>" class="relative z-10 w-full max-w-md h-[360px] object-contain transform hover:rotate-2 transition-transform duration-700" src="<?= escapar(ruta_imagen_producto($productoHero)); ?>"/>
        </div>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <section class="px-8 py-20">
    <div class="text-center mb-16">
      <h2 class="font-headline text-5xl font-black text-on-surface tracking-tight">Selección Editorial</h2>
      <p class="text-on-surface-variant font-body mt-4 text-lg">Productos reales del inventario cargados desde la carpeta de productos.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-8">
      <?php foreach ($destacados as $index => $producto): ?>
      <article class="group bg-surface-container-lowest rounded-xl overflow-hidden shadow-[0_40px_60px_-15px_rgba(19,27,46,0.04)] p-4 flex flex-col">
        <div class="bg-[#eff1fb] rounded-xl overflow-hidden h-[380px] flex items-center justify-center mb-6 relative">
          <?php if ($index === 0): ?>
          <span class="absolute top-4 right-4 bg-[#451ebb] text-white px-4 py-1 rounded-full text-xs font-bold uppercase">Nuevo</span>
          <?php endif; ?>
          <img alt="<?= escapar($producto['nombre']); ?>" class="w-full h-full object-contain p-4 group-hover:scale-105 transition-transform duration-500" src="<?= escapar(ruta_imagen_producto($producto)); ?>"/>
        </div>
        <p class="text-sm uppercase text-on-surface-variant mb-2"><?= escapar(nombre_categoria_visual($producto)); ?> / TECHVISION</p>
        <h3 class="font-headline font-bold text-2xl text-on-surface mb-4"><?= escapar($producto['nombre']); ?></h3>
        <div class="mt-auto flex items-center justify-between gap-4">
          <span class="text-primary font-extrabold text-3xl">$<?= number_format((float) $producto['precioVenta'], 2); ?></span>
          <a href="carrito.php?add=<?= escapar((string) $producto['idProducto']); ?>" class="w-12 h-12 rounded-xl bg-[#e7e8fa] flex items-center justify-center text-[#451ebb] hover:scale-105 transition-transform" aria-label="Añadir al carrito">
            <span class="material-symbols-outlined">shopping_cart</span>
          </a>
        </div>
      </article>
      <?php endforeach; ?>
    </div>
  </section>

  <section class="px-8 py-16 bg-surface-container-low">
    <div class="mb-12 flex justify-between items-end gap-6 flex-wrap">
      <div>
        <h2 class="font-headline text-3xl font-black text-on-surface">Explora por Categoría</h2>
        <p class="text-on-surface-variant font-body mt-2">Cada bloque usa una imagen real de la misma categoría.</p>
      </div>
      <a class="text-primary font-bold flex items-center gap-2 hover:underline" href="cat_logo.php">Ver catálogo completo <span class="material-symbols-outlined">arrow_forward</span></a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <?php foreach ($categorias as $categoria): ?>
        <?php $productosCategoria = obtener_productos_por_categoria((int) $categoria['idCategoria'], 1); $productoCategoria = $productosCategoria[0] ?? null; ?>
        <?php if ($productoCategoria): ?>
        <a href="cat_logo.php?categoria=<?= escapar($categoria['idCategoria']); ?>" class="bg-surface-container-lowest rounded-xl p-6 flex flex-col sm:flex-row items-center gap-6 hover:shadow-xl transition-all overflow-hidden min-h-[260px]">
          <div class="flex-1">
            <h3 class="font-headline text-3xl font-bold text-on-surface"><?= escapar(ucfirst($categoria['nombreCat'])); ?></h3>
            <p class="text-on-surface-variant mt-2 text-base">Producto de ejemplo: <?= escapar($productoCategoria['nombre']); ?></p>
          </div>
          <div class="w-full sm:w-[280px] h-[220px] bg-[#eff1fb] rounded-xl overflow-hidden flex items-center justify-center p-4">
            <img alt="<?= escapar($productoCategoria['nombre']); ?>" class="w-full h-full object-contain" src="<?= escapar(ruta_imagen_producto($productoCategoria)); ?>"/>
          </div>
        </a>
        <?php endif; ?>
      <?php endforeach; ?>
    </div>
  </section>
</main>
</body>
</html>
