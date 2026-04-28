<?php
require_once __DIR__ . '/../funciones/general.php';
require_once __DIR__ . '/../funciones/productos.php';

$categorias = obtener_categorias();
$marcas = obtener_marcas();
$rangosPrecio = obtener_rangos_precio();

$categoriaSeleccionada = isset($_GET['categoria']) ? (int) $_GET['categoria'] : 0;
$marcasSeleccionadas = isset($_GET['marca']) && is_array($_GET['marca']) ? array_map('intval', $_GET['marca']) : [];
$rangoSeleccionado = isset($_GET['precio']) ? (string) $_GET['precio'] : '';
$busqueda = isset($_GET['busqueda']) ? trim((string)$_GET['busqueda']) : '';

$productos = obtener_productos_filtrados($categoriaSeleccionada, $marcasSeleccionadas, $rangoSeleccionado, $busqueda);
$productoPrincipal = $productos[0] ?? null;
$productoSecundario = $productos[1] ?? null;
$productosSecundarios = array_slice($productos, 2, 4);
$categoriaActual = $categoriaSeleccionada > 0 ? obtener_categoria_por_id($categoriaSeleccionada) : null;

$tituloCatalogo = $categoriaActual ? ucfirst((string) $categoriaActual['nombreCat']) : 'Catálogo completo';
$subtituloCatalogo = $categoriaActual
    ? 'Explora la selección disponible en la categoría elegida usando productos reales de tu base de datos.'
    : 'Explora productos reales de tu inventario, filtrados por categoría, marca y rango de precio.';
?>
<!DOCTYPE html>
<html class="light" lang="es">
<head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <title>TechVision | Catálogo</title>
  <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
  <link href="../css/styles.css" rel="stylesheet"/>
  <script src="../js/tailwindcss.js"></script>
  <script src="../js/tailwind-config.js"></script>
