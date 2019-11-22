<?php
    session_start();
?>
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

    if (empty($_SESSION['cliente'])){
        header("Location:../login.php");
      } 

      require_once '../Conn.php';
      require_once '../clases/validateLogin.php';
      $cliente = new validateLogin();
      $cliente->cliente($_SESSION['cliente']);
      require_once 'menuCliente.php';
      require_once '../clases/classClient.php';
      $cliente = new allClient();
      $cliente->showCar($_SESSION['cliente']);

    
    ?>
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