<?php
session_start();

$sessionActiva = isset($_SESSION['usuario']) ? true : false;

if (!$sessionActiva) {
    header('Location: login.php');
     // Asegurémonos de que el script termine después de la redirección.
}

// Verificar el rol almacenado en la sesión.
if ($_SESSION['usuario']['rol'] === 'administrador') {
    // Si el rol es Administrador, redirigir a un layout específico para Administrador.
    include("Vistas/layout_admin.php");
} else {
    // Si no es Administrador, redirigir al layout predeterminado.
    include("Vistas/layout.php");
}
?>
