<?php
require_once __DIR__ . '/../funciones/general.php';
require_once __DIR__ . '/../funciones/auth.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = trim($_POST['usuario'] ?? '');
    $contrasena = trim($_POST['password'] ?? '');

    $usuarioAutenticado = autenticar_empleado($usuario, $contrasena);

    if ($usuarioAutenticado) {
        guardar_sesion_usuario($usuarioAutenticado);
        header('Location: ' . (($usuarioAutenticado['rol'] ?? '') === 'admin' ? 'dashboard.php' : 'index.php'));
        exit;
    }

    $error = 'Usuario o contraseña incorrectos.';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>TechVision | Iniciar sesión</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;700;800&family=Inter:wght@400;500;600;700;800&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
  <link href="../css/styles.css" rel="stylesheet"/>
  <link href="../css/admin.css" rel="stylesheet"/>
  <script src="../js/tailwindcss.js"></script>
  <script src="../js/tailwind-config.js"></script>
</head>
<body class="login-body">
  <?php render_header(''); ?>

  <main class="login-page" style="padding-top: 88px;">
    <div class="login-center">
      <section class="login-card">
        <div class="login-brand">TechVision</div>
        <h1>Bienvenido a TechVision</h1>
        <p class="login-sub">Inicie sesión para continuar</p>

        <?php if ($error !== ''): ?>
          <div class="login-error"><?= escapar($error); ?></div>
        <?php endif; ?>

        <form method="post" autocomplete="off">
          <div class="login-field">
            <div class="login-label-row">
              <label for="usuario">Usuario</label>
            </div>
            <input class="login-input" id="usuario" name="usuario" type="text" placeholder="Ingrese su usuario" autocomplete="username" required>
            <span class="login-field-note">Ingrese el usuario registrado en la tabla de empleados.</span>
          </div>

          <div class="login-field">
            <div class="login-label-row">
              <label for="password">Contraseña</label>
              <a href="#">¿Olvidó su contraseña?</a>
            </div>
            <input class="login-input" id="password" name="password" type="password" placeholder="Ingrese su contraseña" autocomplete="current-password" required>
            <span class="login-field-note">Las credenciales deciden si entra al catálogo o al panel administrativo.</span>
          </div>

          <button class="login-submit" type="submit">Iniciar Sesión</button>
        </form>
      </section>
    </div>

    <footer class="login-footer">
      <strong>TechVision</strong>
      <div>
        <a href="#">Privacy Policy</a>
        <a href="#">Terms of Service</a>
        <a href="#">Security</a>
      </div>
      <span>© 2024 TechVision Curator. All rights reserved.</span>
    </footer>
  </main>
</body>
</html>
