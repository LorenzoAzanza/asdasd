
Titulo: Proyecto rentadora automotriz CLASE 2253<br>
Autor: Lorenzo Azanza <br>
Fecha inicio: 2023-06-25 <br>
Fecha Fin: 2023-08-21 <br>
Fecha ultima actualización: 2023-08-20 <br>
Mail de reclamo: danielazanza6@gmail.com <br>

Descripcion: Sistema de alquiler de vehiculos, Funcional. <br>

Tecnologia: PHP,MySQL, HTML, CSS, JS. <br>
Framework: Materialize CSS https://materializecss.com/ <br>

Versiones probadas <br>

PHP: 8.1.10  <br>
MySQL: 8.0.30 <br>
HTML5 <br>
Apache: 2.4.54 <br>
Materialize CSS 1.0.0 <br>



///////////////////////////ESTE DOCUMENTO CONTIENE TODA LA INFORMACION DEL PROYECTO//////////////////////////////////////////

////////////////////////////////////////////////////////////////////////ACLARACIONES Y DATOS IMPORTANTES/////////////////////////////////////
                  -COMANDO PARA HACER INSTALACION BASE DE DATOS: php .\comandos.php instalacion
                  -DATOS DE ADMINISTRADOR PARA INICIAR SESION: CORREO: alexandercamacho@gmail.com CONTRASEÑA: @Admin123
                  -DATOS DE VENDEDOR YA INGRESADO PARA INICIAR SESION: CORREO: azanza@lore.com CONTRASEÑA: Warframe12$
                  -DATOS DE ENCARGADO YA INGRESADO PARA INICIAR SESION: CORREO: josepere@gmail.com CONTRASEÑA: Warframe12$
                  -DATOS DE CLIENTE YA INGRESADO PARA INICIAR SESION:  CORREO: azanzalorenzo@gmail.com CONTRASEÑA: Warframe12!

                  -AL CAMBIAR EL ROL DE UN USUARIO/CLIENTE DESDE EDITAR USUARIO/CLIENTE TAMBIEN SE DEBE CAMBIAR LA CONTRASEÑA O SE GUARDARA VACIO

                  -LOS ESTADOS PARA USUARIOS VEHICULOS Y CLIENTES SON A:ACTIVADO D:DESACTIVADO B:BORRADO LOS OBJETOS CON ESTADO A O D SE MOSTRARAN EN LAS LISTAS PERO LOS QUE TIENEN ESTADO B NO.

                  -PARA PODER ELIMINAR UN OBJETO DE LA BASE DE DATOS SE UTILIZA EL BOTON DE ELIMINAR DISPONIBLE EN LAS LISTAS, SI SE CAMBIA AL ESTADO B NO SE MOSTRARA EN LA LISTA PERO SEGUIRA EN LA BASE  

                  -LA UNICA MANERA DE AÑADIR UN NUEVO ADMINISTRADOR ES QUE EL USUARIO ADMINISTRADOR LO HAGA DESDE INGRESAR_USUARIOS

                  - SOLO LOS CLIENTES PODRAN ENVIAR UN FORMULARIO AL SOPORTE Y SOLO LOS CLIENTES PODRAN RESERVAR VEHICULOS.

                  -RESERVAS SOLO TIENE 2 ESTADOS, A O D.

                  -SOLO USUARIOS O CLIENTES CON ESTADO A PUEDEN ACCEDER A LA PAGINA

                  -SI UN VEHICULO NO ESTA DISPONIBLE SE HACE UNA RECOMENDACIÓN BASADA EN EL PRECIO PARA BUSCAR UN VEHICULO SIMILAR.

                  -SI UN VEHICULO NO ESTA EN ESTADO A NO SE PUEDE ALQUILAR.
////////////EXPLICACION DE CADA CARPETA Y ARCHIVO///////////////////////






///CARPETA COMANDOS////-Contiene los controladores utilizados y comandos.

Comandos/controladores/controlador_instalacion.php En esta ruta se encuentra el controlador para la instalacion del proyecto.

