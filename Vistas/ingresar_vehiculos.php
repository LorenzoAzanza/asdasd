<?php
$rolesPermitidos = array("administrador", "encargado"); 

if (!in_array($_SESSION['usuario']['rol'], $rolesPermitidos)) {
    
    header("Location: sistema.php");
    exit();
}
    require_once("Modelos/BDvehiculos.php");


    $mensaje="";
    $respuesta="";
    $boton= isset($_POST['boton'])?$_POST['boton']:"";
    $objVehiculos= new vehiculos();
        

    if($boton=="cancelar"){
   
        header('Location: sistema.php?r=vehiculos');

    }elseif($boton=="ingresar"){
      

      
      $img = $objVehiculos->subirImagen($_FILES['fileImg'], 150, 150);
         
      $arrayDatos=array();
      
       

        $arrayDatos['tipo']= isset($_POST['txtTipo'])?$_POST['txtTipo']:"";
        $arrayDatos['color']= isset($_POST['txtColor'])?$_POST['txtColor']:"";
        $arrayDatos['cantidad_pasajeros']= isset($_POST['txtCantidadPasajeros'])?$_POST['txtCantidadPasajeros']:"";
        $arrayDatos['marca']= isset($_POST['txtMarca'])?$_POST['txtMarca']:"";
        $arrayDatos['modelo']= isset($_POST['txtModelo'])?$_POST['txtModelo']:"";
        $arrayDatos['precio']= isset($_POST['txtPrecio'])?$_POST['txtPrecio']:"";
        $arrayDatos['estado']= isset($_POST['txtEstado'])?$_POST['txtEstado']:"";
        $arrayDatos['img']= $img?$img:"";


        if($arrayDatos['tipo']!="" && $arrayDatos['color']!="" && 
        $arrayDatos['cantidad_pasajeros']!=""&&$arrayDatos['marca']!=""&&
        $arrayDatos['modelo']!=""&&$arrayDatos['precio']!="" ){
            $objVehiculos->constructor($arrayDatos);
            $respuesta= $objVehiculos->ingresar();

            if($respuesta==true){
                $mensaje="Se ingreso correctamente";
            }else{
                $mensaje="Error al ingresar registro";
                $respuesta=false;
            }


        }else{
            $mensaje="Por favor llenar todos los campos";
        }

    }



?>


<!DOCTYPE html>
<html lang="es">

<head>
    <title>Ingresar vehiculos</title>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="web/css/materialize.min.css" media="screen,projection" />
    
    <style>
        body {
            display: flex;
            flex-direction: column;
            background: #ffecb3;
           
        }

        main {
            flex: 1 0 auto;
            padding: 20px;
        }

        .ingresar-title {
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

        .form-container label {
            color: #000;
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
            <h1 class="ingresar-title">Ingresar vehículos</h1>
            <div class="form-container">
                <form method="POST" action="sistema.php?r=ingresar_vehiculos" enctype="multipart/form-data">
                    <div class="row">
                        <?php if ($respuesta == true): ?>
                            <div class="card-panel blue center-align">
                                <?=$mensaje?>
                                <a href="sistema.php?r=vehiculos" class="btn green">Regresar</a>
                            </div>
                        <?php elseif ($respuesta == false && $mensaje != ""): ?>
                            <div class="card-panel red center-align">
                                <?=$mensaje?>
                            </div>
                        <?php endif; ?>

                        <div class="input-field col s6">
                            <input id="tipo" type="text" class="validate" name="txtTipo">
                            <label for="tipo">Tipo</label>
                        </div>
                        <div class="input-field col s6">
                            <input id="color" type="text" class="validate" name="txtColor">
                            <label for="color">Color</label>
                        </div>
                        <div class="input-field col s6">
                            <input id="cantidad_pasajeros" type="number" class="validate" name="txtCantidadPasajeros">
                            <label for="cantidad_pasajeros">Cantidad de pasajeros</label>
                        </div>
                        <div class="input-field col s6">
                            <input id="marca" type="text" class="validate" name="txtMarca">
                            <label for="marca">Marca</label>
                        </div>
                        <div class="input-field col s6">
                            <input id="modelo" type="text" class="validate" name="txtModelo">
                            <label for="modelo">Modelo</label>
                        </div>
                        <div class="input-field col s6">
                            <input id="precio" type="number" class="validate" name="txtPrecio">
                            <label for="precio">Precio por dia $U</label>
                        </div>
                        <div class="input-field col s6">
                            <select name="txtEstado">
                                <option value="A" <?=$objVehiculos->estado == 'A' ? 'selected' : ''?>>Activado</option>
                                <option value="D" <?=$objVehiculos->estado == 'D' ? 'selected' : ''?>>Desactivado</option>
                            </select>
                            <label>Estado</label>
                        </div>
                        <div class="file-field input-field col s6">
                            <div class="btn blue">
                                <span>Archivo</span>
                                <input type="file" name="fileImg">
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="submit-buttons">
                        <button class="btn waves-effect waves-light blue" type="submit" name="boton" value="ingresar">
                            Ingresar <i class="material-icons right blue">send</i>
                        </button>
                        <button class="btn waves-effect waves-light red" type="submit" name="boton" value="cancelar">
                            Cancelar <i class="material-icons right red">cancel</i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>

</html>
