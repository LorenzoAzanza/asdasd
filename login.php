<?php

require_once("Modelos/tipo_usuario.php");

session_start();
unset($_SESSION['usuario']);
session_destroy();

$mail = isset($_POST['txtMail']) ? $_POST['txtMail'] : "";
$contrasena = isset($_POST['passContrasena']) ? $_POST['passContrasena'] : "";

$mensaje = "";
$respuesta = false;

if ($mail != "" && $contrasena != "") {
    $objTipo_usuario = new tipo_usuario();
    $respuesta = $objTipo_usuario->login($mail, $contrasena);

    if (!$respuesta) {
        $mensaje = "Error en los datos";
    }else{
        session_start();
        $_SESSION['usuario']= $objTipo_usuario->mail;
        $_SESSION['id_tipo_usuario']= $objTipo_usuario->id_tipo_usuario;
        

        header("location:sistema.php");
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
    <link type="text/css" rel="stylesheet" href="web/css/materialize.min.css"  media="screen,projection"/>
    <style>
        body {
            display: flex;
            min-height: 100vh;
            flex-direction: column;
        }

        main {
            flex: 1 0 auto;
        }

        .enlace-icono {
            display: flex;
            align-items: center;
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
            <h1>Login</h1>
            <form method="POST" action="login.php">
                <div class="row">
                    <?php
                    if (!$respuesta && $mensaje != "") {
                    ?>
                    <div class="card-panel red center-align">
                        <?=$mensaje?>
                    </div>
                    <?php
                    }
                    ?>
                    <div class="input-field col s6 offset-s3">
                        <input id="mail" type="email" class="validate" name="txtMail">
                        <label for="mail">Email</label>
                    </div>
                    <div class="input-field col s6 offset-s3">
                        <input id="contrasena" type="password" class="validate" name="passContrasena">
                        <label for="contrasena">Contraseña</label>
                    </div>
                </div>
                <div class="input-field col s6 offset-s3">
                    <button class="btn waves-effect waves-light blue" type="submit" name="boton" value="ingresar">Ingresar
                        <i class="material-icons right blue">send</i>
                    </button>
                </div>
            </form>
        </div>
    </main>
    <footer class="page-footer red lighten-2">
          
          </div>
          <div class="footer-copyright">
            <div class="container">
            © 2014 Copyright Text
            <a class="grey-text text-lighten-4 right" href="#!">More Links</a>
            </div>
          </div>
        </footer>
    
    <script type="text/javascript" src="web/js/materialize.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            M.AutoInit();
            var elems = document.querySelectorAll('.sidenav');
            var instances = M.Sidenav.init(elems, options);
        });
    </script>
</body>
</html>