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
    
    <title>Reparacion | Registrar </title>
  </head>
  <body>
    <?php
      require_once '../Conn.php';
      class GetEmployes extends Conn {
        public function __construct() {
            parent::__construct();
        }
        
        public function cargaEmpleados() {
          $datos = $this->connection->prepare('SELECT * FROM empleados WHERE estado=0');
          $datos->execute();
          echo '<div class="text-center">
                  <select class="form-control" name="Empleado">';
          while($linea = $datos->fetch(PDO::FETCH_ASSOC)) {
            echo '<option value="'.$linea['dni'].'">'.$linea['nombre'].'</option>';      
          }
          echo '</select>
            </div>';
        }
      }
      class GetRepairs extends Conn {
        public function __construct() {
            parent::__construct();
        }
        public function cargaReparaciones() {
          $datos = $this->connection->prepare('SELECT * FROM catalogo');
          $datos->execute();
          while($linea = $datos->fetch(PDO::FETCH_ASSOC)) {
           echo '<div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" name="'.$linea['id'].'" class="form-check-input" value="'.$linea['precio'].'">'.$linea['nombre'].'
                  </label>
                 </div>';
          }
        }
      }
      class RepairInsert extends Conn {
        protected $multiplicador = 1;
        public function __construct() {
            parent::__construct();
        }
        public function cargaDinero($dni,$plate,$aceite,$motor,$ruedas,$ventana) {
          
          $result = $this->connection->prepare('SELECT * FROM vehiculos WHERE matricula=' .(int) $plate);
          $result->execute();
          $result2 = $this->connection->prepare('SELECT * FROM catalogo');
          $result2->execute();
          $row = $result->fetch(PDO::FETCH_BOTH);
          $row2 = $result2->fetch(PDO::FETCH_BOTH);
            
          if ($row["gama"] == 'baja') {
            $this->multiplicador = 1;
          } elseif ($row["gama"] == 'media') {
            $this->multiplicador = 2;
          } elseif ($row["gama"] == 'alta') {
            $this->multiplicador = 4;}
          $suma = $aceite + $motor + $ruedas + $ventana;
          $coste = $this->multiplicador * $suma;
          $aceite = $this->multiplicador * $aceite;
          $motor = $this->multiplicador * $motor;
          $ruedas = $this->multiplicador * $ruedas;
          $ventana = $this->multiplicador * $ventana;
          $fechaEntrada =  date("Y/m/d");
          $fechaSalida = date('Y/m/d', strtotime('+ 2 days'));
          $this->load($dni,$plate,$fechaEntrada,$fechaSalida,$coste,$aceite,$motor,$ruedas,$ventana);
        }
        public function load($dni,$matricula,$fechaEntrada,$fechaSalida,$coste,$aceite,$motor,$ruedas,$ventana) {
            
            $result = $this->connection->prepare('INSERT INTO reparar (dni,matricula,fechaEntrada,fechaSalida,coste,aceite,motor,ruedas,ventana) values(?,?,?,?,?,?,?,?,?)');
            $result->bindParam('1', $dni);
            $result->bindParam('2', $matricula);
            $result->bindParam('3', $fechaEntrada);
            $result->bindParam('4', $fechaSalida);
            $result->bindParam('5', $coste);
            $result->bindParam('6', $aceite);
            $result->bindParam('7', $motor);
            $result->bindParam('8', $ruedas);
            $result->bindParam('9', $ventana);
            $this->updateemploy($dni);
            
            if($result->execute()){
              return '<div class="alert alert-danger mt-2" role="alert">Reparacion añadida correctamente</div>';
          }
            
        }
        public function updateemploy($dni) {
          $result2 = $this->connection->prepare('UPDATE empleados SET estado=1 WHERE dni=?');
          $result2->bindParam('1', $dni);
          if($result2->execute()){
            $buscar = $this->connection->prepare('SELECT dni, nombre FROM empleados WHERE dni=?');
            $buscar->bindParam('1', $dni);
            $linea = $buscar->fetch();
            return '<div class="alert alert-success mt-2" role="alert">
                ¡'.$linea["nombre"].' ha recibido el encargo!
              </div>';
          }
        }
    }
      if (isset($_POST['registrar'])) {
        
        $reparacion = new RepairInsert();
        
        //Aceite
        if (empty($_POST['1'])) {
          $_POST['0'] = 0;
        }
        //Motor
        if (empty($_POST['2'])) {
          $_POST['1'] = 0;
        }
        //Rueda
        if (empty($_POST['3'])) {
          $_POST['2'] = 0;
        }
        //Ventana
        if (empty($_POST['4'])) {
          $_POST['3'] = 0;
        }
        echo $reparacion->cargaDinero($_POST['Empleado'],$_POST['matricula'],$_POST['1'],$_POST['2'],$_POST['3'],$_POST['4']);
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
                        <label for="dni">Empleado Encargado*</label>
                        <?php
                          $empleados = new GetEmployes();
                          $empleados->cargaEmpleados();
                        ?>
                    </div>
                    <div class="form-group mb-2">
                        <label for="matricula">Matricula*</label>
                        <input type='text' class="form-control" name='matricula' id="matricula" minlength="7" maxlength="8" required>
                    </div>
                    <div class="form-group mb-2">
                        <label for="matricula">Partes Reparadas*</label>
                      <?php
                        $repairs = new GetRepairs();
                        $repairs->cargaReparaciones();
                      ?>
                    </div>
                    <p> <input type="submit" class="btn btn-primary w-100" name='registrar' value="Registrar"></p>
                </form>
            </div>
        </div>
    </div>

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