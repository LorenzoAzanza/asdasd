<?php

require_once("Modelos/generico.php");

class reserva extends generico{

    // Identificador de registro autonumerico
    public $id_reserva;

    public $fecha;
    
    public $id_usuario;

    public $id_vehiculo;

    public $estado;

    protected $tabla = "reserva";

    public function constructor($arrayDatos = array()){
        $this->fecha = $arrayDatos['fecha'];
        $this->id_usuario = $arrayDatos['id_usuario'];
        $this->id_vehiculo = $arrayDatos['id_vehiculo'];
        $this->estado = $arrayDatos['estado'];
    }

    public function cargar($id_reserva){
        $sql = "SELECT * FROM reserva WHERE id_reserva = :id_reserva";
        $arraySql = array("id_reserva" => $id_reserva);

        $lista = $this->traerRegistros($sql, $arraySql);
    
        if (isset($lista[0]['id_reserva'])){
            $this->fecha = $lista[0]['fecha'];
            $this->id_usuario = $lista[0]['id_usuario'];
            $this->id_vehiculo = $lista[0]['id_vehiculo'];
            $this->estado = $lista[0]['estado'];
            $this->id_reserva = $lista[0]['id_reserva'];
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
            fecha = :fecha,
            id_usuario = :id_usuario,
            id_vehiculo = :id_vehiculo,
            estado = :estado";

        $arrayDatos = array(
            "fecha" => $this->fecha,
            "id_usuario" => $this->id_usuario,
            "id_vehiculo" => $this->id_vehiculo,
            "estado" => $this->estado
        );

        return $this->ejecutar($sql, $arrayDatos);
    }

    public function editar(){
        // Para editar los registros
        $sql = "UPDATE reserva SET
            fecha = :fecha,
            id_usuario = :id_usuario,
            id_vehiculo = :id_vehiculo,
            estado = :estado
            WHERE id_reserva = :id_reserva";

        $arrayDatos = array(
            "fecha" => $this->fecha,
            "id_usuario" => $this->id_usuario,
            "id_vehiculo" => $this->id_vehiculo,
            "estado" => $this->estado,
            "id_reserva" => $this->id_reserva
        );

        return $this->ejecutar($sql, $arrayDatos);
    }

    public function borrar(){
        // Verificar si la reserva existe antes de eliminarla
        $existe = $this->cargar($this->id_reserva);
        if ($existe) {
            $sql = "DELETE FROM reserva WHERE id_reserva = :id_reserva";
            $arrayDatos = array("id_reserva" => $this->id_reserva);
            return $this->ejecutar($sql, $arrayDatos);
        } else {
            // La reserva no existe, no es posible eliminarla
            return false;
        }
    }

    public function listar($filtro = array()){
        // Retorna una lista de registros de la base de datos
        $sql = "SELECT * FROM reserva ORDER BY fechaInicio LIMIT " . $filtro['inicio'] . ", " . $filtro['cantidad'];
        return $this->traerRegistros($sql);
    }
}