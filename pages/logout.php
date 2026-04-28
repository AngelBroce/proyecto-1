<?php
require_once __DIR__ . '/../funciones/auth.php';

cerrar_sesion();
header('Location: login.php');
exit;
