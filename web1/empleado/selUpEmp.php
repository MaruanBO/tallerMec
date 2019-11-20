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
    
    <title>Empleado | Seleccionar datos</title>
  </head>
  <body>
    <?php
        require_once '../header.php';
        require_once 'menuEmp.php';
        require_once '../conn.php';

        class selUpEmp extends Conn {

            public function __construct() {
                parent::__construct();
            }
        
            public function load() {
                $result = $this->connection->prepare('SELECT nombre, dni FROM empleados order by nombre, dni');
                $result->execute();

                echo '<div class="container border border-info mt-2 mb-2 bg-light">';
                echo '<form method="post" action="showUpEmp.php">';
                echo '<div class="form-group mb-2 pt-2">';
                echo '<label for="select">Selecciona el nombre del empleado:</label><br>';
                echo '<select name="empleado" id="select" class="form-control">';
                echo '<option selected>No has seleccionado nada</option>';
                while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    echo '<option value="'.$row["dni"].'">'.$row["nombre"].', '.$row["dni"].'</option>';
                }
                echo '</select></div><br>';
                echo '<input type="submit" name="submit" class="btn btn-primary mt-3" value="Modificar"><br><br>';
                echo '</div>';
                echo '</form>';
                echo '</div>';
            }
        }

        $emp1 = new selUpEmp();
        $emp1->load();
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