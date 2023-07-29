<?php

require_once("Modelos/generico.php");

class formulario extends generico{
    // Identificador de registro autonumérico
    public $id_formulario;
    public $nombre;
    public $mail;
    public $mensaje;
    protected $tabla = "formulario";

    public function constructor($arrayDatos = array()){
        $this->nombre = $arrayDatos['nombre'];
        $this->mail = $arrayDatos['mail'];
        $this->mensaje = $arrayDatos['mensaje'];
    }

    public function cargar($id_formulario){
        $sql = "SELECT * FROM formulario WHERE id_formulario = :id_formulario";
        $arraySql = array("id_formulario" => $id_formulario);

        $lista = $this->traerRegistros($sql, $arraySql);

        if (isset($lista[0]['id_formulario'])){
            $this->nombre = $lista[0]['nombre'];
            $this->mail = $lista[0]['mail'];
            $this->mensaje = $lista[0]['mensaje'];
            $this->id_formulario = $lista[0]['id_formulario'];
            $retorno = true;
        } else {
            $retorno = false;
        }

        return $retorno;
    }

    public function totalRegistros(){
        $sql = "SELECT count(*) as total FROM " . $this->tabla;
        $lista = $this->traerRegistros($sql);

        if (isset($lista[0]['total'])){
            $retorno = $lista[0]['total'];
        } else {
            $retorno = 0;
        }

        return $retorno;
    }


    public function listar($filtro = array()){
        $sql = "SELECT * FROM formulario ORDER BY id_formulario LIMIT " . $filtro['inicio'] . ", " . $filtro['cantidad'] . "";
        $lista = $this->traerRegistros($sql);

        return $lista;
    }



}







?>