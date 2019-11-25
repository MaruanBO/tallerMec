<?php 
  session_start(); 
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="../imgs/factura.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../vendor/bootstrap-4.3.1-dist/css/bootstrap.min.css">
    <!-- FontAwesome CSS -->
    <link rel="stylesheet" href="../vendor/fontawesome-5.11.2/css/all.min.css">
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="../vendor/styles.css">
    
    <title>Panel | Cliente </title>
  </head>
  <body>
  <?php
    if (empty($_SESSION['cliente'])){
      header("Location:../login.php");
    } 
    else {
      require_once '../Conn.php';
      require_once '../class/validateLogin.php';      
      $cliente = new ValidateLogin();
      $cliente->cliente($_SESSION['cliente']);
      require_once 'menuCliente.php';
  ?>
    <body>
      <div class="container-fluid bg-white">
        <div class="row">
          <div class="col-12">
            
            <?php
            if (empty($_POST)) {
              echo "<div class='alert alert-primary m-2 bg-light' role='alert'>Bienvenido,". $cliente->getNombre()." !</div>";
            }
            require_once '../class/classClient.php';
            require_once '../class/ClassReparar.php';

            $cliente = new allClient();
            $reparar = new ClassReparar();

            if(isset($_POST['ver'])){
              $cliente->showClient();
            }

            if(isset($_POST["cmodificar"])) {
                $cliente->verModificarCliente();
            }
            
            if(isset($_POST["modificarCliente"])) {
            $cliente->modificarCliente($_POST['nombre'],$_POST['telefono'],$_SESSION["cliente"]);
            }

            if (isset($_POST['verFactura'])) {
              $dni = $_POST['verFactura'];
              $reparar->cargaFacturas($dni);
            } 
            
            if(isset($_POST['car'])){
            $cliente->showCar($_SESSION['cliente']);
            }

            if(isset($_POST["vmodificar"])) {
              $cliente->verModificarCoche();
            }

            if(isset($_POST["modificarVehicle"])) {
              echo $cliente->modificarCoche($_POST["dni_c"],$_POST["matricula"],$_POST["marca"],$_POST["modelo"],$_POST["tipo"],$_POST["gama"]);
            }

            ?>



          </div>
        </div>
      </div>
    </body>
    <?php
      require_once '../footer.php';
    }
    ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../vendor/jquery-3.3.1.slim.min.js"></script>
    <script src="../vendor/popper.min.js"></script>
    <script src="../vendor/bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
  </body>
</html>