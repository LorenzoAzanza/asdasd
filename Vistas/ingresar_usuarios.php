
<?php
    require_once("Modelos/BDUsuarios.php");


    $mensaje="";
    $respuesta="";
    $boton= isset($_POST['boton'])?$_POST['boton']:"";

    if($boton=="cancelar"){
        
        header('Location: sistema.php?r=usuarios');

    }elseif($boton=="ingresar"){
      
        $objUsuarios= new usuario();
        $arrayDatos=array();

        $arrayDatos['nombre']= isset($_POST['txtNombre'])?$_POST['txtNombre']:"";
        $arrayDatos['apellido']= isset($_POST['txtApellido'])?$_POST['txtApellido']:"";
        $arrayDatos['direccion']= isset($_POST['txtDireccion'])?$_POST['txtDireccion']:"";
        $arrayDatos['telefono']= isset($_POST['txtTelefono'])?$_POST['txtTelefono']:"";
        $arrayDatos['mail']= isset($_POST['txtMail'])?$_POST['txtMail']:"";
        $arrayDatos['tipo_documento']= isset($_POST['txtTipo_documento'])?$_POST['txtTipo_documento']:"";
        $arrayDatos['numero_documento']= isset($_POST['txtNumero_documento'])?$_POST['txtNumero_documento']:"";
        $arrayDatos['estado']= isset($_POST['txtEstado'])?$_POST['txtEstado']:"";

        if($arrayDatos['nombre']!="" && $arrayDatos['apellido']!="" && $arrayDatos['direccion']!=""&&$arrayDatos['telefono']!=""&&$arrayDatos['mail']!=""&&$arrayDatos['tipo_documento']!=""&&$arrayDatos['numero_documento']!=""){
            $objUsuarios->constructor($arrayDatos);
            $respuesta= $objUsuarios->ingresar();

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







<h1>Ingresar Usuarios</h1>

    <form method="POST" action="sistema.php?r=ingresar_usuarios">
      <div class="row">
        <?php
        if($respuesta==true){
?>
 <div class="card-panel blue center-align">
        <?=$mensaje?>
        <a href="sistema.php?r=usuarios" class="btn green">Regresar</a>
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
          <input  id="nombre" type="text" class="validate" name="txtNombre">
          <label for="nombre">Nombre</label>
        </div>
        <div class="input-field col s6">
          <input  id="apellido" type="text" class="validate" name="txtApellido">
          <label for="apellido">Apellido</label>
        </div>
        <div class="input-field col s6">
          <input  id="direccion" type="text" class="validate" name="txtDireccion">
          <label for="direccion">Direccion</label>
        </div>
        <div class="input-field col s6">
          <input  id="telefono" type="number" class="validate" name="txtTelefono">
          <label for="telefono">Telefono</label>
        </div>
        <div class="input-field col s6">
          <input  id="mail" type="email" class="validate" name="txtMail">
          <label for="mail">Mail</label>
        </div>
        <div class="input-field col s6">
          <input  id="tipo_documento" type="text" class="validate" name="txtTipo_documento">
          <label for="tipo_documento">Tipo de documento</label>
        </div>
        <div class="input-field col s6">
          <input  id="numero_documento" type="number" class="validate" name="txtNumero_documento">
          <label for="numero_documento">Numero de documento</label>
        </div>
        <div class="input-field col s6">
            <select name="txtEstado">
            <option value="A" selected>A</option>
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
    