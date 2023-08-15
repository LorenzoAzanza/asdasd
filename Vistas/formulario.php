<?php
require_once("Modelos/BDFormulario.php");
require_once("Modelos/BDClientes.php");

$id_cliente= isset($_SESSION['id_cliente'])?$_SESSION['id_cliente']:"";

$objCliente= new cliente();
$objCliente->cargar($id_cliente);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $email = $_POST["email"]; // Asegúrate de obtener los datos correctamente
    $asunto = $_POST["asunto"];
    $mensaje = $_POST["mensaje"];

    $formulario = new formulario();
    $formulario->guardarFormulario($nombre, $email, $asunto, $mensaje);
    $mensaje = "Formulario enviado correctamente";
    // Redirigir a una página de éxito o hacer lo que necesites
    
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Contacto</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="web/css/materialize.min.css" media="screen,projection" />
    <style>
        body {
            display: flex;
            flex-direction: column;
            background: #ffecb3;
            margin: 0;
        }

        main {
            flex: 1 0 auto;
            padding: 20px;
        }

        .container {
            margin-top: 0;
        }

        .form-title {
            text-align: center;
            color: #333;
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .form-container {
            border: 2px solid #e57373;
            padding: 20px;
            border-radius: 10px;
            background-color: #e57373;
            overflow: auto;
        }

        .input-field label {
            color: #333;
        }

        .btn-container {
            text-align: center;
            margin-top: 20px;
        }

        .btn-container .btn {
            margin: 0 10px;
        }
    </style>
</head>

<body>
    <main>
        <div class="container">
            <h1 class="form-title">Formulario de Contacto</h1>
            <?php if (!empty($mensaje)) : ?>
                <div class="card-panel green lighten-2">
                    <?= $mensaje ?>
                </div>
            <?php endif; ?>
            <div class="form-container">
                <form method="POST" action="">
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="mail" type="email" class="validate" name="email" value="<?= $objCliente->mail ?>" readonly>
                            <label for="mail">Email</label>
                        </div>
                        <div class="input-field col s12">
                            <input id="nombre" type="text" class="validate" name="nombre" value="<?= $objCliente->nombre ?>" readonly>
                            <label for="nombre">Nombre</label>
                        </div>
                        <div class="input-field col s12">
                            <input id="asunto" type="text" class="validate" name="asunto" required>
                            <label for="asunto">Asunto</label>
                        </div>
                        <div class="input-field col s12">
                            <textarea id="mensaje" class="materialize-textarea" name="mensaje" rows="4" required></textarea>
                            <label for="mensaje">Mensaje</label>
                        </div>
                        <div class="col s12 btn-container">
                            <button class="btn waves-effect waves-light blue" type="submit" name="boton" value="enviar">Enviar
                                <i class="material-icons right">send</i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>

</html>
