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
    <!-- JavaScript-->
    <script src="../vendor/functions.js"></script>
    
    <title>Cliente | Mostrar datos</title>
  </head>
  <body>
    
    <?php
      if (empty($_SESSION['cliente'])){
        header("Location:../login.php");
      } 
      
      require_once '../Conn.php';
      require_once '../clases/Login.php';
      $cliente = new Login();
      $cliente->cliente($_SESSION['cliente']);
      require_once 'menuCliente.php';

      class modClient extends Conn {
        public function __construct() {
          parent::__construct();
        }

        public function verModificar(){
          $result = $this->connection->prepare('SELECT * FROM clientes WHERE dni = ?');
            $result->bindParam('1', $_SESSION['cliente']);
            $result->execute();
            $row = $result->fetch(PDO::FETCH_ASSOC);

            echo '<div class="container border border-info mt-2 mb-2 bg-white" id="unlock">
                <div class="row pb-3">
                  <div class="col-12"></div>
                </div>
                <div class="container row border-info pb-3 pt-3">
                  <div class="col-12 col-md-6 offset-md-3 border border-success rounded bg-light">
                    <form method="POST" name="">
                      <div class="form-group mb-2">
                        <label for="dni">DNI*</label>
                        <input type="text" class="form-control" name="dni" id="dni" title="e.g 11111111N" pattern="(([X-Z]{1})([-]?)(\d{7})([-]?)([A-Z]{1}))|((\d{8})([-]?)([A-Z]{1}))" required readonly value="'.$row["dni"].'"}">
                      </div>
                      <div class="form-group mb-2">
                        <label for="nombre">Nombre*</label> 
                        <input type="text" name="nombre" id="nombre" class="form-control" title="e.g Pepe Gonzales Morales" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,25}[ ]{1}[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ ]{2,25}"  required value="'.$row["nombre"].'"}">
                      </div>
                      <div class="form-group mb-2">
                        <label for="telefono">Teléfono*</label>
                        <input type="text" class="form-control" name="telefono" id="telefono" title="e.g 666666666" pattern="[0-9]{9}" required value="'.$row["telefono"].'"}">
                      </div>
                      <p> <input type="submit" class="btn btn-primary w-50 pr-3" name="modificar" value="Modificar"></p>
                    </form>
                  </div>
                </div>
              </div>';
        }

        public function modificar($nombre,$telefono,$dni) {
          $result = $this->connection->prepare("UPDATE clientes SET nombre =?, telefono =? WHERE dni =?");
          $result->bindParam('1', $nombre); 
          $result->bindParam('2', $telefono);
          $result->bindParam('3', $dni); 
          if($result->execute()){
              return modClient::verModificar().'<div class="alert alert-success mt-2" role="alert">
                    ¡Cliente actualizado correctamente!
                  </div>';
          }          
        }  
      }

      $user = new modClient();
      if(isset($_POST["modificar"])) {
        echo $user->modificar($_POST['nombre'],$_POST['telefono'],$_SESSION["cliente"]);
      } else {
        $user->verModificar();
      }
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