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
      if (empty($_SESSION['cliente'])){
      header("Location:../login.php");
     }
      
      require '../menuCliente.php';
      require_once '../Conn.php';

class vehiclesData extends Conn {

    public function __construct() {
        parent::__construct();
    }

    public function showVehicle() {
                            
        $result = $this->connection->prepare('SELECT * FROM vehiculos where dni_c = ?');
        $result->bindParam('1', $_SESSION['cliente']);
        $result->execute();
        echo    
            '<table class="table table-hover">
                <tr>
                    <th>Matricula</th>
                    <th>DNI</th>
                    <th>marca</th>
                    <th>modelo</th>
                    <th>tipo</th>
                    <th>gama</th>
                </tr>';
                while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>".$row["matricula"]."</td>";
                    echo "<td>".$row["dni_c"]."</td>";
                    echo "<td>".$row["marca"]."</td>";
                    echo "<td>".$row["modelo"]."</td>";
                    echo "<td>".$row["tipo"]."</td>";
                    echo "<td>".$row["gama"]."</td>";
                    echo 
                        "<td><form method='post' class='mr-5' action='modVehic.php'>
                            <button class='btn btn-primary w-50 pr-3' 
                                type='submit' id='vmodificar' name='vmodificar'
                                    value='".$row["matricula"]."'>
                                    Modificar
                        </button>";

                }

        echo '</tr>';
        echo '</table>';                
    }
}

    $vehicle = new vehiclesData();
    $vehicle->showVehicle();

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