</head>
<body class="bg-[#f6f4fc] text-[#1b2136] selection:bg-primary-fixed selection:text-on-primary-fixed">
<?php render_header('catalogo'); ?>
<main class="pt-24 pb-0 min-h-screen">
  <div class="max-w-[1600px] mx-auto px-4 md:px-6 lg:px-8">
    <div class="grid grid-cols-1 xl:grid-cols-[290px_1fr] gap-6 items-start">
      <aside class="xl:sticky xl:top-28 bg-[#fbfaff] border border-[#ebe7f8] rounded-[24px] p-6 shadow-[0_24px_50px_-30px_rgba(34,28,74,0.3)]">
        <div class="mb-8">
          <h2 class="font-headline text-2xl font-extrabold text-[#202640]">Filtrar Catálogo</h2>
          <p class="text-sm text-[#73708b] mt-1">Refina la búsqueda</p>
        </div>

        <form id="catalogoFiltros" action="cat_logo.php" method="get" class="space-y-8">
          <div>
            <h3 class="font-bold text-[#2f3550] mb-3">Categoría</h3>
            <div class="space-y-2">
              <label class="flex items-center gap-3 text-sm text-[#55536a]">
                <input type="radio" name="categoria" value="0" class="accent-[#5b34ea] filtro-auto" <?= $categoriaSeleccionada === 0 ? 'checked' : ''; ?> />
                <span>Todo</span>
              </label>
              <?php foreach ($categorias as $categoria): ?>
                <label class="flex items-center gap-3 text-sm text-[#55536a]">
                  <input type="radio" name="categoria" value="<?= escapar((string) $categoria['idCategoria']); ?>" class="accent-[#5b34ea] filtro-auto" <?= $categoriaSeleccionada === (int) $categoria['idCategoria'] ? 'checked' : ''; ?> />
                  <span><?= escapar(ucfirst($categoria['nombreCat'])); ?></span>
                </label>
              <?php endforeach; ?>
            </div>
          </div>

          <div>
            <h3 class="font-bold text-[#2f3550] mb-3">Marca</h3>
            <div class="space-y-2 max-h-56 overflow-auto pr-2">
              <?php foreach ($marcas as $marca): ?>
                <label class="flex items-center gap-3 text-sm text-[#55536a]">
                  <input type="checkbox" name="marca[]" value="<?= escapar((string) $marca['idMarca']); ?>" class="accent-[#5b34ea] filtro-auto" <?= in_array((int) $marca['idMarca'], $marcasSeleccionadas, true) ? 'checked' : ''; ?> />
                  <span><?= escapar($marca['nombreMarc']); ?></span>
                </label>
              <?php endforeach; ?>
            </div>
          </div>

          <div>
            <h3 class="font-bold text-[#2f3550] mb-3">Rango de precio</h3>
            <div class="space-y-2">
              <label class="flex items-center gap-3 text-sm text-[#55536a]">
                <input type="radio" name="precio" value="" class="accent-[#5b34ea] filtro-auto" <?= $rangoSeleccionado === '' ? 'checked' : ''; ?> />
                <span>Cualquier precio</span>
              </label>
              <?php foreach ($rangosPrecio as $clave => $rango): ?>
                <label class="flex items-center gap-3 text-sm text-[#55536a]">
                  <input type="radio" name="precio" value="<?= escapar($clave); ?>" class="accent-[#5b34ea] filtro-auto" <?= $rangoSeleccionado === $clave ? 'checked' : ''; ?> />
                  <span><?= escapar($rango['label']); ?></span>
                </label>
              <?php endforeach; ?>
            </div>
          </div>

          <div class="space-y-3 pt-2">
            <p class="text-sm text-[#7a7690] leading-6">Los filtros se aplican automáticamente apenas selecciones una opción.</p>
            <a href="cat_logo.php" class="block w-full rounded-2xl bg-[#eeebfb] text-[#5b34ea] font-bold py-3.5 text-center">Limpiar filtros</a>
          </div>
        </form>
      </aside>

      <section>
        <div class="bg-[#fbfaff] border border-[#ebe7f8] rounded-[28px] p-6 md:p-8 shadow-[0_24px_50px_-30px_rgba(34,28,74,0.25)]">
          <form method="get" action="cat_logo.php" class="mb-6 flex flex-col sm:flex-row gap-3 items-stretch">
            <input type="text" name="busqueda" value="<?= escapar($busqueda); ?>" placeholder="Buscar por nombre o código de barra..." class="w-full sm:w-96 rounded-2xl border border-[#ebe7fd] bg-[#f7f5ff] px-4 py-3 text-[#2a3150] outline-none focus:border-[#5c33f6]" />
            <div class="flex gap-2">
              <button type="submit" class="rounded-2xl bg-[#5b34ea] text-white font-bold px-6 py-3 hover:opacity-95">Buscar</button>
              <?php if ($busqueda !== ''): ?>
                <a href="cat_logo.php" class="rounded-2xl bg-[#eeebfb] text-[#5b34ea] font-bold px-6 py-3 flex items-center justify-center hover:opacity-90">Limpiar</a>
              <?php endif; ?>
            </div>
          </form>
          <div class="flex flex-wrap items-center gap-3 text-xs font-bold uppercase tracking-[0.24em] text-[#7d74a1] mb-5">
            <span>TechVision</span>
            <span class="text-[#c7c3dc]">•</span>
            <span><?= escapar($tituloCatalogo); ?></span>
          </div>

          <div class="grid grid-cols-1 gap-6 items-stretch">
            <div class="rounded-[30px] bg-[#f0ebff] border border-[#e5defb] p-4 md:p-6 overflow-hidden">
              <p class="text-[#8a7bc4] font-extrabold uppercase tracking-[0.18em] text-xs mb-4">Selección superior</p>
              <h1 class="font-headline text-4xl md:text-5xl font-black text-[#202640] leading-[1.02] mb-4"><?= escapar($tituloCatalogo); ?></h1>
              <p class="text-[#5e6174] text-lg leading-8 max-w-2xl mb-8"><?= escapar($subtituloCatalogo); ?></p>

              <?php if ($productoPrincipal || $productoSecundario): ?>
                <div class="grid grid-cols-1 xl:grid-cols-2 gap-5 items-stretch">
                  <?php if ($productoPrincipal): ?>
                    <article class="rounded-[26px] bg-white border border-[#e9e2fb] p-4 md:p-5 shadow-[0_20px_40px_-28px_rgba(34,28,74,0.28)] h-full flex flex-col min-h-full">
                      <a href="detalle_producto.php?id=<?= escapar((string) $productoPrincipal['idProducto']); ?>" class="rounded-[22px] bg-[#f4efff] border border-[#e9e2fb] overflow-hidden flex items-center justify-center p-4 mb-5 min-h-[220px]">
                        <div class="w-full h-full min-h-[180px] rounded-[18px] bg-[#f0ebff] flex items-center justify-center p-3 relative">
                          <span class="absolute top-3 left-3 inline-flex items-center rounded-full bg-[#ffedd9] text-[#c86c1a] text-[11px] font-extrabold uppercase tracking-[0.18em] px-3 py-1.5 shadow-sm">Destacado</span>
                          <img src="<?= escapar(ruta_imagen_producto($productoPrincipal)); ?>" alt="<?= escapar($productoPrincipal['nombre']); ?>" class="w-full h-full object-contain" />
                        </div>
                      </a>
                      <p class="text-xs font-bold uppercase tracking-[0.18em] text-[#7d74a1] mb-2"><?= escapar(nombre_categoria_visual($productoPrincipal)); ?> <span class="text-[#c7c3dc] mx-1">•</span> <?= escapar($productoPrincipal['nombreMarc']); ?></p>
                      <h3 class="font-headline text-[1.9rem] leading-tight font-black text-[#232944] mb-3 break-words"><?= escapar($productoPrincipal['nombre']); ?></h3>
                      <p class="text-[15px] text-[#6f7185] leading-7 mb-5"><?= escapar($productoPrincipal['descripcion']); ?></p>
                      <div class="mt-auto pt-3 flex items-center justify-between gap-3">
                        <span class="text-[#5632e8] text-3xl font-black">$<?= number_format((float) $productoPrincipal['precioVenta'], 2); ?></span>
                        <div class="flex items-center gap-2">
                          <a href="detalle_producto.php?id=<?= escapar((string) $productoPrincipal['idProducto']); ?>" class="w-12 h-12 rounded-full bg-[#edeafd] text-[#5b34ea] flex items-center justify-center shrink-0" aria-label="Ver detalles">
                            <span class="material-symbols-outlined">visibility</span>
                          </a>
                          <a href="carrito.php?add=<?= escapar((string) $productoPrincipal['idProducto']); ?>" class="w-12 h-12 rounded-full bg-[#5b34ea] text-white flex items-center justify-center shrink-0" aria-label="Añadir al carrito">
                            <span class="material-symbols-outlined">shopping_cart</span>
                          </a>
                        </div>
                      </div>
                    </article>
                  <?php endif; ?>

                  <?php if ($productoSecundario): ?>
                    <article class="rounded-[26px] bg-white border border-[#e9e2fb] p-4 md:p-5 shadow-[0_20px_40px_-28px_rgba(34,28,74,0.28)] h-full flex flex-col min-h-full">
                      <a href="detalle_producto.php?id=<?= escapar((string) $productoSecundario['idProducto']); ?>" class="rounded-[22px] bg-[#f4efff] border border-[#e9e2fb] overflow-hidden flex items-center justify-center p-4 mb-5 min-h-[220px]">
                        <div class="w-full h-full min-h-[180px] rounded-[18px] bg-[#f0ebff] flex items-center justify-center p-3">
                          <img src="<?= escapar(ruta_imagen_producto($productoSecundario)); ?>" alt="<?= escapar($productoSecundario['nombre']); ?>" class="w-full h-full object-contain" />
                        </div>
                      </a>
                      <p class="text-xs font-bold uppercase tracking-[0.18em] text-[#7d74a1] mb-2"><?= escapar(nombre_categoria_visual($productoSecundario)); ?></p>
                      <h3 class="font-headline text-[1.9rem] leading-tight font-black text-[#232944] mb-3 break-words"><?= escapar($productoSecundario['nombre']); ?></h3>
                      <p class="text-[15px] text-[#6f7185] leading-7 mb-5"><?= escapar($productoSecundario['descripcion']); ?></p>
                      <div class="mt-auto pt-3 flex items-center justify-between gap-3">
                        <span class="text-[#5632e8] text-3xl font-black">$<?= number_format((float) $productoSecundario['precioVenta'], 2); ?></span>
                        <div class="flex items-center gap-2">
                          <a href="detalle_producto.php?id=<?= escapar((string) $productoSecundario['idProducto']); ?>" class="w-12 h-12 rounded-full bg-[#edeafd] text-[#5b34ea] flex items-center justify-center shrink-0" aria-label="Ver detalles">
                            <span class="material-symbols-outlined">visibility</span>
                          </a>
                          <a href="carrito.php?add=<?= escapar((string) $productoSecundario['idProducto']); ?>" class="w-12 h-12 rounded-full bg-[#5b34ea] text-white flex items-center justify-center shrink-0" aria-label="Añadir al carrito">
                            <span class="material-symbols-outlined">shopping_cart</span>
                          </a>
                        </div>
                      </div>
                    </article>
                  <?php endif; ?>
                </div>
              <?php else: ?>
                <div class="rounded-[24px] bg-white border border-[#ece8fb] p-8 text-[#6f7185]">
                  No se encontraron productos con los filtros seleccionados.
                </div>
              <?php endif; ?>
            </div>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5 mt-6">
            <?php foreach ($productosSecundarios as $producto): ?>
              <article class="rounded-[24px] bg-white border border-[#ece8fb] p-4 shadow-[0_20px_35px_-30px_rgba(34,28,74,0.35)] flex flex-col h-full">
                <a href="detalle_producto.php?id=<?= escapar((string) $producto['idProducto']); ?>" class="rounded-[20px] bg-[#f8f5ff] overflow-hidden flex items-center justify-center p-4 mb-4">
                  <div class="w-full aspect-square rounded-[16px] bg-[#f1ecff] flex items-center justify-center p-3">
                    <img src="<?= escapar(ruta_imagen_producto($producto)); ?>" alt="<?= escapar($producto['nombre']); ?>" class="w-full h-full object-contain" />
                  </div>
                </a>
                <h3 class="font-headline text-xl font-black text-[#232944] mb-2"><?= escapar($producto['nombre']); ?></h3>
                <p class="text-sm text-[#6f7185] mb-3 line-clamp-2"><?= escapar($producto['descripcion']); ?></p>
                <div class="mt-auto flex items-center justify-between gap-3">
                  <span class="text-[#5632e8] text-2xl font-black">$<?= number_format((float) $producto['precioVenta'], 2); ?></span>
                  <div class="flex items-center gap-2">
                    <a href="detalle_producto.php?id=<?= escapar((string) $producto['idProducto']); ?>" class="w-10 h-10 rounded-full bg-[#edeafd] text-[#5b34ea] flex items-center justify-center">
                      <span class="material-symbols-outlined">visibility</span>
                    </a>
                    <a href="carrito.php?add=<?= escapar((string) $producto['idProducto']); ?>" class="w-10 h-10 rounded-full bg-[#5b34ea] text-white flex items-center justify-center">
                      <span class="material-symbols-outlined">shopping_cart</span>
                    </a>
                  </div>
                </div>
              </article>
            <?php endforeach; ?>
          </div>

          <div class="rounded-[28px] bg-gradient-to-r from-[#2f3558] via-[#23345f] to-[#1f2450] p-8 md:p-10 mt-8 text-white overflow-hidden relative">
            <div class="grid grid-cols-1 lg:grid-cols-[1fr_auto] gap-6 items-center">
              <div>
                <h2 class="font-headline text-4xl font-black leading-tight max-w-2xl">Mira nustros productos mas nuevos en nuestro catálogo.</h2>
              </div>
              <div class="grid grid-cols-3 gap-6 text-center min-w-[260px]">
                <div>
                  <p class="text-3xl font-black"><?= count($productos); ?></p>
                  <p class="text-white/60 text-xs uppercase tracking-[0.2em] mt-1">Resultados</p>
                </div>
                <div>
                  <p class="text-3xl font-black"><?= count($categorias); ?></p>
                  <p class="text-white/60 text-xs uppercase tracking-[0.2em] mt-1">Categorías</p>
                </div>
                <div>
                  <p class="text-3xl font-black"><?= count($marcas); ?></p>
                  <p class="text-white/60 text-xs uppercase tracking-[0.2em] mt-1">Marcas</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
</main>
<script>
document.querySelectorAll('.filtro-auto').forEach(function (control) {
  control.addEventListener('change', function () {
    document.getElementById('catalogoFiltros').submit();
  });
});
</script>
</body>
</html>
