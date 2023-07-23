<h1>Editar Perfil</h1>
<?php
    require_once("Modelos/tipo_usuario.php");


    $mensaje="";
    $respuesta="";

    $boton= isset($_POST['boton'])?$_POST['boton']:"";
    $id_tipo_usuario= isset($_SESSION['id_tipo_usuario'])?$_SESSION['id_tipo_usuario']:"";

    $objTipo_usuario= new tipo_usuario();
    $objTipo_usuario->cargar($id_tipo_usuario);
    
    if(isset($_POST['boton']) && $_POST['boton'] == "guardar" 
    && $id_tipo_usuario!=""
    && isset($_POST['id_tipo_usuario']) && $_POST['id_tipo_usuario']>0 
    && isset($_POST['txtMail']) && $_POST['txtMail']!=""){

    
        
       $objTipo_usuario->mail=$_POST['txtMail'];

        $respuesta= $objTipo_usuario->editar();

        if($respuesta==true){
            $mensaje="Se edito correctamente";
        }else{
            $mensaje="No se pudo editar";
        }





    }



    if(isset($_POST['boton']) && $_POST['boton'] == "cancelar"){
        header("Location: sistema.php");
       }
  
 ?>


    <form method="POST" action="sistema.php?r=mi_panel">
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
          <input  id="mail" type="email" class="validate" name="txtMail" value="<?=$objTipo_usuario->mail?>">
          <label for="mail">Email</label>
        </div>
        <div class="col s10">
            <input type="hidden" name="id_tipo_usuario" value="<?=$objTipo_usuario->id_tipo_usuario?>" >
            <button class="btn waves-effect waves-light blue" type="submit" name="boton" value="guardar">Guardar
             <i class="material-icons right blue">save</i>
            </button>
            <button class="btn waves-effect waves-light red" type="submit" name="boton" value="cancelar">Cancelar
             <i class="material-icons right red">cancel</i>
            </button>
</div>
        
       

</div>
    </form>
    