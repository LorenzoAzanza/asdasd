<?php
    require_once("Modelos/BDClientes.php");


    $mensaje="";
    $respuesta="";
   
$boton = isset($_POST['boton']) ? $_POST['boton'] : "";

    $objClientes= new cliente();
        

   

   if($boton=="ingresar"){

         
      $arrayDatos=array();
        //si vale ingresar , ingresamos el registro 
       

        $arrayDatos['nombre']= isset($_POST['txtNombre'])?$_POST['txtNombre']:"";
        $arrayDatos['apellido']= isset($_POST['txtApellido'])?$_POST['txtApellido']:"";
        $arrayDatos['direccion']= isset($_POST['txtDireccion'])?$_POST['txtDireccion']:"";
        $arrayDatos['telefono']= isset($_POST['txtTelefono'])?$_POST['txtTelefono']:"";
        $arrayDatos['mail']= isset($_POST['txtMail'])?$_POST['txtMail']:"";
        $arrayDatos['tipo_documento']= isset($_POST['txtTipo_documento'])?$_POST['txtTipo_documento']:"";
        $arrayDatos['numero_documento']= isset($_POST['txtNumero_documento'])?$_POST['txtNumero_documento']:"";
        $arrayDatos['estado']= isset($_POST['txtEstado'])?$_POST['txtEstado']:"";
        $arrayDatos['contrasena']= isset($_POST['passContrasena'])?$_POST['passContrasena']:"";
        $arrayDatos['rol']= isset($_POST['txtRol'])?$_POST['txtRol']:"";
       

      


        if($arrayDatos['nombre']!="" && $arrayDatos['apellido']!="" && 
        $arrayDatos['direccion']!=""&&$arrayDatos['telefono']!=""&&
        $arrayDatos['mail']!=""&&$arrayDatos['tipo_documento']!=""&&$arrayDatos['numero_documento']!=""&&$arrayDatos['estado']!=""
        &&$arrayDatos['contrasena']!=""&&$arrayDatos['rol']!="" ){
            $objClientes->constructor($arrayDatos);
            $respuesta= $objClientes->ingresar();

            if($respuesta==true){
                $mensaje="Se ingreso correctamente";
            }else{
                $mensaje="Error al ingresar registro";
                $respuesta=false;
            }


        }else{
            $mensaje="Por favor llenar todos los campos";
        }

    }



?>


<!DOCTYPE html>
<html lang="es">

<head>
    <title>Ingresar vehiculos</title>
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

        .ingresar-title {
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

        .form-container label {
            color: #000;
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
            <h1 class="ingresar-title">Ingresar Clientes</h1>
            <div class="form-container">
                <form method="POST" action="sistema.php?r=ingresar_clientes" enctype="multipart/form-data">
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
                            <input id="nombre" type="text" class="validate" name="txtNombre" required>
                            <label for="nombre">Nombre</label>
                        </div>
                        <div class="input-field col s6">
                            <input id="apellido" type="text" class="validate" name="txtApellido" required>
                            <label for="apellido">Apellido</label>
                        </div>
                        <div class="input-field col s6">
                            <input id="direccion" type="text" class="validate" name="txtDireccion" required>
                            <label for="direccion">Direccion</label>
                        </div>
                        <div class="input-field col s6">
                            <input id="telefono" type="number" class="validate" name="txtTelefono" required>
                            <label for="telefono">Telefono</label>
                        </div>
                        <div class="input-field col s6">
                            <input id="mail" type="email" class="validate" name="txtMail" required>
                            <label for="mail">Mail</label>
                        </div>
                        <div class="input-field col s6">
                            
                            <select id="txtTipo_documento" name="txtTipo_documento" >
                                <option value="" disabled selected>Seleccione un tipo de documento</option>
                                <option value="CI" <?=$objClientes->tipo_documento == 'CI' ? 'selected' : ''?>>CI</option>
                                <option value="Pasaporte" <?=$objClientes->tipo_documento == 'Pasaporte' ? 'selected' : ''?>>Pasaporte</option>
                            </select>
                            <label for="txtTipo_documento" required>Tipo de Documento</label>
                        </div>
                        <div class="input-field col s6">
                            <input id="numero_documento" type="number" class="validate" name="txtNumero_documento" required>
                            <label for="numero_documento">Numero de documento</label>
                        </div>
                        <div class="input-field col s6">
                            <input id="contrasena" type="password" class="validate" name="passContrasena" required>
                            <label for="contrasena">Contrasena</label>
                        </div>
                        <div class="input-field col s6" > 
                            <select name="txtRol" required>
                                <option value="cliente" <?=$objClientes->rol == 'cliente' ? 'selected' : ''?>>Cliente</option>
                                

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
                    <div class="submit-buttons">
                        <button class="btn waves-effect waves-light blue" type="submit" name="boton" value="ingresar">
                                     Ingresar <i class="material-icons right blue">send</i>
                        </button>
                        <a href="sistema.php?r=clientes" class="btn red">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>

</html>
