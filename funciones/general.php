<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function base_url(string $ruta = ''): string
{
    return $ruta;
}

function escapar(?string $texto): string
{
    return htmlspecialchars((string) $texto, ENT_QUOTES, 'UTF-8');
}

function pagina_activa(string $archivoActual, string $archivoMenu): bool
{
    return basename($archivoActual) === $archivoMenu;
}
