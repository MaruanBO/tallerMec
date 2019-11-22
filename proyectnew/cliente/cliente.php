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
    
    <title>Panel | Cliente</title>
  </head>
  <body>
  <?php
    session_start(); 
    if (empty($_SESSION['cliente'])){
      header("Location:../login.php");
    } 
    else {
      require_once '../Conn.php';
      require_once '../clases/Login.php';
      $cliente = new Login();
      $cliente->cliente($_SESSION['cliente']);
      require_once 'menuCliente.php';
  ?>
    <!-- Resto de código aqui -->
      <body>
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="alert alert-primary m-2" role="alert">
                Bienvenido, <?php echo $cliente->getNombre() ?>!
              </div>
            </div>
          </div>
        </div>      
      </body>
    <!-- /Resto de código aqui/ -->
    <?php
      require_once '../footer.php';
    } //No borrar
    ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../vendor/jquery-3.3.1.slim.min.js"></script>
    <script src="../vendor/popper.min.js"></script>
    <script src="../vendor/bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
  </body>
</html>