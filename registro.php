<?php
require_once("Modelos/BDClientes.php");

$mensaje = "";
$respuesta = false;
$boton = isset($_POST['boton']) ? $_POST['boton'] : "";

if ($boton == "registrarse") {
    $objClientes = new cliente();
    $arrayDatos = array(
        'nombre' => isset($_POST['txtNombre']) ? $_POST['txtNombre'] : "",
        'apellido' => isset($_POST['txtApellido']) ? $_POST['txtApellido'] : "",
        'direccion' => isset($_POST['txtDireccion']) ? $_POST['txtDireccion'] : "",
        'telefono' => isset($_POST['txtTelefono']) ? $_POST['txtTelefono'] : "",
        'mail' => isset($_POST['txtMail']) ? $_POST['txtMail'] : "",
        'tipo_documento' => isset($_POST['txtTipo_documento']) ? $_POST['txtTipo_documento'] : "",
        'numero_documento' => isset($_POST['txtNumero_documento']) ? $_POST['txtNumero_documento'] : "",
        'estado' => isset($_POST['txtEstado']) ? $_POST['txtEstado'] : "",
        'contrasena' => isset($_POST['passContrasena']) ? $_POST['passContrasena'] : "",
        'confirmarContrasena' => isset($_POST['txtConfirmarContrasena']) ? $_POST['txtConfirmarContrasena'] : ""
    );

    var_dump($arrayDatos);
    // Validación de contraseñas
    $resultado = preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/', $arrayDatos['contrasena']);
    if ($resultado == 0) {
        $mensaje = "La contraseña no cumple con las condiciones de seguridad debe contener alguno de estos caracteres especiales '/^(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/'.";
    } elseif ($arrayDatos['contrasena'] != $arrayDatos['confirmarContrasena']) {
        $mensaje = "Las contraseñas no coinciden.";
    } elseif (empty($arrayDatos['nombre']) || empty($arrayDatos['apellido']) || empty($arrayDatos['direccion']) || empty($arrayDatos['telefono']) || empty($arrayDatos['mail']) || empty($arrayDatos['tipo_documento']) || empty($arrayDatos['numero_documento']) || empty($arrayDatos['estado'])) {
        $mensaje = "Por favor, llenar todos los campos.";
    } else {
        // Si todo está bien, procede con el registro
        $objClientes->constructor($arrayDatos);
        $respuesta = $objClientes->ingresar();

        if ($respuesta) {
            $mensaje = "Se ingresó correctamente.";
        } else {
            $mensaje = "Error al ingresar el registro.";
        }
    }
}
?>







<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingresar Cliente</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="web/css/materialize.min.css" media="screen,projection" />
    <style>
        body {
            display: flex;
            min-height: 100vh;
            flex-direction: column;
            background: #ffecb3;
        }

        main {
            flex: 1 0 auto;
        }

        .container {
            margin-top: 50px;
        }

        .login-title {
            text-align: center;
            color: #333;
            font-size: 36px;
            font-weight: bold;
        }

        .input-field input[type="text"],
        .input-field input[type="email"],
        .input-field input[type="password"] {
            font-size: 14px;
        }

        .material-icons {
            font-size: 20px;
        }
        footer.page-footer {
            margin-top: 50px;
            background-color: #d32f2f; /* Cambia este color para el footer si lo deseas */
        }

        footer.page-footer .container {
            text-align: right;
            color: #000000; /* Cambia este color para el texto del footer si lo deseas */
        }
        .campos {
            border: 2px solid #e57373;
            padding: 20px;
            border-radius: 10px;
            background-color: #e57373;
        }

        .campos label {
            color: #000000;
        }
        
        .mensaje-exito {
            display: block;
            background-color: #4caf50; /* Color de fondo verde */
            color: #000000; /* Color del texto en blanco */
            padding: 10px; /* Espaciado interno del mensaje */
            border-radius: 5px; /* Bordes redondeados */
            text-align: center; /* Alineación del texto al centro */
            margin-bottom: 10px; /* Espaciado inferior del mensaje */
            font-size: 18px; /* Tamaño de fuente más grande */
            font-weight: bold; /* Texto en negrita */
            text-transform: uppercase; /* Texto en mayúsculas */
            box-shadow: 0px 3px 5px rgba(0, 0, 0, 0.2); /* Sombra para resaltar */
        }

        .mensaje-error {
            display: block;
            background-color: #ff3333; /* Color de fondo del mensaje de error */
            color: #000000; /* Color del texto del mensaje de error */
            padding: 10px; /* Espaciado interno del mensaje de error */
            border-radius: 5px; /* Bordes redondeados */
            text-align: center; /* Alineación del texto al centro */
            margin-bottom: 10px; /* Espaciado inferior del mensaje de error */
        }
   
    </style>
