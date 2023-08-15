<?php
require_once("Modelos/generico.php");
require_once("Configuracion/db.php");
class cliente extends generico{

    //identificador de registro autonumerico
    public $id_cliente;

    public $nombre;
    
    public $apellido;

    public $direccion;

    public $telefono;

    public $mail;

    public $tipo_documento;

    public $numero_documento;

    public $estado;

    public $contrasena;

    public $rol;

    public $activo;

    

    public function constructor($arrayDatos=array()){
        $this->nombre=$arrayDatos['nombre'];
        $this->apellido=$arrayDatos['apellido'];
        $this->direccion=$arrayDatos['direccion'];
        $this->telefono=$arrayDatos['telefono'];
        $this->mail=$arrayDatos['mail'];
        $this->tipo_documento=$arrayDatos['tipo_documento'];
        $this->numero_documento=$arrayDatos['numero_documento'];
        $this->estado=$arrayDatos['estado'];
        $this->contrasena = $arrayDatos['contrasena'];
        $this->rol=$arrayDatos['rol'];
      
        
   
      
        
    

    }
    public function cargar($id_cliente){
      
    
        $sql = "SELECT * FROM clientes WHERE id_cliente = :id_cliente";
        $arraySql = array("id_cliente" => $id_cliente);
    

        $lista = $this->traerRegistros($sql, $arraySql);
    
        if (isset($lista[0]['id_cliente'])){
            $this->nombre = $lista[0]['nombre'];
            $this->apellido = $lista[0]['apellido'];
            $this->direccion = $lista[0]['direccion'];
            $this->telefono = $lista[0]['telefono'];
            $this->mail = $lista[0]['mail'];
            $this->tipo_documento = $lista[0]['tipo_documento'];
            $this->numero_documento = $lista[0]['numero_documento'];
            $this->estado = $lista[0]['estado'];
            $this->id_cliente = $lista[0]['id_cliente'];
            $this->rol=$lista[0]['rol'];
            $this->contrasena=$lista[0]['contrasena'];
            $this->activo=$lista[0]['activo'];

            $retorno = true;
        } else {
            $retorno = false;
        }
    
        return $retorno;
    }
    public function totalRegistros(){
 
        $sql = "SELECT  count(*) as total FROM clientes WHERE activo='1'" ;
    
    
        $lista = $this->traerRegistros($sql);
    
        if (isset($lista[0]['total'])){
            $retorno= $lista[0]['total'];
    
           
            
        } else {
            $retorno=0;
        }
    
        return $retorno;
    
    }

