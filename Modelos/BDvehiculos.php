<?php
require_once("Modelos/generico.php");






class vehiculos extends generico{

    //identificador de registro autonumerico
    public $id_vehiculo;

    public $tipo;
    
    public $color;

    public $cantidad_pasajeros;

    public $marca;

    public $modelo;

    public $precio;

    public $estado;

    public $img;

    protected $tabla="vehiculo";

    public function constructor($arrayDatos=array()){
        $this->tipo=$arrayDatos['tipo'];
        $this->color=$arrayDatos['color'];
        $this->cantidad_pasajeros=$arrayDatos['cantidad_pasajeros'];
        $this->marca=$arrayDatos['marca'];
        $this->modelo=$arrayDatos['modelo'];
        $this->precio=$arrayDatos['precio'];
        $this->estado=$arrayDatos['estado'];
        $this->img=$arrayDatos['img'];
        $this->id_vehiculo= isset($arrayDatos['id_vehiculo'])?$arrayDatos['id_vehiculo']:"";
    

    }
    public function cargar($id_vehiculo){
      
    
        $sql = "SELECT * FROM vehiculo WHERE id_vehiculo = :id_vehiculo";
        $arraySql = array("id_vehiculo" => $id_vehiculo);
    

        $lista = $this->traerRegistros($sql, $arraySql);
    
        if (isset($lista[0]['id_vehiculo'])){
            $this->tipo = $lista[0]['tipo'];
            $this->color = $lista[0]['color'];
            $this->cantidad_pasajeros = $lista[0]['cantidad_pasajeros'];
            $this->marca = $lista[0]['marca'];
            $this->modelo = $lista[0]['modelo'];
            $this->precio = $lista[0]['precio'];
            $this->estado = $lista[0]['estado'];
            $this->id_vehiculo = $lista[0]['id_vehiculo'];
            $this->img=$lista[0]['img'];

            $retorno = true;
        } else {
            $retorno = false;
        }
    
        return $retorno;
    }
    public function totalRegistros(){
 
        $sql = "SELECT  count(*) as total FROM ".$this->tabla." " ;
    
    
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
    $sql="INSERT vehiculo SET
        tipo =:tipo,
        color =:color,
        cantidad_pasajeros =:cantidad_pasajeros,
        marca =:marca,
        modelo =:modelo,
        precio =:precio,
        estado =:estado,
        img =:img;

    ";
    $arrayDatos=array(
        "tipo" => $this->tipo,
        "color" => $this->color,
        "cantidad_pasajeros" => $this->cantidad_pasajeros,
        "marca" => $this->marca,
        "modelo" => $this->modelo,
        "precio" => $this->precio,
        "estado" => $this->estado,
        "img" => $this->img,
    );


    $respuesta=$this->ejecutar($sql,$arrayDatos);
    
    return $respuesta;


     }

     public function editar(){
        //para editar los registros///
        $sql = "UPDATE vehiculo SET
        tipo = :tipo,
        color = :color,
        cantidad_pasajeros = :cantidad_pasajeros,
        marca = :marca,
        modelo = :modelo,
        precio = :precio,
        estado = :estado";

        if ($this->img) {
                $sql .= ", img = '$this->img'";
        }

        $sql .= " WHERE id_vehiculo=:id_vehiculo";
            
           
            
        
        $arrayDatos=array(
            "tipo" => $this->tipo,
            "color" => $this->color,
            "cantidad_pasajeros" => $this->cantidad_pasajeros,
            "marca" => $this->marca,
            "modelo" => $this->modelo,
            "precio" => $this->precio,
            "estado" => $this->estado,
            "id_vehiculo" => $this->id_vehiculo,
           
            
        );
    
        $respuesta = $this->ejecutar($sql, $arrayDatos);
        return $respuesta;
    }
    
    public function borrar(){
        // Primero, verifica si el vehículo existe antes de eliminarlo
        $existe = $this->cargar($this->id_vehiculo);
        if ($existe) {
            // Verificar si hay reservas activas para este vehículo antes de borrarlo
            // (puedes implementar este código, como el comentario que tienes en el código)
    
            // Si no hay reservas activas, procede a eliminar el vehículo
            $sql = "DELETE FROM vehiculo WHERE id_vehiculo = :id_vehiculo";
            $arrayDatos = array("id_vehiculo" => $this->id_vehiculo);
    
            $respuesta = $this->ejecutar($sql, $arrayDatos);
    
            return $respuesta;
        } else {
            // El vehículo no existe, no es posible eliminarlo
            return false;
        }
    }

 public function listar($filtro=array()){
// retorna una lista de registros de la base de datos//


$sql = "SELECT * FROM vehiculo ORDER BY id_vehiculo LIMIT " . $filtro['inicio'] . ", " . $filtro['cantidad'] . "";

$lista = $this->traerRegistros($sql);

return $lista;

    }
  
    
    
}







    


   


    
















?>