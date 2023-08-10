<?php
    require_once("Modelos/BDvehiculos.php");

    $id_vehiculo=isset($_GET['id_vehiculo'])?$_GET['id_vehiculo']:"";

    $mensaje="";
    $respuesta="";
    $boton= isset($_POST['boton'])?$_POST['boton']:"";
    $objVehiculos= new vehiculos();
    $objVehiculos->cargar($id_vehiculo);
        

    if($boton=="cancelar"){
        //redireccionar a la lista de proveedores
        header('Location: sistema.php?r=vehiculos');

    }elseif($boton=="guardar"){
      
      //$respuestaCopy=copy($_FILES['fileImg']['tmp_name'] , "web/archivos/".$_FILES['fileImg']['name']);
      //print_r($respuestaCopy);
      
      $img = $objVehiculos->subirImagen($_FILES['fileImg'], 150, 150);
         
      $arrayDatos=array();
        //si vale ingresar , ingresamos el registro 

       
        $arrayDatos['id_vehiculo']=isset($_POST['id_vehiculo'])?$_POST['id_vehiculo']:"";
        $arrayDatos['tipo']= isset($_POST['txtTipo'])?$_POST['txtTipo']:"";
        $arrayDatos['color']= isset($_POST['txtColor'])?$_POST['txtColor']:"";
        $arrayDatos['cantidad_pasajeros']= isset($_POST['txtCantidadPasajeros'])?$_POST['txtCantidadPasajeros']:"";
        $arrayDatos['marca']= isset($_POST['txtMarca'])?$_POST['txtMarca']:"";
        $arrayDatos['modelo']= isset($_POST['txtModelo'])?$_POST['txtModelo']:"";
        $arrayDatos['precio']= isset($_POST['txtPrecio'])?$_POST['txtPrecio']:"";
        $arrayDatos['estado']= isset($_POST['txtEstado'])?$_POST['txtEstado']:"";
        $arrayDatos['img']= $img?$img:"";


        if($arrayDatos['tipo']!=""&&$arrayDatos['color']!=""&&$arrayDatos['cantidad_pasajeros']!=""&&$arrayDatos['marca']!=""&&$arrayDatos['modelo']!=""&&
        $arrayDatos['precio']!=""&&$arrayDatos['estado']!="" &&$arrayDatos['id_vehiculo']!=""){
            $objVehiculos->constructor($arrayDatos);
            $respuesta= $objVehiculos->editar();

            if($respuesta==true){
                $mensaje="Se edito correctamente";
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
    <meta charset="UTF-8">
  
    <title>Editar vehículo Nº: <?=$objVehiculos->id_vehiculo?></title>
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

        .container {
            margin-top: 2;
        }

        .editar-title {
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
            <h1 class="editar-title">Editar vehículo Nº: <?=$objVehiculos->id_vehiculo?></h1>
            <div class="form-container">
                <form method="POST" action="sistema.php?r=editar_vehiculos" enctype="multipart/form-data">
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
                            <input id="tipo" type="text" class="validate" name="txtTipo" value="<?=$objVehiculos->tipo?>">
                            <label for="tipo">Tipo</label>
                        </div>
                        <div class="input-field col s6">
                            <input id="color" type="text" class="validate" name="txtColor" value="<?=$objVehiculos->color?>">
                            <label for="color">Color</label>
                        </div>
                        <div class="input-field col s6">
                            <input id="cantidad_pasajeros" type="number" class="validate" name="txtCantidadPasajeros" value="<?=$objVehiculos->cantidad_pasajeros?>">
                            <label for="cantidad_pasajeros">Cantidad de pasajeros</label>
                        </div>
                        <div class="input-field col s6">
                            <input id="marca" type="text" class="validate" name="txtMarca" value="<?=$objVehiculos->marca?>">
                            <label for="marca">Marca</label>
                        </div>
                        <div class="input-field col s6">
                            <input id="modelo" type="text" class="validate" name="txtModelo" value="<?=$objVehiculos->modelo?>">
                            <label for="modelo">Modelo</label>
                        </div>
                        <div class="input-field col s6">
                            <input id="precio" type="number" class="validate" name="txtPrecio" value="<?=$objVehiculos->precio?>">
                            <label for="precio">Precio por dia $U</label>
                        </div>
                        <div class="input-field col s6">
                            <select name="txtEstado">
                                <option value="A" <?=$objVehiculos->estado == 'A' ? 'selected' : ''?>>A</option>
                                <option value="O" <?=$objVehiculos->estado == 'O' ? 'selected' : ''?>>O</option>
                                <option value="S" <?=$objVehiculos->estado == 'S' ? 'selected' : ''?>>S</option>
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
                        <input type="hidden" name="id_vehiculo" value="<?=$objVehiculos->id_vehiculo?>">
                        <button class="btn waves-effect waves-light blue" type="submit" name="boton" value="guardar">
                            Guardar <i class="material-icons right blue">send</i>
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
