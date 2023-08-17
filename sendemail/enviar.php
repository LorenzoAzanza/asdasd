<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
require_once("Modelos/BDFormulario.php");
require_once("Modelos/BDClientes.php");

//obtenemos id del cliente de la sesion
$id_cliente = isset($_SESSION['id_cliente']) ? $_SESSION['id_cliente'] : "";

// Se crea una instancia de la clase cliente y se carga la información del cliente
$objCliente = new cliente();
$objCliente->cargar($id_cliente);

$mensaje = ""; 

// Comprobar si el formulario se envió mediante POST

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $email = $_POST["mail"];
    $asunto = $_POST["asunto"];
    $mensaje = $_POST["mensaje"];

// Crear una instancia de la clase formulario y guardar los datos en la base de datos

    $formulario = new formulario();
    $formulario->guardarFormulario($nombre, $email, $asunto, $mensaje);
    $mensaje = "Formulario enviado correctamente";
}

// Comprobar si el botón "enviar" se presionó

if (isset($_POST["enviar"])){
    $mail= new PHPMailer(true);

    // Configuración del servidor SMTP de Gmail

    $mail->isSMTP(); 
    $mail->Host='smtp.gmail.com';
    $mail->SMTPAuth=true;
    $mail->Username="rentacarproyectogit@gmail.com";
    $mail->Password="axjyuqgqbmksqdgy";
    $mail->SMTPSecure='ssl';
    $mail->Port= 465;

    $mail->setFrom('rentacarproyectogit@gmail.com');
    $mail->addAddress($_POST["mail"]);

    $mail->isHTML(true);

    $mail->Subject=('Formulario recibido');
    $mail->Body=('Queremos informarle que recibimos su formulario, en breves nos comunicaremos con usted, agradecimientos RentACar');

    $mail->send();

    // Mostrar una alerta y redirigir al usuario después de enviar el correo
    echo"
    <script>
    alert('Enviado correctamente');
    document.location.href='sistema.php?r=formulario';
    </script>
    ";

}








?>