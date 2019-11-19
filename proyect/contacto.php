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
    
    <title>Contacto | Problema </title>
  </head>
  <body>
    <?php
      require 'header.php';
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
                        <label for="problema">Problema</label><br>
                        <textarea id="problema" placeholder="Redacta tu problema" rows="4" cols="40" required></textarea>
                    </div>
                    <p> <input type="submit" class="btn btn-primary w-100" name='registrar' value="Enviar"></p>
                </form>
            </div>
        </div>
    </div>

    <?php
      require 'footer.php';
    ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="vendor/jquery-3.3.1.slim.min.js"></script>
    <script src="vendor/popper.min.js"></script>
    <script src="vendor/bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
  </body>
</html>
