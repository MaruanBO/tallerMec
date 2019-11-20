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
    
    <title>Empleado | Datos Actualizados</title>
  </head>
  <body>
    <?php
        require_once '../header.php';
        require_once 'menuEmp.php';
        require_once '../conn.php';

        class showUpEmp extends Conn {

            public function __construct() {
                parent::__construct();
            }
        
            public function load($dni,$nombre,$telefono) {
                $update  = $this->connection->prepare('UPDATE empleados set nombre = ?, telefono= ? where dni = ?');
                $update->bindParam('1',$nombre);
                $update->bindParam('2',$telefono);
                $update->bindParam('3',$dni);
                $update->execute();
                //$row = $update->fetch(PDO::FETCH_ASSOC);
                $result = $this->connection->prepare('SELECT nombre, dni, telefono FROM empleados where dni = ?');
                $result->bindParam('1',$dni);
                $result->execute();

                $row = $result->fetch(PDO::FETCH_ASSOC);
                echo '<div class="container border border-info mt-2 mb-2 bg-light">';
                echo '<form method="post" action="#">';
                echo '
                    <fieldset disabled>
                        <div class="alert alert-success mt-2" role="alert">
                          ¡Empleado actualizado correctamente!
                        </div>
                        <div class="form-group mb-2">
                            <label for="dni">DNI*</label>
                            <input type="text" class="form-control" name="dni" id="dni" title="e.g 11111111N" pattern="(([X-Z]{1})([-]?)(\d{7})([-]?)([A-Z]{1}))|((\d{8})([-]?)([A-Z]{1}))" required readonly value="'.$row["dni"].'"}">
                        </div>
                        <div class="form-group mb-2">
                            <label for="nombre">Nombre*</label> 
                            <input type="text" name="nombre" id="nombre" class="form-control" title="e.g Pepe Gonzales Morales" pattern="[A-Za-z]{3,15}+" required readonly value="'.$row["nombre"].'"}">
                        </div>
                        <div class="form-group mb-2">
                            <label for="telefono">Teléfono*</label>
                            <input type="text" class="form-control" name="telefono" id="telefono" title="e.g 666666666" pattern="[0-9]{9}" required readonly value="'.$row["telefono"].'"}">
                        </div>';
                echo '<input type="submit" name="submit" class="btn btn-primary mt-3" value="Actualizar"><br><br>';
                echo '</div>';
                echo '</fieldset>';
                echo '</form>';
                echo '</div>';
            }
        }

        $emp1 = new showUpEmp();
        $emp1->load($_POST["dni"],$_POST["nombre"],$_POST["telefono"]);
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