<?php
    require_once("Modelos/BDClientes.php");


    $mensaje="";
    $respuesta="";


    $id_cliente = isset($_GET['id_cliente'])?$_GET['id_cliente']:"";

    if(isset($_POST['id_cliente']) && $_POST['id_cliente']>0 && isset($_POST['boton']) && $_POST['boton'] == "borrar" ){

        $id_cliente=$_POST['id_cliente'];
        $objClientes = new cliente();
        $existe= $objClientes->cargar($id_cliente);
        if($existe){
            $respuesta=$objClientes->borrar();
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
    header("Location: sistema.php?r=clientes");
   }



?>







<h1>Borrar Clientes</h1>

    <form method="POST" action="sistema.php?r=borrar_clientes">
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
        <a href="sistema.php?r=clientes" class="btn red">Regresar</a>
            
            
          </div>

          <?php
        }else{
        ?>

<div class="col s10">

    <h3> Esta seguro que desea borrar el registro Nº: <?=$id_cliente?> </h3>
          
        
</div>

        <div class="col s10">
        <input type="hidden" name="id_cliente" value="<?=$id_cliente?>">
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