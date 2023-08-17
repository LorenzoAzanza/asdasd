<?php
    require_once("Modelos/BDClientes.php");


    $mensaje="";
    $respuesta="";


    $id_cliente = isset($_GET['id_cliente'])?$_GET['id_cliente']:"";

    if(isset($_POST['id_cliente']) && $_POST['id_cliente']>0 && isset($_POST['boton']) && $_POST['boton'] == "borrar" ){

        $id_cliente=$_POST['id_cliente'];
        $objClientes = new cliente();
        $existe= $objClientes->cargar($id_cliente);
    if($existe){
            $respuesta=$objClientes->borrar();
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
    header("Location: sistema.php?r=clientes");
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
    <title>Borrar clientes</title>
</head>

<body>
    <main>
        <div class="container">
            <h1 class="borrar-title">Borrar Cliente</h1>
            <div class="form-container">
                <form method="POST" action="sistema.php?r=borrar_clientes">
                    <div class="row">
                        <?php if ($respuesta == true): ?>
                            <div class="card-panel blue center-align">
                                <?=$mensaje?>
                                <a href="sistema.php?r=clientes" class="btn green">Regresar</a>
                            </div>
                        <?php elseif ($respuesta == false && $mensaje != ""): ?>
                            <div class="card-panel red center-align">
                                <?=$mensaje?>
                                <a href="sistema.php?r=clientes" class="btn red">Regresar</a>
                            </div>
                        <?php else: ?>
                            <div class="col s10">
                                <h3>¿Está seguro de que desea borrar el registro Nº: <?=$id_cliente?>?</h3>
                            </div>
                            <div class="col s10">
                                <input type="hidden" name="id_cliente" value="<?=$id_cliente?>">
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
