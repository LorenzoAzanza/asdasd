<?php
require_once("Modelos/BDFormulario.php");
require_once("Modelos/BDClientes.php");

require 'vendor/autoload.php'; // Asegúrate de que la ruta sea correcta

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mail= filter_var($_POST['mail'], FILTER_SANTIZIE_MAIL);
$nombre= filter_var($_POST['nombre'], FILTER_SANTIZIE_STRING);
$mensaje= filter_var($_POST['mensaje'], FILTER_SANTIZIE_STRING);

if(!empty($mail)&&!empty($nombre)&&!empty($mensaje)){
    $destino='azanzalorenzo@gmail.com';
    $asunto='mail de prueba';

    $cuerpo= '
    <html>
        <head>
            <title>prueba</title>
            </head>
            <body>
                    <h1>Email de '.$nombre.'</h1>
                    <p>'.$texto.'</p>
                    </body>
                    </html>';

                    $headers="MIME-version:1.0\r\n";
                    $headers.="Content-type: text/html; charset=urf-8\r\n";
                    
                    $headers.="From:$nombre<$mail>\r\n";
                    $headers.="Return-path:$destino\r\n";
                    mail($destino,$asunto,$cuerpo,$headers);
                    echo "Email enviado correctamente";
}else{
    echo "Error";
}



?>