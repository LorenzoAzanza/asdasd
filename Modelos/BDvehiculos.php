<?php

class vehiculos{

    //identificador de registro autonumerico
    public $id;

    public $tipo;
    
    public $color;

    public $cantidad_pasajeros;

    public $marca;

    public $modelo;

    public $precio;

    public $estado;


    public function constructor($arrayDatos=array()){
        $this->tipo=$arrayDatos['tipo'];
        $this->color=$arrayDatos['color'];
        $this->cantidad_pasajeros=$arrayDatos['cantidad_pasajeros'];
        $this->marca=$arrayDatos['marca'];
        $this->modelo=$arrayDatos['modelo'];
        $this->precio=$arrayDatos['precio'];
        $this->estado=$arrayDatos['estado'];
    

    }

    public function ingresar(){
//se encarga de ingresar registros//
try{
    $host = "localhost";
    $puerto= "3306";
    $usuario= "root";
    $clave= "";
    $db= "proyecto";

    $conexion= new PDO("mysql:host=".$host.":".$puerto.";dbname=".$db."",$usuario,$clave);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql="INSERT vehiculo SET
        tipo =:tipo,
        color =:color,
        cantidad_pasajeros =:cantidad_pasajeros,
        marca =:marca,
        modelo =:modelo,
        precio =:precio,
        estado =:estado;

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
    $stm= $conexion->prepare($sql);
    $respuesta=$stm->execute($arrayDatos);
}catch(Exception $error){
    print_r($error->getMessage());
    $respuesta=false;

}

 
    return $respuesta;


     }

    public function editar(){
//para editar los registros///

    }

    public function borrar(){
 //para borrar los registros///


    }

    public function listar(){
// retorna una lista de registros de la base de datos//
$host = "localhost";
$puerto= "3306";
$usuario= "root";
$clave= "";
$db= "proyecto";

$conexion= new PDO("mysql:host=".$host.":".$puerto.";dbname=".$db."",$usuario,$clave);
$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql= "SELECT * FROM vehiculo";

$mysqlPrepare= $conexion->prepare($sql);


$mysqlPrepare->execute();

$lista= $mysqlPrepare->fetchAll(PDO::FETCH_ASSOC);

return $lista;

    }


}










?>