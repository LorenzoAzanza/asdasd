<?php
require_once("Modelos/BDFormulario.php");
require_once("Modelos/BDClientes.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Encabezado, metadatos, enlaces a estilos y scripts -->
</head>
<body>
    <form action="enviar.php" method="POST">

        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" required><br>

        <label for="mail">Correo electrónico:</label>
        <input type="email" name="mail" required><br>

        <label for="mensaje">Mensaje:</label>
        <textarea name="mensaje" required></textarea><br>

        <button type="submit">Enviar</button>
    </form>
</body>
</html>
