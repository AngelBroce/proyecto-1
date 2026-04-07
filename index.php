<?php
require_once __DIR__ . '/funciones/general.php';
require_once __DIR__ . '/funciones/productos.php';
?>
<!DOCTYPE html>
<html class="light" lang="es">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <title>
   TechVision | Editorial Electronics
  </title>
  <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;700;800&amp;family=Inter:wght@400;500;600&amp;display=swap" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
  <link href="css/styles.css" rel="stylesheet"/>
  <script src="js/tailwindcss.js">
  </script>
  <script src="js/tailwind-config.js">
  </script>
 </head>
 <body class="bg-surface text-on-surface selection:bg-primary-fixed selection:text-on-primary-fixed">
  <!-- TopAppBar -->
  <header class="fixed top-0 w-full z-50 bg-[#faf8ff]/80 dark:bg-[#131b2e]/80 backdrop-blur-xl shadow-[0_40px_60px_-15px_rgba(19,27,46,0.04)]">
   <div class="flex justify-between items-center px-8 py-4 max-w-none w-full">
    <div class="flex items-center gap-8">
     <span class="text-2xl font-black tracking-tighter text-[#131b2e] dark:text-[#faf8ff] font-headline">
      TechVision
     </span>
     <nav class="hidden md:flex gap-6">
      <a class="font-manrope font-bold text-lg tracking-tight text-[#451ebb] dark:text-[#e6deff] border-b-2 border-[#451ebb] pb-1" href="#">
       Smartphones
      </a>
      <a class="font-manrope font-bold text-lg tracking-tight text-[#484554] dark:text-[#d2d9f4] hover:text-[#451ebb] transition-colors" href="#">
       Laptops
      </a>
      <a class="font-manrope font-bold text-lg tracking-tight text-[#484554] dark:text-[#d2d9f4] hover:text-[#451ebb] transition-colors" href="#">
       Audio
      </a>
      <a class="font-manrope font-bold text-lg tracking-tight text-[#484554] dark:text-[#d2d9f4] hover:text-[#451ebb] transition-colors" href="#">
       Ofertas
      </a>
     </nav>
    </div>
    <div class="flex items-center gap-4">
     <div class="hidden lg:flex items-center bg-surface-container-low px-4 py-2 rounded-full">
      <span class="material-symbols-outlined text-on-surface-variant text-sm">
       search
      </span>
      <input class="bg-transparent border-none focus:ring-0 text-sm w-48 font-body" placeholder="Buscar tecnología..." type="text"/>
     </div>
     <div class="flex items-center gap-2">
      <button class="p-2 hover:bg-[#f2f3ff] dark:hover:bg-[#283044] rounded-lg transition-all active:scale-95 duration-200">
       <span class="material-symbols-outlined text-[#451ebb] dark:text-[#e6deff]">
        shopping_cart
       </span>
      </button>
      <button class="p-2 hover:bg-[#f2f3ff] dark:hover:bg-[#283044] rounded-lg transition-all active:scale-95 duration-200">
       <span class="material-symbols-outlined text-[#451ebb] dark:text-[#e6deff]">
        person
       </span>
      </button>
     </div>
    </div>
   </div>
  </header>
  <main class="pt-24">
   <!-- Hero Section -->
   <section class="px-8 py-12">
    <div class="relative overflow-hidden rounded-xl hero-gradient min-h-[600px] flex items-center">
     <div class="grid lg:grid-cols-2 w-full px-12 gap-12 z-10">
      <div class="flex flex-col justify-center text-on-primary">
       <span class="font-label uppercase tracking-widest text-primary-fixed mb-4">
        Lanzamiento Exclusivo
       </span>
       <h1 class="font-headline font-extrabold text-5xl md:text-7xl mb-6 leading-tight">
        Vision Pro
        <br/>
        Max 15
       </h1>
       <p class="font-body text-lg text-primary-fixed/80 max-w-md mb-8">
        Experimenta la cúspide de la ingeniería móvil con el nuevo procesador Quantum y una pantalla que redefine la realidad.
       </p>
       <div class="flex gap-4">
        <button class="bg-surface-container-lowest text-primary px-8 py-4 rounded-lg font-bold shadow-lg hover:scale-105 transition-transform active:scale-95">
         Comprar ahora
        </button>
        <button class="border border-primary-fixed/30 text-primary-fixed px-8 py-4 rounded-lg font-bold hover:bg-primary-container/50 transition-colors">
         Ver detalles
        </button>
       </div>
      </div>
      <div class="relative flex justify-center items-center">
       <div class="absolute inset-0 bg-white/10 blur-3xl rounded-full scale-75">
       </div>
       <img alt="Smartphone Vision Pro Max" class="relative z-10 w-full max-w-md object-contain transform hover:rotate-2 transition-transform duration-700" data-alt="Modern sleek purple smartphone floating against a dark violet gradient background with dramatic cinematic studio lighting and reflections" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBFJ9pJaFww8RoGy99wSAOn09Zs0G162WVmxZ7zfpzTIWR5_43gCrZSFhCNhiLQ-cdMvHEI3W63LSAR2YkcJRTMftuB8oJqff0oFIg5ZHed1OWk59EhoJygm1-3FSByZXLxfIuiAAkOcLqvMLn3deBrrJz5j1Sy-k_n2arWwl_80dgzwhtaIcx2leps-eI7--9juu8jhTmSCgqDJoQ_rfGVMofhvYxXpkigrLpWQMnu7xw-rvB78IDDG5xkw1XjjTiRnpT76cvqTME"/>
      </div>
     </div>
    </div>
   </section>
   <!-- Categories Bento Grid -->
   <section class="px-8 py-16 bg-surface-container-low">
    <div class="mb-12 flex justify-between items-end">
     <div>
      <h2 class="font-headline text-3xl font-black text-on-surface">
       Explora por Categoría
      </h2>
      <p class="text-on-surface-variant font-body mt-2">
       Tecnología seleccionada para tu estilo de vida.
      </p>
     </div>
     <a class="text-primary font-bold flex items-center gap-2 hover:underline" href="#">
      Ver catálogo completo
      <span class="material-symbols-outlined">
       arrow_forward
      </span>
     </a>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-4 grid-rows-2 gap-6 h-[600px]">
     <div class="md:col-span-2 md:row-span-2 bg-surface-container-lowest rounded-xl p-8 flex flex-col justify-between group cursor-pointer hover:shadow-xl transition-all">
      <div>
       <h3 class="font-headline text-2xl font-bold">
        Smartphones
       </h3>
       <p class="text-on-surface-variant text-sm mt-1">
        Lo último en potencia móvil.
       </p>
      </div>
      <img alt="Smartphones" class="w-full h-64 object-contain group-hover:scale-110 transition-transform duration-500" data-alt="Collection of high-end smartphones arranged artistically on a clean gray surface with soft shadows" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBoLRhyfffr9BwSxMXR41Eu8eS4Ca7Ak2IrBE6ZcJuWPqgOxo8qVQiniOOAckstfhTv5jSJjJsToivSVwn_VBh5oz4g5otBOvQLQ8eNWfQfQPrae_6FhLkIbFEWUvaLis-77kMuf0zW5Mzr7sJwMP3qgHRXCCpDOxEE4JDmBh3gqRW_AfSZwM_3JUsZ7DDIgP6CiSwbCSqJaG783ekUm965gae6naICx6mZA2Qt9zg-wrTsYrzL0JN2SmsnSr4T2uIFhM17XD4GjdA"/>
     </div>
     <div class="md:col-span-2 bg-surface-container-lowest rounded-xl p-8 flex items-center justify-between group cursor-pointer hover:shadow-xl transition-all overflow-hidden">
      <div class="max-w-[50%]">
       <h3 class="font-headline text-2xl font-bold">
        Laptops
       </h3>
       <p class="text-on-surface-variant text-sm mt-1">
        Productividad sin límites.
       </p>
      </div>
      <img alt="Laptops" class="w-1/2 h-full object-cover rounded-lg group-hover:translate-x-4 transition-transform duration-500" data-alt="Sleek silver aluminum laptop open on a white desk in a bright minimalist home office setting" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAH_bdCl6zmDlVQ9UiUFMMyDfxAnt2gNor_g9SjS8k2Jbz66k1Vic2iJxTRNdrVUznZYTdXPvjmbhViEqoeZcH3sfO2NCdn_kqe1syUR0FX_rq8erMJNwpgvkfTBAg8k8jitdKJMkAam0KFbANQWrchv3-s0V4rUe7WEuF-mKIfuYSR6CS_8nTuduq-9x47l8MJIBrD0vi8Fy4GsZ3xY9ZhNO8uruHO-K--7OHXgqMCk8KLKtdQ9mWF373ZJ3op9uAvQexZAtBcCKA"/>
     </div>
     <div class="bg-surface-container-lowest rounded-xl p-6 flex flex-col justify-between group cursor-pointer hover:shadow-xl transition-all">
      <h3 class="font-headline text-xl font-bold">
       Audio
      </h3>
      <img alt="Audio" class="w-full h-32 object-contain group-hover:scale-105 transition-transform" data-alt="Premium wireless over-ear headphones in matte black finish on a dark textured background" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCTUSJWj8StYNnYaBU1jZvX4BxHN_KkxFTJLPVnVZYuztFiQgosHH3u202GubdQ-x4WxRiG8BuO5ogD9_vqiYJIGdBaN_iA4dr4iZrjtWfl4_LW1Wgl3F0BN6sZJ3d_10YkGxp1i_hlWNcT4dnL7TYN2OccUqfqr8AbTyP-waBqACG40QB78fsjZTMwJ09JwYrIN701ScsZ6VhH6VwtCYIoSfRvIQUxP2HMJw20udby3opnqov9sgXl1pjp44cVwJ6pNrdMANpGJrs"/>
     </div>
     <div class="bg-surface-container-lowest rounded-xl p-6 flex flex-col justify-between group cursor-pointer hover:shadow-xl transition-all">
      <h3 class="font-headline text-xl font-bold">
       Tablets
      </h3>
      <img alt="Tablets" class="w-full h-32 object-contain group-hover:scale-105 transition-transform" data-alt="Modern tablet with digital pen lying on a clean workspace with artistic wallpapers on screen" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCuMy6qC19zjc1M2zu5E0ZW_rB8mM3rWzubbZ7J71j5jwG9jCSmuWlhky2Pd3SJrRpZctbVOYvfb5p8msXPRJerucqSIMdXBzWTBM0qYMPVtahJiNqg7wwbd_cVxK0LFd5tYDsynWbeXxPLQ9PDdJ0_x_EQRYjqekVC9oizJkOWjclno2d1USihRWnGN_XdAp3zPLRnfzvpz7dUH53b7I1baznBbK_eWAZXt6Hdr_q1xs40WlgKOFKx9N9P7VRrWdPefC_7L9AUztM"/>
     </div>
    </div>
   </section>
   <!-- Featured Products -->
   <section class="px-8 py-20">
    <div class="text-center mb-16">
     <h2 class="font-headline text-4xl font-black text-on-surface">
      Selección Editorial
     </h2>
     <p class="text-on-surface-variant font-body mt-4 text-lg">
      Los productos que definen el futuro, hoy.
     </p>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
     <!-- Product Card 1 -->
     <div class="flex flex-col group">
      <div class="aspect-square bg-surface-container-low rounded-xl mb-6 p-8 relative overflow-hidden flex items-center justify-center">
       <div class="absolute top-4 right-4 bg-primary text-on-primary text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-widest">
        Nuevo
       </div>
       <img alt="Audio Master 5" class="w-full h-full object-contain group-hover:scale-110 transition-transform duration-500" data-alt="Elegant black headphones presented in a professional studio setup with soft rim lighting" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBvYT3mahM4iEwh2JgT3JQeNbK8YP_kwv7aZTZTK9PjYzhKsZAft0ku2plIYgQwpSDoC-zAvKqxeeb-ILRaSIXi69FIC0MnMA0dyuNAMFm9iCZiunGh1Rbcdd3hBVusUfZw66SkJ6r4_QR8mTB19xc9VG_v-NmqHG2fJquD5Kj7eIAQG271QBXLQkGyDspjEZmM2ihionLQg7SUCIKRMV7k1pCMXkwelFh8o2HvjFD1N-7uPo0xmFPaLNw5OOPQE2V4O_gDlqA1ukc"/>
      </div>
      <div class="px-2">
       <span class="text-on-surface-variant text-xs font-label uppercase tracking-tighter mb-1 block">
        Audio / TechVision
       </span>
       <h4 class="font-headline text-xl font-bold mb-2">
        Audio Master 5 Pro
       </h4>
       <div class="flex items-center justify-between">
        <span class="font-headline font-extrabold text-lg text-primary">
         $349.00
        </span>
        <button class="bg-surface-container-highest p-2 rounded-lg text-primary hover:bg-primary hover:text-on-primary transition-colors">
         <span class="material-symbols-outlined">
          add_shopping_cart
         </span>
        </button>
       </div>
      </div>
     </div>
     <!-- Product Card 2 -->
     <div class="flex flex-col group">
      <div class="aspect-square bg-surface-container-low rounded-xl mb-6 p-8 relative overflow-hidden flex items-center justify-center">
       <img alt="Workstation Laptop" class="w-full h-full object-contain group-hover:scale-110 transition-transform duration-500" data-alt="Top view of a high-performance gaming laptop with backlit keyboard in a dark room" src="https://lh3.googleusercontent.com/aida-public/AB6AXuA_u4OWzUE5UkPjQAd9Am0j3ArGNV59Z4MKyIjhKxEtM00j6J2r-KT2Ab7Tb4P_E2lPs3WryWHisqhn5XI3HCjjO_JCF-lCgvDYhLcnjYpUn0wVtEwJhgk0IE0mXuwIsGoH73GDQnJOdIu_jrIvU8aVtS1fSyXD7cvISdtP0WqL9NUXp0IUJeCesyntEqlnB0x0mb2Cr5z2AZhZDAg40ch5X0009Oby0Qar1s_giOrPLsrIEv1YDWNVIZfFvzceQTkfQdQdEUz98Ps"/>
      </div>
      <div class="px-2">
       <span class="text-on-surface-variant text-xs font-label uppercase tracking-tighter mb-1 block">
        Laptops / TechVision
       </span>
       <h4 class="font-headline text-xl font-bold mb-2">
        VisionBook Air M2
       </h4>
       <div class="flex items-center justify-between">
        <span class="font-headline font-extrabold text-lg text-primary">
         $1,299.00
        </span>
        <button class="bg-surface-container-highest p-2 rounded-lg text-primary hover:bg-primary hover:text-on-primary transition-colors">
         <span class="material-symbols-outlined">
          add_shopping_cart
         </span>
        </button>
       </div>
      </div>
     </div>
     <!-- Product Card 3 -->
     <div class="flex flex-col group">
      <div class="aspect-square bg-surface-container-low rounded-xl mb-6 p-8 relative overflow-hidden flex items-center justify-center">
       <span class="absolute top-4 right-4 bg-on-tertiary-fixed-variant text-tertiary-fixed text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-widest">
        Edición Limitada
       </span>
       <img alt="Smartwatch" class="w-full h-full object-contain group-hover:scale-110 transition-transform duration-500" data-alt="Premium smartwatch with a minimalist white face and silver metal band on a clean white surface" src="https://lh3.googleusercontent.com/aida-public/AB6AXuB8Yxtc92MW0qGQteXrpYcpj8Yeqcdfovz6AQjgU6woMbmNrjRr8NGE5r-HAyRV25llUWqAKXMXjNVTaSgV7DRhUGD0G-i1APeDgR_7HMezkf3RtPqbzDbJaqf7Kbf7wrJ8q9uHmCbOAR-lmIS3WdaHD5-VbW5HMC2AwDtFIcVlbTU28d2-jUoLc1wW3RzY26nR2tKAtOcqtpXjCYJAzuxQog5Ap3XSbKtooxyJK5_PtEfq09pP6Jz4wN7vzExgd54hot5nthMnsmo"/>
      </div>
      <div class="px-2">
       <span class="text-on-surface-variant text-xs font-label uppercase tracking-tighter mb-1 block">
        Wearables / TechVision
       </span>
       <h4 class="font-headline text-xl font-bold mb-2">
        Chronos Watch Ultra
       </h4>
       <div class="flex items-center justify-between">
        <span class="font-headline font-extrabold text-lg text-primary">
         $499.00
        </span>
        <button class="bg-surface-container-highest p-2 rounded-lg text-primary hover:bg-primary hover:text-on-primary transition-colors">
         <span class="material-symbols-outlined">
          add_shopping_cart
         </span>
        </button>
       </div>
      </div>
     </div>
     <!-- Product Card 4 -->
     <div class="flex flex-col group">
      <div class="aspect-square bg-surface-container-low rounded-xl mb-6 p-8 relative overflow-hidden flex items-center justify-center">
       <img alt="Gaming Console" class="w-full h-full object-contain group-hover:scale-110 transition-transform duration-500" data-alt="Close up of a modern gaming console controller with glowing LEDs in a futuristic gaming setup" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAjoHkeEpthD1t6LE4MvLB69Pml7j26_9NeEFuEo3i7uwK3rzb4jHqVzMGMf0vti6ioV9eNkAXuQsZn-mJjPA27hkjcVmbXCTb-u3rmgZ39jfNfvHxGMIU8HXw2Ca042p-MFBK7YTm1if10ZLCieXqsZhZxpCmcf71R_eUbAV8EI0EEixbznB6pnhCR88q7C3Ou278v84VPZ__FjOMlvOPYVl41YT_PzRjBbEueDFdsoDhbV7C1dSqo2ewsfnI1P6FRb8sgnYAMMG8"/>
      </div>
      <div class="px-2">
       <span class="text-on-surface-variant text-xs font-label uppercase tracking-tighter mb-1 block">
        Gaming / TechVision
       </span>
       <h4 class="font-headline text-xl font-bold mb-2">
        Nexus Pro Console
       </h4>
       <div class="flex items-center justify-between">
        <span class="font-headline font-extrabold text-lg text-primary">
         $549.00
        </span>
        <button class="bg-surface-container-highest p-2 rounded-lg text-primary hover:bg-primary hover:text-on-primary transition-colors">
         <span class="material-symbols-outlined">
          add_shopping_cart
         </span>
        </button>
       </div>
      </div>
     </div>
    </div>
   </section>
   <!-- Spec Blade (High Contrast Moment) -->
   <section class="bg-inverse-surface py-24">
    <div class="max-w-6xl mx-auto px-8 grid lg:grid-cols-2 gap-16 items-center">
     <div class="text-inverse-on-surface">
      <h2 class="font-headline text-5xl font-extrabold mb-8 tracking-tighter">
       Ingeniería sin compromisos.
      </h2>
      <div class="space-y-8">
       <div class="flex gap-6 items-start">
        <span class="material-symbols-outlined text-primary-fixed text-3xl">
         memory
        </span>
        <div>
         <h4 class="font-bold text-xl mb-2">
          Chip Q1 Quantum
         </h4>
         <p class="text-inverse-on-surface/70">
          Un 40% más rápido que la generación anterior, optimizado para IA generativa local.
         </p>
        </div>
       </div>
       <div class="flex gap-6 items-start">
        <span class="material-symbols-outlined text-primary-fixed text-3xl">
         battery_charging_full
        </span>
        <div>
         <h4 class="font-bold text-xl mb-2">
          Autonomía de 72 Horas
         </h4>
         <p class="text-inverse-on-surface/70">
          Gestión de energía inteligente que aprende de tus patrones de uso diarios.
         </p>
        </div>
       </div>
       <div class="flex gap-6 items-start">
        <span class="material-symbols-outlined text-primary-fixed text-3xl">
         camera
        </span>
        <div>
         <h4 class="font-bold text-xl mb-2">
          Sensor Óptico Pro
         </h4>
         <p class="text-inverse-on-surface/70">
          Captura detalles invisibles al ojo humano con nuestro nuevo sistema tri-lente.
         </p>
        </div>
       </div>
      </div>
     </div>
     <div class="bg-primary-container/20 rounded-2xl p-1 shadow-2xl overflow-hidden group">
      <img alt="Internal Hardware" class="w-full h-[500px] object-cover rounded-xl opacity-80 group-hover:opacity-100 group-hover:scale-105 transition-all duration-1000" data-alt="Detailed close up of futuristic circuit board with glowing purple and blue light paths and high-tech components" src="https://lh3.googleusercontent.com/aida-public/AB6AXuB7UYJ-KdANuKPJB3KoWcOuKBiGuBS4gp_oh9C8IPIB8afLv80ilJ_PkCE70eHD4pr359LQTP_Qy0xiJNO17by9w65ZLZycCwhZdUo8NOIX0dXl7PoYoparTzBzIkO_uT8Sa6GGxxea-5C5zYB1fFw5X-1MfGcAoL6dESt6r32BFlzGorXly1sG3MbRvOYQY7BefRSpQ5esBFcqLYjPW35becbFFKHt2QiR9AeblumDFueX2c1R9pTeP90hrkrYdC93PUd_hlyqZqE"/>
     </div>
    </div>
   </section>
   <!-- CTA Newsletter -->
   <section class="px-8 py-24 flex justify-center">
    <div class="bg-surface-container-highest rounded-2xl p-12 w-full max-w-4xl text-center border border-primary/10">
     <h3 class="font-headline text-3xl font-black mb-4">
      Únete a la Vanguardia
     </h3>
     <p class="text-on-surface-variant font-body mb-8">
      Suscríbete para recibir noticias exclusivas sobre lanzamientos y acceso prioritario a preventas.
     </p>
     <form class="flex flex-col sm:flex-row gap-4 max-w-lg mx-auto">
      <input class="flex-grow bg-surface-container-low border-none rounded-lg px-6 py-4 focus:ring-2 focus:ring-primary/40 font-body outline-none" placeholder="tu@email.com" type="email"/>
      <button class="bg-primary text-on-primary px-8 py-4 rounded-lg font-bold hover:shadow-lg transition-shadow" type="submit">
       Suscribirse
      </button>
     </form>
    </div>
   </section>
  </main>
  <!-- Footer -->
  <footer class="bg-[#283044] dark:bg-[#0a0f1a] w-full py-12 px-8 mt-auto">
   <div class="flex flex-col md:flex-row justify-between items-center gap-6 w-full">
    <div class="flex flex-col gap-2">
     <span class="font-manrope font-black text-[#faf8ff] text-2xl">
      TechVision
     </span>
     <p class="text-[#d2d9f4]/60 font-inter text-xs uppercase tracking-widest max-w-xs text-center md:text-left">
      Curando el futuro de la tecnología para el usuario moderno.
     </p>
    </div>
    <div class="flex gap-8">
     <a class="font-inter text-xs uppercase tracking-widest text-[#d2d9f4]/60 hover:text-[#faf8ff] transition-colors underline decoration-[#451ebb]" href="#">
      Privacidad
     </a>
     <a class="font-inter text-xs uppercase tracking-widest text-[#d2d9f4]/60 hover:text-[#faf8ff] transition-colors underline decoration-[#451ebb]" href="#">
      Soporte
     </a>
     <a class="font-inter text-xs uppercase tracking-widest text-[#d2d9f4]/60 hover:text-[#faf8ff] transition-colors underline decoration-[#451ebb]" href="#">
      Envíos
     </a>
     <a class="font-inter text-xs uppercase tracking-widest text-[#d2d9f4]/60 hover:text-[#faf8ff] transition-colors underline decoration-[#451ebb]" href="#">
      Garantía
     </a>
    </div>
    <div class="text-[#faf8ff] font-inter text-xs uppercase tracking-widest opacity-80 hover:opacity-100 transition-opacity">
     © 2024 TechVision Editorial. Todos los derechos reservados.
    </div>
   </div>
  </footer>
 </body>
</html>
