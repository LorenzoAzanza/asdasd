<?php
    require_once("Modelos/BDUsuarios.php");


    $mensaje="";
    $respuesta="";


    $id_usuario = isset($_GET['id_usuario'])?$_GET['id_usuario']:"";

    if(isset($_POST['id_usuario']) && $_POST['id_usuario']>0 && isset($_POST['boton']) && $_POST['boton'] == "borrar" ){

        $id_usuario=$_POST['id_usuario'];
        $objUsuarios = new usuario();
        $existe= $objUsuarios->cargar($id_usuario);
        if($existe){
            $respuesta=$objUsuarios->borrar();
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
    header("Location: sistema.php?r=usuarios");
   }



?>







<h1>Borrar usuarios</h1>

    <form method="POST" action="sistema.php?r=borrar_usuarios">
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
        <a href="sistema.php?r=usuarios" class="btn red">Regresar</a>
            
            
          </div>

          <?php
        }else{
        ?>

<div class="col s10">

    <h3> Esta seguro que desea borrar el registro Nº: <?=$id_usuario?> </h3>
          
        
</div>

        <div class="col s10">
        <input type="hidden" name="id_usuario" value="<?=$id_usuario?>">
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