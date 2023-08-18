<?php
$rolesPermitidos = array("administrador", "encargado", "vendedor"); 

if (!in_array($_SESSION['usuario']['rol'], $rolesPermitidos)) {
    
    header("Location: sistema.php");
    exit();
}
    require_once("Modelos/BDClientes.php");

    $mensaje = "";
    $respuesta = "";
    $boton = isset($_POST['boton']) ? $_POST['boton'] : "";
    $id_cliente = isset($_GET['id_cliente']) ? $_GET['id_cliente'] : "";

    $objClientes = new cliente();
    $objClientes->cargar($id_cliente);

    if (isset($_POST['boton']) && $_POST['boton'] == "guardar") {
        $id_cliente = $_POST['id_cliente'];
        $arrayDatos = array(
            "nombre" => $_POST['txtNombre'],
            "apellido" => $_POST['txtApellido'],
            "direccion" => $_POST['txtDireccion'],
            "telefono" => $_POST['txtTelefono'],
            "mail" => $_POST['txtMail'],
            "tipo_documento" => $_POST['txtTipo_documento'],
            "numero_documento" => $_POST['txtNumero_documento'],
            "estado" => $_POST['txtEstado'],
            "rol" => $_POST['txtRol'],
            
            "contrasena" => $_POST['passContrasena']
        );
        $objClientes->cargar($id_cliente);
        $objClientes->constructor($arrayDatos);
        $respuesta = $objClientes->editar();


        if ($respuesta == true) {
            $mensaje = "Se editó correctamente";
        } else {
            $mensaje = "No se pudo editar";
        }
    }

    if (isset($_POST['boton']) && $_POST['boton'] == "cancelar") {
        header("Location: sistema.php?r=clientes");
    }
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <title>Editar clientes</title>
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

      

        .editar-title {
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
        }

        .submit-buttons {
            text-align: center;
            margin-top: 20px;
        }

        .submit-buttons .btn {
            margin-right: 10px;
        }
    </style>
</head>

<body>
    <main>
        <div class="container">
            <h1 class="editar-title">Editar Cliente Nº: <?=$id_cliente?></h1>
            <div class="form-container">
                <form method="POST" action="sistema.php?r=editar_clientes">
                    <div class="row">
                        <?php if ($respuesta == true): ?>
                            <div class="card-panel blue center-align">
                                <?=$mensaje?>
                                <a href="sistema.php?r=clientes" class="btn green">Regresar</a>
                            </div>
                        <?php elseif ($respuesta == false && $mensaje != ""): ?>
                            <div class="card-panel red center-align">
                                <?=$mensaje?>
                            </div>
                        <?php endif; ?>

                        <div class="input-field col s6">
                            <input id="nombre" type="text" class="validate" name="txtNombre" value="<?=$objClientes->nombre?>">
                            <label for="nombre">Nombre</label>
                        </div>
                        <div class="input-field col s6">
                            <input id="apellido" type="text" class="validate" name="txtApellido" value="<?=$objClientes->apellido?>">
                            <label for="apellido">Apellido</label>
                        </div>
                        <div class="input-field col s6">
                            <input id="direccion" type="text" class="validate" name="txtDireccion" value="<?=$objClientes->direccion?>">
                            <label for="direccion">Direccion</label>
                        </div>
                        <div class="input-field col s6">
                            <input id="telefono" type="number" class="validate" name="txtTelefono" value="<?=$objClientes->telefono?>">
                            <label for="telefono">Telefono</label>
                        </div>
                        <div class="input-field col s6">
                            <input id="mail" type="email" class="validate" name="txtMail" value="<?=$objClientes->mail?>">
                            <label for="mail">Mail</label>
                        </div>
                        <div class="input-field col s6 offset-s3">
                            <i class="material-icons prefix">lock</i>
                            <input id="passContrasena" type="password" class="validate white-text" name="passContrasena">
                            <label for="passContrasena">Contraseña</label>
                        </div>
                        <div class="input-field col s6">
                            
                            <select id="txtTipo_documento" name="txtTipo_documento" required>
                                <option value="" disabled selected>Seleccione un tipo de documento</option>
                                <option value="CI" <?=$objClientes->tipo_documento == 'CI' ? 'selected' : ''?>>CI</option>
                                <option value="Pasaporte" <?=$objClientes->tipo_documento == 'Pasaporte' ? 'selected' : ''?>>Pasaporte</option>
                            </select>
                            <label for="txtTipo_documento">Tipo de Documento</label>
                        </div>
                        <div class="input-field col s6">
                            <input id="numero_documento" type="number" class="validate" name="txtNumero_documento" value="<?=$objClientes->numero_documento?>">
                            <label for="numero_documento">Numero de documento</label>
                        </div>
                        <div class="input-field col s6">
                        <div class="input-field col s6">
                            <select name="txtRol"> 
                                <option value="cliente" <?=$objClientes->rol == 'cliente' ? 'selected' : ''?>>Cliente</option>
                                <option value="vendedor" <?=$objClientes->rol == 'vendedor' ? 'selected' : ''?>>Vendedor</option>
                                <option value="encargado" <?=$objClientes->rol == 'encargado' ? 'selected' : ''?>>Encargado</option>

                            </select>
                            <label>Rol</label>
                        </div>
                        <div class="input-field col s6">
                            <select name="txtEstado">
                                <option value="A" <?=$objClientes->estado == 'A' ? 'selected' : ''?>>Activado</option>
                                <option value="D" <?=$objClientes->estado == 'D' ? 'selected' : ''?>>Desactivado</option>
                                <option value="B" <?=$objClientes->estado == 'B' ? 'selected' : ''?>>Borrado</option>

                            </select>
                            <label>Estado</label>
                        </div>
                        <div class="col s10">
                            <input type="hidden" name="id_cliente" value="<?=$objClientes->id_cliente?>" >
                            <div class="submit-buttons">
                                <button class="btn waves-effect waves-light blue" type="submit" name="boton" value="guardar">
                                    Guardar <i class="material-icons right blue">save</i>
                                </button>
                                <button class="btn waves-effect waves-light red" type="submit" name="boton" value="cancelar">
                                    Cancelar <i class="material-icons right red">cancel</i>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>

</html>
