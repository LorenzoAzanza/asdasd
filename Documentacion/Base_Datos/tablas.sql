create table tipo_usuario(
id_tipo_usuario INT(10) auto_increment not null,
nombre_usuario VARCHAR(20),
mail VARCHAR(40),
rol VARCHAR(13),
primary key(id_tipo_usuario)

)
ALTER TABLE tipo_usuario ADD CONSTRAINT unique_mail UNIQUE (mail);


create table vehiculo(
id_vehiculo INT(10) auto_increment not null,
tipo VARCHAR (15),
color VARCHAR (10),
cantidad_pasajeros INT(8),
marca VARCHAR(20),
modelo VARCHAR(20),
precio DOUBLE,
estado CHAR(1),
primary key(id_vehiculo)

)

create  table  formulario(
  id_formulario INT(20) auto_increment  not null ,
  nombre VARCHAR(20),
  mail VARCHAR(40),
  mensaje TEXT,
  primary key(id_formulario)
)

create table usuario(
id_usuario INT(50) auto_increment not null,
nombre VARCHAR(20),
apellido VARCHAR(30),
direccion VARCHAR(40),
telefono VARCHAR(15),
mail VARCHAR(40),
tipo_documento VARCHAR(20),
numero_documento VARCHAR(15),
estado CHAR(1),
primary key(id_usuario)

)
ALTER TABLE usuario  ADD CONSTRAINT unique_mail UNIQUE (mail);

CREATE TABLE Reserva (
  id_reserva INT(10) AUTO_INCREMENT NOT NULL,
  fechaInicio DATE,
  fechaFin DATE,
  estado CHAR(1),
  id_usuario INT(50),
  id_vehiculo INT(10),
  PRIMARY KEY (id_reserva),
  KEY (id_usuario),
  KEY (id_vehiculo),
  CONSTRAINT fk_id_usuario FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario),
  CONSTRAINT fk_id_vehiculo FOREIGN KEY (id_vehiculo) REFERENCES vehiculo(id_vehiculo)
)

--- INSERT A TABLAS VEHICULOS-----
-- A= activo
-- O= Ocupado
-- S= Suspendido

insert into vehiculo(tipo,color,cantidad_pasajeros,marca,modelo,precio,estado)
	values("Sedan","Gris","4","Ford","Fusion","3000","A")

select * from vehiculo v ;

insert into vehiculo (tipo,color,cantidad_pasajeros,marca,modelo,precio,estado)
	values("Convertible","Negro","2","Mazda","MX-5","3500","A")
	
insert into vehiculo (tipo,color,cantidad_pasajeros,marca,modelo,precio,estado)
	values("Coupe","Blanco","2","Lotus","Elise","5000","A")
	
insert into vehiculo (tipo,color,cantidad_pasajeros,marca,modelo,precio,estado)
	values("SuperDeportivo","Naranja","2","McLaren","Senna","10000","A")
	
insert into vehiculo (tipo,color,cantidad_pasajeros,marca,modelo,precio,estado)
	values("Crossovers","Rojo","5","Toyota","Venza","8000","A")

insert into vehiculo (tipo,color,cantidad_pasajeros,marca,modelo,precio,estado)
	values("SuperDeportivo","Azul","2","Bugatti","Chiron","15000","A")
	
update vehiculo set 
		color= "Dorado"
		where id_vehiculo=6;


select * from vehiculo v ;

-- INSERT A TABLA USUARIO---
-- A= activo
-- S= Suspendido

insert into usuario (nombre,apellido,direccion,telefono,mail,tipo_documento,numero_documento,estado)
values
	("Lorenzo","Azanza","1 de mayo 1650","092491130","azanzalorenzo@gmail.com","CI","55606045","A"),
	("Daniel","Viera","Bolivia y Chile 24","099384152","danielviera@gmail.com","CI","44539087","A"),
	("Alexander","Camacho","Av Battle 4320","093433221","alexandercamacho@gmail.com","CI","53232314","A"),
	("Amanda","Hernandez","Jose Quiroga 321","099438372","amandahernandez@gmail.com","CI","55898764","A"),
	("Jose","Perez","Calle Uruguay 1540","093487332","joseperez@gmail.com","CI","54432123","A");

select * from usuario u ;

