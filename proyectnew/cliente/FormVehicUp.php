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
    
    <title>Cliente | Mostrar datos</title>
  </head>
  <body>
    
    <?php
    session_start();
      
      require 'menuCliente.php';
      require_once 'conn.php';

class vehiclesUpdate extends Conn {

    public function __construct() {
        parent::__construct();
    }
    public function verModificar(){
        $result = $this->connection->prepare('SELECT * FROM vehiculos WHERE dni_c = ?');
        $result->bindParam('1', $_SESSION['cliente']);
        $result->execute();
        $row = $result->fetch(PDO::FETCH_ASSOC);
        echo '<div class="container border border-info mt-2 mb-2 bg-white">
                <div class="row pb-3">
                    <div class="col-12"></div>
                </div>
                <div class="container row border-bottom border-info pb-3 pt-3">
                    <div class="col-12 col-md-6 offset-md-3 border border-success rounded bg-light">
                        <form method="POST" name="" action="vehicleUpdate.php">
                            <div class="form-group mb-2">
                                <h1 class="text-center">Formulario</h1>
                                <label for="dni">DNI*</label>
                                <input value="'.$row["dni_c"].'" type="text" class="form-control" disabled id="dni_c" required>
                            </div>
                            <div class="form-group mb-2">
                                <label for="nombre">Matricula*</label> 
                                <input value="'.$row["matricula"].'" type="text"  disabled id="matricula" class="form-control" title="e.g 0000FPZ" pattern="[0-9]{4}[A-Z]{3,4}" required>
                            </div>
                            <div class="form-group mb-2">
                                <label for="nombre">Marca*</label> 
                                <input value="'.$row["marca"].'" type="text" name="marca" id="marca" class="form-control" title="e.g Pepe Gonzales Morales" pattern="[A-Za-z]{1,10}" required>
                            </div>
                            <div class="form-group mb-2">
                                <label for="nombre">Modelo*</label> 
                                <input value="'.$row["modelo"].'" type="text" name="modelo" id="modelo" class="form-control" title="e.g Pepe Gonzales Morales" pattern="[A-Za-z]{1,10}" required>
                            </div>
                            <div class="form-group mb-2">
                                <label for="nombre">Tipo*</label> 
                                <input value="'.$row["tipo"].'" type="text" name="tipo" id="tipo" class="form-control" title="e.g Pepe Gonzales Morales" pattern="[A-Za-z]{1,10}" required>
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
}

    $vehicle = new vehiclesUpdate();
    $vehicle->verModificar();

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