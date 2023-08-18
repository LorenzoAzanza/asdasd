<?php
$rolesPermitidos = array("administrador", "encargado"); 

if (!in_array($_SESSION['usuario']['rol'], $rolesPermitidos)) {
    
    header("Location: sistema.php");
    exit();
}
    require_once("Modelos/BDvehiculos.php");


    $mensaje="";
    $respuesta="";


    $id_vehiculo = isset($_GET['id_vehiculo'])?$_GET['id_vehiculo']:"";

    if(isset($_POST['id_vehiculo']) && $_POST['id_vehiculo']>0 && isset($_POST['boton']) && $_POST['boton'] == "borrar" ){

        $id_vehiculo=$_POST['id_vehiculo'];
        $objVehiculos = new vehiculos();
        $existe= $objVehiculos->cargar($id_vehiculo);
        if($existe){
            $respuesta=$objVehiculos->borrar();
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
    header("Location: sistema.php?r=vehiculos");
   }



?>







<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Borrar Vehículo</title>
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
</head>

<body>
    <main>
        <div class="container">
            <h1 class="borrar-title">Borrar Vehículo</h1>
            <div class="form-container">
                <form method="POST" action="sistema.php?r=borrar_vehiculos">
                    <div class="row">
                        <?php if ($respuesta == true): ?>
                            <div class="card-panel blue center-align">
                                <?=$mensaje?>
                                <a href="sistema.php?r=vehiculos" class="btn green">Regresar</a>
                            </div>
                        <?php elseif ($respuesta == false && $mensaje != ""): ?>
                            <div class="card-panel red center-align">
                                <?=$mensaje?>
                                <a href="sistema.php?r=vehiculos" class="btn red">Regresar</a>
                            </div>
                        <?php else: ?>
                            <div class="col s10">
                                <h3>¿Está seguro de que desea borrar el registro Nº: <?=$id_vehiculo?>?</h3>
                            </div>
                            <div class="col s10">
                                <input type="hidden" name="id_vehiculo" value="<?=$id_vehiculo?>">
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
