<?php
require_once("Modelos/generico.php");


class usuario extends generico{

    //identificador de registro autonumerico
    public $id_usuario;

    public $nombre;
    
    public $apellido;

    public $direccion;

    public $telefono;

    public $mail;

    public $tipo_documento;

    public $numero_documento;

    public $estado;

    protected $tabla="usuario";

    public function constructor($arrayDatos=array()){
        $this->nombre=$arrayDatos['nombre'];
        $this->apellido=$arrayDatos['apellido'];
        $this->direccion=$arrayDatos['direccion'];
        $this->telefono=$arrayDatos['telefono'];
        $this->mail=$arrayDatos['mail'];
        $this->tipo_documento=$arrayDatos['tipo_documento'];
        $this->numero_documento=$arrayDatos['numero_documento'];
        $this->estado=$arrayDatos['estado'];
    

    }
    public function cargar($id_usuario){
      
    
        $sql = "SELECT * FROM usuario WHERE id_usuario = :id_usuario";
        $arraySql = array("id_usuario" => $id_usuario);
    

        $lista = $this->traerRegistros($sql, $arraySql);
    
        if (isset($lista[0]['id_usuario'])){
            $this->nombre = $lista[0]['nombre'];
            $this->apellido = $lista[0]['apellido'];
            $this->direccion = $lista[0]['direccion'];
            $this->telefono = $lista[0]['telefono'];
            $this->mail = $lista[0]['mail'];
            $this->tipo_documento = $lista[0]['tipo_documento'];
            $this->numero_documento = $lista[0]['numero_documento'];
            $this->estado = $lista[0]['estado'];
            $this->id_usuario = $lista[0]['id_usuario'];
            $retorno = true;
        } else {
            $retorno = false;
        }
    
        return $retorno;
    }
    public function totalRegistros(){
 
        $sql = "SELECT  count(*) as total FROM usuario WHERE  estado='A'" ;
    
    
        $lista = $this->traerRegistros($sql);
    
        if (isset($lista[0]['total'])){
            $retorno= $lista[0]['total'];
    
           
            
        } else {
            $retorno=0;
        }
    
        return $retorno;
    
    }

    public function ingresar(){
//se encarga de ingresar registros//
    $sql="INSERT usuario SET
        nombre =:nombre,
        apellido =:apellido,
        direccion =:direccion,
        telefono =:telefono,
        mail =:mail,
        tipo_documento =:tipo_documento,
        numero_documento =:numero_documento,
        estado =:estado

    ";
    $arrayDatos=array(
        "nombre" => $this->nombre,
        "apellido" => $this->apellido,
        "direccion" => $this->direccion,
        "telefono" => $this->telefono,
        "mail" => $this->mail,
        "tipo_documento" => $this->tipo_documento,
        "numero_documento" => $this->numero_documento,
        "estado" => $this->estado
    );


    $respuesta=$this->ejecutar($sql,$arrayDatos);
    
    return $respuesta;


     }

    public function editar(){
//para editar los registros///

    $sql="UPDATE usuario SET
        nombre =:nombre,
        apellido =:apellido,
        direccion =:direccion,
        telefono =:telefono,
        mail =:mail,
        tipo_documento =:tipo_documento,
        numero_documento =:numero_documento,
        estado =:estado
        where id_usuario = :id_usuario;

    ";
    $arrayDatos=array(
        "nombre" => $this->nombre,
        "apellido" => $this->apellido,
        "direccion" => $this->direccion,
        "telefono" => $this->telefono,
        "mail" => $this->mail,
        "tipo_documento" => $this->tipo_documento,
        "numero_documento" => $this->numero_documento,
        "estado" => $this->estado,
        "id_usuario" => $this->id_usuario
    );
    


    $respuesta=$this->ejecutar($sql,$arrayDatos);
    return $respuesta;


    }

    public function borrar(){
 //para borrar los registros///
 
     /*
    // para validar que no hay reservas activas
    SELECT count (*) as total Reserva WHERE id_vehiculo= $this->id_vehiculo and estado= 'A'
    if(total>0){
        no borramos el registro
    }


    */

    $sql="UPDATE usuario SET
       
        estado = 'S'
        where id_usuario= :id_usuario;


    ";
    $arrayDatos=array(
       "id_usuario"=> $this->id_usuario
    );
    $respuesta=$this->ejecutar($sql, $arrayDatos);
 
    return $respuesta;


    }

 public function listar($filtro=array()){
// retorna una lista de registros de la base de datos//

$sql= "SELECT * FROM usuario WHERE estado='A' ORDER BY id_usuario LIMIT ".$filtro['inicio'].", ".$filtro['cantidad']."";

$lista=$this->traerRegistros($sql);


return $lista;

    }




}














?>