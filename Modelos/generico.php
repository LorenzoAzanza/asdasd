<?php

class generico{
  


    protected function traerRegistros($sql,$arrayDatos=array()){
        try{
            if(file_exists("Configuracion/db.php")){
                include("Configuracion/db.php");
            }
           
            $host =isset($baseDatos['host'])?$baseDatos['host']:"localhost";
            $puerto=isset($baseDatos['puerto'])?$baseDatos['puerto']:"3306";
            $usuario= isset($baseDatos['usuario'])?$baseDatos['usuario']:"root";
            $clave= isset($baseDatos['clave'])?$baseDatos['clave']:"";
            $db= isset($baseDatos['db'])?$baseDatos['db']:"proyecto";
    
    $conexion= new PDO("mysql:host=".$host.":".$puerto.";dbname=".$db."",$usuario,$clave);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $mysqlPrepare= $conexion->prepare($sql);
    $mysqlPrepare->execute($arrayDatos);
    $lista= $mysqlPrepare->fetchAll(PDO::FETCH_ASSOC);
    
    }catch(Exception $error){
        print_r($error->getMessage());
        $lista=false;
    }
    return $lista;
    
    
    }
    
    protected function ejecutar($sql, $arraySql=array()){
    try{
        if(file_exists("Configuracion/db.php")){
            include("Configuracion/db.php");
        }
      
        $host =isset($baseDatos['host'])?$baseDatos['host']:"localhost";
        $puerto=isset($baseDatos['puerto'])?$baseDatos['puerto']:"3306";
        $usuario= isset($baseDatos['usuario'])?$baseDatos['usuario']:"root";
        $clave= isset($baseDatos['clave'])?$baseDatos['clave']:"";
        $db= isset($baseDatos['db'])?$baseDatos['db']:"proyecto";
    
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


    public function listar($filtro=array()){
 
        
            }
}













?>