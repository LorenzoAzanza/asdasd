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
            margin: 0;
        }

        main {
            flex: 1 0 auto;
            padding: 20px;
        }


        .reservas-title {
            text-align: center;
            color: #333;
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .table-container {
            border: 2px solid #e57373;
            padding: 20px;
            border-radius: 10px;
            background-color: #e57373;
            overflow: auto;
        }

        .pagination .active a {
            background-color: blue;
        }

    </style>
</head>

<body>
    <main>
        <div class="container">
            <h1 class="reservas-title">Lista de Reservas, páginas <?=$pagina?>/<?=$totalPaginas?>, total registros activos: <?=$totalRegistros?></h1>
            <div class="nuevo-botton">
                <a href="sistema.php?r=ingresar_reservas" class="btn blue ">
                    <i class="material-icons">add</i> Nuevo
                </a>
            </div>
            <div class="table-container">
                <table class="striped">
                    <thead>
                        <tr>
                            <th>ID Reserva</th>
                            <th>Fecha Inicio y Fin</th>
                            <th>Cliente</th>
                            <th>Vehículo</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($listaReservas as $reserva) { ?>
                        <tr>
                            <td><?=$reserva['id_reserva'] ?></td>
                            <td>
                                <?=date('d/m/Y', strtotime($reserva['fechaInicio']))?> - 
                                <?=date('d/m/Y', strtotime($reserva['fechaFin']))?>
                            </td>
                            <td><?=$reserva['nombreCliente'] ?></td>
                            <td><?=$reserva['marcaVehiculo'] ?></td>
                            <td><?=$reserva['estado'] ?></td>
                            <td>
                                <a href="sistema.php?r=editar_reserva&id_reserva=<?=$reserva['id_reserva'] ?>" class="btn blue">
                                    <i class="material-icons">edit</i> Editar
                                </a>
                                <a href="sistema.php?r=borrar_reserva&id_reserva=<?=$reserva['id_reserva'] ?>" class="btn red">
                                    <i class="material-icons">delete</i> Borrar
                                </a>
                            </td>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
                <ul class="pagination center-align">
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
            </div>
        </div>
    </main>
</body>
</html>
