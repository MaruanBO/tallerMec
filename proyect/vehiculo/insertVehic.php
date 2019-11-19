<!DOCTYPE html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../vendor/bootstrap-4.3.1-dist/css/bootstrap.min.css">
    <!-- FontAwesome CSS -->
    <link rel="stylesheet" href="../vendor/fontawesome-5.11.2/css/all.min.css">
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="">
    
    <title>Vehiculo | Registrar </title>
  </head>
  <body>
    <?php
      require '../header.php';
      require 'menuVehic.php';
    ?>
    
    <div class="container border border-info mt-2 mb-2 bg-white">
        <div class="row pb-3">
            <div class="col-12"></div>
        </div>
        <div class="container row border-bottom border-info pb-3 pt-3">
            <div class="col-12 col-md-6 offset-md-3 border border-success rounded bg-light">
                <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" name="">
                    <div class="form-group mb-2">
                        <h1 class="text-center">Formulario</h1>
                        <label for="dni">DNI*</label>
                        <input type='text' class="form-control" name='dni' id="dni" minlength="9" maxlength="9" required>
                    </div>
                    <div class="form-group mb-2">
                        <label for="matricula">Matricula*</label>
                        <input type='text' class="form-control" name='matricula' id="matricula" minlength="7" maxlength="8" required>
                    </div>
                    <div class="form-group mb-2">
                        <label for="marca">Marca*</label>
                        <input type='text' class="form-control" name='marca' id="marca" maxlength="10" required>
                    </div>
                    <div class="form-group mb-2">
                        <label for="modelo">Modelo*</label>
                        <input type='text' class="form-control" name='modelo' id="modelo" maxlength="10" required>
                    </div>
                    <div class="form-group mb-2">
                        <label for="tipo">Tipo*</label>
                        <select id="tipo" >
                            <option>Coche</option>
                            <option>Moto</option>
                        </select>
                    </div>
                    <div class="form-group mb-2">
                        <label for="gama">Gama*</label>
                        <select id="gama">
                            <option>Baja</option>
                            <option>Media</option>
                            <option>Alta</option>
                        </select>
                    </div>
                    <p> <input type="submit" class="btn btn-primary w-100" name='registrar' value="Registrar"></p>
                </form>
            </div>
        </div>
    </div>

    <?php
      require '../footer.php';
    ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../vendor/jquery-3.3.1.slim.min.js"></script>
    <script src="../vendor/popper.min.js"></script>
    <script src="../vendor/bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
  </body>
</html>
