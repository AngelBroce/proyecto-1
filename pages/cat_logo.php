<?php
require_once __DIR__ . '/../funciones/productos.php';
?>
<!DOCTYPE html>
<html lang="es">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <title>
   TechVision | Editorial Product Catalog
  </title>
  <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;700;800&amp;family=Inter:wght@400;500;600&amp;display=swap" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
  <link href="../css/styles.css" rel="stylesheet"/>
  <script src="../js/tailwindcss.js">
  </script>
  <script src="../js/tailwind-config.js">
  </script>
 </head>
 <body class="bg-surface text-on-surface">
  <!-- TopAppBar Navigation -->
  <header class="fixed top-0 w-full z-50 bg-[#faf8ff]/80 dark:bg-[#131b2e]/80 backdrop-blur-xl shadow-[0_40px_60px_-15px_rgba(19,27,46,0.04)]">
   <div class="flex justify-between items-center px-8 py-4 max-w-none w-full">
    <div class="text-2xl font-black tracking-tighter text-[#131b2e] dark:text-[#faf8ff]">
     TechVision
    </div>
    <nav class="hidden md:flex items-center gap-8 font-manrope font-bold text-lg tracking-tight">
     <a class="text-[#451ebb] border-b-2 border-[#451ebb] pb-1" href="#">
      Smartphones
     </a>
     <a class="text-[#484554] hover:text-[#451ebb] transition-colors" href="#">
      Laptops
     </a>
     <a class="text-[#484554] hover:text-[#451ebb] transition-colors" href="#">
      Audio
     </a>
     <a class="text-[#484554] hover:text-[#451ebb] transition-colors" href="#">
      Ofertas
     </a>
    </nav>
    <div class="flex items-center gap-4">
     <button class="p-2 hover:bg-[#f2f3ff] rounded-lg transition-all active:scale-95 duration-200">
      <span class="material-symbols-outlined" data-icon="shopping_cart">
       shopping_cart
      </span>
     </button>
     <button class="p-2 hover:bg-[#f2f3ff] rounded-lg transition-all active:scale-95 duration-200">
      <span class="material-symbols-outlined" data-icon="person">
       person
      </span>
     </button>
    </div>
   </div>
   <div class="bg-[#f2f3ff] h-[1px] w-full">
   </div>
  </header>
  <main class="pt-24 flex min-h-screen">
   <!-- SideNavBar Filters -->
   <aside class="hidden lg:flex flex-col gap-4 py-8 px-8 h-screen w-80 sticky top-24 bg-[#faf8ff]">
    <div class="mb-6">
     <h2 class="font-manrope font-extrabold text-[#131b2e] text-xl">
      Filtrar Catálogo
     </h2>
     <p class="font-inter text-sm font-medium text-on-surface-variant">
      Refina tu búsqueda
     </p>
    </div>
    <!-- Filter Sections -->
    <div class="space-y-8 flex-1 overflow-y-auto pr-2">
     <!-- Brand Filter -->
     <div>
      <h3 class="font-headline font-bold text-sm mb-3">
       Marca
      </h3>
      <div class="space-y-2">
       <label class="flex items-center gap-3 group cursor-pointer">
        <input class="w-5 h-5 rounded border-outline-variant text-primary focus:ring-primary/40" type="checkbox"/>
        <span class="text-on-surface-variant group-hover:text-primary transition-colors text-sm">
         Apple
        </span>
       </label>
       <label class="flex items-center gap-3 group cursor-pointer">
        <input checked="" class="w-5 h-5 rounded border-outline-variant text-primary focus:ring-primary/40" type="checkbox"/>
        <span class="text-on-surface-variant group-hover:text-primary transition-colors text-sm">
         Samsung
        </span>
       </label>
       <label class="flex items-center gap-3 group cursor-pointer">
        <input class="w-5 h-5 rounded border-outline-variant text-primary focus:ring-primary/40" type="checkbox"/>
        <span class="text-on-surface-variant group-hover:text-primary transition-colors text-sm">
         Google
        </span>
       </label>
      </div>
     </div>
     <!-- Price Range -->
     <div>
      <h3 class="font-headline font-bold text-sm mb-3">
       Rango de Precio
      </h3>
      <div class="flex gap-2">
       <input class="w-full bg-surface-container-low border-none rounded-lg p-2 text-xs focus:ring-2 focus:ring-primary/20" placeholder="Min" type="text"/>
       <input class="w-full bg-surface-container-low border-none rounded-lg p-2 text-xs focus:ring-2 focus:ring-primary/20" placeholder="Max" type="text"/>
      </div>
     </div>
     <!-- Category Icons Navigation from JSON -->
     <div class="pt-4 space-y-1">
      <h3 class="font-headline font-bold text-sm mb-3">
       Categorías
      </h3>
      <div class="flex items-center gap-3 p-3 bg-[#f2f3ff] text-[#451ebb] font-bold rounded-r-full -ml-8 pl-8">
       <span class="material-symbols-outlined" data-icon="smartphone">
        smartphone
       </span>
       <span class="text-sm">
        Smartphones
       </span>
      </div>
      <div class="flex items-center gap-3 p-3 text-[#484554] hover:pl-10 transition-all cursor-pointer">
       <span class="material-symbols-outlined" data-icon="laptop">
        laptop
       </span>
       <span class="text-sm">
        Laptops
       </span>
      </div>
      <div class="flex items-center gap-3 p-3 text-[#484554] hover:pl-10 transition-all cursor-pointer">
       <span class="material-symbols-outlined" data-icon="headset">
        headset
       </span>
       <span class="text-sm">
        Audio
       </span>
      </div>
      <div class="flex items-center gap-3 p-3 text-[#484554] hover:pl-10 transition-all cursor-pointer">
       <span class="material-symbols-outlined" data-icon="memory">
        memory
       </span>
       <span class="text-sm">
        Componentes
       </span>
      </div>
     </div>
    </div>
    <button class="mt-auto w-full py-4 rounded-xl bg-gradient-to-br from-primary to-primary-container text-on-primary font-bold shadow-lg shadow-primary/20 active:scale-95 transition-all">
     Aplicar Filtros
    </button>
   </aside>
   <!-- Main Product Canvas -->
   <section class="flex-1 px-8 py-8 bg-surface-container-low">
    <!-- Header Editorial Content -->
    <div class="mb-12 max-w-4xl">
     <span class="text-primary font-bold tracking-widest uppercase text-xs">
      Flagship Experience
     </span>
     <h1 class="text-5xl md:text-6xl font-headline font-extrabold text-on-surface tracking-tighter mt-4 leading-tight">
      Smartphones
      <br/>
      de Próxima Generación
     </h1>
     <p class="mt-6 text-on-surface-variant text-lg max-w-2xl leading-relaxed">
      Nuestra curaduría editorial presenta dispositivos que definen el futuro de la comunicación móvil. Estética minimalista combinada con ingeniería de vanguardia.
     </p>
    </div>
    <!-- Bento-style Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
     <!-- Large Featured Product Card -->
     <div class="md:col-span-2 xl:col-span-2 group relative overflow-hidden bg-surface-container-lowest rounded-xl flex flex-col md:flex-row shadow-[0_40px_60px_-15px_rgba(19,27,46,0.04)]">
      <div class="flex-1 p-8 md:p-12 flex flex-col justify-between">
       <div>
        <span class="bg-tertiary-fixed text-on-tertiary-fixed-variant px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider">
         Edición Especial
        </span>
        <h3 class="text-3xl font-headline font-extrabold text-on-surface mt-6">
         Galaxy Ultra Vision Z
        </h3>
        <p class="text-on-surface-variant mt-4 font-body leading-relaxed">
         El pináculo de la ingeniería móvil con pantalla Dynamic Liquid de 144Hz y sistema de cámaras Pro-Level.
        </p>
        <div class="mt-8">
         <span class="text-primary font-headline font-extrabold text-2xl">
          $1,299.00
         </span>
        </div>
       </div>
       <div class="mt-8 flex gap-4">
        <button class="px-8 py-3 bg-primary text-on-primary rounded-lg font-bold hover:shadow-xl transition-all">
         Añadir al Carrito
        </button>
        <button class="px-8 py-3 bg-surface-container-highest text-primary rounded-lg font-bold">
         Ver Detalles
        </button>
       </div>
      </div>
      <div class="flex-1 relative min-h-[300px] bg-surface-variant">
       <img alt="Galaxy Ultra Vision Z" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" data-alt="Close up high resolution shot of a sleek modern smartphone with metallic finish and triple lens camera system on soft gradient background" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAEKQ4AzUwMMw7bOZN2k6qSEx_Y3cKu0oTJu-QBBuuQXhyC8wsfi3n8UuWs9wg6VZbD2X8-B_9UG8LEs0vA29H47KCBL4K4P6V4UiaArwqLpXpd1wyYqch8ngcd99yNDpZqBHsl3bpJ1SJbWQa9qXSg8hPbhgVgA2sT-UEfGA_W6eWs0tRv8SD84XuKCgP8hgMXe8RtKDBYQy1Bc9JNBHbRPq2VaHUF6jFdMBthLyxkv8XnHp_0sfdjiAcDag_Ndi67Tr-Oq-z0r4o"/>
      </div>
     </div>
     <!-- Regular Product Card 1 -->
     <div class="group bg-surface-container-lowest rounded-xl overflow-hidden shadow-[0_40px_60px_-15px_rgba(19,27,46,0.04)]">
      <div class="h-64 bg-surface-variant overflow-hidden relative">
       <img alt="iPhone 15 Pro" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" data-alt="Side profile of a premium titanium smartphone reflecting soft studio lighting in a minimalist setting" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBhCREUSdy6obcwzw1n3ri4ny9SYvFN4PWluBvnu1EaiFppnZMjpd8PP0SoZAowDC2GDfDXoJ4iWtrNGIzXIjEUflh6DiDN19I7S1SsCZmDqtMHAhpPfxkp9Iqqv-mXQgVX9JvDtwVWSQIJfrOEtOrNzlCXJh0CaLyUxpXg3YS-ohNGwLmjuoQkjdplA0RQwBHKnnJ7kbjMRfXwe9r3frcONYX_-SdScAy6_p26nekDQS8Y2I-0k0Uc6Y8-nfozschO0BXXZub137o"/>
       <div class="absolute top-4 right-4 bg-white/80 backdrop-blur rounded-full p-2">
        <span class="material-symbols-outlined text-primary" data-icon="favorite">
         favorite
        </span>
       </div>
      </div>
      <div class="p-6">
       <h4 class="font-headline font-bold text-xl text-on-surface">
        iPhone 15 Pro Max
       </h4>
       <p class="text-on-surface-variant text-sm mt-2 font-body">
        Diseño en titanio de grado aeroespacial.
       </p>
       <div class="mt-6 flex justify-between items-center">
        <span class="text-primary font-bold text-xl">
         $1,199.00
        </span>
        <button class="w-10 h-10 bg-primary text-on-primary rounded-full flex items-center justify-center hover:scale-110 transition-transform">
         <span class="material-symbols-outlined text-sm" data-icon="add">
          add
         </span>
        </button>
       </div>
      </div>
     </div>
     <!-- Regular Product Card 2 -->
     <div class="group bg-surface-container-lowest rounded-xl overflow-hidden shadow-[0_40px_60px_-15px_rgba(19,27,46,0.04)]">
      <div class="h-64 bg-surface-variant overflow-hidden relative">
       <img alt="Pixel 8 Pro" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" data-alt="Google Pixel phone showing the horizontal camera bar on a soft pastel background with crisp lighting" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBogBkbzDc4fWFsAOCTxhcNXSc-nVFaK8Egc9cWr-rCeJvcUz5vF2cEU8spxq6IPk1DbX1PY_XNkBm3zh1oao9V9Tf8Joc0gC9lH53j5NIOUCoI6v3Jc2DOTRoAD5O1iBU9YR6fIKlOT4jBJwb9PUTiR5xyuuiSYNfd2dAWznGh6174ceJq_1_R-cVVwtsAZ3SRU2kZ22HULKkP1YK2AEDV0aPHlLpZcauETwzzaP08trs7dOBSiwuZgBBq9BDXt8NyZlwpwkEqo48"/>
      </div>
      <div class="p-6">
       <h4 class="font-headline font-bold text-xl text-on-surface">
        Google Pixel 8 Pro
       </h4>
       <p class="text-on-surface-variant text-sm mt-2 font-body">
        La IA más avanzada en un smartphone.
       </p>
       <div class="mt-6 flex justify-between items-center">
        <span class="text-primary font-bold text-xl">
         $999.00
        </span>
        <button class="w-10 h-10 bg-primary text-on-primary rounded-full flex items-center justify-center hover:scale-110 transition-transform">
         <span class="material-symbols-outlined text-sm" data-icon="add">
          add
         </span>
        </button>
       </div>
      </div>
     </div>
     <!-- Regular Product Card 3 -->
     <div class="group bg-surface-container-lowest rounded-xl overflow-hidden shadow-[0_40px_60px_-15px_rgba(19,27,46,0.04)]">
      <div class="h-64 bg-surface-variant overflow-hidden relative">
       <img alt="Nothing Phone 2" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" data-alt="Minimalist smartphone with transparent back design and glowing led strips on a dark matte surface" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAcNh9vevDym9r21CYwZTxqA4fqdtQpaEHEtwwWfCfkvHSdofeEBIQwb6E3-5Mbdw3LSgsCui2Io9YLZSiKVlOX4KQCAvX5erRDQb4tobOc0hR2hq-8Ux1Sk20kxE-MACWwMGBAdO2-CWMkfgFO9scQH680ePFEUU_vyXgLCgdweWaJu0oaT5jSXZrwuKyAQx-2sNrz7TVrpxmF2tUqipydcD1_r5DdSM5-flEeUsVEaQmY1qHpqJjiB16Yr5jSfUOZ7C2iTat1ZjI"/>
      </div>
      <div class="p-6">
       <h4 class="font-headline font-bold text-xl text-on-surface">
        Nothing Phone (2)
       </h4>
       <p class="text-on-surface-variant text-sm mt-2 font-body">
        Un nuevo enfoque de diseño icónico.
       </p>
       <div class="mt-6 flex justify-between items-center">
        <span class="text-primary font-bold text-xl">
         $699.00
        </span>
        <button class="w-10 h-10 bg-primary text-on-primary rounded-full flex items-center justify-center hover:scale-110 transition-transform">
         <span class="material-symbols-outlined text-sm" data-icon="add">
          add
         </span>
        </button>
       </div>
      </div>
     </div>
     <!-- Spec Blade Contrast Moment -->
     <div class="col-span-1 md:col-span-2 xl:col-span-3 mt-12 mb-12">
      <div class="bg-inverse-surface rounded-3xl p-12 md:p-20 flex flex-col md:flex-row items-center gap-12 overflow-hidden relative">
       <div class="absolute top-0 right-0 w-96 h-96 bg-primary opacity-20 blur-[100px] -mr-48 -mt-48">
       </div>
       <div class="flex-1 z-10">
        <h2 class="text-4xl md:text-5xl font-headline font-black text-inverse-on-surface leading-tight">
         Potencia sin precedentes.
         <br/>
         Diseño sin compromisos.
        </h2>
        <p class="text-inverse-on-surface/70 mt-8 text-lg max-w-xl">
         Todos nuestros dispositivos están certificados para ofrecer la mejor experiencia de usuario, con garantías extendidas y soporte técnico especializado.
        </p>
       </div>
       <div class="flex-none grid grid-cols-2 gap-8 z-10">
        <div class="text-center">
         <div class="text-3xl font-black text-primary-fixed">
          5G
         </div>
         <div class="text-xs text-inverse-on-surface/50 uppercase mt-2 font-bold tracking-widest">
          Velocidad
         </div>
        </div>
        <div class="text-center">
         <div class="text-3xl font-black text-primary-fixed">
          12GB
         </div>
         <div class="text-xs text-inverse-on-surface/50 uppercase mt-2 font-bold tracking-widest">
          RAM Min.
         </div>
        </div>
        <div class="text-center">
         <div class="text-3xl font-black text-primary-fixed">
          OLED
         </div>
         <div class="text-xs text-inverse-on-surface/50 uppercase mt-2 font-bold tracking-widest">
          Panel
         </div>
        </div>
        <div class="text-center">
         <div class="text-3xl font-black text-primary-fixed">
          48h
         </div>
         <div class="text-xs text-inverse-on-surface/50 uppercase mt-2 font-bold tracking-widest">
          Batería
         </div>
        </div>
       </div>
      </div>
     </div>
    </div>
   </section>
  </main>
  <!-- Footer -->
  <footer class="bg-[#283044] dark:bg-[#0a0f1a] w-full py-12 px-8 mt-auto">
   <div class="flex flex-col md:flex-row justify-between items-center gap-6 w-full max-w-7xl mx-auto">
    <div class="font-manrope font-black text-[#faf8ff] text-2xl tracking-tighter">
     TechVision
    </div>
    <nav class="flex gap-8 font-inter text-xs uppercase tracking-widest">
     <a class="text-[#d2d9f4]/60 hover:text-[#faf8ff] transition-colors underline decoration-[#451ebb]" href="#">
      Privacidad
     </a>
     <a class="text-[#d2d9f4]/60 hover:text-[#faf8ff] transition-colors" href="#">
      Soporte
     </a>
     <a class="text-[#d2d9f4]/60 hover:text-[#faf8ff] transition-colors" href="#">
      Envíos
     </a>
     <a class="text-[#d2d9f4]/60 hover:text-[#faf8ff] transition-colors" href="#">
      Garantía
     </a>
    </nav>
    <div class="font-inter text-xs text-[#e6deff]/40 tracking-widest uppercase">
     © 2024 TechVision Editorial. Todos los derechos reservados.
    </div>
   </div>
  </footer>
  <!-- FAB for focused action (Contextual mapping) -->
  <button class="fixed bottom-8 right-8 w-16 h-16 bg-gradient-to-br from-primary to-primary-container text-on-primary rounded-full shadow-2xl flex items-center justify-center active:scale-95 transition-all z-40 lg:hidden">
   <span class="material-symbols-outlined" data-icon="filter_list">
    filter_list
   </span>
  </button>
 </body>
</html>
