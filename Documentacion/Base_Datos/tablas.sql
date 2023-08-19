CREATE TABLE `tipo_usuario` (
  `id_tipo_usuario` int NOT NULL AUTO_INCREMENT,
  `mail` varchar(40) DEFAULT NULL,
  `rol` varchar(13) DEFAULT NULL,
  `contrasena` varchar(255) NOT NULL,
  `estado` char(1) DEFAULT NULL,
  `nombre` varchar(20) DEFAULT NULL,
  `apellido` varchar(30) DEFAULT NULL,
  `direccion` varchar(40) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `tipo_documento` varchar(20) DEFAULT NULL,
  `numero_documento` varchar(15) DEFAULT NULL,
  `activo` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id_tipo_usuario`)
)
INSERT INTO `tipo_usuario` VALUES (2,'alexandercamacho@gmail.com','administrador','4c79273eed3d095e55d1224f6524ae92','A','Alexander','Camacho','Av Battle 4320','093433221','CI','53232314',1),(24,'azanza@lore.com','vendedor','aeb50fe49ef476a69905c454b794497b','A','Hojaaaaa','King','Warfqw3e12','23892034','CI','3242342',1),(34,'josepere@gmail.com','encargado','aeb50fe49ef476a69905c454b794497b','A','Jose','Pere','aksdlaksdl','908234798','CI','32453452345',1);


CREATE TABLE `vehiculo` (
  `id_vehiculo` int NOT NULL AUTO_INCREMENT,
  `tipo` varchar(15) DEFAULT NULL,
  `color` varchar(10) DEFAULT NULL,
  `cantidad_pasajeros` int DEFAULT NULL,
  `marca` varchar(20) DEFAULT NULL,
  `modelo` varchar(20) DEFAULT NULL,
  `precio` double DEFAULT NULL,
  `estado` char(1) DEFAULT NULL,
  `img` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_vehiculo`)
)
	
	INSERT INTO `vehiculo` VALUES (1,'Sedan','Gris',4,'Ford','Fusion',3000,'A','64d4358ed1f01.jpg'),(2,'Convertible','Negro',2,'Mazda','MX-5',3500,'D','64d4359eeaa46.jpg'),(3,'Coupe','Azul',2,'Lotus','Elise',5000,'A','64d435d8ac775.jpg'),(4,'SuperDeportivo','Naranja',2,'McLaren','Senna',10000,'A','64d4362f8a427.jpg'),(5,'Crossovers','Gris',5,'Toyota','Venza',8000,'A','64d4369315463.jpg'),(6,'SuperDeportivo','Plateado',2,'Bugatti','Chiron',15000,'A','64d436b61eb09.jpg'),(39,'Deportivo','Negro',2,'Mazda','RX-7',8000,'A','64d436dd9bf42.jpg'),(40,'SuperDeportivo','Rojo',2,'Ferrari','F-50',13000,'A','64d43b83dc145.jpg');


CREATE TABLE `formulario` (
  `id_formulario` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) DEFAULT NULL,
  `mail` varchar(40) DEFAULT NULL,
  `mensaje` text,
  `asunto` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_formulario`)
)

CREATE TABLE `clientes` (
  `id_cliente` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `apellido` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `direccion` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `telefono` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `mail` varchar(40) NOT NULL,
  `tipo_documento` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `numero_documento` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `estado` char(1) DEFAULT NULL,
  `contrasena` varchar(255) NOT NULL,
  `rol` varchar(20) DEFAULT 'cliente',
  `activo` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id_cliente`),
  UNIQUE KEY `unique_mail` (`mail`),
  UNIQUE KEY `unique_numero_documento` (`numero_documento`)
)
INSERT INTO `clientes` VALUES (82,'Lorenzo','Azanza','1ยบ de mayo 1650 entre bolivia y chile','234345','azanzalorenzo@gmail.com','CI','345234234','A','7d7c8191356e56d420ffa20d6d473b6d','cliente',1);

 


CREATE TABLE `reserva` (
  `id_reserva` int NOT NULL AUTO_INCREMENT,
  `fechaInicio` date DEFAULT NULL,
  `fechaFin` date DEFAULT NULL,
  `estado` char(1) DEFAULT NULL,
  `id_cliente` int DEFAULT NULL,
  `id_vehiculo` int DEFAULT NULL,
  PRIMARY KEY (`id_reserva`),
  KEY `id_usuario` (`id_cliente`),
  KEY `id_vehiculo` (`id_vehiculo`),
  CONSTRAINT `fk_id_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`),
  CONSTRAINT `fk_id_vehiculo` FOREIGN KEY (`id_vehiculo`) REFERENCES `vehiculo` (`id_vehiculo`)
)
INSERT INTO `reserva` VALUES (19,'2023-08-18','2023-08-21','A',82,1);



show tables;

-- A= activo
-- D= DESACTIVADO
-- B= BORRADO