///CARPETA CONFIGURACION////- Contiene el archivo de configuracion de la base de datos

Configuracion/db.php

//CARPETA DOCUMENTACION/// -Contiene toda la documentacion del proyecto Guia/Diagramas/Normalizacion etc.

Documentacion/Base_Datos -  Contiene Entidad_relacion, normalizacion de la base de dato y un archivo tablas.sql con los codigos de las tablas para hacer una instalacion manual si es necesario.

Documentacion/Diagramas - Diagramas del funcionamiento

Documentacion/readme.md - Toda la informacion sobre el proyecto 

///CARPETA MODELOS/// -Contiene la mayor parte del backend de la pagina

Modelos/BDClientes.php - Contiene la clase cliente la cual tiene todos los metodos/funciones utilizados para interactuar con la tabla clientes de la base de datos
BDFormulario.php -  Contiene la clase formulario la cual tiene todos los metodos/funciones utilizados para interactuar con la tabla formulario de la base de datos
BDReserva.php -  Contiene la clase reserva la cual tiene todos los metodos/funciones utilizados para interactuar con la tabla reserva de la base de datos
BDVehiculos.php -  Contiene la clase vehiculos la cual tiene todos los metodos/funciones utilizados para interactuar con la tabla vehiculo de la base de datos
generico.php -  Contiene la clase generico la cual tiene algunos metodos/funciones generales que son reutilizados con frecuencia.
tipo_usuario.php -  Contiene la clase tipo_usuario la cual tiene todos los metodos/funciones utilizados para interactuar con la tabla tipo_usuario de la base de datos

////CARPETA SENDEMAIL///// -Contiene el codigo relacionado con el envio de correos electronicos, tanto el backend para realizar el envio y el frontend con la vista- el envio se hace utilizando phpmailer- el cual no fue instalado con composer para tener menos archivos en el proyecto.

phpmailer-> Contiene todos los archivos de phpmailer
enviar.php-> Contiene la logica utilizada para realizar el envio al correo electronico.
formulario.php-> Contiene el frontend de formulario y logica adicional.

///CARPETA TMP/// - Contiene imagenes tmp que se pueden generar al agregar vehiculos.

//CARPETA VISTAS///- Contiene la mayor parte del frontend que sera visible al usuario y partes de logica.

