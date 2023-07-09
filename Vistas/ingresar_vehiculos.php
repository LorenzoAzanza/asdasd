<?php
    require_once("Modelos/BDvehiculos.php");


    $mensaje="";
    $respuesta="";
    $boton= isset($_POST['boton'])?$_POST['boton']:"";

    if($boton=="cancelar"){
        //redireccionar a la lista de proveedores
        header('Location: sistema.php?r=vehiculos');

    }elseif($boton=="ingresar"){
        //si vale ingresar , ingresamos el registro 
        $objVehiculos= new vehiculos();
        $arrayDatos=array();

        $arrayDatos['tipo']= isset($_POST['txtTipo'])?$_POST['txtTipo']:"";
        $arrayDatos['color']= isset($_POST['txtColor'])?$_POST['txtColor']:"";
        $arrayDatos['cantidad_pasajeros']= isset($_POST['txtCantidadPasajeros'])?$_POST['txtCantidadPasajeros']:"";
        $arrayDatos['marca']= isset($_POST['txtMarca'])?$_POST['txtMarca']:"";
        $arrayDatos['modelo']= isset($_POST['txtModelo'])?$_POST['txtModelo']:"";
        $arrayDatos['precio']= isset($_POST['txtPrecio'])?$_POST['txtPrecio']:"";
        $arrayDatos['estado']= isset($_POST['txtEstado'])?$_POST['txtEstado']:"";

        if($arrayDatos['tipo']!="" && $arrayDatos['color']!="" && $arrayDatos['cantidad_pasajeros']!=""&&$arrayDatos['marca']!=""&&$arrayDatos['modelo']!=""&&$arrayDatos['precio']!=""){
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







<h1>Ingresar vehiculos</h1>

    <form method="POST" action="sistema.php?r=ingresar_vehiculos">
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
          <input  id="tipo" type="text" class="validate" name="txtTipo">
          <label for="tipo">Tipo</label>
        </div>
        <div class="input-field col s6">
          <input  id="color" type="text" class="validate" name="txtColor">
          <label for="color">Color</label>
        </div>
        <div class="input-field col s6">
          <input  id="cantidad_pasajeros" type="text" class="validate" name="txtCantidadPasajeros">
          <label for="cantidad_pasajeros">Cantidad de pasajeros</label>
        </div>
        <div class="input-field col s6">
          <input  id="marca" type="text" class="validate" name="txtMarca">
          <label for="marca">Marca</label>
        </div>
        <div class="input-field col s6">
          <input  id="modelo" type="text" class="validate" name="txtModelo">
          <label for="modelo">Modelo</label>
        </div>
        <div class="input-field col s6">
          <input  id="precio" type="text" class="validate" name="txtPrecio">
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
            <button class="btn waves-effect waves-light blue" type="submit" name="boton" value="ingresar">Ingresar
             <i class="material-icons right blue">send</i>
            </button>
            <button class="btn waves-effect waves-light red" type="submit" name="boton" value="cancelar">Cancelar
             <i class="material-icons right red">cancel</i>
            </button>
</div>

</div>
    </form>
    