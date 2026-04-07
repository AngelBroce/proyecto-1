<?php
require_once __DIR__ . '/../funciones/auth.php';
?>
<!DOCTYPE html>
<html class="light" lang="es">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <link href="../css/styles.css" rel="stylesheet"/>
  <link href="../css/login.css" rel="stylesheet"/>
  <script src="../js/tailwindcss.js">
  </script>
  <script src="../js/tailwind-config.js">
  </script>
  <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;700;800&amp;family=Inter:wght@400;500;600&amp;display=swap" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
 </head>
 <body class="bg-surface font-body text-on-surface antialiased min-h-screen flex flex-col">
  <!-- TopNavBar suppressed per "Destination Rule" (Login screen es transactional) -->
  <main class="flex-grow flex items-center justify-center px-6 py-12">
   <!-- Main Central Card -->
   <div class="w-full max-w-2xl bg-surface-container-lowest rounded-xl soft-elevation p-8 md:p-12 border border-outline-variant/10">
    <!-- Header Section -->
    <header class="text-center mb-12">
     <div class="mb-6 inline-block">
      <span class="text-2xl font-black text-on-surface tracking-tighter font-headline">
       TechVision
      </span>
     </div>
     <h1 class="text-3xl md:text-4xl font-extrabold font-headline text-on-surface mb-3 tracking-tight">
      Bienvenido a TechVision
     </h1>
     <p class="text-on-surface-variant text-lg">
      Seleccione su perfil para continuar
     </p>
    </header>
    <!-- Role Selection Section -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-12">
     <!-- Administrator Card -->
     <button class="group flex flex-col items-center justify-center p-6 bg-surface-container-low rounded-xl transition-all duration-200 border-2 border-transparent hover:border-primary/40 focus:border-primary focus:bg-surface-container-lowest outline-none">
      <div class="w-14 h-14 rounded-full bg-surface-container-highest flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-200">
       <span class="material-symbols-outlined text-primary text-3xl" data-icon="admin_panel_settings">
        admin_panel_settings
       </span>
      </div>
      <span class="font-headline font-bold text-on-surface">
       Administrador
      </span>
     </button>
     <!-- Employee Card (Active/Selected State Example) -->
     <button class="group flex flex-col items-center justify-center p-6 bg-surface-container-lowest rounded-xl transition-all duration-200 border-2 border-primary shadow-sm outline-none">
      <div class="w-14 h-14 rounded-full bg-primary-fixed flex items-center justify-center mb-4">
       <span class="material-symbols-outlined text-primary text-3xl" data-icon="badge">
        badge
       </span>
      </div>
      <span class="font-headline font-bold text-on-surface">
       Empleado
      </span>
     </button>
     <!-- Customer Card -->
     <button class="group flex flex-col items-center justify-center p-6 bg-surface-container-low rounded-xl transition-all duration-200 border-2 border-transparent hover:border-primary/40 focus:border-primary focus:bg-surface-container-lowest outline-none">
      <div class="w-14 h-14 rounded-full bg-surface-container-highest flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-200">
       <span class="material-symbols-outlined text-primary text-3xl" data-icon="shopping_bag">
        shopping_bag
       </span>
      </div>
      <span class="font-headline font-bold text-on-surface">
       Cliente
      </span>
     </button>
    </div>
    <!-- Login Form -->
    <form class="max-w-md mx-auto space-y-6">
     <div class="space-y-2">
      <label class="text-sm font-semibold text-on-surface-variant px-1" for="email">
       Correo Electrónico
      </label>
      <input class="w-full px-4 py-4 rounded-xl bg-surface-container-low border-none focus:ring-2 focus:ring-primary/40 transition-all outline-none text-on-surface placeholder:text-outline/60" id="email" name="email" placeholder="nombre@ejemplo.com" type="email"/>
     </div>
     <div class="space-y-2">
      <div class="flex justify-between items-center px-1">
       <label class="text-sm font-semibold text-on-surface-variant" for="password">
        Contraseña
       </label>
       <a class="text-xs font-bold text-primary hover:text-primary-container transition-colors" href="#">
        ¿Olvidó su contraseña?
       </a>
      </div>
      <input class="w-full px-4 py-4 rounded-xl bg-surface-container-low border-none focus:ring-2 focus:ring-primary/40 transition-all outline-none text-on-surface placeholder:text-outline/60" id="password" name="password" placeholder="••••••••" type="password"/>
     </div>
     <div class="pt-4">
      <button class="w-full editorial-gradient py-4 rounded-xl text-on-primary font-bold font-headline text-lg hover:opacity-90 transition-opacity active:scale-[0.98] duration-200 shadow-lg shadow-primary/20" type="submit">
       Iniciar Sesión
      </button>
     </div>
    </form>
    <!-- Footer Link -->
    <p class="text-center mt-10 text-on-surface-variant text-sm">
     ¿No tiene una cuenta?
     <a class="font-bold text-primary hover:underline" href="#">
      Regístrese aquí
     </a>
    </p>
   </div>
  </main>
  <!-- Footer Component from JSON Mapping -->
  <footer class="w-full px-8 py-12 flex flex-col md:flex-row justify-between items-center gap-4 bg-[#f2f3ff] dark:bg-[#1c253d] font-['Inter'] text-sm tracking-wide">
   <div class="text-xl font-bold text-[#131b2e] dark:text-[#faf8ff] font-headline">
    TechVision
   </div>
   <div class="flex flex-wrap justify-center gap-6">
    <a class="text-[#484554] hover:text-[#451ebb] transition-colors" href="#">
     Privacy Policy
    </a>
    <a class="text-[#484554] hover:text-[#451ebb] transition-colors" href="#">
     Terms of Service
    </a>
    <a class="text-[#484554] hover:text-[#451ebb] transition-colors" href="#">
     Security
    </a>
   </div>
   <div class="text-[#484554]">
    © 2024 TechVision Curator. All rights reserved.
   </div>
  </footer>
 </body>
</html>
