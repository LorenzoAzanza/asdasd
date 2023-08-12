<?php


require_once("Modelos/BDClientes.php");

    $nuevaContrasena = trim("TTDSADS432432^");
    $resultado = preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/', $nuevaContrasena);




    $mensaje="";
    $respuesta="";

    $boton= isset($_POST['boton'])?$_POST['boton']:"";
    $id_cliente= isset($_SESSION['id_cliente'])?$_SESSION['id_cliente']:"";

    $objCliente= new cliente();
    $objCliente->cargar($id_cliente);
    
      if($boton == "guardar" && $id_cliente!=""
           
          && isset($_POST['txtMail']) && $_POST['txtMail']!="" && isset($_POST['txtNombre']) && $_POST['txtNombre']!="" && isset($_POST['txtApellido']) && $_POST['txtApellido']!=""
          && isset($_POST['txtDireccion']) && $_POST['txtDireccion']!="" && isset($_POST['txtTelefono']) && $_POST['txtTelefono']!="" 
          && isset($_POST['txtTipo_documento']) && $_POST['txtTipo_documento']!="" && isset($_POST['txtNumero_documento']) && $_POST['txtNumero_documento']!=""){

    
        
       $objCliente->mail=$_POST['txtMail'];
       $objCliente->nombre=$_POST['txtNombre'];
       $objCliente->apellido=$_POST['txtApellido'];
       $objCliente->direccion=$_POST['txtDireccion'];
       $objCliente->telefono=$_POST['txtTelefono'];
       $objCliente->tipo_documento=$_POST['txtTipo_documento'];
       $objCliente->numero_documento=$_POST['txtNumero_documento'];

        $respuesta= $objCliente->editar();

      if($respuesta==true){
            $mensaje="Se edito correctamente";
      }else{
            $mensaje="No se pudo editar";
          }
    }

    $contrasena= isset($_POST['txtContrasena'])?$_POST['txtContrasena']:"";
    $nuevaContrasena= isset($_POST['txtNuevaContrasena'])?$_POST['txtNuevaContrasena']:"";
    $confirmarContrasena= isset($_POST['txtConfirmarContrasena'])?$_POST['txtConfirmarContrasena']:"";



    if($boton == "contrasena" && $id_cliente!="" && $contrasena !="" && $nuevaContrasena !=""  && $confirmarContrasena !=""){

        $respuesta= $objCliente->cambiarContrasena($contrasena,$nuevaContrasena,$confirmarContrasena);

      if($respuesta===true){
            $mensaje="Se edito correctamente";
      }else{
            $mensaje=$respuesta;
            $respuesta=false;
          }
    }

      if(isset($_POST['boton']) && $_POST['boton'] == "cancelar"){
        header("Location: sistema.php");
       }
  
 ?>
 
<h1>Editar Perfil</h1>

  <form method="POST" action="sistema.php?r=mi_panel">
  <input type="hidden" name="id_cliente" value="<?=$objCliente->id_cliente?>">

    <div class="row">
<?php
      if($respuesta==true && $boton=="guardar"){
?>
    <div class="card-panel blue center-align">
        <?=$mensaje?>
      <a href="sistema.php?r=usuarios" class="btn green">Regresar</a>
    </div>

<?php
        }elseif(($respuesta==false && $mensaje!="") && $boton=="guardar" ){ 
          
?>
    <div class="card-panel red center-align">
        <?=$mensaje?>
            
    </div>
<?php
        }
?>
          
        
          <div class="row">
    <div class="input-field col s6">
    <input id="mail" type="email" class="validate" name="txtMail" value="<?= $objCliente->mail ?>">
        <label for="mail">Email</label>
    </div>
    
    <div class="input-field col s6">
        <input id="nombre" type="text" class="validate" name="txtNombre" value="<?=$objCliente->nombre?>">
        <label for="nombre">Nombre</label>
    </div>
    <div class="input-field col s6">
        <input id="apellido" type="text" class="validate" name="txtApellido" value="<?=$objCliente->apellido?>">
        <label for="apellido">Apellido</label>
    </div>
    <div class="input-field col s6">
        <input id="direccion" type="text" class="validate" name="txtDireccion" value="<?=$objCliente->direccion?>">
        <label for="direccion">Direccion</label>
    </div>
    <div class="input-field col s6">
        <input id="telefono" type="number" class="validate" name="txtTelefono" value="<?=$objCliente->telefono?>">
        <label for="telefono">Telefono</label>
    </div>
    <div class="input-field col s6">
        <input id="tipo_documento" type="text" class="validate" name="txtTipo_documento" value="<?=$objCliente->tipo_documento?>">
        <label for="tipo_documento">Tipo de documento</label>
    </div>
    <div class="input-field col s6">
        <input id="numero_documento" type="number" class="validate" name="txtNumero_documento" value="<?=$objCliente->numero_documento?>">
        <label for="numero_documento">Numero de documento</label>
    </div>
    <div class="col s12">
        <input type="hidden" name="id_cliente" value="<?=$objCliente->id_cliente?>">
        <button class="btn waves-effect waves-light blue" type="submit" name="boton" value="guardar">Guardar
            <i class="material-icons right blue">save</i>
        </button>
        <button class="btn waves-effect waves-light red" type="submit" name="boton" value="cancelar">Cancelar
            <i class="material-icons right red">cancel</i>
        </button>
    </div>
</div>

        
       

    </div>
  </form>
<h1>Cambio de Contraseña</h1>

<form method="POST" action="sistema.php?r=mi_panel">
    <div class="row">
<?php
      if($respuesta==true && $boton=="contrasena"){
?>
    <div class="card-panel blue center-align">
        <?=$mensaje?>
      <a href="sistema.php?r=usuarios" class="btn green">Regresar</a>
    </div>

<?php
        }elseif(($respuesta==false && $mensaje!="") && $boton=="contrasena"){ 
?>
    <div class="card-panel red center-align">
        <?=$mensaje?>
            
    </div>
<?php
        }
?>
          
        
    <div class="input-field col s6">
      <input  id="contrasena" type="password" class="validate" name="txtContrasena" value="">
        <label for="contrasena">Contraseña</label>
    </div>
    <div class="input-field col s6">
      <input  id="nuevaContrasena" type="password" class="validate" name="txtNuevaContrasena" value="">
        <label for="nuevaContrasena">Nueva Contraseña</label>
    </div>
    <div class="input-field col s6">
      <input  id="confirmarContrasena" type="password" class="validate" name="txtConfirmarContrasena" value="">
        <label for="confirmarContrasena">Confirmar Contraseña</label>
    </div>

    <div class="col s10">
      <input type="hidden" name="id_cliente" value="<?=$objCliente->id_cliente?>" >
        <button class="btn waves-effect waves-light blue" type="submit" name="boton" value="contrasena">Guardar
          <i class="material-icons right blue">save</i>
        </button>
        <button class="btn waves-effect waves-light red" type="submit" name="boton" value="cancelar">Cancelar
          <i class="material-icons right red">cancel</i>
        </button>
    </div>
        
       

    </div>
  </form>
    