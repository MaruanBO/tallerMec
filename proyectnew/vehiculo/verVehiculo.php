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
    
    <title>Vehiculo | Mostrar datos</title>
  </head>
  <body>
    <?php
      //require 'menuVehic.php';
      require_once '../Conn.php';
      require_once 'vehiculos.php';   
        
        $user = new vehiculos();
        $user->load($_POST['dni']);
        if (isset($_POST['borrador'])) {
          $user->borrar($_POST['borrador']);
        }
        if (isset($_POST['vmodificar'])){
          $user->verModificar($_POST['vmodificar']);
        }
        if (isset($_POST['modificar'])){
          $user->modificar($_POST['modificar']);
        }
    ?>
    

    <?php
      //require '../footer.php';
    ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../vendor/jquery-3.3.1.slim.min.js"></script>
    <script src="../vendor/popper.min.js"></script>
    <script src="../vendor/bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
  </body>
</html>