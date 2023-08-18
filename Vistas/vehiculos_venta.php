<?php
require_once("Modelos/BDVehiculos.php");

// Crear una instancia del modelo de vehículos
$objVehiculo = new vehiculos();

// Obtenemos lista de vehiculo
$listaVehiculos = $objVehiculo->listar(array(
    'inicio' => 0,
    'cantidad' => 10 // Cantidad de vehículos a mostrar
));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" media="screen,projection">
    <style>
        body {
            background-color: #f0f0f0;
        }
        .card-panel {
            margin: 10px;
        }
        input::placeholder {
        color: black;
        
    }
    
    
    </style>
    <title>Vehículos disponibles</title>
</head>
<body style="background-image: url('web/img/pexels-fondo.webp'); background-size:complete;">

<div class="container indigo lighten-4">
    <h1 class="center-align black-text text-darken-3">Vehículos disponibles</h1>
    
    <!-- Filtros -->
    <form id="filterForm"  action="sistema.php?r=reservar&id_vehiculo=<?php echo $vehiculo['id_vehiculo']; ?>" method="POST">

    <select name="color">
        <option value="">Seleccionar color</option>
        <?php foreach ($listaVehiculos as $vehiculo) { ?>
            <option value="<?php echo $vehiculo['color']; ?>"><?php echo $vehiculo['color']; ?></option>
        <?php } ?>
    </select>
    
    <select name="tipo">
        <option value="">Seleccionar tipo</option>
        <?php foreach ($listaVehiculos as $vehiculo) { ?>
            <option value="<?php echo $vehiculo['tipo']; ?>"><?php echo $vehiculo['tipo']; ?></option>
        <?php } ?>
    </select>
    
    <input type="number" name="pasajeros" placeholder="Cantidad de pasajeros">
    
    <input type="number" name="precio" placeholder="Precio máximo">
     
    <button type="submit" class="blue">Buscar</button>
</form>
    
       <!-- Contenedor de los vehículos -->
<div class="row" id="vehiculosContainer">
    <?php foreach ($listaVehiculos as $vehiculo) { ?>
          <!-- Cada vehículo se representa como un div con la clase vehiculo-card -->
        <div class="col s12 m4 vehiculo-card" data-color="<?php echo $vehiculo['color']; ?>" data-tipo="<?php echo $vehiculo['tipo']; ?>" data-pasajeros="<?php echo $vehiculo['cantidad_pasajeros']; ?>" data-precio="<?php echo $vehiculo['precio']; ?>">
            <div class="card-panel red lighten-2">
                    <img src="web/archivos/<?=$vehiculo['img']?>" width="150px" alt="Vehículo <?php echo $vehiculo['id_vehiculo']; ?>">
                    <h5 class="white-text text-darken-3"><?php echo $vehiculo['tipo']; ?> <?php echo $vehiculo['color']; ?></h5>
                    <p><?php echo $vehiculo['modelo']; ?> - <?php echo $vehiculo['marca']; ?></p>
                    <p>Pasajeros: <?php echo $vehiculo['cantidad_pasajeros']; ?></p>
                    <p>Precio $U por dia: $<?php echo $vehiculo['precio']; ?></p>
                    <a class="btn blue" href="sistema.php?r=reservar&id_vehiculo=<?php echo $vehiculo['id_vehiculo']; ?>">Reservar</a>
                    
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script>
    // Agregamos un evento 'submit' al formulario con id 'filterForm'
    document.getElementById('filterForm').addEventListener('submit', function(event) {
        // Prevenir el comportamiento predeterminado del formulario (evitar recargar la página)
        event.preventDefault();
         // Obtener el valor seleccionado en el elemento <select> con nombre 'color'
        var color = document.querySelector('select[name="color"]').value;
        var tipo = document.querySelector('select[name="tipo"]').value;
         // Obtener el valor ingresado en el elemento <input> con nombre 'pasajeros'
        // Convertirlo a un número entero usando parseInt
        var pasajeros = parseInt(document.querySelector('input[name="pasajeros"]').value);
          // Obtener el valor ingresado en el elemento <input> con nombre 'precio'
    // Convertirlo a un número de punto flotante usando parseFloat
        var precio = parseFloat(document.querySelector('input[name="precio"]').value);

                // Llamar a la función de filtrado con los criterios seleccionados

        filterVehiculos(color, tipo, pasajeros, precio);
    });
// Definición de la función de filtrado de vehículos

    function filterVehiculos(color, tipo, pasajeros, precio) {
            // Seleccionar todos los elementos con la clase 'vehiculo-card'

        var vehiculos = document.querySelectorAll('.vehiculo-card');
           
        // foreach sobre cada vehículo en la lista

        vehiculos.forEach(function(vehiculo) {
        // Obtener los valores de atributos personalizados de cada vehículo

            var vehiculoColor = vehiculo.getAttribute('data-color');
            var vehiculoTipo = vehiculo.getAttribute('data-tipo');
            var vehiculoPasajeros = parseInt(vehiculo.getAttribute('data-pasajeros'));
            var vehiculoPrecio = parseFloat(vehiculo.getAttribute('data-precio'));
// Comprobar si el vehículo cumple con los criterios de búsqueda
            if ((color === '' || vehiculoColor === color) &&
                (tipo === '' || vehiculoTipo === tipo) &&
                (isNaN(pasajeros) || vehiculoPasajeros >= pasajeros) &&
                (isNaN(precio) || vehiculoPrecio <= precio)) {
                vehiculo.style.display = 'block'; //mostrar el vehiculo si cumple con los criterios
            } else {
                vehiculo.style.display = 'none'; //ocultar el vehiculo si no los cumple
            }
        });
    }
</script>