<?php

require_once("Modelos/generico.php");

class tipo_usuario extends generico{

    public $id_tipo_usuario;
    public $mail;
    public $contrasena;
    public $rol;

    public function constructor($arrayDatos){
        $this->id_tipo_usuario = $arrayDatos['id_tipo_usuario'];
        $this->mail = $arrayDatos['mail'];
        $this->contrasena = $arrayDatos['contrasena'];
        $this->rol = $arrayDatos['rol'];
    }

    public function login($usuario, $contrasena){
        $sql = "SELECT * FROM tipo_usuario WHERE mail = :mail AND contrasena = :contrasena AND rol = 'Administrador' AND estado = 'A'";
        $arraySql = array("mail" => $usuario, "contrasena" => md5($contrasena));

        $registro = $this->traerRegistros($sql, $arraySql);

        if (isset($registro[0]['id_tipo_usuario'])){
            $this->id_tipo_usuario = $registro[0]['id_tipo_usuario'];
            $this->mail = $registro[0]['mail'];
            $this->rol = $registro[0]['rol'];

            return true;
        } else {
            return false;
        }
    }

    public function cargar($id_tipo_usuario){
      
    
        $sql = "SELECT * FROM tipo_usuario WHERE id_tipo_usuario = :id_tipo_usuario";
        $arraySql = array("id_tipo_usuario" => $id_tipo_usuario);
    

        $lista = $this->traerRegistros($sql, $arraySql);
    
        if (isset($lista[0]['id_tipo_usuario'])){
           
             $this->mail = $lista[0]['mail'];
             $this->id_tipo_usuario=$lista[0]['id_tipo_usuario'];
            
            $retorno = true;
        } else {
            $retorno = false;
        }
    
        return $retorno;
    }



    public function editar() {
        //para editar los registros///
        $sql = "UPDATE tipo_usuario SET
            mail = :mail
            WHERE id_tipo_usuario = :id_tipo_usuario";
        $arrayDatos = array(
            "mail" => $this->mail,
            "id_tipo_usuario" => $this->id_tipo_usuario
        );
    
        $respuesta = $this->ejecutar($sql, $arrayDatos);
        return $respuesta;
    }


}




?>