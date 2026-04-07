<?php
require_once __DIR__ . '/../funciones/productos.php';
?>
<!DOCTYPE html>
<html lang="es">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <title>
   TechVision | VisionBook Pro 16
  </title>
  <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200;400;500;700;800&amp;family=Inter:wght@300;400;500;600&amp;display=swap" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
  <link href="../css/styles.css" rel="stylesheet"/>
  <script src="../js/tailwindcss.js">
  </script>
  <script src="../js/tailwind-config.js">
  </script>
 </head>
 <body class="bg-surface text-on-surface font-body selection:bg-primary-fixed selection:text-primary">
  <!-- TopAppBar -->
  <header class="fixed top-0 w-full z-50 bg-[#faf8ff]/80 backdrop-blur-xl shadow-[0_40px_60px_-15px_rgba(19,27,46,0.04)]">
   <div class="flex justify-between items-center px-8 py-4 max-w-none w-full">
    <div class="text-2xl font-black tracking-tighter text-[#131b2e]">
     TechVision
    </div>
    <nav class="hidden md:flex items-center gap-8">
     <a class="font-manrope font-bold text-lg tracking-tight text-[#484554] hover:text-[#451ebb] transition-colors" href="#">
      Smartphones
     </a>
     <a class="font-manrope font-bold text-lg tracking-tight text-[#451ebb] border-b-2 border-[#451ebb] pb-1" href="#">
      Laptops
     </a>
     <a class="font-manrope font-bold text-lg tracking-tight text-[#484554] hover:text-[#451ebb] transition-colors" href="#">
      Audio
     </a>
     <a class="font-manrope font-bold text-lg tracking-tight text-[#484554] hover:text-[#451ebb] transition-colors" href="#">
      Ofertas
     </a>
    </nav>
    <div class="flex items-center gap-4">
     <button class="p-2 hover:bg-[#f2f3ff] rounded-lg transition-all active:scale-95 duration-200">
      <span class="material-symbols-outlined text-[#131b2e]">
       shopping_cart
      </span>
     </button>
     <button class="p-2 hover:bg-[#f2f3ff] rounded-lg transition-all active:scale-95 duration-200">
      <span class="material-symbols-outlined text-[#131b2e]">
       person
      </span>
     </button>
    </div>
   </div>
   <div class="bg-[#f2f3ff] h-[1px] w-full">
   </div>
  </header>
  <main class="pt-24 pb-20">
   <!-- Hero Section: Product Focus -->
   <section class="max-w-7xl mx-auto px-8 lg:pt-12 grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
    <!-- Left: High-End Product Presentation -->
    <div class="lg:col-span-7 relative group">
     <div class="bg-surface-container-low rounded-xl overflow-hidden aspect-[4/3] flex items-center justify-center p-12">
      <img alt="VisionBook Pro 16" class="w-full h-full object-contain mix-blend-multiply transition-transform duration-700 group-hover:scale-105" data-alt="Premium sleek metallic silver laptop open on a white minimalist desk with soft cinematic studio lighting and deep blue shadows" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAugoJxorg40gHAeqlCBD06RW6va0cBKeX4TOSVhDoY2EpezgYusgsdAonoO-59Xwh_iVhgcYMG3-sArWQlDMwfMP3TSlEwbFbSDH8hS4-3jx1qUXDHnuTlizujtHNcJCYa7N8KN0lPOBFY-z9uWRWThI8EYMjMAofLqiqh3Jcb4CAnWxB7595KFFbfGpKZgmEoSjMNK4MSdUABHdsFiZzFH6-LF6OYzD3GbJquCQnbPLRLeTo7JJ3AlhQC6wyfdmnKfMRlVHZAIhI"/>
     </div>
     <!-- Floating Detail Badges -->
     <div class="absolute top-8 left-8 flex flex-col gap-3">
      <span class="bg-on-tertiary-fixed-variant text-tertiary-fixed px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest shadow-xl">
       Edición Limitada
      </span>
     </div>
    </div>
    <!-- Right: Commercial Anchor -->
    <div class="lg:col-span-5 flex flex-col gap-8 lg:pl-8">
     <div class="space-y-2">
      <p class="text-primary font-bold tracking-widest uppercase text-xs">
       Series X • Profesional
      </p>
      <h1 class="font-headline font-extrabold text-5xl tracking-tight text-on-surface leading-tight">
       VisionBook Pro 16
      </h1>
      <div class="flex items-center gap-2 mt-4">
       <div class="flex text-primary">
        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">
         star
        </span>
        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">
         star
        </span>
        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">
         star
        </span>
        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">
         star
        </span>
        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 0;">
         star
        </span>
       </div>
       <span class="text-on-surface-variant text-sm font-medium">
        (128 reseñas de expertos)
       </span>
      </div>
     </div>
     <div class="space-y-6">
      <div class="flex flex-col">
       <span class="text-on-surface-variant line-through text-lg">
        $2,899.00
       </span>
       <span class="font-headline font-black text-6xl text-on-surface tracking-tighter">
        $2,499.00
       </span>
      </div>
      <p class="text-on-surface-variant leading-relaxed font-light text-lg">
       Diseñado para creadores de contenido y desarrolladores que exigen potencia absoluta. Equipado con el chip VisionX2 y una pantalla Liquid-OLED de 120Hz.
      </p>
     </div>
     <!-- Config Selection (Minimalist) -->
     <div class="space-y-4">
      <span class="text-xs font-bold uppercase tracking-widest text-on-surface-variant">
       Memoria RAM
      </span>
      <div class="flex gap-3">
       <button class="px-6 py-3 rounded-xl border-2 border-primary bg-primary/5 text-primary font-bold transition-all">
        32GB
       </button>
       <button class="px-6 py-3 rounded-xl border-2 border-outline-variant/20 hover:border-primary/40 text-on-surface-variant font-medium transition-all">
        64GB
       </button>
       <button class="px-6 py-3 rounded-xl border-2 border-outline-variant/20 hover:border-primary/40 text-on-surface-variant font-medium transition-all">
        128GB
       </button>
      </div>
     </div>
     <!-- Action Button -->
     <button class="group relative overflow-hidden rounded-xl bg-gradient-to-br from-primary to-primary-container p-5 text-on-primary shadow-2xl transition-all active:scale-95">
      <div class="flex items-center justify-center gap-3">
       <span class="font-headline font-extrabold text-xl">
        Añadir al Carrito
       </span>
       <span class="material-symbols-outlined transition-transform group-hover:translate-x-1">
        arrow_forward
       </span>
      </div>
     </button>
     <div class="flex items-center gap-6 pt-4 text-xs font-bold text-on-surface-variant uppercase tracking-widest">
      <div class="flex items-center gap-2">
       <span class="material-symbols-outlined text-primary text-lg">
        local_shipping
       </span>
       Envío Gratis
      </div>
      <div class="flex items-center gap-2">
       <span class="material-symbols-outlined text-primary text-lg">
        verified
       </span>
       3 Años de Garantía
      </div>
     </div>
    </div>
   </section>
   <!-- Spec-Blade: Dark Mode Contrast -->
   <section class="mt-32 bg-inverse-surface text-inverse-on-surface py-24">
    <div class="max-w-7xl mx-auto px-8">
     <div class="flex flex-col md:flex-row justify-between items-end gap-8 mb-20">
      <div class="max-w-2xl">
       <h2 class="font-headline font-extrabold text-4xl mb-4">
        Especificaciones de Grado Estúdio
       </h2>
       <p class="text-surface-dim font-light text-lg italic">
        "Donde la ingeniería se encuentra con la elegancia visual."
       </p>
      </div>
      <span class="material-symbols-outlined text-6xl opacity-20">
       memory
      </span>
     </div>
     <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
      <div class="space-y-4 border-l border-surface-dim/20 pl-6 hover:border-primary transition-colors">
       <p class="text-xs font-black uppercase tracking-widest text-primary-fixed">
        Procesador
       </p>
       <h3 class="font-headline font-bold text-xl">
        VisionX2 Ultra
       </h3>
       <p class="text-surface-dim text-sm">
        Arquitectura de 3nm con 16 núcleos de alto rendimiento.
       </p>
      </div>
      <div class="space-y-4 border-l border-surface-dim/20 pl-6 hover:border-primary transition-colors">
       <p class="text-xs font-black uppercase tracking-widest text-primary-fixed">
        Pantalla
       </p>
       <h3 class="font-headline font-bold text-xl">
        16.2" Liquid OLED
       </h3>
       <p class="text-surface-dim text-sm">
        Resolución 4K, 1600 nits de brillo pico y ProMotion 120Hz.
       </p>
      </div>
      <div class="space-y-4 border-l border-surface-dim/20 pl-6 hover:border-primary transition-colors">
       <p class="text-xs font-black uppercase tracking-widest text-primary-fixed">
        Gráficos
       </p>
       <h3 class="font-headline font-bold text-xl">
        Neural GPU 40c
       </h3>
       <p class="text-surface-dim text-sm">
        Trazado de rayos por hardware y aceleración AI nativa.
       </p>
      </div>
      <div class="space-y-4 border-l border-surface-dim/20 pl-6 hover:border-primary transition-colors">
       <p class="text-xs font-black uppercase tracking-widest text-primary-fixed">
        Batería
       </p>
       <h3 class="font-headline font-bold text-xl">
        22 Horas
       </h3>
       <p class="text-surface-dim text-sm">
        Carga rápida USB-C de 140W incluida en la caja.
       </p>
      </div>
     </div>
    </div>
   </section>
   <!-- Customer Ratings & Social Proof (Bento Grid Style) -->
   <section class="max-w-7xl mx-auto px-8 mt-32">
    <h2 class="font-headline font-extrabold text-4xl mb-12">
     Experiencias de Usuario
    </h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
     <!-- Large Summary Card -->
     <div class="bg-surface-container-low p-10 rounded-xl flex flex-col justify-center items-center text-center">
      <span class="text-7xl font-headline font-black text-on-surface">
       4.9
      </span>
      <div class="flex text-primary my-4">
       <span class="material-symbols-outlined text-3xl" style="font-variation-settings: 'FILL' 1;">
        star
       </span>
       <span class="material-symbols-outlined text-3xl" style="font-variation-settings: 'FILL' 1;">
        star
       </span>
       <span class="material-symbols-outlined text-3xl" style="font-variation-settings: 'FILL' 1;">
        star
       </span>
       <span class="material-symbols-outlined text-3xl" style="font-variation-settings: 'FILL' 1;">
        star
       </span>
       <span class="material-symbols-outlined text-3xl" style="font-variation-settings: 'FILL' 1;">
        star
       </span>
      </div>
      <p class="text-on-surface-variant font-medium">
       Basado en más de 2,400 valoraciones verificadas.
      </p>
     </div>
     <!-- Review Card 1 -->
     <div class="bg-surface-container-lowest p-8 rounded-xl shadow-sm space-y-4">
      <div class="flex items-center gap-4">
       <div class="w-10 h-10 rounded-full bg-secondary-container flex items-center justify-center font-bold text-primary">
        JD
       </div>
       <div>
        <p class="font-bold text-on-surface">
         Julian De Luca
        </p>
        <p class="text-xs text-on-surface-variant">
         Editor de Video Senior
        </p>
       </div>
      </div>
      <p class="text-on-surface-variant italic leading-relaxed">
       "La potencia es increíble. Puedo renderizar 8K en tiempo real sin que los ventiladores hagan ruido."
      </p>
     </div>
     <!-- Review Card 2 -->
     <div class="bg-surface-container-lowest p-8 rounded-xl shadow-sm space-y-4">
      <div class="flex items-center gap-4">
       <div class="w-10 h-10 rounded-full bg-primary-fixed flex items-center justify-center font-bold text-primary">
        SC
       </div>
       <div>
        <p class="font-bold text-on-surface">
         Sara Castillo
        </p>
        <p class="text-xs text-on-surface-variant">
         Arquitecta de Software
        </p>
       </div>
      </div>
      <p class="text-on-surface-variant italic leading-relaxed">
       "El teclado es lo mejor que he probado. La pantalla OLED facilita trabajar en exteriores sin reflejos."
      </p>
     </div>
    </div>
   </section>
   <!-- Related Products: Editorial Layout -->
   <section class="max-w-7xl mx-auto px-8 mt-32">
    <div class="flex justify-between items-end mb-12">
     <div>
      <h2 class="font-headline font-extrabold text-4xl mb-2">
       Completa tu Ecosistema
      </h2>
      <p class="text-on-surface-variant">
       Productos seleccionados para elevar tu productividad.
      </p>
     </div>
     <button class="text-primary font-bold hover:underline">
      Ver todo el catálogo
     </button>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
     <!-- Product Card 1 -->
     <div class="group cursor-pointer">
      <div class="bg-surface-container-low aspect-square rounded-xl overflow-hidden mb-6 flex items-center justify-center p-8">
       <img alt="VisionTab Ultra" class="w-full h-full object-contain mix-blend-multiply group-hover:scale-110 transition-transform duration-500" data-alt="Modern sleek black tablet with vibrant abstract wallpaper leaning against a designer lamp on a walnut desk" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBzy4Cuib2oMkU23S-WwR_AN7zsVyOZSAf7ht-hqklcw7amiDQ_UNynAANLeL1PU9YPScn_V9iG2BcAM0fgeeAPGYv5BL8NSLqLOp5vcJv4e1VJ0K7_wey46zzE4uIm0TByYJ5pAJEhsnGbp-3TdJ2IHUmLi4q2jEDexYIk6iompNQNyfNovSX-ggY5OdffFk35M9b20qlkyizlkaPMySEmH7kEmB-pLoznyvM_KQ11D5GC4klpmuQArYuciBVLpoco3hFuY_IZTbw"/>
      </div>
      <div class="space-y-1">
       <h3 class="font-headline font-bold text-xl">
        VisionTab Ultra
       </h3>
       <p class="text-on-surface-variant text-sm uppercase tracking-tighter">
        Accesorios Pro
       </p>
       <p class="font-headline font-black text-2xl mt-2">
        $899.00
       </p>
      </div>
     </div>
     <!-- Product Card 2 -->
     <div class="group cursor-pointer">
      <div class="bg-surface-container-low aspect-square rounded-xl overflow-hidden mb-6 flex items-center justify-center p-8">
       <img alt="Sonic Vision X" class="w-full h-full object-contain mix-blend-multiply group-hover:scale-110 transition-transform duration-500" data-alt="Matte black wireless over-ear headphones with premium leather padding against a soft grey architectural background" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDlTF_GWi9qrn72LAIT4VpItVkGPKF-xjsbpoGQKMM0mRIZ-fZ2_H1nKMSGsW2Czy7MqMakJfNPwYlEJiqFs5GYjbYoLlLQ0lWQrdjRqSCqLQQhLqic_7i_scld5CuLSBkTUaVhrIL3wXOfN23IEiAeqceRZGe5QJT2ejgfIkVP1GK2u0Kyh_l_xE6-Ip1zaGXeCyYOwb04LHAzPj_QNaSwF6DD-orVc4WSGR81adDd9EvXKFU3ANDQOnIl1qsqShgFwn_MSTepxv0"/>
      </div>
      <div class="space-y-1">
       <h3 class="font-headline font-bold text-xl">
        Sonic Vision X
       </h3>
       <p class="text-on-surface-variant text-sm uppercase tracking-tighter">
        Audio Espacial
       </p>
       <p class="font-headline font-black text-2xl mt-2">
        $349.00
       </p>
      </div>
     </div>
     <!-- Product Card 3 -->
     <div class="group cursor-pointer">
      <div class="bg-surface-container-low aspect-square rounded-xl overflow-hidden mb-6 flex items-center justify-center p-8">
       <img alt="VisionHub Station" class="w-full h-full object-contain mix-blend-multiply group-hover:scale-110 transition-transform duration-500" data-alt="Minimalist aluminum multi-port docking station with several cables connected arranged neatly on a modern white surface" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDhZDLhJv_50xjNZqlJ1dFzxCVcYNJAZ4Ot7_XMnV6uymVduUHXyjRqYqh5ii3iI-5U9mJM1EvT2-clJqEFYOWcibl97Pjlt0OP5suhgw5RROHlZoUZB2Aa2Fotn_MSRRnSTUa_0OlHl0uCuapShKJ8fGqfg4F26x6NEkNzN_fyZLxzlYzBPiox7eooCJJ56bHs49yYztSCAAvQ_VbX8bDXqsp1EGZGtZAa8OSdD8dNwNXx5cN63JkI-WgSoxCN5VwgA-OXIX9A0mE"/>
      </div>
      <div class="space-y-1">
       <h3 class="font-headline font-bold text-xl">
        VisionHub Station
       </h3>
       <p class="text-on-surface-variant text-sm uppercase tracking-tighter">
        Conectividad
       </p>
       <p class="font-headline font-black text-2xl mt-2">
        $199.00
       </p>
      </div>
     </div>
    </div>
   </section>
  </main>
  <!-- Footer -->
  <footer class="bg-[#283044] w-full py-12 px-8 mt-auto">
   <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center gap-6">
    <div class="font-manrope font-black text-[#faf8ff] text-2xl">
     TechVision
    </div>
    <nav class="flex flex-wrap justify-center gap-8">
     <a class="font-inter text-xs uppercase tracking-widest text-[#d2d9f4]/60 hover:text-[#faf8ff] underline decoration-[#451ebb] transition-colors" href="#">
      Privacidad
     </a>
     <a class="font-inter text-xs uppercase tracking-widest text-[#d2d9f4]/60 hover:text-[#faf8ff] underline decoration-[#451ebb] transition-colors" href="#">
      Soporte
     </a>
     <a class="font-inter text-xs uppercase tracking-widest text-[#d2d9f4]/60 hover:text-[#faf8ff] underline decoration-[#451ebb] transition-colors" href="#">
      Envíos
     </a>
     <a class="font-inter text-xs uppercase tracking-widest text-[#d2d9f4]/60 hover:text-[#faf8ff] underline decoration-[#451ebb] transition-colors" href="#">
      Garantía
     </a>
    </nav>
    <p class="font-inter text-xs uppercase tracking-widest text-[#d2d9f4]/60 text-center md:text-right">
     © 2024 TechVision Editorial. Todos los derechos reservados.
    </p>
   </div>
  </footer>
  <!-- Bottom Mobile Nav (Supressed on desktop per shell logic) -->
  <nav class="md:hidden fixed bottom-0 left-0 right-0 bg-surface/80 backdrop-blur-xl flex justify-around items-center py-3 z-50 border-t border-outline-variant/10">
   <button class="flex flex-col items-center gap-1 text-[#484554]">
    <span class="material-symbols-outlined">
     smartphone
    </span>
    <span class="text-[10px] font-bold uppercase tracking-tighter">
     Phones
    </span>
   </button>
   <button class="flex flex-col items-center gap-1 text-[#451ebb]">
    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">
     laptop
    </span>
    <span class="text-[10px] font-bold uppercase tracking-tighter">
     Laptops
    </span>
   </button>
   <button class="flex flex-col items-center gap-1 text-[#484554]">
    <span class="material-symbols-outlined">
     headset
    </span>
    <span class="text-[10px] font-bold uppercase tracking-tighter">
     Audio
    </span>
   </button>
   <button class="flex flex-col items-center gap-1 text-[#484554]">
    <span class="material-symbols-outlined">
     shopping_cart
    </span>
    <span class="text-[10px] font-bold uppercase tracking-tighter">
     Cart
    </span>
   </button>
  </nav>
 </body>
</html>
