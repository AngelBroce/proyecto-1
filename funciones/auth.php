<?php
require_once __DIR__ . '/general.php';
require_once __DIR__ . '/db.php';

function usuario_autenticado(): bool
{
    return isset($_SESSION['usuario']);
}

function obtener_usuario_actual(): ?array
{
    return $_SESSION['usuario'] ?? null;
}

function autenticar_empleado(string $usuario, string $contrasena): ?array
{
    $pdo = conexion_db();
    $stmt = $pdo->prepare('SELECT usuario, nombre, apellido, rol FROM empleado WHERE usuario = ? AND contrasena = ? LIMIT 1');
    $stmt->execute([$usuario, $contrasena]);
    $fila = $stmt->fetch();

    if (!$fila) {
        return null;
    }

    $tipoRol = ((int) $fila['rol'] === 1) ? 'admin' : 'empleado';

    return [
        'usuario' => $fila['usuario'],
        'nombre' => trim(($fila['nombre'] ?? '') . ' ' . ($fila['apellido'] ?? '')),
        'rol' => $tipoRol,
    ];
}

function guardar_sesion_usuario(array $usuario): void
{
    $_SESSION['usuario'] = $usuario;
}

function requiere_admin(): void
{
    if (!isset($_SESSION['usuario']) || (($_SESSION['usuario']['rol'] ?? '') !== 'admin')) {
        header('Location: login.php');
        exit;
    }
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
