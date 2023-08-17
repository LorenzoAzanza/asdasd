<?php

require_once("Configuracion/db.php");
require_once("Modelos/generico.php");

class formulario extends generico{
    // Identificador de registro autonumérico
    public $id_formulario;
    public $nombre;
    public $mail;
    public $mensaje;
    public $asunto;
    
    public function constructor($arrayDatos = array()){
        $this->nombre = $arrayDatos['nombre'];
        $this->mail = $arrayDatos['mail'];
        $this->mensaje = $arrayDatos['mensaje'];
        $this->asunto = $arrayDatos['asunto'];

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


    //metodo para guardar el formulario en la base de datos
    public function guardarFormulario($nombre, $email, $asunto, $mensaje) {
        $sql = "INSERT INTO formulario (nombre, mail, asunto, mensaje) VALUES (:nombre, :mail, :asunto, :mensaje)";
        $arrayDatos = array(
            "nombre" => $nombre,
            "mail" => $email,
            "asunto" => $asunto,
            "mensaje" => $mensaje
        );

        $this->ejecutar($sql, $arrayDatos); // Utiliza el método guardar de la clase generico
    }


}



?>