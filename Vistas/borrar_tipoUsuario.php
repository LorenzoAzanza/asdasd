<?php
$rolPermitido = "administrador";
if ($_SESSION['usuario']['rol'] !== $rolPermitido) {
    
    header("Location: sistema.php");
    exit();
}
require_once("Modelos/tipo_usuario.php");


$mensaje="";
$respuesta="";


$id_tipo_usuario = isset($_GET['id_tipo_usuario'])?$_GET['id_tipo_usuario']:"";

if(isset($_POST['id_tipo_usuario']) && $_POST['id_tipo_usuario']>0 && isset($_POST['boton']) && $_POST['boton'] == "borrar" ){

    $id_tipo_usuario=$_POST['id_tipo_usuario'];
    $objTipo_usuario = new tipo_usuario();
    $existe= $objTipo_usuario->cargar($id_tipo_usuario);
if($existe){
        $respuesta=$objTipo_usuario->borrar();
    if($respuesta){
            $mensaje="El registro se borro correctamente";

        }else{
        $mensaje="Error no se pudo borrar el registro";

        }

    }else{
        $respuesta=false;
        $mensaje="No existe ese registro";
    }


}

if(isset($_POST['boton']) && $_POST['boton'] == "cancelar"){
header("Location: sistema.php?r=tipo_usuario");
}





?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
 
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

      

        .borrar-title {
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
        }

       
        .submit-buttons {
            text-align: center;
            margin-top: 20px;
        }

        .submit-buttons .btn {
            margin-right: 10px;
        }
    </style>
    <title>Borrar Usuarios</title>
</head>

<body>
    <main>
        <div class="container">
            <h1 class="borrar-title">Borrar Usuario</h1>
            <div class="form-container">
                <form method="POST" action="sistema.php?r=borrar_tipoUsuario">
                    <div class="row">
                        <?php if ($respuesta == true): ?>
                            <div class="card-panel blue center-align">
                                <?=$mensaje?>
                                <a href="sistema.php?r=tipo_usuario" class="btn green">Regresar</a>
                            </div>
                        <?php elseif ($respuesta == false && $mensaje != ""): ?>
                            <div class="card-panel red center-align">
                                <?=$mensaje?>
                                <a href="sistema.php?r=tipo_usuario" class="btn red">Regresar</a>
                            </div>
                        <?php else: ?>
                            <div class="col s10">
                                <h3>¿Está seguro de que desea borrar el registro Nº: <?=$id_tipo_usuario?>?</h3>
                            </div>
                            <div class="col s10">
                                <input type="hidden" name="id_tipo_usuario" value="<?=$id_tipo_usuario?>">
                                <div class="submit-buttons">
                                    <button class="btn waves-effect waves-light blue" type="submit" name="boton" value="borrar">
                                        Borrar <i class="material-icons right blue">send</i>
                                    </button>
                                    <button class="btn waves-effect waves-light red" type="submit" name="boton" value="cancelar">
                                        Cancelar <i class="material-icons right red">cancel</i>
                                    </button>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>

</html>
