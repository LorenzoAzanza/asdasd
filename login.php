<?php
session_start();

require_once("Modelos/tipo_usuario.php");
require_once("Modelos/BDClientes.php"); 
include("Configuracion/db.php");




$mail = isset($_POST['txtMail']) ? $_POST['txtMail'] : "";
$contrasena = isset($_POST['passContrasena']) ? $_POST['passContrasena'] : "";

$respuesta="";
$mensaje = "";

if (isset($_POST['boton']) && $_POST['boton'] == "ingresar") {
    if ($mail != "" && $contrasena != "") {
        $objTipo_usuario = new tipo_usuario();
        $respuesta_tipo_usuario = $objTipo_usuario->login($mail, $contrasena);
        if ($respuesta_tipo_usuario && $objTipo_usuario->estado !== 'D' && $objTipo_usuario->estado !== 'B') {
       
            $_SESSION['usuario']['tipo'] = 'tipo_usuario';
            $_SESSION['usuario']['mail'] = $objTipo_usuario->mail;
            $_SESSION['usuario']['nombre'] = $objTipo_usuario->nombre;
            $_SESSION['usuario']['apellido'] = $objTipo_usuario->apellido;
            $_SESSION['usuario']['direccion'] = $objTipo_usuario->direccion;
            $_SESSION['usuario']['telefono'] = $objTipo_usuario->telefono;
            $_SESSION['usuario']['tipo_documento'] = $objTipo_usuario->tipo_documento;
            $_SESSION['usuario']['numero_documento'] = $objTipo_usuario->numero_documento;
            $_SESSION['usuario']['id_tipo_usuario'] = $objTipo_usuario->numero_documento;

            $_SESSION['id_tipo_usuario'] = $objTipo_usuario->id_tipo_usuario;

            $_SESSION['usuario']['rol'] = $objTipo_usuario->obtenerRol();

         

            header("location: sistema.php");
            exit();
        } else {
            $objCliente = new cliente();
            $respuesta_cliente = $objCliente->login($mail, $contrasena);

            if ($respuesta_cliente && $objCliente->estado !== 'D' && $objCliente->estado !== 'B') {
                $_SESSION['usuario']['tipo'] = 'cliente';
                $_SESSION['usuario']['mail'] = $objCliente->mail;
                $_SESSION['usuario']['nombre'] = $objCliente->nombre;
                $_SESSION['usuario']['apellido'] = $objCliente->apellido;
                $_SESSION['usuario']['direccion'] = $objCliente->direccion;
                $_SESSION['usuario']['telefono'] = $objCliente->telefono;
                $_SESSION['usuario']['tipo_documento'] = $objCliente->tipo_documento;
                $_SESSION['usuario']['numero_documento'] = $objCliente->numero_documento;
                $_SESSION['usuario']['id_cliente'] = $objCliente->id_cliente;
                $_SESSION['usuario']['rol'] = $objCliente->obtenerRol();
                $_SESSION['id_cliente'] = $objCliente->id_cliente;
                header("location: sistema.php");
                exit();
            } else {
                $mensaje = "Error en los datos de inicio de sesión.";
            }
        }
    } else {
        $mensaje = "Por favor, complete todos los campos.";
    }
}

?>





<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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

        footer.page-footer {
            margin-top: 50px;
            background-color: #d32f2f; /* Cambia este color para el footer si lo deseas */
        }

        footer.page-footer .container {
            text-align: right;
            color: #000000; /* Cambia este color para el texto del footer si lo deseas */
        }

        /* Ajustar tamaño de los campos */
        .input-field input[type="email"],
        .input-field input[type="password"] {
            font-size: 14px;
        }

        /* Ajustar tamaño de los íconos */
        .material-icons {
            font-size: 20px;
        }

        /* Cambiar color del borde de la tarjeta */
        .campos {
            border: 2px solid #e57373;
            padding: 20px;
            border-radius: 10px;
            background-color: #e57373; /* Cambia este color para el fondo dentro del borde */
        }

        /* Cambiar color de las etiquetas (labels) dentro del borde */
        .campos label {
            color: #000; /* Cambia este color para el texto dentro del borde */
        }
    </style>
</head>

<body>
    <nav>
        <div class="nav-wrapper red lighten-2">
            <a href="sistema.php?r=layout" class="brand-logo center"><i class="material-icons">local_taxi</i>RentACar</a>
        </div>
    </nav>
    <main>
        <div class="container">
            <div class="campos">
                <div class="campos-content">
                    <h1 class="login-title">Login</h1>
                    <div class="row">
                        <?php if (!$respuesta && $mensaje != ""): ?>
                            <div class="campos-panel red center-align">
                                <?=$mensaje?>
                            </div>
                        <?php endif; ?>
                        <form class="col s12" method="POST" action="login.php">
                            <div class="row center-align">
                                <div class="input-field col s6 offset-s3">
                                    <i class="material-icons prefix">email</i>
                                    <input id="mail" type="email" class="validate white-text" name="txtMail">
                                    <label for="mail">Email</label>
                                </div>
                            </div>
                            <div class="row center-align">
                                <div class="input-field col s6 offset-s3">
                                    <i class="material-icons prefix">lock</i>
                                    <input id="contrasena" type="password" class="validate white-text" name="passContrasena">
                                    <label for="contrasena">Contraseña</label>
                                </div>
                            </div>
                            
                            <div class="row center-align">
                                <div class="input-field col s12">
                                    <button class="btn waves-effect red lighten-2" type="submit" name="boton" value="ingresar">Ingresar
                                        <i class="material-icons right">send</i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    
                        <div class="row center-align">
                        <div class="input-field col s12">
                            
                            <a class="btn waves-effect blue" href="registro.php">Registrarse
                                 <i class="material-icons right">mode_edit</i>
                            </a>
                                    
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
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
            var elems = document.querySelectorAll('.sidenav');
            var instances = M.Sidenav.init(elems, {});
        });
    </script>
</body>

</html>