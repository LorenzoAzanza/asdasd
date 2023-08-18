<?php
    require_once("Modelos/BDReserva.php");


    $mensaje="";
    $respuesta="";
    $boton= isset($_POST['boton'])?$_POST['boton']:"";
    $objReserva= new reserva();
        

    if($boton=="cancelar"){
        header('Location: sistema.php?r=reservas');

    }elseif($boton=="ingresar"){
      

     
               
      $arrayDatos=array();
      
       

        $arrayDatos['fechaInicio']= isset($_POST['txtFechaInicio'])?$_POST['txtFechaInicio']:"";
        $arrayDatos['fechaFin']= isset($_POST['txtFechaFin'])?$_POST['txtFechaFin']:"";
        $arrayDatos['id_cliente']= isset($_POST['id_cliente'])?$_POST['id_cliente']:"";
        $arrayDatos['id_vehiculo']= isset($_POST['id_vehiculo'])?$_POST['id_vehiculo']:"";
        $arrayDatos['estado']= isset($_POST['txtEstado'])?$_POST['txtEstado']:"";


        if($arrayDatos['fechaInicio']!="" && $arrayDatos['fechaFin']!="" && 
        $arrayDatos['id_cliente']!=""&&$arrayDatos['id_vehiculo']!=""&&
        $arrayDatos['estado']!=""){
            $objReserva->constructor($arrayDatos);
            $respuesta= $objReserva->ingresar();

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
    <title>Ingresar Reservas</title>
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
            <h1 class="ingresar-title">Ingresar Reservas</h1>
            <div class="form-container">
                <form method="POST" action="sistema.php?r=ingresar_reservas" enctype="multipart/form-data">
                    <div class="row">
                        <?php if ($respuesta == true): ?>
                            <div class="card-panel blue center-align">
                                <?=$mensaje?>
                                <a href="sistema.php?r=reservas" class="btn green">Regresar</a>
                            </div>
                        <?php elseif ($respuesta == false && $mensaje != ""): ?>
                            <div class="card-panel red center-align">
                                <?=$mensaje?>
                            </div>
                        <?php endif; ?>

                        <div class="input-field col s6">
                            <input id="fechaInicio" type="date" class="validate" name="txtFechaInicio">
                            <label for="fechaInicio">Fecha Inicio</label>
                        </div>
                        <div class="input-field col s6">
                            <input id="fechaFin" type="date" class="validate" name="txtFechaFin">
                            <label for="fechaFin">Fecha Fin</label>
                        </div>
                        <div class="input-field col s6">
                            <input id="id_cliente" type="number" class="validate" name="id_cliente">
                            <label for="id_cliente">ID del cliente</label>
                        </div>
                        <div class="input-field col s6">
                            <input id="id_vehiculo" type="number" class="validate" name="id_vehiculo">
                            <label for="id_vehiculo">ID del vehiculo</label>
                        </div>
            
                        <div class="input-field col s6">
                            <select name="txtEstado">
                                <option value="A" <?=$objReserva->estado == 'A' ? 'selected' : ''?>>Activa</option>
                           
                            </select>
                            <label>Estado</label>
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
