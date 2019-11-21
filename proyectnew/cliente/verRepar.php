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
    
    <title>Reparacion | Mostrar datos</title>
  </head>
  <body>
    <?php
      session_start();
      if (empty($_SESSION['cliente'])){
      header("Location:../login.php");
     }

      require '../menuCliente.php';
      require_once '../Conn.php';

      class GetFacturas extends Conn {

        public function __construct() {
            parent::__construct();
        }
        public function cargaFacturas($dni) {
          $datos = $this->connection->prepare('SELECT id,reparar.dni as dni,reparar.matricula as matricula,fechaEntrada,fechaSalida,coste,informe,vehiculos.dni_c as dni_c, vehiculos.marca as marca, vehiculos.modelo as modelo, empleados.nombre as nombre FROM reparar JOIN vehiculos ON reparar.matricula = vehiculos.matricula JOIN empleados ON reparar.dni = empleados.dni');
          $datos->execute();
          echo '<table class="table table-hover">
           <tr>
            <th>Nombre Empleado</th>
            <th>Dni Cliente</th>
            <th>Matricula</th>
            <th>Marca</th>
            <th>Modelo</th>
            <th>Fecha Reparacion</th>
            <th>Coste</th>
            <th>Acciones</th>
           </tr>
           ';
          while($linea = $datos->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>".$linea["nombre"]."</td>";
            echo "<td>".$linea["dni_c"]."</td>";
            echo "<td>".$linea["matricula"]."</td>";
            echo "<td>".$linea["marca"]."</td>";
            echo "<td>".$linea["modelo"]."</td>";
            echo "<td>".$linea["fechaEntrada"]."</td>";
            echo "<td>".$linea["coste"]."€</td>";
            echo "<td><form method='post' class='mr-5' action='../reparar/verReparExt.php'><button type='submit' class='btn btn-primary w-50 pr-3' name='verFacturaExt' value='".$linea["id"]."'>Factura Extendida</button></form></td>";
            echo '</tr>';
          }
          echo '</table>';
        }
      }
    ?>
  
    <?php

      if (isset($_POST['verFactura'])) {
        $dni = $_POST['verFactura'];
        $facturas = new GetFacturas();
        $facturas->cargaFacturas($dni);
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