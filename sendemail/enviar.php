<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
require_once("Modelos/BDFormulario.php");
require_once("Modelos/BDClientes.php");

$id_cliente = isset($_SESSION['id_cliente']) ? $_SESSION['id_cliente'] : "";

$objCliente = new cliente();
$objCliente->cargar($id_cliente);

$mensaje = ""; // Inicializar el mensaje vacío

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $email = $_POST["mail"]; // Asegúrate de obtener los datos correctamente
    $asunto = $_POST["asunto"];
    $mensaje = $_POST["mensaje"];

    $formulario = new formulario();
    $formulario->guardarFormulario($nombre, $email, $asunto, $mensaje);
    $mensaje = "Formulario enviado correctamente";
}
if (isset($_POST["enviar"])){
    $mail= new PHPMailer(true);

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

    echo"
    <script>
    alert('Enviado correctamente');
    document.location.href='sistema.php?r=formulario';
    </script>
    ";

}








?>