
<?php
$rolesPermitidos = array("administrador", "encargado"); // Definir los roles permitidos en un array

if (!in_array($_SESSION['usuario']['rol'], $rolesPermitidos)) {
    // Redirigir a una página de acceso denegado
    header("Location: sistema.php");
    exit();
}
    require_once("Modelos/BDReserva.php");


    $mensaje="";
    $respuesta="";
    $boton= isset($_POST['boton'])?$_POST['boton']:"";
    $id_reserva= isset($_GET['id_reserva'])?$_GET['id_reserva']:"";

    $objReserva= new reserva();
    $objReserva->cargar($id_reserva);
    
    if(isset($_POST['boton']) && $_POST['boton'] == "guardar" && isset($_POST['id_reserva']) && $_POST['id_reserva']>0 &&  isset($_POST['txtFechaInicio']) && $_POST['txtFechaInicio']!=""
    &&  isset($_POST['txtFechaFin']) && $_POST['txtFechaFin']!="" &&  isset($_POST['id_cliente']) && $_POST['id_cliente']!=""
    &&  isset($_POST['id_vehiculo']) && $_POST['id_vehiculo']!="" && 
    isset($_POST['txtEstado']) && $_POST['txtEstado']!="" ){

        $id_reserva=$_POST['id_reserva'];
        $arrayDatos= array(
        "fechaInicio"=>$_POST['txtFechaInicio'],
        "fechaFin"=>$_POST['txtFechaFin'],
        "id_cliente"=>$_POST['id_cliente'],
        "id_vehiculo"=>$_POST['id_vehiculo'],
        "estado"=>$_POST['txtEstado']
        );
        

        $objReserva->cargar($id_reserva);
        $objReserva->constructor($arrayDatos);
        $respuesta= $objReserva->editar();

        if($respuesta==true){
            $mensaje="Se edito correctamente";
        }else{
            $mensaje="No se pudo editar";
        }





    }



    if(isset($_POST['boton']) && $_POST['boton'] == "cancelar"){
        header("Location: sistema.php?r=reservas");
       }
  
 ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <title>Editar reservas</title>
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
            <h1 class="editar-title">Editar Reserva Nº: <?=$id_reserva?></h1>
            <div class="form-container">
                <form method="POST" action="sistema.php?r=editar_reserva">
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
                            <input id="fechaInicio" type="date" class="validate" name="txtFechaInicio" value="<?=$objReserva->fechaInicio?>">
                            <label for="fechaInicio">Fecha de Inicio</label>
                        </div>
                        <div class="input-field col s6">
                            <input id="fechaFin" type="date" class="validate" name="txtFechaFin" value="<?=$objReserva->fechaFin?>">
                            <label for="fechaFin">Fecha de Fin</label>
                        </div>
                        <div class="input-field col s6">
                            <input id="id_cliente" type="text" class="validate" name="id_cliente" value="<?=$objReserva->id_cliente?>">
                            <label for="id_cliente">Id del cliente</label>
                        </div>
                        <div class="input-field col s6">
                            <input id="id_vehiculo" type="text" class="validate" name="id_vehiculo" value="<?=$objReserva->id_vehiculo?>">
                            <label for="id_vehiculo">Telefono</label>
                        </div>
                       
                        <div class="input-field col s6">
                            <select name="txtEstado">
                                <option value="A" <?=$objReserva->estado == 'A' ? 'selected' : ''?>>Activa</option>
                                <option value="B" <?=$objReserva->estado == 'B' ? 'selected' : ''?>>Borrada</option>
                            </select>
                            <label>Estado</label>
                        </div>
                        <div class="col s10">
                            <input type="hidden" name="id_reserva" value="<?=$objReserva->id_reserva?>" >
                            <div class="submit-buttons">
                                <button class="btn waves-effect waves-light blue" type="submit" name="boton" value="guardar">
                                    Guardar <i class="material-icons right blue">save</i>
                                </button>
                                <button class="btn waves-effect waves-light red" type="submit" name="boton" value="cancelar">
                                    Cancelar <i class="material-icons right red">cancel</i>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>

</html>
