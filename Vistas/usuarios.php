
<?php

require_once("Modelos/tipo_usuario.php");

$objTipo_usuario= new tipo_usuario();


$cantidad=isset($_GET['cantidad'])?$_GET['cantidad']:4;
$pagina=isset($_GET['pagina'])?$_GET['pagina']:1;

$totalRegistros=$objTipo_usuario->totalRegistros();

$paginaAnterior=$pagina-1;
if($paginaAnterior<1){
    $paginaAnterior=1;

}
$totalPaginas= ceil($totalRegistros/$cantidad);
$paginaSiguiente=$pagina+1;
if($paginaSiguiente>$totalPaginas){
    $paginaSiguiente=$totalPaginas;

}



$totalPaginas=ceil($totalRegistros/$cantidad);


$arrayFiltro=array();

$arrayFiltro['inicio']=($pagina-1)*$cantidad;
$arrayFiltro['cantidad']=$cantidad;

$listaUsuario=$objTipo_usuario->listar($arrayFiltro);





?>



<h1>Usuarios, paginas <?=$pagina?>/<?=$totalPaginas?>, total registros activos:<?=$totalRegistros?></h1>


<table class="striped">
        <thead>
          <tr>
      <th colspan="9">
        <a href="sistema.php?r=ingresar_usuarios" class="btn blue">
          <i class="material-icons">add</i> Nuevo
</a>
        
    </th>

</tr>
          <tr>
              <th>#ID USUARIOS</th>
              <th>Nombre</th>
              <th>Apellido</th>
              <th>Direccion</th>
              <th>Telefono</th>
              <th>Mail</th>
              <th>Tipo de documento</th>
              <th>Numero de documento</th>
              <th>Rol</th>
              <th>Estado</th>
              <th style="width:150px"></th>

          </tr>
        </thead>

        <tbody>


<?php foreach($listaUsuario as $usuario){ ?>
          <tr>
            <td><?=$usuario['id_tipo_usuario'] ?></td>
            <td><?=$usuario['nombre'] ?></td>
            <td><?=$usuario['apellido'] ?></td>
            <td><?=$usuario['direccion'] ?></td>
            <td><?=$usuario['telefono'] ?></td>
            <td><?=$usuario['mail'] ?></td>
            <td><?=$usuario['tipo_documento'] ?></td>
            <td><?=$usuario['numero_documento'] ?></td>
            <td><?=$usuario['rol']?></td>
            <td><?=$usuario['estado'] ?></td>
            <td>
              <a href="sistema.php?r=editar_usuarios&id_tipo_usuario=<?=$usuario['id_tipo_usuario'] ?>" class="btn blue">
                <i class="material-icons">edit</i>
              </a>
              <a href="sistema.php?r=borrar_usuarios&id_tipo_usuario=<?=$usuario['id_tipo_usuario'] ?>" class="btn red">
                <i class="material-icons">delete</i>
              </a>
            </td>


          </tr>
<?php }?>
  <tr>
      <td colspan="12">
        
  <ul class="pagination center-align">
    <li class="waves-effect"><a href="sistema.php?r=usuarios&pagina=1"><i class="material-icons">fast_rewind</i></a></li>
    <li class="waves-effect"><a href="sistema.php?r=usuarios&pagina=<?=$paginaAnterior?>"><i class="material-icons">chevron_left</i></a></li>
  
<?php
        for($i = ($pagina-2); $i <= ($pagina+2); $i++){

          if($i<1 || $i > $totalPaginas ){
            continue;
          }

          $color="waves-effect";
          if($i== $pagina){
              $color="active";
          }
 ?>
          <li class="<?=$color?>"><a href="sistema.php?r=usuarios&pagina=<?=$i?>"><?=$i?></a></li>

<?php
        }
?>
   
  
    <li class="waves-effect"><a href="sistema.php?r=usuarios&pagina=<?=$paginaSiguiente?>"><i class="material-icons">chevron_right</i></a></li>
    <li class="waves-effect"><a href="sistema.php?r=usuarios&pagina=<?=$totalPaginas?>"><i class="material-icons">fast_forward</i></a></li>
  </ul>

      </td>
  </tr>
          
        </tbody>
      </table>
            