    <?php

    require_once("Modelos/generico.php");

    class tipo_usuario extends generico{

        public $id_tipo_usuario;
        public $mail;
        public $contrasena;
        public $rol;
        public $estado;
        public $id_cliente;
        public $nombre;
        public $apellido;
        public $direccion;
        public $telefono;
        public $tipo_documento;
        public $numero_documento;




        public function constructor($arrayDatos){
            $this->mail = $arrayDatos['mail'];
            $this->rol = $arrayDatos['rol'];
            $this->estado=$arrayDatos['estado'];
            $this->nombre=$arrayDatos['nombre'];
            $this->apellido=$arrayDatos['apellido'];
            $this->direccion=$arrayDatos['direccion'];
            $this->telefono=$arrayDatos['telefono'];
            $this->tipo_documento=$arrayDatos['tipo_documento'];
            $this->numero_documento=$arrayDatos['numero_documento'];
         


        }

       // ...

public function login($mail, $contrasena){
    $sql = "SELECT * FROM tipo_usuario WHERE mail = :mail AND contrasena = :contrasena AND estado = 'A'";
    $arraySql = array("mail" => $mail, "contrasena" => md5($contrasena));

    $registro = $this->traerRegistros($sql, $arraySql);

    if (isset($registro[0]['id_tipo_usuario'])){
        $this->id_tipo_usuario = $registro[0]['id_tipo_usuario'];
        $this->mail = $registro[0]['mail'];
        $this->rol = $registro[0]['rol'];

        // Almacenar el rol en la sesión.
        $_SESSION['usuario']['rol'] = $this->rol;

        return true;
    } else {
        return false;
    }
}
public function totalRegistros(){
 
    $sql = "SELECT  count(*) as total FROM tipo_usuario WHERE  estado='A'" ;


    $lista = $this->traerRegistros($sql);

    if (isset($lista[0]['total'])){
        $retorno= $lista[0]['total'];

       
        
    } else {
        $retorno=0;
    }

    return $retorno;

}
public function obtenerRol() {
    return $this->rol;
}

// ...


        public function cargar($id_tipo_usuario){
        
        
            $sql = "SELECT * FROM tipo_usuario WHERE id_tipo_usuario = :id_tipo_usuario";
            $arraySql = array("id_tipo_usuario" => $id_tipo_usuario);
        

            $lista = $this->traerRegistros($sql, $arraySql);
        
            if (isset($lista[0]['id_tipo_usuario'])){
            
                $this->mail = $lista[0]['mail'];
                $this->id_tipo_usuario=$lista[0]['id_tipo_usuario'];
                $this->rol=$lista[0]['rol'];
                $this->nombre=$lista[0]['nombre'];
                $this->apellido=$lista[0]['apellido'];
                $this->direccion=$lista[0]['direccion'];
                $this->telefono=$lista[0]['telefono'];
                $this->tipo_documento=$lista[0]['tipo_documento'];
                $this->numero_documento=$lista[0]['numero_documento'];
                $this->estado=$lista[0]['estado'];




                
                $retorno = true;
            } else {
                $retorno = false;
            }
        
            return $retorno;
        }
        



        public function editar() {
            //para editar los registros///
            $sql = "UPDATE tipo_usuario SET
                nombre =:nombre,
                apellido =:apellido,
                direccion =:direccion,
                telefono =:telefono,
                mail = :mail,
                tipo_documento=:tipo_documento,
                numero_documento=:numero_documento,
                rol=:rol,
                estado=:estado
                WHERE id_tipo_usuario = :id_tipo_usuario";
            $arrayDatos = array(
                "mail" => $this->mail,
                "id_tipo_usuario" => $this->id_tipo_usuario,
                "nombre"=>$this->nombre,
                "apellido"=>$this->apellido,
                "direccion"=>$this->direccion,
                "telefono"=>$this->telefono,
                "tipo_documento"=>$this->tipo_documento,
                "numero_documento"=>$this->numero_documento,
                "rol"=>$this->rol,
                "estado"=>$this->estado
 );
        
            $respuesta = $this->ejecutar($sql, $arrayDatos);
            return $respuesta;
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
            $sql = "SELECT * FROM tipo_usuario WHERE  id_tipo_usuario=".$this->id_tipo_usuario." AND contrasena = :contrasena";
            $arraySql = array("contrasena" => md5($contrasena));

            $registro = $this->traerRegistros($sql, $arraySql);

            if (!isset($registro[0]['id_tipo_usuario'])){
                $retorno="La Contraseña no es correcta";
                return $retorno;
            
            }
            $sql = "UPDATE tipo_usuario SET
                contrasena = :contrasena
                WHERE id_tipo_usuario = :id_tipo_usuario";
            $arrayDatos = array(
                "contrasena" => md5($nuevaContrasena),
                "id_tipo_usuario" => $this->id_tipo_usuario
            );
        
            $respuesta = $this->ejecutar($sql, $arrayDatos);
            return $respuesta;

        }
        public function listar($filtro=array()){
            // retorna una lista de registros de la base de datos//
            
            $sql= "SELECT * FROM tipo_usuario ORDER BY rol LIMIT ".$filtro['inicio'].", ".$filtro['cantidad']."";
            
            $lista=$this->traerRegistros($sql);
            
            
            return $lista;
            
                }
        

    }




    ?>