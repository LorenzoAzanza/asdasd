<!DOCTYPE html>
  <html>
    <head>
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="web/css/materialize.min.css"  media="screen,projection"/>

      <!--Let browser know website is optimized for mobile-->
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
      </style>
    </head>

    <body>
      
    <nav>
    <div class="nav-wrapper #2196f3 blue">
      <a href="sistema.php?r=layout" class="brand-logo center"><i class="material-icons">local_taxi</i>RentACar</a>
      <ul class="right hide-on-med-and-down">
        <li><a href="sistema.php?r=formulario"><i class="material-icons">message</i>Formulario</a></li>
        <li><a href="sistema.php?r=perfil"><i class="material-icons">person</i>Perfil</a></li>
        <li><a href="sistema.php?r=vehiculos"><i class="material-icons">directions_car</i>Vehiculos</a></li>
      </ul>
    </div>
  </nav>
      <main>
        
        <div class="container">
        
            <?php include("router.php"); ?>
        </div>
      </main>

      <footer class="page-footer #2196f3 blue">
          
          </div>
          <div class="footer-copyright">
            <div class="container">
            © 2014 Copyright Text
            <a class="grey-text text-lighten-4 right" href="#!">More Links</a>
            </div>
          </div>
        </footer>
      
      
      <!--JavaScript at end of body for optimized loading-->
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