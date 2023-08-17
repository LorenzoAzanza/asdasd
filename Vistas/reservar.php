
    <?php
    require_once("Modelos/BDVehiculos.php");
    require_once("Modelos/BDClientes.php");
    require_once("Modelos/BDReserva.php");


    $objVehiculo = new vehiculos();

    $idVehiculo = $_GET['id_vehiculo'] ?? null;

    // Obtener la información del vehículo
    $vehiculo = $objVehiculo->obtenerInformacionDelVehiculo($idVehiculo);

    $vehiculoConReservas = $objVehiculo->verificarReservasActivas($idVehiculo);


    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        // Obtener las fechas de inicio y fin de la reserva
        $fechaInicio = new DateTime($_POST['fechaInicio']);
        $fechaFin = new DateTime($_POST['fechaFin']);
        
        $objReserva = new reserva();
        $vehiculoDisponible = !$objReserva->verificarReservasEnFechas($idVehiculo, $fechaInicio, $fechaFin);

        if ($vehiculoDisponible) {
        // Calcular la diferencia en días
        $diferencia = $fechaInicio->diff($fechaFin);
        $cantidadDias = $diferencia->days;

        // Obtener la información del vehículo
        $vehiculo = $objVehiculo->obtenerInformacionDelVehiculo($idVehiculo);

        // Calcular el precio total
        $precioPorDia = $vehiculo['precio'];
        $precioTotal = $precioPorDia * $cantidadDias;

        // Estado "A" para una reserva activa
        $estadoReserva = "A";

        $id_cliente= isset($_SESSION['id_cliente'])?$_SESSION['id_cliente']:"";
        
        // Crear una instancia del modelo de cliente
        $objCliente = new cliente();
        $objCliente->cargar($id_cliente);

        $reservaExitosa = $objCliente->crearReserva($idVehiculo, $id_cliente, $fechaInicio, $fechaFin, $precioTotal);

        if ($reservaExitosa) {
            $sqlActualizarEstado = "UPDATE vehiculo SET estado = 'D' WHERE id_vehiculo = :id_vehiculo";
            $arrayDatosActualizar = array("id_vehiculo" => $idVehiculo);
            $objVehiculo->ejecutar($sqlActualizarEstado, $arrayDatosActualizar);
            $mensaje = "Reserva exitosa. Precio total: $" . $precioTotal;
        } else {
            $mensaje = "Error al realizar la reserva.";
        }
    }else{
        $mensaje = "Este vehículo no está disponible en las fechas seleccionadas.";
        $vehiculosSimilares = $objVehiculo->obtenerVehiculosSimilares($vehiculo['precio']);
        if (!empty($vehiculosSimilares)) {
            echo '<div class="recomendacion">Este vehículo no está disponible en las fechas seleccionadas. Te recomendamos considerar los siguientes vehículos por precios similares:';
            echo '<br>';
            foreach ($vehiculosSimilares as $vehiculoSimilar) {
                echo '<a href="sistema.php?r=reservar&id_vehiculo=' . $vehiculoSimilar['id_vehiculo'] . '">' . $vehiculoSimilar['marca'] . ' ' . $vehiculoSimilar['modelo'] .' '."Por dia:"."$" ."U". $vehiculoSimilar['precio'] . '</a>';
                echo '<br>';

            }
            echo '</div>';
        } else {
            echo '<p>No hay vehículos similares disponibles en este momento.</p>';
        }
    }
    }
    ?>





<!DOCTYPE html>
<html lang="en">
<head>
<title>Reservar</title>
    <style>
        .mensaje {
            background-color: #4CAF50;
            color: white;
            padding: 20px;
            text-align: center;
            font-size: 24px;
            margin-top: 20px;
        }
        label{
        color: black;
        
        }
        .recomendacion {
            background-color: #FFFF00; 
            color: black;
            padding: 20px;
            text-align: center;
            font-size: 18px;
            margin-top: 20px;
        }
    </style>
</head>
<body style="background-image: url('web/img/pexels-bayram-musayev-17690357.webp'); background-size:1200px;">
    <title>Reservar</title>
        <div class="container red lighten-2">
            <h1 class="center-align black-text text-darken-3">Realizar reserva para <?php echo $vehiculo['marca'] . ' ' . $vehiculo['modelo']; ?></h1>
                <form action="sistema.php?r=reservar&id_vehiculo=<?php echo $idVehiculo; ?>" method="POST">
                    <label for="fechaInicio">Fecha de Inicio:</label>
                    <input type="date" name="fechaInicio" required>
                    <label for="fechaFin">Fecha de Fin:</label>
                        <input type="date" name="fechaFin" required>

                    <div class="input-field center-align">
                        <button type="submit" class="btn blue darken-2">Reservar</button>
                    </div>
        </div>
                </form>

    <?php
    if (isset($mensaje)) {
        echo '<div class="mensaje">' . $mensaje . '</div>';
    }
    ?>

</body>
</html>
