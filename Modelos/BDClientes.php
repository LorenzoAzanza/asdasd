<?php
//Incluimos los archivos de configuracion
require_once("Modelos/generico.php");
require_once("Configuracion/db.php");

class cliente extends generico{

    //Propiedades que representan los campos de la tabla
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
    //Metodo para cargar los datos del cliente especifico
    public function cargar($id_cliente){
      
    
        $sql = "SELECT * FROM clientes WHERE id_cliente = :id_cliente";
        $arraySql = array("id_cliente" => $id_cliente);
    
        //llamamos el metodo traerRegistros heredado de generico
        $lista = $this->traerRegistros($sql, $arraySql);
    
        if (isset($lista[0]['id_cliente'])){
        // Si hay registros, se asignan los valores de la consulta a las propiedades de la clase cliente

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
        $RolPredeterminado = "cliente";
    
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
            "rol" => $RolPredeterminado // Se asigna el rol por defecto
        );
    
        $respuesta = $this->ejecutar($sql, $arrayDatos);
    
        return $respuesta;
    }


    //Esta funcion sirve por si queremos registrar un vendedor o encargado , le cambiamos el rol de cliente a vendedor por ejemplo
    //Se cambia el campo activo, y ya no se muestra en la tabla clientes pero si en la de tipo_usuarios
    public function agregarNuevoUsuarioEnTipoUsuario($rol) {
        $sql = "INSERT INTO tipo_usuario (rol, estado, mail, nombre, apellido, direccion, telefono, tipo_documento, numero_documento, contrasena) 
                SELECT :rol, :estado, :mail, :nombre, :apellido, :direccion, :telefono, :tipo_documento, :numero_documento, :contrasena
                FROM clientes
                WHERE id_cliente = :id_cliente";
    
        // Ejecutar la consulta con los nuevos datos
        $arrayDatos = array(
            "rol" => $rol,
            "estado" => $this->estado,
            "mail" => $this->mail,
            "nombre" => $this->nombre,
            "apellido" => $this->apellido,
            "direccion" => $this->direccion,
            "telefono" => $this->telefono,
            "tipo_documento" => $this->tipo_documento,
            "numero_documento" => $this->numero_documento,
            "contrasena" => md5($this->contrasena),
            "id_cliente" => $this->id_cliente
        );
    
        $respuesta = $this->ejecutar($sql, $arrayDatos);
    
        if ($respuesta) {
            // Eliminar el registro de la tabla clientes
            $sql_eliminar_cliente = "DELETE FROM clientes WHERE id_cliente = :id_cliente";
            $this->ejecutar($sql_eliminar_cliente, array("id_cliente" => $this->id_cliente));
    
            $mensaje = "El cliente se ha movido a la tabla tipo_usuario y se ha eliminado de la tabla clientes.";
        } else {
            $mensaje = "Error al agregar el cliente a la tabla tipo_usuario.";
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
        $sql_clientes="UPDATE tipo_usuario SET estado=:estado WHERE mail=:mail";
            $arrayDatos_clientes=array(
                "estado"=>$this->estado,
                "mail"=>$this->mail
            );
    
        // Verificar si se proporciona una nueva contraseña
        if (!empty($this->contrasena)) {
            $sql .= ", contrasena = :contrasena";
            $arrayDatos["contrasena"] = md5($this->contrasena);
        }
    
        $sql .= " WHERE id_cliente = :id_cliente";
    
        $respuesta = $this->ejecutar($sql, $arrayDatos);
        $respuesta=$this->ejecutar($sql_clientes,$arrayDatos_clientes);
    
        if ($respuesta == true) {
            $mensaje = "Se editó correctamente";
    
            // Verificar si el nuevo rol es distinto a cliente
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
        // Primero, verificar si el cliente existe
        $existe = $this->cargar($this->id_cliente);
        if ($existe) {
           
           
    
            // Si no hay reservas activas, procede a eliminar el cliente
            $sql = "DELETE FROM clientes WHERE id_cliente = :id_cliente";
            $arrayDatos = array("id_cliente" => $this->id_cliente);
    
            $respuesta = $this->ejecutar($sql, $arrayDatos);
    
            return $respuesta;
        } else {
            // no exisate
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

    


    public function cambiarContrasena($contrasena,$nuevaContrasena,$confirmarContrasena){

        //validamos que la contraseña cumpla con los requisitos
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
    

   
    // Metodo para crear reservas
    public function crearReserva($id_vehiculo, $id_cliente, $fechaInicio, $fechaFin) {
        // Construimos la consulta sql para insertar la reserva
        $sql = "INSERT INTO reserva (id_vehiculo, id_cliente, fechaInicio, fechaFin,estado) 
                VALUES (:id_vehiculo, :id_cliente, :fechaInicio, :fechaFin,:estado)";
        
        $arrayDatos = array(
            "id_vehiculo" => $id_vehiculo,
            "id_cliente" => $id_cliente,
            "fechaInicio" => $fechaInicio->format('Y-m-d'), //  y-m-d formato de la fecha
            "fechaFin" => $fechaFin->format('Y-m-d'),       
            "estado" => "A"
        );
    
        $respuesta = $this->ejecutar($sql, $arrayDatos);
        return $respuesta;
    }

    

}


?>