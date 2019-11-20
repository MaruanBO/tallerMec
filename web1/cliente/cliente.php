<?php 
  session_start(); 
?>
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
      require_once 'menuCliente.php';
      require_once '../Conn.php';

      class Cliente extends Conn {

        public function __construct() {
          parent::__construct();
        }

        public function getNombre(){
          $result = $this->connection->prepare('SELECT * FROM clientes WHERE dni = ?');
          $result->bindParam('1', $_SESSION['cliente']);
          $result->execute();
          $row = $result->fetch(PDO::FETCH_ASSOC);
          return $row["nombre"];
        }
      }

      $cliente = new Cliente();
    ?>
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
    <?php
      require_once '../footer.php';
    ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../vendor/jquery-3.3.1.slim.min.js"></script>
    <script src="../vendor/popper.min.js"></script>
    <script src="../vendor/bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
  </body>
</html>