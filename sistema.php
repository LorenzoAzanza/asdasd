<?php
session_start();

$sessionActiva = isset($_SESSION['usuario']) ? true : false;

if (!$sessionActiva) {
    header('Location: login.php');
    exit(); // Asegurémonos de que el script termine después de la redirección.
}

// Verificar el rol almacenado en la sesión.
$rol = $_SESSION['usuario']['rol'];

if ($rol === 'administrador') {
    // Si el rol es Administrador, redirigir a un layout específico para Administrador.
    include("Vistas/layout_admin.php");
} elseif ($rol === 'encargado') {
    // Si el rol es Encargado, redirigir a un layout específico para Encargado.
    include("Vistas/layout_encargado.php");
} elseif ($rol === 'vendedor') {
    // Si el rol es Vendedor, redirigir a un layout específico para Vendedor.
    include("Vistas/layout_vendedor.php");
} else {
    // Si no es Administrador, Encargado ni Vendedor, redirigir al layout predeterminado.
    include("Vistas/layout.php");
}
?>