    public function ingresar(){
        // Se establece el rol por defecto como "cliente"
        $defaultRol = "cliente";
    
        // Consulta SQL para insertar el registro en la base de datos
        $sql="INSERT clientes SET
            nombre = :nombre,
            apellido = :apellido,
            direccion = :direccion,
            telefono = :telefono,
            mail = :mail,
            tipo_documento = :tipo_documento,
            numero_documento = :numero_documento,
            estado = :estado,
            contrasena = :contrasena,
            rol = :rol"; 
    
        $arrayDatos = array(
            "nombre" => $this->nombre,
            "apellido" => $this->apellido,
            "direccion" => $this->direccion,
            "telefono" => $this->telefono,
            "mail" => $this->mail,
            "tipo_documento" => $this->tipo_documento,
            "numero_documento" => $this->numero_documento,
            "estado" => $this->estado,
            "contrasena" => md5($this->contrasena),
            "rol" => $defaultRol // Se asigna el rol por defecto
        );
    
        $respuesta = $this->ejecutar($sql, $arrayDatos);
    
        return $respuesta;
    }
     public function agregarNuevoUsuarioEnTipoUsuario($rol) {
        // Verificar si el cliente ya tiene una entrada en la tabla tipo_usuarios
        $sql = "SELECT * FROM tipo_usuario WHERE id_cliente = :id_cliente";
        $arrayDatos = array("id_cliente" => $this->id_cliente);
    
        $resultado = $this->traerRegistros($sql, $arrayDatos);
    
        if ($resultado && count($resultado) > 0) {
            // El cliente ya tiene una entrada en la tabla tipo_usuarios, actualizar los datos
            $sql = "UPDATE tipo_usuario SET 
                    rol = :rol, 
                    estado = :estado, 
                    mail = :mail, 
                    nombre = :nombre, 
                    apellido = :apellido, 
                    direccion = :direccion, 
                    telefono = :telefono, 
                    tipo_documento = :tipo_documento, 
                    numero_documento = :numero_documento,
                    contrasena = :contrasena,
                    activo = '1'
                    WHERE id_cliente = :id_cliente";

                      $sql_contraseña = "SELECT contrasena FROM clientes WHERE id_cliente = :id_cliente";
                      $resultado_contraseña = $this->traerRegistros($sql_contraseña, $arrayDatos);
                      $contrasena = isset($resultado_contraseña[0]['contrasena']) ? $resultado_contraseña[0]['contrasena'] : null;
        } else {
            // El cliente no tiene una entrada en la tabla tipo_usuarios, insertar un nuevo registro
            // Obtener la contraseña del cliente desde la tabla 'clientes'
            $contrasena = "contrasena_predeterminada";

    
            $sql = "INSERT INTO tipo_usuario (id_cliente, rol, estado, mail, nombre, apellido, direccion, telefono, tipo_documento, numero_documento, contrasena) 
                    VALUES (:id_cliente, :rol, :estado, :mail, :nombre, :apellido, :direccion, :telefono, :tipo_documento, :numero_documento, :contrasena)";
        }
    
        // Ejecutar la consulta con los nuevos datos
        $arrayDatos = array(
            "id_cliente" => $this->id_cliente,
            "rol" => $rol,
            "estado" => $this->estado,
            "mail" => $this->mail,
            "nombre" => $this->nombre,
            "apellido" => $this->apellido,
            "direccion" => $this->direccion,
            "telefono" => $this->telefono,
            "tipo_documento" => $this->tipo_documento,
            "numero_documento" => $this->numero_documento,
            "contrasena" => $contrasena
        );
    
        $respuesta = $this->ejecutar($sql, $arrayDatos);
    
        // Si la inserción o actualización en tipo_usuario fue exitosa, proceder a desactivar al cliente en la tabla clientes
        if ($respuesta) {
            $sql_desactivar_cliente = "UPDATE clientes SET activo = 0 WHERE id_cliente = :id_cliente";
            $arrayDatos_desactivar_cliente = array("id_cliente" => $this->id_cliente);
            $this->ejecutar($sql_desactivar_cliente, $arrayDatos_desactivar_cliente);
        }
    
        return $respuesta;
    }
   
    

    public function editar() {
        //para editar los registros///
    
        $sql = "UPDATE clientes SET
            nombre = :nombre,
            apellido = :apellido,
            direccion = :direccion,
            telefono = :telefono,
            mail = :mail,
            tipo_documento = :tipo_documento,
            numero_documento = :numero_documento,
            estado = :estado,
            rol = :rol";
    
        $arrayDatos = array(
            "nombre" => $this->nombre,
            "apellido" => $this->apellido,
            "direccion" => $this->direccion,
            "telefono" => $this->telefono,
            "mail" => $this->mail,
            "tipo_documento" => $this->tipo_documento,
            "numero_documento" => $this->numero_documento,
            "estado" => $this->estado,
            "rol" => $this->rol,
            "id_cliente" => $this->id_cliente
        );
    
        // Verificar si se proporciona una nueva contraseña
        if (!empty($this->contrasena)) {
            $sql .= ", contrasena = :contrasena";
            $arrayDatos["contrasena"] = md5($this->contrasena);
        }
    
        $sql .= " WHERE id_cliente = :id_cliente";
    
        $respuesta = $this->ejecutar($sql, $arrayDatos);
    
        if ($respuesta == true) {
            $mensaje = "Se editó correctamente";
    
            // Verificar si el nuevo rol es 'vendedor'
            if ($this->rol == 'vendedor' || $this->rol=='administrador' || $this->rol=='encargado') {
                // Agregar al cliente en la tabla tipo_usuario
                $respuesta_tipo_usuario = $this->agregarNuevoUsuarioEnTipoUsuario($this->rol);
    
                if ($respuesta_tipo_usuario) {
                    $mensaje .= " El cliente se ha agregado a la tabla clientes con el nuevo rol.";
                } else {
                    $mensaje .= " Error al agregar el cliente a la tabla clientes.";
                }
            }
        } else {
            $mensaje = "No se pudo editar";
        }
    
        return $respuesta;
    }

    public function borrar(){
        // Primero, verifica si el vehículo existe antes de eliminarlo
        $existe = $this->cargar($this->id_cliente);
        if ($existe) {
            // Verificar si hay reservas activas para este vehículo antes de borrarlo
            // (puedes implementar este código, como el comentario que tienes en el código)
    
            // Si no hay reservas activas, procede a eliminar el vehículo
            $sql = "DELETE FROM clientes WHERE id_cliente = :id_cliente";
            $arrayDatos = array("id_cliente" => $this->id_cliente);
    
            $respuesta = $this->ejecutar($sql, $arrayDatos);
    
            return $respuesta;
        } else {
            // El vehículo no existe, no es posible eliminarlo
            return false;
        }
    }


