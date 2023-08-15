<?php


require_once("Modelos/BDClientes.php");
require_once("Modelos/BDReserva.php");



    $nuevaContrasena = trim("TTDSADS432432^");
    $resultado = preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/', $nuevaContrasena);




    $mensaje="";
    $respuesta="";

    $boton= isset($_POST['boton'])?$_POST['boton']:"";
    $id_cliente= isset($_SESSION['id_cliente'])?$_SESSION['id_cliente']:"";

    $objCliente= new cliente();
    $objCliente->cargar($id_cliente);
   
    
    if ($boton == "guardar" && $id_cliente != "") {
      $objCliente->mail = isset($_POST['txtMail']) && $_POST['txtMail'] != "" ? $_POST['txtMail'] : $objCliente->mail;
      $objCliente->nombre = isset($_POST['txtNombre']) && $_POST['txtNombre'] != "" ? $_POST['txtNombre'] : $objCliente->nombre;
      $objCliente->apellido = isset($_POST['txtApellido']) && $_POST['txtApellido'] != "" ? $_POST['txtApellido'] : $objCliente->apellido;
      $objCliente->direccion = isset($_POST['txtDireccion']) && $_POST['txtDireccion'] != "" ? $_POST['txtDireccion'] : $objCliente->direccion;
      $objCliente->telefono = isset($_POST['txtTelefono']) && $_POST['txtTelefono'] != "" ? $_POST['txtTelefono'] : $objCliente->telefono;
      $objCliente->tipo_documento = isset($_POST['txtTipo_documento']) && $_POST['txtTipo_documento'] != "" ? $_POST['txtTipo_documento'] : $objCliente->tipo_documento;
      $objCliente->numero_documento = isset($_POST['txtNumero_documento']) && $_POST['txtNumero_documento'] != "" ? $_POST['txtNumero_documento'] : $objCliente->numero_documento;
  
  
          $respuesta= $objCliente->editar();

      if($respuesta==true){
            $mensaje="Se edito correctamente";
      }else{
            $mensaje="No se pudo editar";
          }
    }

    $contrasena= isset($_POST['txtContrasena'])?$_POST['txtContrasena']:"";
    $nuevaContrasena= isset($_POST['txtNuevaContrasena'])?$_POST['txtNuevaContrasena']:"";
    $confirmarContrasena= isset($_POST['txtConfirmarContrasena'])?$_POST['txtConfirmarContrasena']:"";

  

    if($boton == "contrasena" && $id_cliente!="" && $contrasena !="" && $nuevaContrasena !=""  && $confirmarContrasena !=""){

        $respuesta= $objCliente->cambiarContrasena($contrasena,$nuevaContrasena,$confirmarContrasena);

      if($respuesta===true){
            $mensaje="Se edito correctamente";
      }else{
            $mensaje=$respuesta;
            $respuesta=false;
          }
    }

      if(isset($_POST['boton']) && $_POST['boton'] == "cancelar"){
        header("Location: sistema.php");
       }
  
       $objReserva = new reserva();
       $reservasActivas = $objReserva->getReservasActivasCliente($objCliente->id_cliente);



 ?>
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

        .container {
            margin-top: 0;
        }

        .form-title {
            text-align: center;
            color: #333;
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .form-container {
            border: 2px solid #e57373;
            padding: 20px;
            border-radius: 10px;
            background-color: #e57373;
            overflow: auto;
        }

        .input-field label {
            color: #333;
        }

        .btn-container {
            text-align: center;
            margin-top: 20px;
        }

        .btn-container .btn {
            margin: 0 10px;
        }
    </style>
</head>















 
<body>
    <main>
    <div class="container">
    <!-- Sección: Reservas Activas -->
    <div class="row">
        <?php if (!empty($reservasActivas)): ?>
            <h1 class="form-title">Reservas Activas</h1>
            <ul class="red lighten-2">
                <?php foreach ($reservasActivas as $reserva): ?>
                    <li class="">
                        <div class="card-panel red lighten-2 black-text">
                            <p>Reserva ID: <?= $reserva['id_reserva'] ?></p>
                        </div>
                        <div class="card-panel red lighten-2 black-text">
                            <p>Fecha de Inicio: <?= $reserva['fechaInicio'] ?></p>
                        </div>
                        <div class="card-panel red lighten-2 black-text">
                            <p>Fecha de Fin: <?= $reserva['fechaFin'] ?></p>
                        </div>
                        <div class="card-panel red lighten-2 black-text">
                            <p>Vehículo: <?= $reserva['marcaVehiculo'] ?></p>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No tienes reservas activas.</p>
        <?php endif; ?>
    </div>
</div>





        <div class="container">
            <h1 class="form-title">Editar Perfil</h1>
            <div class="form-container">
                <form method="POST" action="sistema.php?r=perfil">
                    <?php if ($respuesta == true && $boton == "guardar"): ?>
                        <div class="card-panel blue center-align">
                            <?=$mensaje?>
                            <a href="sistema.php" class="btn green">Regresar</a>
                        </div>
                    <?php elseif (($respuesta == false && $mensaje != "") && $boton == "guardar"): ?>
                        <div class="card-panel red center-align">
                            <?=$mensaje?>
                        </div>
                    <?php endif; ?>
          
        
                    <div class="row">
                        <div class="input-field col s6">
                            <input id="mail" type="email" class="validate" name="txtMail" value="<?= $objCliente->mail ?>">
                            <label for="mail">Email</label>
                        </div>
                        <div class="input-field col s6">
                            <input id="nombre" type="text" class="validate" name="txtNombre" value="<?=$objCliente->nombre?>">
                            <label for="nombre">Nombre</label>
                        </div>
                        <div class="input-field col s6">
                            <input id="apellido" type="text" class="validate" name="txtApellido" value="<?=$objCliente->apellido?>">
                            <label for="apellido">Apellido</label>
                        </div>
                        <div class="input-field col s6">
                            <input id="direccion" type="text" class="validate" name="txtDireccion" value="<?=$objCliente->direccion?>">
                            <label for="direccion">Apellido</label>
                        </div>
                        <div class="input-field col s6">
                            <input id="telefono" type="number" class="validate" name="txtTelefono" value="<?=$objCliente->telefono?>">
                            <label for="telefono">Apellido</label>
                        </div>
                        

  

                        <div class="input-field col s6">
                           <select id="txtTipo_documento" name="txtTipo_documento">
                                <option value="" disabled selected><?=$objCliente->tipo_documento?></option>
                                <option value="CI">CI</option>
                                <option value="Pasaporte">Pasaporte</option>
                           </select>
                              <label for="txtTipo_documento">Tipo de Documento</label>
                        </div>
                        <div class="input-field col s6">
                              <input id="numero_documento" type="number" class="validate" name="txtNumero_documento" value="<?=$objCliente->numero_documento?>">
                              <label for="numero_documento">Numero de documento</label>
                              
                        </div>
                        
                        
                        <div class="col s12 btn-container">
                              <input type="hidden" name="id_cliente" value="<?=$objCliente->id_cliente?>" >
                                  <button class="btn waves-effect waves-light blue" type="submit" name="boton" value="guardar">Guardar
                                    <i class="material-icons right">save</i>
                                  </button>
                                  <button class="btn waves-effect waves-light red" type="submit" name="boton" value="cancelar">Cancelar
                                    <i class="material-icons right">cancel</i>
                                  </button>
                        </div>

        
       

            </div>
  </form>

<form method="POST" action="sistema.php?r=perfil">
    <div class="row">
<?php
      if($respuesta==true && $boton=="contrasena"){
?>
    <div class="card-panel blue center-align">
        <?=$mensaje?>
      <a href="sistema.php" class="btn green">Regresar</a>
    </div>

<?php
        }elseif(($respuesta==false && $mensaje!="") && $boton=="contrasena"){ 
?>
    <div class="card-panel red center-align">
        <?=$mensaje?>
            
    </div>
<?php
        }
?>
          
        
          <div class="container">
            <h1 class="form-title">Cambio de Contraseña</h1>
            <div class="form-container">
                <form method="POST" action="sistema.php?r=perfil">
                    <div class="row">
                        <!-- Campo de contraseña actual -->
                        <div class="input-field col s6">
                            <input id="contrasena" type="password" class="validate" name="txtContrasena" value="">
                            <label for="contrasena">Contraseña Actual</label>
                        </div>
                        <!-- Campo de nueva contraseña -->
                        <div class="input-field col s6">
                            <input id="nuevaContrasena" type="password" class="validate" name="txtNuevaContrasena" value="">
                            <label for="nuevaContrasena">Nueva Contraseña</label>
                        </div>
                        <!-- Campo de confirmación de nueva contraseña -->
                        <div class="input-field col s6">
                            <input id="confirmarContrasena" type="password" class="validate" name="txtConfirmarContrasena" value="">
                            <label for="confirmarContrasena">Confirmar Contraseña</label>
                        </div>
                        <!-- Botones de guardar y cancelar -->
                        <div class="col s12 btn-container">
                            <input type="hidden" name="id_cliente" value="<?=$objCliente->id_cliente?>" >
                            <button class="btn waves-effect waves-light blue" type="submit" name="boton" value="contrasena">Guardar
                                <i class="material-icons right">save</i>
                            </button>
                            <button class="btn waves-effect waves-light red" type="submit" name="boton" value="cancelar">Cancelar
                                <i class="material-icons right">cancel</i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
  </form>
    