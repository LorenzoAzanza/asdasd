<?php
$rolesPermitidos = array("administrador", "encargado"); 

if (!in_array($_SESSION['usuario']['rol'], $rolesPermitidos)) {
   
    header("Location: sistema.php");
    exit();
}
require_once("Modelos/BDvehiculos.php");

$objVehiculos= new vehiculos();


$cantidad=isset($_GET['cantidad'])?$_GET['cantidad']:4;
$pagina=isset($_GET['pagina'])?$_GET['pagina']:1;

$totalRegistros=$objVehiculos->totalRegistros();

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

$listaVehiculos=$objVehiculos->listar($arrayFiltro);





?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="web/css/materialize.min.css" media="screen,projection" />
    <style>
        body {
            display: flex;
            flex-direction: column;
            background: #ffecb3;
            
        }

        main {
            flex: 1 0 auto;
            padding: 20px;
        }


        .vehiculos-title {
            text-align: center;
            color: black;
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .table-container {
            border: 2px solid #e57373;
            padding: 20px;
            border-radius: 10px;
            background-color: #e57373;
        }

        
        .table-container td {
            color: #000;
            text-align: center;
            padding: 10px;
        }

        .table-container th {
            background-color: #d32f2f;
        }
        .nuevo-botton{
          text-align: center;
          margin-bottom: 20px;
        }
        .pagination .active a {
            background-color: blue;
        }

       
      
    </style>
</head>
<title>Lista de vehiculos</title>
<body>
    <main>
        <div class="container">
            <h1 class="vehiculos-title">Lista de vehículos, páginas <?=$pagina?>/<?=$totalPaginas?>, total registros:<?=$totalRegistros?></h1>
            <div class="nuevo-botton">
                <a href="sistema.php?r=ingresar_vehiculos" class="btn blue ">
                    <i class="material-icons">add</i> Nuevo
                </a>
            </div>
            <div class="table-container">
                <table class="striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tipo</th>
                            <th>Color</th>
                            <th>Cantidad de pasajeros</th>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Precio por dia $U</th>
                            <th>Estado</th>
                            <th>Imagen</th>
                            <th style="width: 150px"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($listaVehiculos as $vehiculo) { ?>
                        <tr>
                            <td><?=$vehiculo['id_vehiculo']?></td>
                            <td><?=$vehiculo['tipo']?></td>
                            <td><?=$vehiculo['color']?></td>
                            <td><?=$vehiculo['cantidad_pasajeros']?></td>
                            <td><?=$vehiculo['marca']?></td>
                            <td><?=$vehiculo['modelo']?></td>
                            <td><?=$vehiculo['precio']?></td>
                            <td><?=$vehiculo['estado']?></td>
                            <td>
                                <img src="web/archivos/<?=$vehiculo['img']?>" width="150px" />
                            </td>
                            <td>
                                <a href="sistema.php?r=editar_vehiculos&id_vehiculo=<?=$vehiculo['id_vehiculo']?>"
                                    class="btn blue"><i class="material-icons">edit</i></a>
                                <a href="sistema.php?r=borrar_vehiculos&id_vehiculo=<?=$vehiculo['id_vehiculo']?>"
                                    class="btn red"><i class="material-icons">delete</i></a>
                            </td>
                        </tr>
                        <?php } ?>
                        <tr>
                            <td colspan="12">
                                <ul class="pagination center-align">
    <li class="waves-effect"><a href="sistema.php?r=vehiculos&pagina=1"><i class="material-icons">fast_rewind</i></a></li>
    <li class="waves-effect"><a href="sistema.php?r=vehiculos&pagina=<?=$paginaAnterior?>"><i class="material-icons">chevron_left</i></a></li>

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
          <li class="<?=$color?>"><a href="sistema.php?r=vehiculos&pagina=<?=$i?>"><?=$i?></a></li>

<?php
        }
?>
   
  
    <li class="waves-effect"><a href="sistema.php?r=vehiculos&pagina=<?=$paginaSiguiente?>"><i class="material-icons">chevron_right</i></a></li>
    <li class="waves-effect"><a href="sistema.php?r=vehiculos&pagina=<?=$totalPaginas?>"><i class="material-icons">fast_forward</i></a></li>
    </ul>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>

</html>