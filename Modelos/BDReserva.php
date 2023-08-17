<?php

require_once("Configuracion/db.php");
require_once("Modelos/generico.php");

class reserva extends generico{

    // Identificador de registro autonumerico
    public $id_reserva;

    public $fechaInicio;

    public $fechaFin;
    
    public $id_cliente;

    public $id_vehiculo;

    public $estado;

    protected $tabla = "reserva";

    public function constructor($arrayDatos = array()){
        $this->fechaInicio = $arrayDatos['fechaInicio'];
        $this->fechaFin = $arrayDatos['fechaFin'];
        $this->id_cliente = $arrayDatos['id_cliente'];
        $this->id_vehiculo = $arrayDatos['id_vehiculo'];
        $this->estado = $arrayDatos['estado'];
    }

    public function cargar($id_reserva){
      
    
        $sql = "SELECT * FROM reserva WHERE id_reserva = :id_reserva";
        $arraySql = array("id_reserva" => $id_reserva);
    

        $lista = $this->traerRegistros($sql, $arraySql);
    
        if (isset($lista[0]['id_reserva'])){
            $this->fechaInicio = $lista[0]['fechaInicio'];
            $this->fechaFin = $lista[0]['fechaFin'];
            $this->id_vehiculo = $lista[0]['id_vehiculo'];
            $this->estado = $lista[0]['estado'];
            $this->id_cliente = $lista[0]['id_cliente'];
            $this->id_reserva=$lista[0]['id_reserva'];
       

            $retorno = true;
        } else {
            $retorno = false;
        }
    
        return $retorno;
    }
    public function totalRegistros(){
        $sql = "SELECT COUNT(*) AS total FROM reserva WHERE estado = 'A'";
        $lista = $this->traerRegistros($sql);

        if (isset($lista[0]['total'])){
            return $lista[0]['total'];
        } else {
            return 0;
        }
    }

    public function ingresar(){
        // Se encarga de ingresar registros
        $sql = "INSERT reserva SET
            fechaInicio = :fechaInicio,
            fechaFin = :fechaFin,
            id_cliente = :id_cliente,
            id_vehiculo = :id_vehiculo,
            estado = :estado";

        $arrayDatos = array(
            "fechaInicio" => $this->fechaInicio,
            "fechaFin" => $this->fechaFin,
            "id_cliente" => $this->id_cliente,
            "id_vehiculo" => $this->id_vehiculo,
            "estado" => $this->estado
        );

        return $this->ejecutar($sql, $arrayDatos);
    }

    public function editar(){
        // Para editar los registros
        $sql = "UPDATE reserva SET
            fechaInicio = :fechaInicio,
            fechaFin= :fechaFin,

            id_cliente = :id_cliente,
            id_vehiculo = :id_vehiculo,
            estado = :estado
            WHERE id_reserva = :id_reserva";

        $arrayDatos = array(
            "fechaInicio" => $this->fechaInicio,
            "fechaFin" => $this->fechaFin,
            "id_cliente" => $this->id_cliente,
            "id_vehiculo" => $this->id_vehiculo,
            "estado" => $this->estado,
            "id_reserva" => $this->id_reserva
        );

        return $this->ejecutar($sql, $arrayDatos);
    }

    public function borrar(){
  
        $existe = $this->cargar($this->id_reserva);
     
        if ($existe) {
          
            $sql = "DELETE  FROM reserva WHERE id_reserva = :id_reserva";
            $arrayDatos = array("id_reserva" => $this->id_reserva);
    
            $respuesta = $this->ejecutar($sql, $arrayDatos);
    
            return $respuesta;
        } else {
           
            return false;
        }
    }

    public function listar($filtro = array()){

         // Consulta SQL para obtener la lista de reservas junto con información relacionada

        $sql = "SELECT
		r.id_reserva, r.fechaInicio , r.fechaFin , r.estado , CONCAT(v.marca,' ID ', v.id_vehiculo)as marcaVehiculo, CONCAT(c.nombre,' ',c.apellido,' ID ', c.id_cliente) as nombreCliente
		from reserva r 
		inner join vehiculo v on r.id_vehiculo = v.id_vehiculo 
		inner join clientes c on r.id_cliente = c.id_cliente;
	 " . $filtro['inicio'] . ", " . $filtro['cantidad'];
        return $this->traerRegistros($sql);
    }

    // Este método verifica si hay reservas activas para un vehículo en las fechas especificadas
    public function verificarReservasEnFechas($idVehiculo, $fechaInicio, $fechaFin) {
        // Verificar si hay una reserva activa en las fechas dadas
        $sql = "SELECT COUNT(*) as total FROM reserva WHERE id_vehiculo = :id_vehiculo AND estado = 'A' AND fechaInicio <= :fechaFin AND fechaFin >= :fechaInicio";
        $arraySql = array(
            "id_vehiculo" => $idVehiculo,
            "fechaInicio" => $fechaInicio->format('Y-m-d'),
            "fechaFin" => $fechaFin->format('Y-m-d')
        );
    
        $result = $this->traerRegistros($sql, $arraySql);
    
        if (isset($result[0]['total']) && $result[0]['total'] > 0) {
            return true; 
        } else {
            return false; 
        }
    }

        //Funcion creada para mostrar las reservas del usuario en el perfil

    public function ObtenerReservasActivasCliente($idCliente) {
        // Obtener las reservas activas de un cliente específico
        $sql = "SELECT
            r.id_reserva, r.fechaInicio, r.fechaFin, CONCAT(v.marca, ' ID ', v.id_vehiculo) as marcaVehiculo
            FROM reserva r
            INNER JOIN vehiculo v ON r.id_vehiculo = v.id_vehiculo
            WHERE r.id_cliente = :id_cliente AND r.estado = 'A'";
        
        $arraySql = array("id_cliente" => $idCliente);
        
        return $this->traerRegistros($sql, $arraySql);
    }
}