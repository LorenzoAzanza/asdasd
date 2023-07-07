<!DOCTYPE html>
  <html>
    <head>
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="web/css/materialize.min.css"  media="screen,projection"/>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>

    <body>
      
      <nav>
        <div class="nav-wrapper #1e88e5 blue darken-1">
          <a href="#!" class="brand-logo center">Car</a>
          <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
          <ul class="right hide-on-med-and-down">
                <li><a href="sass.html">Sass</a></li>
                <li><a href="badges.html">Components</a></li>
                <li><a href="collapsible.html">Javascript</a></li>

                <li>
                  <a href="mobile.html">
                    Perfil <span class="badge"><i class="material-icons white-text">person</i>
                  </a>

                </li>
          </ul>
        </div>
      </nav>

      <ul class="sidenav" id="mobile-demo">
            <li><a href="sass.html">Sass</a></li>
            <li><a href="badges.html">Components</a></li>
            <li><a href="collapsible.html">Javascript</a></li>
            <li><a href="mobile.html">Mobile</a></li>
      </ul>
      
        <h1>Hola arranco el proyecto</h1>
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