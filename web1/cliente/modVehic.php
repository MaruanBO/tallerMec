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
    <!-- JavaScript-->
    <!--<script src="../vendor/functions.js"></script>-->
    
    <title>Vehiculo | Mostrar datos</title>
  </head>
  <body>
    <?php
      	require_once 'menuCliente.php';
      	require_once '../Conn.php';

      	class modVehic extends Conn {
          public function __construct() {
            parent::__construct();
          }
          public function verModificar(){
            /*if($matricula == $_SESSION['cliente']) {
              $result = $this->connection->prepare('SELECT * FROM vehiculos WHERE dni_c = ?');
              $result->bindParam('1', $matricula);
            } else {
              $result = $this->connection->prepare('SELECT * FROM vehiculos WHERE matricula = ?');
              $result->bindParam('1', $matricula);
            }*/
            $result = $this->connection->prepare('SELECT * FROM vehiculos WHERE dni_c = ? OR matricula = ?');
            $result->bindParam('1', $_SESSION['cliente']);
            $result->bindParam('2', $_POST["vmodificar"]);
            $result->execute();
            $row = $result->fetch(PDO::FETCH_ASSOC);
            
            echo '<div class="container border border-info mt-2 mb-2 bg-white">
                <div class="row pb-3">
                  <div class="col-12"></div>
                </div>
                <div class="container row border-info pb-3 pt-3">
                  <div class="col-12 col-md-6 offset-md-3 border border-success rounded bg-light">
                    <form method="POST" name="">
                      <div class="form-group mb-2">
                        <h1 class="text-center">Formulario</h1>
                        <label for="dni">DNI*</label>
                        <input value="'.$row["dni_c"].'" type="text" class="form-control" name="dni_c" id="dni_c" title="e.g 11111111N" pattern="(([X-Z]{1})([-]?)(\d{7})([-]?)([A-Z]{1}))|((\d{8})([-]?)([A-Z]{1}))" required readonly>
                      </div>
                      <div class="form-group mb-2">
                        <label for="nombre">Matricula*</label> 
                        <input value="'.$row["matricula"].'" type="text" name="matricula" id="matricula" class="form-control" title="e.g 0000FPZ" pattern="[0-9]{4}[A-Z]{3,4}" required readonly>
                      </div>
                      <div class="form-group mb-2">
                        <label for="nombre">Marca*</label> 
                        <input value="'.$row["marca"].'" type="text" name="marca" id="marca" class="form-control" title="e.g Pepe Gonzales Morales" pattern="[A-Za-z]{1,10}" required>
                      </div>
                      <div class="form-group mb-2">
                        <label for="nombre">Modelo*</label> 
                        <input value="'.$row["modelo"].'" type="text" name="modelo" id="modelo" class="form-control" title="e.g Pepe Gonzales Morales" pattern="[A-Za-z0-9]{1,10}" required>
                      </div>
                      <div class="form-group mb-2">
                        <label for="nombre">Tipo*</label> 
                          <input value="'.$row["tipo"].'" type="text" name="tipo" id="tipo" class="form-control" title="e.g Coche o Moto" pattern="[A-Za-z]{4,6}" required>
                      </div>
                      <div class="form-group mb-2">
                        <label for="nombre">Gama*</label> 
                        <select name="gama" id="gama" class="form-control" required>
                          <option selected>'.$row["gama"].'</option>
                            <option>Baja</option>
                            <option>Media</option>
                            <option>Alta</option>
                        </select>
                      </div>
                      <p> <input type="submit" class="btn btn-primary w-50 pr-3" name="modificar" value="Modificar"></p>
                    </form>
                  </div>
                </div>
              </div>'; 
            }

          public function modificar($dni_c,$matricula,$marca,$modelo,$tipo,$gama) {

            $result = $this->connection->prepare('UPDATE vehiculos SET marca= ?,modelo= ?,tipo= ?,gama= ? where matricula = ?');
            $result->bindParam('1', $marca);
            $result->bindParam('2', $modelo);
            $result->bindParam('3', $tipo);
            $result->bindParam('4', $gama);
            $result->bindParam('5', $matricula);
            $result->execute();

            return modVehic::verModificar().'
                  <div class="alert alert-success mt-2" role="alert">
                    ¡Empleado actualizado correctamente!
                  </div>'; 
          }
        		
      	}
        $user = new modVehic();
        
        if(isset($_POST["modificar"])) {
          echo $user->modificar($_POST["dni_c"],$_POST["matricula"],$_POST["marca"],$_POST["modelo"],$_POST["tipo"],$_POST["gama"]);
        } else {
          $user->verModificar();
        }

      	require '../footer.php';
    ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../vendor/jquery-3.3.1.slim.min.js"></script>
    <script src="../vendor/popper.min.js"></script>
    <script src="../vendor/bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
  </body>
</html>