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
      require '../header.php';
      require 'menuCliente.php';
      require_once 'conn.php';

        class clientesData extends Conn {

            protected $connection = null;

            public function __construct() {
                parent::__construct();
            }

           public function load($name) {
                
                $result = $this->connection->prepare('SELECT nombre , dni , telefono FROM clientes WHERE nombre = ?');   
                $result->bindParam('1', $name);   
                $result->execute();

               echo '<table class="table table-hover">
               <tr>
                <th>Nombre</th>
                <th>DNI</th>
                <th>Teléfono</th>
                <th>Acciones</th>
               </tr>';
                while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>".$row["nombre"]."</td>";
                    echo "<td>".$row["dni"]."</td>";
                    echo "<td>".$row["telefono"]."</td>";
                    echo "<td><form method='post' class='mr-5' action='../reparar/verRepar.php'><button type='submit' class='btn btn-primary w-50 pr-3' name='verFactura' value='".$row["dni"]."'>Facturas</button></form></td>";
                }
                echo '</tr>';
                echo '</table>';                
            }
        }
        if($_POST){
        $user = new clientesData();
        $user->load($_POST['cliente']);
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