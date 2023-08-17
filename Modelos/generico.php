<?php

class generico{
  


    public function traerRegistros($sql,$arrayDatos=array()){
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
    
    public function ejecutar($sql, $arraySql=array()){
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


    public function subirImagen($archivo, $alto, $ancho){
    //valido si existe el archivo temporal y si la ruta es vacia
        if(!isset($archivo['tmp_name'])||$archivo['tmp_name']==""){

            return false;

        }
            $rutaTMP= $archivo['tmp_name'];
                
            $nombre= uniqid();
            $tipoArchivo= $archivo['type'];

                switch($tipoArchivo){
                    case "image/jpeg":
                    case "image/JPEG":
                    case "image/jpg":
                    case "image/JPG":
                        $tipo="jpg";
                        break; 

                    case "image/png":
                    case "image/PNG":
                        $tipo="png";
                        break;

                    default:
                        return false;
                        break;    
                    
                }

                
            $rutaServidorTMP = "tmp/".$nombre.".".$tipo;
            $rutaServidorFinal = "web/archivos/" . $nombre . "." . $tipo;
                

            $respuesta = copy($rutaTMP, $rutaServidorTMP);
                // valido si puedo copiar el archivo a mi ruta temporal
            if(!$respuesta){


                    return false;
            }


            if($tipo=="jpg"){
                $imagenTMP= imagecreatefromjpeg($rutaServidorTMP);


            }else{
                $imagenTMP= imagecreatefrompng($rutaServidorTMP);

            }

                //obtener ancho y alto original
                $anchoOriginal=imagesx($imagenTMP);
                $altoOriginal=imagesy($imagenTMP);
                // creo la imagen con mis dimensiones
                $imagen_redimensionada= imagecreatetruecolor($ancho,$alto);

                imagecopyresampled($imagen_redimensionada, $imagenTMP, 0,0,0,0,$ancho,$alto, $anchoOriginal, $altoOriginal  );

            if($tipo=="jpg"){
                    imagejpeg($imagen_redimensionada,$rutaServidorFinal);
            }else{
                    imagepng($imagen_redimensionada,$rutaServidorFinal);
            }

                //destruyo en memoria las variables

                imagedestroy($imagenTMP);
                imagedestroy($imagen_redimensionada);
                //elimino imagen temporal
                unlink($rutaServidorTMP);

            return $nombre.".".$tipo;

            }



}













?>