<?php
    require_once("Modelos/BDvehiculos.php");


    $mensaje="";
    $respuesta="";
    $boton= isset($_POST['boton'])?$_POST['boton']:"";
    $id_vehiculo= isset($_GET['id_vehiculo'])?$_GET['id_vehiculo']:"";

    $objVehiculo= new vehiculos();
    $objVehiculo->cargar($id_vehiculo);
    
    if(isset($_POST['boton']) && $_POST['boton'] == "guardar" && isset($_POST['id_vehiculo']) && $_POST['id_vehiculo']>0 &&  isset($_POST['txtTipo']) && $_POST['txtTipo']!=""
    &&  isset($_POST['txtColor']) && $_POST['txtColor']!="" &&  isset($_POST['txtCantidadPasajeros']) && $_POST['txtCantidadPasajeros']!=""
    &&  isset($_POST['txtMarca']) && $_POST['txtMarca']!="" &&  isset($_POST['txtModelo']) && $_POST['txtModelo']!=""
    &&  isset($_POST['txtPrecio']) && $_POST['txtPrecio']!="" &&  isset($_POST['txtEstado']) && $_POST['txtEstado']!=""){

        $id_vehiculo=$_POST['id_vehiculo'];
        $arrayDatos= array(
        "tipo"=>$_POST['txtTipo'],
        "color"=>$_POST['txtColor'],
        "cantidad_pasajeros"=>$_POST['txtCantidadPasajeros'],
        "marca"=>$_POST['txtMarca'],
        "modelo"=>$_POST['txtModelo'],
        "precio"=>$_POST['txtPrecio'],
        "estado"=>$_POST['txtEstado']
        );
        

        $objVehiculo->cargar($id_vehiculo);
        $objVehiculo->constructor($arrayDatos);
        $respuesta= $objVehiculo->editar();

        if($respuesta==true){
            $mensaje="Se edito correctamente";
        }else{
            $mensaje="No se pudo editar";
        }





    }



    if(isset($_POST['boton']) && $_POST['boton'] == "cancelar"){
        header("Location: sistema.php?r=vehiculos");
       }
  
 ?>

<h1>Editar vehiculo Nº:<?=$id_vehiculo?> </h1>

    <form method="POST" action="sistema.php?r=editar_vehiculos">
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
            
          </div>
          <?php
        }
        ?>
          
        
        <div class="input-field col s6">
          <input  id="tipo" type="text" class="validate" name="txtTipo" value="<?=$objVehiculo->tipo?>">
          <label for="tipo">Tipo</label>
        </div>
        <div class="input-field col s6">
          <input  id="color" type="text" class="validate" name="txtColor" value="<?=$objVehiculo->color?>">
          <label for="color">Color</label>
        </div>
        <div class="input-field col s6">
          <input  id="cantidad_pasajeros" type="text" class="validate" name="txtCantidadPasajeros" value="<?=$objVehiculo->cantidad_pasajeros?>">
          <label for="cantidad_pasajeros">Cantidad de pasajeros</label>
        </div>
        <div class="input-field col s6">
          <input  id="marca" type="text" class="validate" name="txtMarca" value="<?=$objVehiculo->marca?>">
          <label for="marca">Marca</label>
        </div>
        <div class="input-field col s6">
          <input  id="modelo" type="text" class="validate" name="txtModelo" value="<?=$objVehiculo->modelo?>">
          <label for="modelo">Modelo</label>
        </div>
        <div class="input-field col s6">
          <input  id="precio" type="text" class="validate" name="txtPrecio" value="<?=$objVehiculo->precio?>">
          <label for="precio">Precio</label>
        </div>
        <div class="input-field col s6">
            <select name="txtEstado">
            <option value="A" selected>A</option>
            <option value="O">O</option>
            <option value="S">S</option>
         
            </select>
  <label>Estado</label>
</div>
        <div class="col s10">
            <input type="hidden" name="id_vehiculo" value="<?=$objVehiculo->id_vehiculo?>" >
            <button class="btn waves-effect waves-light blue" type="submit" name="boton" value="guardar">Guardar
             <i class="material-icons right blue">save</i>
            </button>
            <button class="btn waves-effect waves-light red" type="submit" name="boton" value="cancelar">Cancelar
             <i class="material-icons right red">cancel</i>
            </button>
</div>

</div>
    </form>
    