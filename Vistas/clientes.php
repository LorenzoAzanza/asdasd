
<?php
$rolesPermitidos = array("administrador", "encargado", "vendedor"); 

if (!in_array($_SESSION['usuario']['rol'], $rolesPermitidos)) {
    
    header("Location: sistema.php");
    exit();
}
require_once("Modelos/BDClientes.php");

$objClientes = new cliente();

$cantidad=isset($_GET['cantidad'])?$_GET['cantidad']:4;
$pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

$totalRegistros = $objClientes->totalRegistros();

$paginaAnterior = $pagina - 1;
if ($paginaAnterior < 1) {
    $paginaAnterior = 1;
}

$totalPaginas = ceil($totalRegistros / $cantidad);
$paginaSiguiente = $pagina + 1;
if ($paginaSiguiente > $totalPaginas) {
    $paginaSiguiente = $totalPaginas;
}

$arrayFiltro = array("activo" => 1); // Filtrar solo clientes activos

$arrayFiltro['inicio'] = ($pagina - 1) * $cantidad;
$arrayFiltro['cantidad'] = $cantidad;

$listaclientes = $objClientes->listar($arrayFiltro);






?>


<!DOCTYPE html>
<html lang="es">

<head>
    <title>Lista de clientes </title>
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

      

        .clientes-title {
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
            
            <h1 class="clientes-title">Lista de clientes, Páginas <?=$pagina?>/<?=$totalPaginas?>, Total Registros Activos: <?=$totalRegistros?></h1>
            <div class="table-container">
            <div class="nuevo-botton">
                <a href="sistema.php?r=ingresar_clientes" class="btn blue ">
                    <i class="material-icons">add</i> Nuevo
                </a>
            </div>
                <table class="striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Dirección</th>
                            <th>Teléfono</th>
                            <th>Mail</th>
                            <th>Tipo de documento</th>
                            <th>Número de documento</th>
                            <th>Rol</th>
                            <th>Estado</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($listaclientes as $cliente): ?>
                            <tr>
                                <td><?=$cliente['id_cliente']?></td>
                                <td><?=$cliente['nombre']?></td>
                                <td><?=$cliente['apellido']?></td>
                                <td><?=$cliente['direccion']?></td>
                                <td><?=$cliente['telefono']?></td>
                                <td><?=$cliente['mail']?></td>
                                <td><?=$cliente['tipo_documento']?></td>
                                <td><?=$cliente['numero_documento']?></td>
                                <td><?=$cliente['rol']?></td>
                                <td><?=$cliente['estado']?></td>
                                <td>
                                    <a href="sistema.php?r=editar_clientes&id_cliente=<?=$cliente['id_cliente']?>" class="btn blue">
                                        <i class="material-icons">edit</i>
                                    </a>
                                    <a href="sistema.php?r=borrar_clientes&id_cliente=<?=$cliente['id_cliente']?>" class="btn red">
                                        <i class="material-icons">delete</i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td colspan="12">
                                <div class="pagination-container">
                                    <ul class="pagination center-align">
                                        <li class="waves-effect"><a href="sistema.php?r=clientes&pagina=1"><i class="material-icons">fast_rewind</i></a></li>
                                        <li class="waves-effect"><a href="sistema.php?r=clientes&pagina=<?=$paginaAnterior?>"><i class="material-icons">chevron_left</i></a></li>
                                        <?php for($i = ($pagina-2); $i <= ($pagina+2); $i++): ?>
                                            <?php if($i >= 1 && $i <= $totalPaginas): ?>
                                                <li class="waves-effect <?=($i == $pagina) ? 'active' : ''?>">
                                                    <a href="sistema.php?r=clientes&pagina=<?=$i?>"><?=$i?></a>
                                                </li>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                        <li class="waves-effect"><a href="sistema.php?r=clientes&pagina=<?=$paginaSiguiente?>"><i class="material-icons">chevron_right</i></a></li>
                                        <li class="waves-effect"><a href="sistema.php?r=clientes&pagina=<?=$totalPaginas?>"><i class="material-icons">fast_forward</i></a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>

</html>