borrar_clientes.php -> Esta pagina permite al usuario borrar un cliente de la base de datos después de una confirmación. También proporciona mensajes de éxito o error dependiendo del resultado de la operación de eliminación.
borrar_reservas.php->  Esta pagina permite al usuario borrar una reserva de la base de datos después de una confirmación. También proporciona mensajes de éxito o error dependiendo del resultado de la operación de eliminación.
borrar_tipoUsuario.php->  Esta pagina permite al administrador borrar un usuario de la base de datos después de una confirmación. También proporciona mensajes de éxito o error dependiendo del resultado de la operación de eliminación.
borrar_vehiculos.php->  Esta pagina permite al usuario borrar un vehiculo de la base de datos después de una confirmación. También proporciona mensajes de éxito o error dependiendo del resultado de la operación de eliminación.
clientes.php -> Esta pagina permite ver una lista de los clientes A o D disponibles con botones para agregar eliminar o editar clientes.
editar_clientes.php->  Esta paginapermite al usuario editar un cliente de la base de datos. También proporciona mensajes de éxito o error dependiendo del resultado de la operación de edición.
editar_reservas.php->  Esta pagina permite al usuario editar una reserva de la base de datos. También proporciona mensajes de éxito o error dependiendo del resultado de la operación de edición.
editar_tipoUsuario.php->  Esta pagina permite al administrador editar un usuario de la base de datos. También proporciona mensajes de éxito o error dependiendo del resultado de la operación de edición.
editar_vehiculos.php-> Esta pagina permite al usuario editar un vehiculo de la base de datos. También proporciona mensajes de éxito o error dependiendo del resultado de la operación de edición.
ingresar_clientes.php-> Esta pagina permite al usuario ingresar un cliente a la base de datos. También proporciona mensajes de éxito o error dependiendo del resultado de la operación.
ingresar_reservas.php-> Esta pagina permite al usuario ingresar una reserva a la base de datos. También proporciona mensajes de éxito o error dependiendo del resultado de la operación.
ingresar_usuarios.php-> Esta pagina permite al administrador ingresar un usuario a la base de datos. También proporciona mensajes de éxito o error dependiendo del resultado de la operación.
ingresar_vehiculos.php-> Esta pagina permite al usuario ingresar un vehiculo a la base de datos. También proporciona mensajes de éxito o error dependiendo del resultado de la operación.
layout_admin.php-> Esta página muestra el layout de administrador con todas las opciones disponibles para su rol.
layout_encargado.php-> Esta página muestra el layout de encargado con todas las opciones disponibles para su rol.
layout_vendedor.php-> Esta página muestra el layout de vendedor con todas las opciones disponibles para su rol.
layout.php-> Esta página muestra el layout de clientes con todas las opciones disponibles para su rol.
perfil_usuarios.php -> Esta pagina muestra y permite la edicion de datos del usuario.
perfil.php -> Esta pagina muestra y permite la edicion de datos del cliente.
principal.php-> Esta pagina contiene el contenido principal de la pagina web.
reservar.php-> Esta pagina permite al cliente concretar una reserva del vehiculo seleccionado.
reservas.php-> Esta pagina permite a un usuario ver la listas de reservas actuales, tambien con botones para agregar editar o eliminar reservas.
tipo_usuario.php-> Esta pagina permite al administrador ver la listas de usuarios activos o desactivados, tambien con botones para agregar editar o eliminar usuarios.
vehiculos_venta.php -> Esta pagina muestra todos los vehiculos disponibles para que el cliente pueda realizar una reserva, puede filtrar los vehiculos.
vehiculos.php -> Esta pagina muestra al usuario todos los vehiculos con estado A o D, tambien con botones para agregar editar o eliminar vehiculos.

///CARPETA WEB//-  Contiene los complementos para la pagina web js/css/img

web/archivos -> aqui se almacenan las imagenes usadas para los vehiculos.
web/img -> aqui se almacenan las imagenes utilizadas en backgrounds o de iconos.

//ARCHIVOS SIN CARPETA///

.gitignore -> archivo utilizado para ignorar al subir a github
comandos.php -> Es el punto de entrada para el sistema de manejo de comandos, y su función principal es iniciar el proceso de enrutamiento y ejecución de comandos según lo definido en routerComandos.php.
index.php -> Este archivo asegura que los usuarios solo puedan acceder al sistema si han iniciado sesión correctamente.
login.php -> Es responsable de gestionar el proceso de inicio de sesión. Verifica las credenciales ingresadas por el usuario, valida el inicio de sesión tanto para tipos de usuario como para clientes y luego redirige al usuario a la página de inicio sistema.php si el inicio de sesión es exitoso. Si el inicio de sesión falla, muestra un mensaje de error y permite al usuario intentarlo nuevamente o registrarse.
logout.php ->Se utiliza para cerrar la sesión del usuario en el sistema. 
registro.php -> Se utiliza para registrar nuevos usuarios en el sistema. Valida los datos ingresados en el formulario de registro, realiza las validaciones necesarias y, si todo es correcto, registra al usuario en la base de datos
router.php->Se utiliza para enrutar las solicitudes del usuario a las páginas o componentes correspondientes en función del valor del parámetro "r" en la URL.
sistema.php->Se encarga de dirigir al usuario a la interfaz de usuario adecuada en función de su rol y nivel de acceso en el sistema.











/////////////GUIA DE USO///////////


-Primero realizar la instalacion utilizando el controlador instalador o ingresando manualmente las tablas.sql
--LOGIN---
-La primera pagina que se encontrara es login.php. 
Tiene un campo para el correo y para la contraseña, un boton para ingresar y otro para registrarse.
En el caso de querer loguearse utilizar la cuenta de administrador proporcionada anteriormente.

