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
    
    <title>Empleado | Información</title>
  </head>
  <body>
    <?php
        require_once '../header.php';
        require_once 'menuEmp.php';
        require_once '../conn.php';

        class verEmp extends Conn {

            public function __construct() {
                parent::__construct();
            }
        
            public function loadDatos($dni) {
                $result = $this->connection->prepare('SELECT nombre, dni, telefono FROM empleados where dni = ?');
                    $result->bindParam('1',$dni);
                $result->execute();

               echo '<table class="table table-hover">
               <tr>
                <th>Nombre</th>
                <th>DNI</th>
                <th>Teléfono</th>
               </tr>';
                $row = $result->fetch(PDO::FETCH_ASSOC);
                    echo "<tr>";
                    echo "<td>".$row["nombre"]."</td>";
                    echo "<td>".$row["dni"]."</td>";
                    echo "<td>".$row["telefono"]."</td>";
                    echo "</tr>";
                
                echo '</table>';
            }

            public function loadEstado($dni) {
                $result = $this->connection->prepare('SELECT nombre, dni, estado FROM empleados where dni = ?');
                $result->bindParam('1',$dni);
                $result->execute();

               echo '<table class="table table-hover">
               <tr>
                <th>Nombre</th>
                <th>DNI</th>
                <th>Estado</th>
               </tr>';
               $row = $result->fetch(PDO::FETCH_ASSOC);
                echo "<tr>";
                echo "<td>".$row["nombre"]."</td>";
                echo "<td>".$row["dni"]."</td>";
                if($row["estado"]==0) {
                    echo "<td class='text-success'>Libre</td>";
                } else {
                    echo "<td class='text-danger'>Ocupado</td>";
                }
                echo "</tr>";                
                echo '</table>';
            }
        }

        if(isset($_POST['submit'])){
            if($_POST['exampleRadios']=='option1') {
                $empleado = new verEmp();
                $empleado->loadDatos($_POST['empleado']);
            } else {
                $empleado = new verEmp();
                $empleado->loadEstado($_POST['empleado']);
            }
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