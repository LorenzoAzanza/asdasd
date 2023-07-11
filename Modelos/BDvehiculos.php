<?php

class vehiculos{

    //identificador de registro autonumerico
    public $id_vehiculo;

    public $tipo;
    
    public $color;

    public $cantidad_pasajeros;

    public $marca;

    public $modelo;

    public $precio;

    public $estado;

    protected $tabla="vehiculos";

    public function constructor($arrayDatos=array()){
        $this->tipo=$arrayDatos['tipo'];
        $this->color=$arrayDatos['color'];
        $this->cantidad_pasajeros=$arrayDatos['cantidad_pasajeros'];
        $this->marca=$arrayDatos['marca'];
        $this->modelo=$arrayDatos['modelo'];
        $this->precio=$arrayDatos['precio'];
        $this->estado=$arrayDatos['estado'];
    

    }
    public function cargar($id_vehiculo){
        $host = "localhost";
        $puerto = "3306";
        $usuario = "root";
        $clave = "";
        $db = "proyecto";
    
        $conexion = new PDO("mysql:host=".$host.":".$puerto.";dbname=".$db, $usuario, $clave);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        $sql = "SELECT * FROM vehiculo WHERE id_vehiculo = :id_vehiculo";
        $arraySql = array(":id_vehiculo" => $id_vehiculo);
    
        $mysqlPrepare = $conexion->prepare($sql);
        $mysqlPrepare->execute($arraySql);
    
        $lista = $mysqlPrepare->fetchAll(PDO::FETCH_ASSOC);
    
        if (isset($lista[0]['id_vehiculo'])){
            $this->tipo = $lista[0]['tipo'];
            $this->color = $lista[0]['color'];
            $this->cantidad_pasajeros = $lista[0]['cantidad_pasajeros'];
            $this->marca = $lista[0]['marca'];
            $this->modelo = $lista[0]['modelo'];
            $this->precio = $lista[0]['precio'];
            $this->estado = $lista[0]['estado'];
            $this->id_vehiculo = $lista[0]['id_vehiculo'];
            $retorno = true;
        } else {
            $retorno = false;
        }
    
        return $retorno;
    }

    public function ingresar(){
//se encarga de ingresar registros//
    $sql="INSERT vehiculo SET
        tipo =:tipo,
        color =:color,
        cantidad_pasajeros =:cantidad_pasajeros,
        marca =:marca,
        modelo =:modelo,
        precio =:precio,
        estado =:estado

    ";
    $arrayDatos=array(
        "tipo" => $this->tipo,
        "color" => $this->color,
        "cantidad_pasajeros" => $this->cantidad_pasajeros,
        "marca" => $this->marca,
        "modelo" => $this->modelo,
        "precio" => $this->precio,
        "estado" => $this->estado
    );


    $respuesta=$this->ejecutar($sql,$arrayDatos);
    
    return $respuesta;


     }

    public function editar(){
//para editar los registros///

    $sql="UPDATE vehiculo SET
        tipo =:tipo,
        color =:color,
        cantidad_pasajeros =:cantidad_pasajeros,
        marca =:marca,
        modelo =:modelo,
        precio =:precio,
        estado =:estado
        where id_vehiculo = :id_vehiculo;

    ";
    $arrayDatos=array(
        "tipo" => $this->tipo,
        "color" => $this->color,
        "cantidad_pasajeros" => $this->cantidad_pasajeros,
        "marca" => $this->marca,
        "modelo" => $this->modelo,
        "precio" => $this->precio,
        "estado" => $this->estado,
        "id_vehiculo" => $this->id_vehiculo
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

    $sql="UPDATE vehiculo SET
       
        estado = 'S'
        where id_vehiculo= :id_vehiculo;


    ";
    $arrayDatos=array(
       "id_vehiculo"=> $this->id_vehiculo
    );
    $respuesta=$this->ejecutar($sql, $arrayDatos);
 
    return $respuesta;


    }

 public function listar($filtro=array()){
// retorna una lista de registros de la base de datos//
$host = "localhost";
$puerto= "3306";
$usuario= "root";
$clave= "";
$db= "proyecto";

$conexion= new PDO("mysql:host=".$host.":".$puerto.";dbname=".$db."",$usuario,$clave);
$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$sql= "SELECT * FROM vehiculo WHERE estado='A' ORDER BY id_vehiculo LIMIT ".$filtro['inicio'].", ".$filtro['cantidad']."";
$mysqlPrepare= $conexion->prepare($sql);


$mysqlPrepare->execute();

$lista= $mysqlPrepare->fetchAll(PDO::FETCH_ASSOC);

return $lista;

    }

protected function ejecutar($sql, $arraySql=array()){
try{
    $host = "localhost";
    $puerto= "3306";
    $usuario= "root";
    $clave= "";
    $db= "proyecto";

    $conexion= new PDO("mysql:host=".$host.":".$puerto.";dbname=".$db."",$usuario,$clave);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

   
    $stm= $conexion->prepare($sql);
    $respuesta=$stm->execute($arraySql);
}catch(Exception $error){
    print_r($error->getMessage());
    $respuesta=false;

}

 
    return $respuesta;


}


public function totalRegistros(){
    $host = "localhost";
    $puerto = "3306";
    $usuario = "root";
    $clave = "";
    $db = "proyecto";

    $conexion = new PDO("mysql:host=".$host.":".$puerto.";dbname=".$db, $usuario, $clave);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT  count(*) as total FROM ".this->tabla." WHERE  estado='A'" ;


    $mysqlPrepare = $conexion->prepare($sql);
    $mysqlPrepare->execute();

    $lista = $mysqlPrepare->fetchAll(PDO::FETCH_ASSOC);

    if (isset($lista[0]['total'])){
        $retorno= $lista[0]['total'];

       
        
    } else {
        $retorno=0;
    }

    return $retorno;

}

}










?>