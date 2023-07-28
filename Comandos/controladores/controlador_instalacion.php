<?php

require_once("comandos/controladores/controlador_generico.php");
require_once("Modelos/generico.php");

class controlador_instalacion extends controlador_generico{

    protected $llave=true; //false


    public function procesar(){

        $this->horaInicio= date("Y-m-d H:i:s");

        $arrayTabla=array();


        $arrayTabla[]="
            SET FOREIGN_KEY_CHECKS=0;
            DROP TABLE IF EXISTS tipo_usuario;
            DROP TABLE IF EXISTS usuario;
            DROP TABLE IF EXISTS vehiculo;
            DROP TABLE IF EXISTS reserva;
            DROP TABLE IF EXISTS formulario;
            SET FOREIGN_KEY_CHECKS=1;

        ";


        $arrayTabla[]="CREATE TABLE `tipo_usuario` (
            `id_tipo_usuario` int NOT NULL AUTO_INCREMENT,
            `mail` varchar(40) DEFAULT NULL,
            `rol` varchar(13) DEFAULT NULL,
            `contrasena` varchar(255) NOT NULL,
            `estado` char(1) DEFAULT NULL,
            PRIMARY KEY (`id_tipo_usuario`)
          ) ";
            $arrayTabla[]="CREATE TABLE `usuario` (
                `id_usuario` int NOT NULL AUTO_INCREMENT,
                `nombre` varchar(20) DEFAULT NULL,
                `apellido` varchar(30) DEFAULT NULL,
                `direccion` varchar(40) DEFAULT NULL,
                `telefono` varchar(15) DEFAULT NULL,
                `mail` varchar(40) NOT NULL,
                `tipo_documento` varchar(20) DEFAULT NULL,
                `numero_documento` varchar(15) DEFAULT NULL,
                `estado` char(1) DEFAULT NULL,
                `id_tipo_usuario` int DEFAULT NULL,
                PRIMARY KEY (`id_usuario`),
                UNIQUE KEY `unique_mail` (`mail`),
                UNIQUE KEY `unique_numero_documento` (`numero_documento`),
                KEY `id_tipo_usuario` (`id_tipo_usuario`),
                CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_tipo_usuario`) REFERENCES `tipo_usuario` (`id_tipo_usuario`)
              )";



        $arrayTabla[]="CREATE TABLE `vehiculo` (
            `id_vehiculo` int NOT NULL AUTO_INCREMENT,
            `tipo` varchar(15) DEFAULT NULL,
            `color` varchar(10) DEFAULT NULL,
            `cantidad_pasajeros` int DEFAULT NULL,
            `marca` varchar(20) DEFAULT NULL,
            `modelo` varchar(20) DEFAULT NULL,
            `precio` double DEFAULT NULL,
            `estado` char(1) DEFAULT NULL,
            PRIMARY KEY (`id_vehiculo`)
          ) ";

      
          
          $arrayTabla[]="CREATE TABLE `reserva` (
            `id_reserva` int NOT NULL AUTO_INCREMENT,
            `fechaInicio` date DEFAULT NULL,
            `fechaFin` date DEFAULT NULL,
            `estado` char(1) DEFAULT NULL,
            `id_usuario` int DEFAULT NULL,
            `id_vehiculo` int DEFAULT NULL,
            PRIMARY KEY (`id_reserva`),
            KEY `id_usuario` (`id_usuario`),
            KEY `id_vehiculo` (`id_vehiculo`),
            CONSTRAINT `fk_id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
            CONSTRAINT `fk_id_vehiculo` FOREIGN KEY (`id_vehiculo`) REFERENCES `vehiculo` (`id_vehiculo`)
          )";

        $arrayTabla[]="CREATE TABLE `formulario` (
            `id_formulario` int NOT NULL AUTO_INCREMENT,
            `nombre` varchar(20) DEFAULT NULL,
            `mail` varchar(40) DEFAULT NULL,
            `mensaje` text,
            PRIMARY KEY (`id_formulario`)
          )";

            $arrayTabla[] ="INSERT INTO `tipo_usuario` VALUES (1,'danielviera@gmail.com','Administrador','4c79273eed3d095e55d1224f6524ae92','A');";
            $arrayTabla[] ="INSERT INTO `usuario` VALUES (1,'Lorenzo','Azanza','1 de mayo 1650','092491130','azanzalorenzo@gmail.com','CI','55606045','A',NULL),
            (2,'Daniel','Viera','Bolivia y Chile 24','099384152','danielviera@gmail.com','CI','44539087','A',NULL),
            (3,'Alexander','Camacho','Av Battle 4320','093433221','alexandercamacho@gmail.com','CI','53232314','A',NULL),
            (4,'Amanda','Hernandez','Jose Quiroga 321','099438372','amandahernandez@gmail.com','CI','55898764','A',NULL),
            (5,'Jose','Perez','Calle Uruguay 1540','093487332','joseperez@gmail.com','CI','54432123','A',NULL),
            (13,'Rafael','De Lima','1ยบ de bolivia 123','092431145','rafa@gmail.com','CI','456456','S',NULL);";


            $arrayTabla[]="INSERT INTO `vehiculo` VALUES (1,'Sedan','Gris',4,'Ford','Fusion',3000,'A'),
            (2,'Convertible','Negro',2,'Mazda','MX-5',3500,'A'),
            (3,'Coupe','Blanco',2,'Lotus','Elise',5000,'O'),
            (4,'SuperDeportivo','Naranja',2,'McLaren','Senna',10000,'S'),
            (5,'Crossovers','Rojo',5,'Toyota','Venza',8000,'A'),
            (6,'SuperDeportivo','Dorado',2,'Bugatti','Chiron',15000,'O');";

            $arrayTabla[]="INSERT INTO `reserva` VALUES (1,'2023-07-18','2023-09-10','A',1,1);";

            $arrayTabla[]="INSERT INTO `formulario` VALUES (1,'Daniel Viera','danielviera@gmail.comr','Hola buenas tardes, haciendo la base de datos, probando los campos.');";

            $objGenerico=new generico();
          foreach($arrayTabla as $tabla){

            if($this->llave === true){
                $respuesta= $objGenerico->ejecutar($tabla);
                var_dump($respuesta);
            }else{
                print_r("\n\nLa llave esta en false\n\n");
            }

           
            sleep("2");



          }


          $this->horaFin=date("Y-m-d H:i:s");

    }


}








?>