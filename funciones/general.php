<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function base_url(string $ruta = ''): string
{
    return $ruta;
}

function escapar($texto): string
{
    return htmlspecialchars((string) $texto, ENT_QUOTES, 'UTF-8');
}

function pagina_activa(string $actual, string $esperada): bool
{
    return $actual === $esperada;
}

function clase_nav(string $actual, string $esperada): string
{
    if (pagina_activa($actual, $esperada)) {
        return 'font-manrope font-bold text-lg tracking-tight text-[#451ebb] border-b-2 border-[#451ebb] pb-1';
    }

    return 'font-manrope font-bold text-lg tracking-tight text-[#484554] hover:text-[#451ebb] transition-colors';
}

function cantidad_carrito_header(): int
{
    $cantidad = 0;
    $carrito = $_SESSION['carrito'] ?? [];

    if (!is_array($carrito)) {
        return 0;
    }

    foreach ($carrito as $item) {
        $cantidad += (int) ($item['cantidad'] ?? 0);
    }

    return $cantidad;
}

function render_header(string $actual = ''): void
{
    $cantidad = cantidad_carrito_header();
    ?>
    <header class="fixed top-0 w-full z-50 bg-[#faf8ff]/80 backdrop-blur-xl shadow-[0_40px_60px_-15px_rgba(19,27,46,0.04)]">
      <div class="flex justify-between items-center px-8 py-4 max-w-none w-full">
        <div class="flex items-center gap-8">
          <a class="text-2xl font-black tracking-tighter text-[#131b2e]" href="index.php">TechVision</a>
          <nav class="hidden md:flex gap-6">
            <a class="<?= clase_nav($actual, 'inicio'); ?>" href="index.php">Inicio</a>
            <a class="<?= clase_nav($actual, 'catalogo'); ?>" href="cat_logo.php">Catálogo</a>
          </nav>
        </div>
        <div class="flex items-center gap-2">
          <a href="carrito.php" class="relative p-2 hover:bg-[#f2f3ff] rounded-lg transition-all active:scale-95 duration-200" aria-label="Ir al carrito">
            <span class="material-symbols-outlined text-[#451ebb]">shopping_cart</span>
            <?php if ($cantidad > 0): ?>
              <span class="absolute -top-1 -right-1 min-w-[18px] h-[18px] rounded-full bg-[#5b34ea] text-white text-[10px] font-bold flex items-center justify-center px-1"><?= $cantidad; ?></span>
            <?php endif; ?>
          </a>
          <a href="login.php" class="p-2 hover:bg-[#f2f3ff] rounded-lg transition-all active:scale-95 duration-200" aria-label="Ir al login">
            <span class="material-symbols-outlined text-[#451ebb]">person</span>
          </a>
        </div>
      </div>
    </header>
    <?php
}
