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

        class deleteEmp extends Conn {

            public function __construct() {
                parent::__construct();
            }

            public function load() {
                $result = $this->connection->prepare('SELECT nombre, dni FROM empleados order by nombre, dni');
                $result->execute();

                echo '<div class="container border border-info mt-2 mb-2 bg-light">';
                echo '<form method="post" action="deleteEmp.php">';
                echo '<div class="form-group mb-2 pt-2">';
                echo '<label for="select">Selecciona el nombre del empleado:</label><br>';
                echo '<select name="empleado" id="select" class="form-control">';
                echo '<option selected>No has seleccionado nada</option>';
                while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    echo '<option value="'.$row["dni"].'">'.$row["nombre"].', '.$row["dni"].'</option>';
                }
                echo '</select></div><br>';
                echo '<input type="submit" name="submit" class="btn btn-primary mt-3" value="Eliminar"><br><br>';
                echo '</div>';
                echo '</form>';
                echo '</div>';
                 /* El mensaje de borrar lo muestra fuera del formulario*/
                if(isset($_POST['submit'])){
                    echo deleteEmp::borrar($_POST['empleado']);
                }
            }

            public function borrar($dni) {
                $search = $this->connection->prepare('SELECT dni FROM empleados WHERE dni= ?');
                $search->bindParam('1',$dni);
                $search->execute();
                $row = $search->fetch(PDO::FETCH_ASSOC);
                if($row['dni']=="") {
                    return '
                        <div class="alert alert-danger mt-2" role="alert">
                            ¡Empleado no encontrado!
                        </div>';
                } else {
                    $result = $this->connection->prepare('DELETE FROM EMPLEADOS WHERE dni= ?');
                    $result->bindParam('1',$dni);
                    $result->execute();
                   return '
                        <div class="alert alert-success mt-2" role="alert">
                            ¡Empleado borrado correctamente!
                        </div>';
                }
            }
        }

        $emp1 = new deleteEmp();
        $emp1->load();
    ?>

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