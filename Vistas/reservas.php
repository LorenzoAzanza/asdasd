<?php

require_once("Modelos/BDReserva.php");

$objReserva = new Reserva();

$cantidad = isset($_GET['cantidad']) ? $_GET['cantidad'] : 4;
$pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

$totalRegistros = $objReserva->totalRegistros();

$paginaAnterior = $pagina - 1;
if ($paginaAnterior < 1) {
    $paginaAnterior = 1;
}

$totalPaginas = ceil($totalRegistros / $cantidad);
$paginaSiguiente = $pagina + 1;
if ($paginaSiguiente > $totalPaginas) {
    $paginaSiguiente = $totalPaginas;
}

$totalPaginas = ceil($totalRegistros / $cantidad);

$arrayFiltro = array();

$arrayFiltro['inicio'] = ($pagina - 1) * $cantidad;
$arrayFiltro['cantidad'] = $cantidad;

$listaReservas = $objReserva->listar($arrayFiltro);



?>

<h1>Reservas, paginas <?=$pagina?>/<?=$totalPaginas?>, total registros activos:<?=$totalRegistros?></h1>

<table class="striped">
    <thead>
        <tr>
            <th colspan="6">
                <a href="sistema.php?r=ingresar_reserva" class="btn blue">
                    <i class="material-icons">add</i> Nueva Reserva
                </a>
            </th>
        </tr>
        <tr>
            <th>#</th>
            <th>Fecha</th>
            <th>Cliente</th>
            <th>Vehículo</th>
            <th>Estado</th>
            <th style="width:150px"></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($listaReservas as $reserva) { ?>
        <tr>
            <td><?=$reserva['id_reserva'] ?></td>
            <td><?=$reserva['fechaInicio'].' Hasta '.$reserva['fechaFin'] ?></td>
            <td><?=$reserva['nombreCliente'] ?></td>
            <td><?=$reserva['marcaVehiculo'] ?></td>
            <td><?=$reserva['estado'] ?></td>
            <td>
                <a href="sistema.php?r=editar_reserva&id_reserva=<?=$reserva['id_reserva'] ?>" class="btn blue">
                    <i class="material-icons">edit</i>
                </a>
                <a href="sistema.php?r=borrar_reserva&id_reserva=<?=$reserva['id_reserva'] ?>" class="btn red">
                    <i class="material-icons">delete</i>
                </a>
            </td>
        </tr>
        <?php }?>
        <tr>
            <td colspan="6">
                <ul class="pagination center-align blue">
                    <li class="waves-effect"><a href="sistema.php?r=reservas&pagina=1"><i class="material-icons">fast_rewind</i></a></li>
                    <li class="waves-effect"><a href="sistema.php?r=reservas&pagina=<?=$paginaAnterior?>"><i class="material-icons">chevron_left</i></a></li>
                    <?php
                        for ($i = ($pagina - 2); $i <= ($pagina + 2); $i++) {
                            if ($i < 1 || $i > $totalPaginas) {
                                continue;
                            }
                            $color = "waves-effect";
                            if ($i == $pagina) {
                                $color = "active";
                            }
                    ?>
                    <li class="<?=$color?>"><a href="sistema.php?r=reservas&pagina=<?=$i?>"><?=$i?></a></li>
                    <?php
                        }
                    ?>
                    <li class="waves-effect"><a href="sistema.php?r=reservas&pagina=<?=$paginaSiguiente?>"><i class="material-icons">chevron_right</i></a></li>
                    <li class="waves-effect"><a href="sistema.php?r=reservas&pagina=<?=$totalPaginas?>"><i class="material-icons">fast_forward</i></a></li>
                </ul>
            </td>
        </tr>
    </tbody>
</table>