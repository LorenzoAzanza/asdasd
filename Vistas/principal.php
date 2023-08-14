<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" media="screen,projection">
    <title>Rentadora de Vehículos</title>
</head>
<body style="background-image: url('web/img/pexels-fondo.webp'); background-size:2100px 1115px;">


<!-- Contenido Principal -->
<div class="container">
    <div class="row">
        <div class="col s18">
            <div class="card-panel red lighten-2">
                <div class="card-content black-text center-align">
                    <h1 class="black-text text-darken-3">
                      <span class="black-text">Bienvenido a</span> <span class="white-text">RentACar</span></h1>
                    <p class="flow-text">Encuentra el vehículo perfecto para tus necesidades de alquiler.</p>
                </div>
            </div>
        </div>
    </div>
</div>

    <div class="row">
    <div class="col s12 m6">
    <div class="card-panel red lighten-2">
        <div class="card-image">
            <img src="web/img/pexels-inicio.webp" width="560" height="400" alt="Explora nuestros Vehículos">
        </div>
        <div class="card-content black-text"> <!-- Cambiado a black-text para texto negro -->
            <span class="card-title black-text">Explora nuestros Vehículos</span>
            <p class="black-text">Descubre nuestra amplia flota de vehículos disponibles para alquiler.</p>
        </div>
        <div class="card-action">
            <a class="btn blue" href="sistema.php?r=vehiculos_venta"> <!-- Cambiado a btn blue para botón azul -->
                Ver Vehículos
            </a>
        </div>
    </div>
</div>

<div class="col s12 m4">
    <div class="card-panel red lighten-2">
        <div class="card-image">
            <img src="web/img/pexels-formulario.webp" alt="Formulario" class="responsive-img">
        </div>
        <div class="card-content black-text">
            <span class="card-title">Formulario</span>
            <p>Completa nuestro formulario y contáctanos para obtener más información.</p>
        </div>
        <div class="card-action">
            <a class="btn blue" href="sistema.php?r=formulario">
                Escribe un formulario
            </a>
        </div>
    </div>
</div>
<div class="col s12 m4">
    <div class="card-panel red lighten-2">
        <div class="card-image">
            <img src="web/img/pexels-reserva.webp" width="360" height="140" alt="Reserva">
        </div>
        <div class="card-content black-text">
            <span class="card-title">Consulta tu reserva</span>
            <p>Puedes consultar si tienes alguna reserva</p>
        </div>
        <div class="card-action">
            <a class="btn blue" href="sistema.php?r=reservas">
                Consultar
            </a>
        </div>
    </div>
</div>
    </div>
</div>


<div class="container">
    <div class="row">
    <div class="col s12 center">
    <h2 class="red lighten-2">¡Descubre por qué somos la mejor opción!</h2>
    <p class="red lighten-2 flow-text">Ofrecemos una experiencia de alquiler de vehículos única y conveniente.</p>
</div>
<div class="col s12 m4">
            <div class="card-panel red lighten-2">
                <span class="black-text">Flota Variada
                    <p>Desde vehículos compactos hasta SUVs de lujo.</p>
                </span>
            </div>
        </div>
        <div class="col s12 m4">
            <div class="card-panel red lighten-2">
                <span class="black-text">Atención Personalizada
                    <p>Nuestro equipo está aquí para ayudarte en cada paso del camino.</p>
                </span>
            </div>
        </div>
        <div class="col s12 m4">
            <div class="card-panel red lighten-2">
                <span class="black-text">Reservas en Línea
                    <p>Haz tu reserva de manera rápida y sencilla a través de nuestra plataforma en línea.</p>
                </span>
            </div>
        </div>
    </div>
</div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.parallax');
        var instances = M.Parallax.init(elems, {});
    });
</script>
</body>
</html>
