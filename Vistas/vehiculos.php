<?php

require_once("Modelos/BDvehiculos.php");

$objVehiculos= new vehiculos();

$listaVehiculos=$objVehiculos->listar();





?>



<h1>Vehiculos</h1>


<table class="striped">
        <thead>
          <tr>
      <th colspan="9">
        <a href="sistema.php?r=ingresar_vehiculos" class="btn blue">
          <i class="material-icons">add</i> Nuevo
</a>
        
    </th>

</tr>
          <tr>
              <th>#</th>
              <th>Tipo</th>
              <th>Color</th>
              <th>Cantidad de pasajeros</th>
              <th>Marca</th>
              <th>Modelo</th>
              <th>Precio</th>
              <th>Estado</th>
              <th></th>

          </tr>
        </thead>

        <tbody>


<?php foreach($listaVehiculos as $vehiculo){ ?>
          <tr>
            <td><?=$vehiculo['id_vehiculo'] ?></td>
            <td><?=$vehiculo['tipo'] ?></td>
            <td><?=$vehiculo['color'] ?></td>
            <td><?=$vehiculo['cantidad_pasajeros'] ?></td>
            <td><?=$vehiculo['marca'] ?></td>
            <td><?=$vehiculo['modelo'] ?></td>
            <td><?=$vehiculo['precio'] ?></td>
            <td><?=$vehiculo['estado'] ?></td>
            <td>
              <a class="btn blue">
                <i class="material-icons">edit</i>
              </a>
              <a class="btn red">
                <i class="material-icons">delete</i>
              </a>
            </td>


          </tr>
<?php }?>
          
        </tbody>
      </table>
            