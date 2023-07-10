<?php
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







<h1>Borrar vehiculos</h1>

    <form method="POST" action="sistema.php?r=borrar_vehiculos">
      <div class="row">
        <?php
        if($respuesta==true){
?>
 <div class="card-panel blue center-align">
        <?=$mensaje?>
        <a href="sistema.php?r=vehiculos" class="btn green">Regresar</a>
      </div>

<?php
        }elseif($respuesta==false && $mensaje!=""){ 
?>
            <div class="card-panel red center-align">
            <?=$mensaje?>
        <a href="sistema.php?r=vehiculos" class="btn red">Regresar</a>
            
            
          </div>

          <?php
        }else{
        ?>

<div class="col s10">

    <h3> Esta seguro que desea borrar el registro Nº: <?=$id_vehiculo?> </h3>
          
        
</div>

        <div class="col s10">
        <input type="hidden" name="id_vehiculo" value="<?=$id_vehiculo?>">
            <button class="btn waves-effect waves-light blue" type="submit" name="boton" value="borrar">Borrar
             <i class="material-icons right blue">send</i>
            </button>
            <button class="btn waves-effect waves-light red" type="submit" name="boton" value="cancelar">Cancelar
             <i class="material-icons right red">cancel</i>
            </button>
</div>
<?php
        }
?>

</div>
    </form>