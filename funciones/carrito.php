<?php
require_once __DIR__ . '/general.php';

function obtener_carrito(): array
{
    return $_SESSION['carrito'] ?? [];
}

function cantidad_carrito(): int
{
    $cantidad = 0;
    foreach (obtener_carrito() as $item) {
        $cantidad += (int) ($item['cantidad'] ?? 0);
    }
    return $cantidad;
}
