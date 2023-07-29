<?php
require_once("Modelos/BDFormulario.php");

if (isset($_POST['enviar'])) {
    // Obtener los valores del formulario
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : "";
    $mail = isset($_POST['mail']) ? $_POST['mail'] : "";
    $mensaje = isset($_POST['mensaje']) ? $_POST['mensaje'] : "";

    // Crear una instancia de la clase formulario
    $objFormulario = new formulario();

    // Asignar los valores del formulario a la instancia
    $objFormulario->nombre = $nombre;
    $objFormulario->mail = $mail;
    $objFormulario->mensaje = $mensaje;

    // Ingresar el registro del formulario en la base de datos
    $respuesta = $objFormulario->ingresar();

    // Enviar correos de agradecimiento y notificación a la empresa
    if ($respuesta) {
        $to = $mail;
        $subject = "Gracias por contactarnos";
        $message = "Estimado(a) $nombre,\n\nGracias por contactarnos. Hemos recibido su mensaje y nos pondremos en contacto a la brevedad posible.\n\nAtentamente,\nEl equipo de nuestra empresa";
        $headers = "From: tu_empresa@ejemplo.com\r\n";
        mail($to, $subject, $message, $headers);

        $to_empresa = "correo_empresa@ejemplo.com";
        $subject_empresa = "Nuevo mensaje de formulario de contacto";
        $message_empresa = "Se ha recibido un nuevo mensaje de contacto a través del formulario.\n\nNombre: $nombre\nCorreo: $mail\nMensaje: $mensaje";
        $headers_empresa = "From: tu_empresa@ejemplo.com\r\n";
        mail($to_empresa, $subject_empresa, $message_empresa, $headers_empresa);
    }
}
?>

<h1>Formulario de Contáctenos</h1>

<form method="POST" action="formulario">
    <div class="row">
        <!-- Campos del formulario -->
        <div class="col s10">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" required>

            <label for="mail">Correo electrónico:</label>
            <input type="email" name="mail" id="mail" required>

            <label for="mensaje">Mensaje:</label>
            <textarea name="mensaje" id="mensaje" required></textarea>
        </div>

        <div class="col s10">
            <button class="btn waves-effect waves-light blue" type="submit" name="enviar">Enviar
                <i class="material-icons right blue">send</i>
            </button>
        </div>
    </div>
</form>