<!DOCTYPE html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="vendor/bootstrap-4.3.1-dist/css/bootstrap.min.css">
    <!-- FontAwesome CSS -->
    <link rel="stylesheet" href="vendor/fontawesome-5.11.2/css/all.min.css">
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="">
    <style> 
  .carousel-inner img {
      width: 100%;
      height: 100%;
  }

#myCarousel .carousel-indicators {
    position: static;
    margin-top:20px;
}

#myCarousel .carousel-indicators > li {
  width:100px;
}

 #myCarousel .carousel-indicators li img {
    display: block;
    opacity: 0.5;
 }

  #myCarousel .carousel-indicators li.active img {
    opacity: 1;
  }

  #myCarousel .carousel-indicators li:hover img {
    opacity: 0.75;
  }
      }
      
    </style>
    
    <title>Inicio | Taller</title>
  </head>
  <body>
    <header>
      <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <a class="navbar-brand" href="http://localhost/ejer/objet/poo/proyectnew/index.php">Taller</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
          <ul class="navbar-nav mr-auto text-center">
            <li class="nav-item active">
              <a class="nav-link" href="http://localhost/ejer/objet/poo/proyectnew/index.php">Inicio <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="http://localhost/ejer/objet/poo/proyectnew/login.php">Iniciar Sesión</a>
            </li>
          </ul>
        </div>
      </nav>
    </header>

    <p>CAROUSEL</p>

    <?php
      require_once 'footer.php';
    ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="vendor/jquery-3.3.1.slim.min.js"></script>
    <script src="vendor/popper.min.js"></script>
    <script src="vendor/bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
  </body>
</html>