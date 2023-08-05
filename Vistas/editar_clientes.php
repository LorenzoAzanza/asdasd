<h1> Editar Cliente <h1>
<?php
    require_once("Modelos/BDClientes.php");


    $mensaje="";
    $respuesta="";
    $boton= isset($_POST['boton'])?$_POST['boton']:"";
    $id_cliente= isset($_GET['id_cliente'])?$_GET['id_cliente']:"";

    $objClientes= new cliente();
    $objClientes->cargar($id_cliente);
    
    if(isset($_POST['boton']) && $_POST['boton'] == "guardar" && isset($_POST['id_cliente']) && $_POST['id_cliente']>0 &&  isset($_POST['txtNombre']) && $_POST['txtNombre']!=""
    &&  isset($_POST['txtApellido']) && $_POST['txtApellido']!="" &&  isset($_POST['txtDireccion']) && $_POST['txtDireccion']!=""
    &&  isset($_POST['txtTelefono']) && $_POST['txtTelefono']!="" &&  isset($_POST['txtMail']) && $_POST['txtMail']!=""
    &&  isset($_POST['txtTipo_documento']) && $_POST['txtTipo_documento']!="" &&  isset($_POST['txtNumero_documento'])&& $_POST['txtNumero_documento']!="" && 
    isset($_POST['txtEstado']) && $_POST['txtEstado']!="" && 
    isset($_POST['txtRol']) && $_POST['txtRol']!=""){

        $id_cliente=$_POST['id_cliente'];
        $arrayDatos= array(
        "nombre"=>$_POST['txtNombre'],
        "apellido"=>$_POST['txtApellido'],
        "direccion"=>$_POST['txtDireccion'],
        "telefono"=>$_POST['txtTelefono'],
        "mail"=>$_POST['txtMail'],
        "tipo_documento"=>$_POST['txtTipo_documento'],
        "numero_documento"=>$_POST['txtNumero_documento'],
        "estado"=>$_POST['txtEstado'],
        "rol"=>$_POST['txtRol']
        );
        

        $objClientes->cargar($id_cliente);
        $objClientes->constructor($arrayDatos);
        $respuesta= $objClientes->editar();

        if($respuesta==true){
            $mensaje="Se edito correctamente";
        }else{
            $mensaje="No se pudo editar";
        }





    }



    if(isset($_POST['boton']) && $_POST['boton'] == "cancelar"){
        header("Location: sistema.php?r=clientes");
       }
  
 ?>

<h1>Cliente Nº:<?=$id_cliente?> </h1>

    <form method="POST" action="sistema.php?r=editar_clientes">
      <div class="row">
        <?php
        if($respuesta==true){
?>
 <div class="card-panel blue center-align">
        <?=$mensaje?>
        <a href="sistema.php?r=clientes" class="btn green">Regresar</a>
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
          <input  id="nombre" type="text" class="validate" name="txtNombre" value="<?=$objClientes->nombre?>">
          <label for="nombre">Nombre</label>
        </div>
        <div class="input-field col s6">
          <input  id="apellido" type="text" class="validate" name="txtApellido" value="<?=$objClientes->apellido?>">
          <label for="apellido">Apellido</label>
        </div>
        <div class="input-field col s6">
          <input  id="direccion" type="text" class="validate" name="txtDireccion" value="<?=$objClientes->direccion?>">
          <label for="direccion">Direccion</label>
        </div>
        <div class="input-field col s6">
          <input  id="telefono" type="number" class="validate" name="txtTelefono" value="<?=$objClientes->telefono?>">
          <label for="telefono">Telefono</label>
        </div>
        <div class="input-field col s6">
          <input  id="mail" type="email" class="validate" name="txtMail" value="<?=$objClientes->mail?>">
          <label for="mail">Mail</label>
        </div>
       
        <div class="input-field col s6">
          <input  id="tipo_documento" type="text" class="validate" name="txtTipo_documento" value="<?=$objClientes->tipo_documento?>">
          <label for="tipo_documento">Tipo de documento</label>
        </div>
        <div class="input-field col s6">
          <input  id="numero_documento" type="number" class="validate" name="txtNumero_documento" value="<?=$objClientes->numero_documento?>">
          <label for="numero_documento">Numero de documento</label>
        </div>
        <div class="input-field col s6"> 
          <select name="txtRol">
          <option value="cliente"  selected>Cliente</option>
          <option value="Administrador" >Administrador</option>
          <option value="vendedor">Vendedor</option>
      </select>
      <label>Rol</label>

      </div>
     


        <div class="input-field col s6">
            <select name="txtEstado">
            <option value="A" selected>A</option>
            <option value="S">S</option>
         
            </select>
  <label>Estado</label>
</div>
        <div class="col s10">
            <input type="hidden" name="id_cliente" value="<?=$objClientes->id_cliente?>" >
            <button class="btn waves-effect waves-light blue" type="submit" name="boton" value="guardar">Guardar
             <i class="material-icons right blue">save</i>
            </button>
            <button class="btn waves-effect waves-light red" type="submit" name="boton" value="cancelar">Cancelar
             <i class="material-icons right red">cancel</i>
            </button>
</div>

</div>
    </form>
    