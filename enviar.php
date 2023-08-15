<?php
require_once("Modelos/BDFormulario.php");
require_once("Modelos/BDClientes.php");

require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mail = filter_var($_POST['txtMail'], FILTER_SANITIZE_EMAIL);
$nombre = $_POST['txtNombre'];
$mensaje = $_POST['mensaje'];
$asunto = $_POST['txtAsunto'];

if (!empty($mail) && !empty($nombre) && !empty($mensaje) && !empty($asunto)) {
    // Guardar en la base de datos
    $objFormulario = new formulario();
    $objFormulario->guardarFormulario($nombre, $mail, $asunto, $mensaje);

    $destino = 'rentacarproyectogit@gmail.com';

    $cuerpo = '
    <html>
    <head>
        <title>' . $asunto . '</title>
    </head>
    <body>
        <h1>Mensaje de ' . $mail . '</h1>
        <p>' . $mensaje . '</p>
    </body>
    </html>';

    $mail = new PHPMailer();
    // Configurar el servidor SMTP y otras opciones aquí

    $mail->setFrom($mail->Username, $nombre);
    $mail->addAddress($destino);
    $mail->Subject = $asunto;
    $mail->isHTML(true);
    $mail->Body = $cuerpo;

    if ($mail->send()) {
        // Establecer el mensaje en la variable de sesión
        $_SESSION['mensaje_enviado'] = true;

        header("Location: sistema.php?r=formulario");
        exit();
    } else {
        echo "Error al enviar el correo.";
    }
}
?>