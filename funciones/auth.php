<?php
require_once __DIR__ . '/general.php';

function usuario_autenticado(): bool
{
    return isset($_SESSION['usuario']);
}

function iniciar_sesion_demo(string $correo, string $rol = 'empleado'): void
{
    $_SESSION['usuario'] = [
        'correo' => $correo,
        'rol' => $rol,
    ];
}

function cerrar_sesion(): void
{
    $_SESSION = [];
    if (ini_get('session.use_cookies')) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
    }
    session_destroy();
}
