<!DOCTYPE html>
  <html>
    <head>
 
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link type="text/css" rel="stylesheet" href="web/css/materialize.min.css"  media="screen,projection"/>
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      
      
      <style>
         body {
                display: flex;
                min-height: 100vh;
               flex-direction: column;
          }

          main {
              flex: 1 0 auto;
          }

          .enlace-icono {
            display: flex;
            align-items: center;
            
          }

 
    

      </style>
    </head>

    <body>
      
        <nav>
          <div class="nav-wrapper red lighten-2">
            <a href="sistema.php" class="brand-logo center"><i class="material-icons">local_taxi</i>RentACar</a>
            <ul class="right hide-on-med-and-down">
                <li><a href="sistema.php?r=clientes" class="enlace-icono black-text"><img src="web/img/grupo-de-chat.png" width="30" height="30">Clientes</a></li>
                <li><a href="sistema.php?r=reservas" class="enlace-icono black-text"><img src="web/img/icons8-reserva-50.png" width="30" height="30">Alquileres</a></li>
                <li><a href="sistema.php?r=vehiculos" class="enlace-icono black-text"><img src="web/img/servicio.png" width="30" height="30">Vehículos</a></li>
                <li><a class='dropdown-trigger btn green lighten-2 black-text' href='#' data-target='dropdown1'><img src="web/img/avatar.png" width="30" height="30">Cuenta</a></li>
              <ul id='dropdown1' class='dropdown-content'>
                <li><a class="red-text" href="logout.php"><i class="material-icons red-text">close</i>Salir</a></li>
                <li><a href="sistema.php?r=perfil_usuarios" class="black-text"><i class="material-icons">edit</i>Perfil</a></li>
          
              </ul>
            </ul>
            <ul class="left hide-on-med-and-down">
                <li><a href="sistema.php?r=formulario" class="enlace-icono black-text"><img src="web/img/formulario-de-contacto.png" width="30" height="30">Formulario</a></li>
                <li><a href="sistema.php?r=vehiculos_venta" class="enlace-icono black-text "><img src="web/img/auto-limpio.png" width="30" height="30">Vehículos</a></li>
            </ul>
          </div>



        </nav>
    <main>
        
      <div class="container">
          <?php include("router.php"); ?>
      </div>
    </main>

      <footer class="page-footer red lighten-2">
          <div class="footer-copyright">
            <div class="container">
            © 2023 RentACar Copyright 
            
            </div>
          </div>
      </footer>
      
      <script type="text/javascript" src="web/js/materialize.min.js"></script>
      <script>
         document.addEventListener('DOMContentLoaded', function() {
              M.AutoInit();
              var elems = document.querySelectorAll('.sidenav');
              var instances = M.Sidenav.init(elems, options);
      });

      </script>
    </body>
  </html>