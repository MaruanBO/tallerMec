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
    
    <title>Panel | Empleado </title>
  </head>
  <body>
    <header>
      <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <a class="navbar-brand" href="http://localhost/web1/admin.php">Empleado</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav mr-auto text-center">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarCliente" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Cliente
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarCliente">
                <a class="dropdown-item" href="#">Agregar</a>
                <a class="dropdown-item" href="#">Ver</a>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarVehiculo" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Vehiculo
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarVehiculo">
                <a class="dropdown-item" href="#">Agregar</a>
                <a class="dropdown-item" href="#">Ver</a>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarFactura" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Factura
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarFactura">
                <a class="dropdown-item" href="#">Agregar</a>
                <a class="dropdown-item" href="#">Ver</a>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="http://localhost/web1/catalogo.php">Catálogo</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="http://localhost/web1/logout.php">Cerrar Sesión</a>
            </li>
          </ul>
        </div>
      </nav>
    </header>
    <body>
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="alert alert-primary m-2" role="alert">
              Bienvenido, <?php //Nombre usuario ?>!
            </div>
          </div>
        </div>
      </div>
    </body>
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