En el caso de querer registrarse darle al boton de registrarse.

--REGISTRO--

Contiene todos los campos necesarios para registrarse, ninguno puede quedar vacio y todos tienen un formato.
-El nombre y apellido no pueden contener numeros.
- El telefono no puede contener letras.
-El email debe tener el formato de email @ y .
- La contraseña tiene que contener 1 mayuscula 1 numero y 1 caracter especial, en el caso de no contener alguno se mostrara un mensaje con los caracteres disponibles.
- Confirmar contraseña las contraseñas deben ser identicas.
-Numero de documento no puede contener letras.
Rol y estado son campos ya predefinidos.

Luego de completar los datos le da al boton registrar y si lo logro exitosamente ya puede ingresar a traves del login.


--PAGINA PRINCIPAL---

VISTAS

Aqui se veran mensajes y botones interactivos para distintas partes de la pagina


Ver vehiculos- redireccion hacia la lista de vehiculos disponibles para alquilar. (SOLO ES POSIBLE REALIZAR UNA RESERVA SI ES UN CLIENTE)
Escribe un formulario- redireccion para realizar un formulario (SOLO ES POSIBLE SI ES UN CLIENTE)
Consultar- Redireccion para consultar reservas activas (SOLO LO PUEDE UTILIZAR UN CLIENTE)

BOTONES DE NAVBAR

//DISPONIBLE PARA CLIENTES Y USUARIOS///

CUENTA- menu desplegable con las opciones salir para hacer un logout o perfil para editar sus datos.
      Perfil- Aqui estaran todos sus datos para editar con botones  de guardar o cancelar, la edicion de contraseña tiene botones aparte, sigue las mismas reglas que el registro aqui tambien debe ingresar su contraseña actual.

      //OPCION SOLO DISPONIBLE PARA ADMINISTRADORES, ENCARGADOS

Vehiculos (opcion de la derecha)- Obtendra una vista que contiene una lista de vehiculos en la base de datos , puede añadir editar o borrar vehiculos con sus respectivos botones.
        Nuevo - Puede añadir un vehiculo colocando los campos correspondientes y subiendo una imagen.
       boton Editar- Puede editar los campos del vehiculo seleccionado.
       boton borrar- Puede eliminar el vehiculo seleccionado.

////OPCION DISPONIBLE PARA ADMINISTRADORES, ENCARGADOS Y VENDEDORES

Alquileres- Aqui tiene una lista de las reservas  - con los botones para editar agregar o eliminar.

//OPCION DISPONIBLE PARA ADMINISTRADORES

Usuarios- Lista de usuarios - con sus botones para añadir eliminar y editar.

//OPCION DISPONIBLE PARA ADMINISTRADORES VENDEDORES Y ENCARGADOS

Clientes- Lista de clientes- con sus botones para añadir eliminar y editar.

Logo RentACar- lo redirige a la pagina principal.

//OPCION PARA CLIENTES LOS OTROS PUEDEN ACCEDER PERO NO REALIZAR RESERVAS

Vehiculos- Muestra los vehiculos disponibles para su alquiler con sus datos y imagenes, se puede filtrar por color,tipo,pasajeros,precio maximo, una vez seleccionada las especificaciones deseadas darle al boton buscar.
Una vez con el vehiculo deseado darle al boton reservar. Lo redirige a una vista para completar la reserva del vehiculo seleccionando fechas, luego al darle al boton reservar
le dara el precio que debe pagar segun la cantidad de dias y un mensaje de reserva completada, en el caso que el vehiculo este desactivado obtendra un mensaje de vehiculo no disponible, si el vehiculo ya esta reservado
obtendra un mensaje con una oferta de precio similar.

//OPCION PARA CLIENTES LOS OTROS PUEDEN ACCEDER PERO NO REALIZARLO

Formulario- Formulario de contacto ya tendra los campos de email y nombre completados automaticamente con sus datos, debera ingresar el asunto y el mensaje, una vez completado presionar el boton enviar, saldra una
advertencia de formulario enviado y se le enviara un correo de agradecimiento.