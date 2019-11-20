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
    
    <title>Empleado | Registrar</title>
  </head>
  <body>
    <?php
      require_once '../header.php';
      require_once 'menuEmp.php';
      require_once '../Conn.php';

      class insertEmp extends Conn {

        public function __construct() {
            parent::__construct();
        }

        public function load($dni,$nombre,$telefono) {
            $search = $this->connection->prepare('SELECT dni FROM EMPLEADOS WHERE dni= ?');
            $search->bindParam('1',$dni);
            $search->execute();
            $row = $search->fetch(PDO::FETCH_ASSOC);
            if($row['dni']==$dni) {
                return '
                    <div class="alert alert-danger mt-2" role="alert">
                        ¡Empleado ya existe!
                    </div>';
            } else {
                $result = $this->connection->prepare('INSERT INTO empleados (dni,nombre,telefono) values(?,?,?)');
                $result->bindParam('1', $dni);
                $result->bindParam('2', $nombre);
                $result->bindParam('3', $telefono);
                $result->execute();
                return '
                    <div class="alert alert-success mt-2" role="alert">
                        ¡Empleado registrado correctamente!
                    </div>';
            }
        }
      }
    ?>
    
    <div class="container border border-info mt-2 mb-2 bg-white">
        <div class="row pb-3">
            <div class="col-12"></div>
        </div>
        <div class="container row border-bottom border-info pb-3 pt-3">
            <div class="col-12 col-md-6 offset-md-3 border border-success rounded bg-light">
                <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" name="">
                    <div class="form-group mb-2">
                        <h1 class="text-center">Formulario</h1>
                        <label for="nombre">Nombre y Apellidos*</label> 
                        <input type="text" name="nombre" id="nombre" class="form-control" title="e.g Pepe Gonzales Morales" pattern="[A-Za-z]{4,15}+" required placeholder="Pepe Gonzales Morales">
                    </div>
                    <div class="form-group mb-2">
                        <label for="dni">DNI*</label>
                        <input type="text" class="form-control" name="dni" id="dni" title="e.g 11111111N" pattern="(([X-Z]{1})([-]?)(\d{7})([-]?)([A-Z]{1}))|((\d{8})([-]?)([A-Z]{1}))" required placeholder="11111111A">
                    </div>
                    <div class="form-group mb-2">
                        <label for="telefono">Teléfono*</label>
                        <input type="text" class="form-control" name="telefono" id="telefono" title="e.g 666666666" pattern="[0-9]{9}" required placeholder="676483293">
                    </div>
                    <p> <input type="submit" class="btn btn-primary w-100" name='submit' value="Registrar"></p>
                </form>
                <?php
                    if(isset($_POST['submit'])){
                      $empleado = new insertEmp();
                      echo $empleado->load($_POST['dni'],$_POST['nombre'],$_POST['telefono']);
                    }
                ?>
            </div>
        </div>
    </div>

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