</head>

<body>
    <nav>
        <div class="nav-wrapper red lighten-2">
            <a href="sistema.php?r=clientes" class="brand-logo center"><i class="material-icons">local_taxi</i>RentACar</a>
        </div>
    </nav>
    <main>
        <div class="container">
            <form class="col s12" method="POST" action="registro.php">
                <div class="campos">
                    <h1 class="login-title">Registrarse</h1>
                    <?php if ($mensaje != ""): ?>
                    <!-- Mostrar mensaje de error si existe -->
                    <div class="row center-align">
                        <div class="input-field col s12">
                            <span class="<?= $respuesta ? 'mensaje-exito' : 'mensaje-error' ?> center-align"><?= $mensaje ?></span>
                        </div>
                    </div>
                    <?php endif; ?>
                    <div class="row">
                        <div class="input-field col s6">
                            <i class="material-icons prefix">person</i>
                            <input id="txtNombre" type="text" class="validate" name="txtNombre" pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ\s]+" required>
                            <label for="txtNombre">Nombre</label>
                            <span class="helper-text" data-error="Solo se permiten letras." data-success=""></span>
                        </div>
                        <div class="input-field col s6">
                            <i class="material-icons prefix">person</i>
                            <input id="txtApellido" type="text" class="validate" name="txtApellido" pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ\s]+" required>
                            <label for="txtApellido">Apellido</label>
                            <span class="helper-text" data-error="Solo se permiten letras." data-success=""></span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">home</i>
                            <input id="txtDireccion" type="text" class="validate" name="txtDireccion" required>
                            <label for="txtDireccion">Dirección</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s6">
                            <i class="material-icons prefix">phone</i>
                            <input id="txtTelefono" type="tel" class="validate" name="txtTelefono" pattern="[0-9]+" required>
                            <label for="txtTelefono">Teléfono</label>
                            <span class="helper-text" data-error="Solo se permiten números." data-success=""></span>
                        </div>
                        <div class="input-field col s6">
                            <i class="material-icons prefix">email</i>
                            <input id="txtMail" type="email" class="validate" name="txtMail" required>
                            <label for="txtMail">Email</label>
                        </div>
                    </div>
                    <div class="row center-align">
                        <div class="input-field col s6 offset-s3">
                            <i class="material-icons prefix">lock</i>
                            <input id="passContrasena" type="password" class="validate white-text" name="passContrasena" required>
                            <label for="passContrasena">Contraseña</label>
                        </div>
                    </div>
                    <div class="row center-align">
                        <div class="input-field col s6 offset-s3">
                            <i class="material-icons prefix">lock</i>
                            <input id="txtConfirmarContrasena" type="password" class="validate white-text" name="txtConfirmarContrasena" required>
                            <label for="txtConfirmarContrasena">Confirmar Contraseña</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <i class="material-icons prefix">description</i>
                            <select id="txtTipo_documento" name="txtTipo_documento" required>
                                <option value="" disabled selected>Seleccione un tipo de documento</option>
                                <option value="CI">CI</option>
                                <option value="Pasaporte">Pasaporte</option>
                            </select>
                            <label for="txtTipo_documento">Tipo de Documento</label>
                        </div>
                        <div class="input-field col s6">
                            <i class="material-icons prefix">description</i>
                            <input id="txtNumero_documento" type="text" class="validate" name="txtNumero_documento" pattern="[0-9]+" required>
                            <label for="txtNumero_documento">Numero de documento</label>
                            <span class="helper-text" data-error="Solo se permiten números." data-success=""></span>
                        </div>
                        <div class="input-field col s6">
                            <i class="material-icons prefix">description</i>
                            <select id="txtEstado" name="txtEstado" required>
                                <option value="A">Activo</option>
                            </select>
                            <label for="txtEstado">Estado</label>
                        </div>
                    </div>

                    <div class="row center-align">
                        <div class="input-field col s12">
                            <button class="btn waves-effect waves-light blue" type="submit" name="boton" value="registrarse">Registrarse
                                <i class="material-icons right">send</i>
                            </button>
                            <button class="btn waves-effect red darken-3" type="button" onclick="cancelarRegistro()">Cancelar
                                <i class="material-icons right">cancel</i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>
    <footer class="page-footer red lighten-2">
        <div class="container">
            © 2023 RentACar copyrigth
        </div>
    </footer>

    <script type="text/javascript" src="web/js/materialize.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('select');
            var instances = M.FormSelect.init(elems, {});
        });

        function cancelarRegistro() {
            window.location.href = "sistema.php?r=login";
        }
    </script>
</body>

</html>

