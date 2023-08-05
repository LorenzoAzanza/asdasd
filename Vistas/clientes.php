
<?php

require_once("Modelos/BDClientes.php");

$objClientes= new cliente();



$cantidad=isset($_GET['cantidad'])?$_GET['cantidad']:4;
$pagina=isset($_GET['pagina'])?$_GET['pagina']:1;

$totalRegistros=$objClientes->totalRegistros();

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

$arrayFiltro = array("activo" => 1);

$listaclientes = $objClientes->listar($arrayFiltro);





?>



<h1>clientes, paginas <?=$pagina?>/<?=$totalPaginas?>, total registros activos:<?=$totalRegistros?></h1>


<table class="striped">
        <thead>
          <tr>
      <th colspan="9">
        <a href="sistema.php?r=ingresar_clientes" class="btn blue">
          <i class="material-icons">add</i> Nuevo
</a>
        
    </th>

</tr>
          <tr>
              <th>#</th>
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


<?php foreach($listaclientes as $cliente){ ?>
          <tr>
            <td><?=$cliente['id_cliente'] ?></td>
            <td><?=$cliente['nombre'] ?></td>
            <td><?=$cliente['apellido'] ?></td>
            <td><?=$cliente['direccion'] ?></td>
            <td><?=$cliente['telefono'] ?></td>
            <td><?=$cliente['mail'] ?></td>
            <td><?=$cliente['tipo_documento'] ?></td>
            <td><?=$cliente['numero_documento'] ?></td>
            <td><?=$cliente['rol'] ?></td>
            <td><?=$cliente['estado'] ?></td>
            <td>
              <a href="sistema.php?r=editar_clientes&id_cliente=<?=$cliente['id_cliente'] ?>" class="btn blue">
                <i class="material-icons">edit</i>
              </a>
              <a href="sistema.php?r=borrar_clientes&id_cliente=<?=$cliente['id_cliente'] ?>" class="btn red">
                <i class="material-icons">delete</i>
              </a>
            </td>


          </tr>
<?php }?>
  <tr>
      <td colspan="12">
        
  <ul class="pagination center-align">
    <li class="waves-effect"><a href="sistema.php?r=clientes&pagina=1"><i class="material-icons">fast_rewind</i></a></li>
    <li class="waves-effect"><a href="sistema.php?r=clientes&pagina=<?=$paginaAnterior?>"><i class="material-icons">chevron_left</i></a></li>
  
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
          <li class="<?=$color?>"><a href="sistema.php?r=clientes&pagina=<?=$i?>"><?=$i?></a></li>

<?php
        }
?>
   
  
    <li class="waves-effect"><a href="sistema.php?r=clientes&pagina=<?=$paginaSiguiente?>"><i class="material-icons">chevron_right</i></a></li>
    <li class="waves-effect"><a href="sistema.php?r=clientes&pagina=<?=$totalPaginas?>"><i class="material-icons">fast_forward</i></a></li>
  </ul>

      </td>
  </tr>
          
        </tbody>
      </table>
            