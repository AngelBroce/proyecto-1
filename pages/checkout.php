<?php
require_once __DIR__ . '/../funciones/general.php';
require_once __DIR__ . '/../funciones/carrito.php';
require_once __DIR__ . '/../funciones/pagos.php';

$items = obtener_items_carrito();
if (empty($items)) {
    header('Location: carrito.php');
    exit;
}

asegurar_tarjetas_demo();
$resultado = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $resultado = procesar_pago_carrito(
        (string) ($_POST['tipo'] ?? ''),
        (string) ($_POST['numero'] ?? ''),
        (string) ($_POST['mes'] ?? ''),
        (string) ($_POST['anio'] ?? ''),
        (string) ($_POST['cvv'] ?? '')
    );
    if (($resultado['ok'] ?? false) === true) {
        $items = [];
    }
}

$subtotal = total_carrito();
$itbms = round($subtotal * 0.07, 2);
$total = round($subtotal + $itbms, 2);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <title>TechVision | Checkout</title>
  <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;700;800&amp;family=Inter:wght@400;500;600&amp;display=swap" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
  <link href="../css/styles.css" rel="stylesheet"/>
  <script src="../js/tailwindcss.js"></script>
  <script src="../js/tailwind-config.js"></script>
</head>
<body class="bg-surface text-on-surface min-h-screen flex flex-col">
<?php render_header(''); ?>
<main class="flex-grow pt-32 pb-16 px-4 md:px-6">
  <div class="max-w-7xl mx-auto">

    <?php if ($resultado): ?>
      <div class="mb-8 rounded-[28px] border <?= $resultado['ok'] ? 'border-green-200 bg-green-50' : 'border-red-200 bg-red-50'; ?> p-6 md:p-8 shadow-sm">
        <div class="flex items-start gap-4">
          <div class="w-14 h-14 rounded-2xl <?= $resultado['ok'] ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700'; ?> flex items-center justify-center shrink-0">
            <span class="material-symbols-outlined text-3xl"><?= $resultado['ok'] ? 'check_circle' : 'error'; ?></span>
          </div>
          <div>
            <h1 class="text-2xl md:text-3xl font-extrabold tracking-tight mb-2"><?= $resultado['ok'] ? 'Pago completado' : 'No se pudo procesar el pago'; ?></h1>
            <p class="font-medium"><?= escapar($resultado['mensaje']); ?></p>
            <?php if (($resultado['ok'] ?? false) === true): ?>
              <p class="mt-3 text-sm md:text-base text-green-800">Factura #<?= (int) $resultado['idFactura']; ?>, subtotal $<?= number_format((float) $resultado['subtotal'], 2); ?>, ITBMS $<?= number_format((float) $resultado['itbms'], 2); ?> y total pagado $<?= number_format((float) $resultado['total'], 2); ?>.</p>
              <div class="flex flex-wrap gap-3 mt-5">
                <a href="cat_logo.php" class="inline-flex items-center justify-center px-5 py-3 rounded-2xl bg-[#5c33f6] text-white font-bold">Volver al catálogo</a>
                <a href="index.php" class="inline-flex items-center justify-center px-5 py-3 rounded-2xl bg-white border border-green-200 text-green-800 font-bold">Ir al inicio</a>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    <?php endif; ?>

    <?php if (!(($resultado['ok'] ?? false) === true)): ?>
    <section class="rounded-[32px] overflow-hidden border border-[#e7e4fb] shadow-[0_12px_35px_rgba(43,30,97,0.07)] bg-white">
      <div class="grid grid-cols-1 xl:grid-cols-[1.2fr_0.8fr]">
        <div class="p-6 md:p-8 xl:p-10 bg-[#fbfaff]">
          <div class="mb-8 flex items-center gap-4">
            <a href="carrito.php" class="w-11 h-11 rounded-full bg-[#f4f0ff] text-[#5c33f6] flex items-center justify-center hover:bg-[#edeafd] transition-colors shrink-0" aria-label="Volver al carrito">
              <span class="material-symbols-outlined">arrow_back</span>
            </a>
            <div>
              <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight text-[#20263d]">Checkout</h1>
              <p class="mt-1 text-[#6d7288] text-base md:text-lg">Completa el pago de tu carrito con Visa o Mastercard.</p>
            </div>
          </div>

          <form method="post" class="space-y-8">
            <div>
              <div class="flex items-center justify-between gap-4 mb-4">
                <div class="flex items-center gap-2 text-[#2a3150] font-extrabold text-lg">
                  <span class="material-symbols-outlined text-[#5c33f6]">credit_card</span>
                  <span>Método de pago</span>
                </div>
                <div class="flex items-center gap-2 text-xs font-bold text-[#7a739f]">
                  <span class="inline-flex items-center gap-1 rounded-full bg-[#edeafd] px-3 py-2"><span class="material-symbols-outlined text-base text-[#5c33f6]">credit_card</span>Visa</span>
                  <span class="inline-flex items-center gap-1 rounded-full bg-[#edeafd] px-3 py-2"><span class="material-symbols-outlined text-base text-[#5c33f6]">payments</span>Mastercard</span>
                </div>
              </div>

              <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-5">
                <label class="block cursor-pointer">
                  <input type="radio" name="tipo" value="visa" class="peer sr-only" <?= (($_POST['tipo'] ?? '') === 'visa') ? 'checked' : ''; ?> required>
                  <div class="rounded-[22px] border border-[#e5e0fb] bg-white px-5 py-4 flex items-center justify-between transition peer-checked:border-[#5c33f6] peer-checked:bg-[#f4f0ff] peer-checked:shadow-[0_8px_20px_rgba(92,51,246,0.12)] peer-checked:[&_.material-symbols-outlined]:text-[#5c33f6] peer-checked:[&_.material-symbols-outlined]:drop-shadow-[0_0_8px_rgba(92,51,246,0.6)]">
                    <div>
                      <p class="font-extrabold text-[#2a3150]">Visa</p>
                      <p class="text-sm text-[#7c8095]">Tarjeta de crédito o débito</p>
                    </div>
                    <span class="material-symbols-outlined text-[#d4d0e9] transition-all duration-300">radio_button_checked</span>
                  </div>
                </label>
                <label class="block cursor-pointer">
                  <input type="radio" name="tipo" value="mastercard" class="peer sr-only" <?= (($_POST['tipo'] ?? '') === 'mastercard') ? 'checked' : ''; ?> required>
                  <div class="rounded-[22px] border border-[#e5e0fb] bg-white px-5 py-4 flex items-center justify-between transition peer-checked:border-[#5c33f6] peer-checked:bg-[#f4f0ff] peer-checked:shadow-[0_8px_20px_rgba(92,51,246,0.12)] peer-checked:[&_.material-symbols-outlined]:text-[#5c33f6] peer-checked:[&_.material-symbols-outlined]:drop-shadow-[0_0_8px_rgba(92,51,246,0.6)]">
                    <div>
                      <p class="font-extrabold text-[#2a3150]">Mastercard</p>
                      <p class="text-sm text-[#7c8095]">Compra segura en línea</p>
                    </div>
                    <span class="material-symbols-outlined text-[#d4d0e9] transition-all duration-300">radio_button_checked</span>
                  </div>
                </label>
              </div>

              <div class="space-y-5 rounded-[28px] bg-white border border-[#ebe7fd] p-5 md:p-6">
                <div>
                  <label class="block text-sm font-extrabold text-[#60657c] mb-2">Número de tarjeta</label>
                  <div class="relative">
                    <input type="text" name="numero" maxlength="19" value="<?= escapar((string) ($_POST['numero'] ?? '')); ?>" placeholder="0000 0000 0000 0000" class="w-full rounded-2xl border border-[#ebe7fd] bg-[#f7f5ff] px-4 py-4 pr-12 text-[#2a3150] outline-none focus:border-[#5c33f6]" required autocomplete="cc-number" oninput="this.value = this.value.replace(/\D/g, '').replace(/(\d{4})(?=\d)/g, '$1 ');">
                    <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 text-[#5c33f6]">credit_card</span>
                  </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                  <div class="sm:col-span-2">
                    <label class="block text-sm font-extrabold text-[#60657c] mb-2">Fecha de expiración</label>
                    <div class="grid grid-cols-2 gap-3">
                      <input id="mes-expiracion" type="text" name="mes" maxlength="2" value="<?= escapar((string) ($_POST['mes'] ?? '')); ?>" placeholder="MM" class="w-full rounded-2xl border border-[#ebe7fd] bg-[#f7f5ff] px-4 py-4 text-[#2a3150] outline-none focus:border-[#5c33f6]" required autocomplete="cc-exp-month">
                      <input type="text" name="anio" maxlength="4" value="<?= escapar((string) ($_POST['anio'] ?? '')); ?>" placeholder="YYYY" class="w-full rounded-2xl border border-[#ebe7fd] bg-[#f7f5ff] px-4 py-4 text-[#2a3150] outline-none focus:border-[#5c33f6]" required autocomplete="cc-exp-year" oninput="this.value = this.value.replace(/\D/g, '')">
                    </div>
                  </div>
                  <div>
                    <label class="block text-sm font-extrabold text-[#60657c] mb-2">CVV</label>
                    <input type="text" name="cvv" maxlength="4" value="<?= escapar((string) ($_POST['cvv'] ?? '')); ?>" placeholder="xxxx" class="w-full rounded-2xl border border-[#ebe7fd] bg-[#f7f5ff] px-4 py-4 text-[#2a3150] outline-none focus:border-[#5c33f6]" required autocomplete="cc-csc" oninput="this.value = this.value.replace(/\D/g, '')">
                  </div>
                </div>
              </div>
            </div>
                <div class="flex flex-col">
                  <button type="submit" class="w-full mt-6 py-4 rounded-2xl bg-[#5c33f6] text-white font-extrabold text-lg shadow-[0_14px_28px_rgba(92,51,246,0.28)] hover:opacity-95">Completar compra</button>
                  <p class="mt-4 text-xs leading-5 text-center text-[#8a8ea3]">Al completar esta compra, aceptas nuestras políticas y confirmas que la transacción se procesará de forma segura.</p>
                </div>
          </form>
        </div>

        <aside class="bg-[#f5f2ff] p-6 md:p-8 xl:p-10 border-t xl:border-t-0 xl:border-l border-[#e7e4fb] flex flex-col">
          <h2 class="text-2xl font-extrabold text-[#2a3150] mb-5">Resumen del pedido</h2>

          <div class="space-y-4">
            <?php foreach ($items as $item): $producto = $item['producto']; ?>
              <div class="flex items-center gap-4 rounded-[24px] bg-white border border-[#ebe7fd] p-4">
                <div class="w-20 h-20 rounded-2xl bg-[#f7f5ff] p-2 flex items-center justify-center shrink-0 overflow-hidden">
                  <img src="<?= escapar(ruta_imagen_producto($producto)); ?>" alt="<?= escapar($producto['nombre']); ?>" class="w-full h-full object-contain">
                </div>
                <div class="min-w-0 flex-grow">
                  <p class="font-extrabold text-[#2a3150] leading-tight truncate"><?= escapar($producto['nombre']); ?></p>
                  <p class="text-sm text-[#6f748b]">Cantidad: <?= (int) $item['cantidad']; ?></p>
                  <p class="text-sm text-[#6f748b] line-clamp-2"><?= escapar(substr((string) ($producto['descripcion'] ?? ''), 0, 80)); ?></p>
                  <p class="mt-1 font-extrabold text-[#5c33f6]">$<?= number_format((float) $item['subtotal'], 2); ?></p>
                </div>
              </div>
            <?php endforeach; ?>
          </div>

          <div class="mt-6 rounded-[24px] bg-white border border-[#ebe7fd] p-5">
            <div class="space-y-3 text-[#666b82]">
              <div class="flex justify-between gap-4"><span>Subtotal</span><span class="font-bold text-[#2a3150]">$<?= number_format($subtotal, 2); ?></span></div>
              <div class="flex justify-between gap-4"><span>ITBMS</span><span class="font-bold text-[#2a3150]">$<?= number_format($itbms, 2); ?></span></div>
              <div class="flex justify-between gap-4 pt-3 border-t border-[#ece8fd] text-xl font-black text-[#2a3150]"><span>Total</span><span>$<?= number_format($total, 2); ?></span></div>
            </div>

            <!-- Botón movido dentro del formulario principal -->
          </div>
        </aside>
      </div>

      <div class="bg-white px-6 md:px-8 xl:px-10 py-6 border-t border-[#ebe7fd] flex flex-col md:flex-row md:items-center md:justify-between gap-4 text-sm text-[#8a8ea3]">
        <div class="font-extrabold tracking-[0.18em] text-[#2a3150]">TECHVISION</div>
        <div class="flex flex-wrap items-center gap-x-6 gap-y-2">
          <span>Privacidad</span>
          <span>Términos</span>
          <span>Pago seguro</span>
        </div>
        <div>© 2024 TechVision Curator. Todos los derechos reservados.</div>
      </div>
    </section>
    <?php endif; ?>
  </div>
</main>
</body>
  <script>
    // Validación en tiempo real para el campo de mes (solo 1-12)
    document.addEventListener('DOMContentLoaded', function() {
      var mesInput = document.getElementById('mes-expiracion');
      if (mesInput) {
        mesInput.addEventListener('input', function(e) {
          let val = this.value.replace(/[^0-9]/g, '');
          if (val.length > 2) val = val.slice(0,2);
          if (val !== '') {
            let num = parseInt(val, 10);
            if (num < 1) val = '';
            if (num > 12) val = '12';
          }
          this.value = val;
        });
      }
    });
  </script>
</html>