    public function listar($filtros = array()) {
$sql = "SELECT * FROM clientes WHERE activo = 1 AND estado <> 'B' ORDER BY id_cliente LIMIT " . $filtros['inicio'] . ", " . $filtros['cantidad'] . "";

        $lista = $this->traerRegistros($sql);
        
        return $lista;
        
            }
    
            public function login($mail, $contrasena){
                $sql = "SELECT * FROM clientes WHERE mail = :mail AND contrasena = :contrasena AND estado = 'A'";
                $arraySql = array("mail" => $mail, "contrasena" => md5($contrasena));
            
                $registro = $this->traerRegistros($sql, $arraySql);
            
                if (isset($registro[0]['id_cliente'])){
                    $this->id_cliente = $registro[0]['id_cliente'];
                    $this->mail = $registro[0]['mail'];
                    $this->rol = $registro[0]['rol'];
            
                    // Almacenar el rol en la sesión.
                    $_SESSION['usuario']['rol'] = $this->rol;
            
                    return true;
                } else {
                    return false;
                }
            }

    public function obtenerRol() {
        return $this->rol;
    }
    public function cambiarContrasena($contrasena,$nuevaContrasena,$confirmarContrasena){

        //$largoContrasena=strlen($nuevaContrasena);

        $resultado = preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/', $nuevaContrasena);

        if($resultado==0){

            $retorno="La clave no cumple con las condiciones de seguridad. <br>
                    Tiene que tener un minimo de 8 caracteres, los cuales incluyan
                    mayusculas, minusculas, numeros y alguno de estos caracteres
                    @$!%*#?&";

            return $retorno;

        }

        if(!($nuevaContrasena===$confirmarContrasena)){

            $retorno="Las Contraseñas no coinciden";
            return $retorno;
        }
        $sql = "SELECT * FROM clientes WHERE  id_cliente=".$this->id_cliente." AND contrasena = :contrasena";
        $arraySql = array("contrasena" => md5($contrasena));

        $registro = $this->traerRegistros($sql, $arraySql);

        if (!isset($registro[0]['id_cliente'])){
            $retorno="La Contraseña no es correcta";
            return $retorno;
        
        }
        $sql = "UPDATE clientes SET
            contrasena = :contrasena
            WHERE id_cliente = :id_cliente";
        $arrayDatos = array(
            "contrasena" => md5($nuevaContrasena),
            "id_cliente" => $this->id_cliente
        );
    
        $respuesta = $this->ejecutar($sql, $arrayDatos);
        return $respuesta;

    }

    public function obtenerDatosUsuario($correoElectronico) {
        // Crear una instancia de la clase cliente
        $objCliente = new cliente();

        // Usar el método login para cargar los datos del usuario
        $loginExitoso = $objCliente->login($correoElectronico, $contrasena); // Debes tener la contraseña del usuario

        if ($loginExitoso) {
            // Obtener los datos del usuario cargados en la instancia
            $datosUsuario = array(
                'id_cliente' => $objCliente->id_cliente,
                'nombre' => $objCliente->nombre,
                'apellido' => $objCliente->apellido,
                'direccion' => $objCliente->direccion,
                'telefono' => $objCliente->telefono,
                'mail' => $objCliente->mail,
                'tipo_documento' => $objCliente->tipo_documento,
                'numero_documento' => $objCliente->numero_documento,
                // Y otros campos que necesites
            );

            return $datosUsuario;
        } else {
            return false; // El inicio de sesión no fue exitoso
        }
    }
    
    public function crearReserva($id_vehiculo, $id_cliente, $fechaInicio, $fechaFin) {
        $sql = "INSERT INTO reserva (id_vehiculo, id_cliente, fechaInicio, fechaFin,estado) 
                VALUES (:id_vehiculo, :id_cliente, :fechaInicio, :fechaFin,:estado)";
        
        $arrayDatos = array(
            "id_vehiculo" => $id_vehiculo,
            "id_cliente" => $id_cliente,
            "fechaInicio" => $fechaInicio->format('Y-m-d'), // Asegura el formato correcto de la fecha
            "fechaFin" => $fechaFin->format('Y-m-d'),       // Asegura el formato correcto de la fecha
            "estado" => "A"
        );
    
        $respuesta = $this->ejecutar($sql, $arrayDatos);
        return $respuesta;
    }
    

}














?>