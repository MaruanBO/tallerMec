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
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
        <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>

    <!-- (Optional) Latest compiled and minified JavaScript translation files -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/i18n/defaults-*.min.js"></script>

    <link rel="stylesheet" type="text/css" href="">
    
    <title>Vehiculo | Mostrar datos</title>
  </head>
  <body>

    <?php
      session_start();
      require '../header.php';
      require 'menuVehiculo.php';
      require_once 'conn.php';
      require_once 'vehiculos.php';

      $user = new vehiculos();
      $do = false;

      if (isset($_SESSION['admin']) || isset($_SESSION['emp'])) {

        $user->findCliente();
        if (isset($_POST['ver'])) {
          $dni = $_POST['dni_c'];        
          $do = true;
        } 


      } elseif (isset($_SESSION['cliente'])){

        $dni = $_SESSION['cliente'];
        $do = true;

      } else {
          //LLEVAR A PAGINA DE LOGIN O INDEX////////////////////////
      }

      if ($do == true) {
      echo '
        <div class="container border border-info mt-2 mb-2 bg-white">
            <div class="row pb-3">
                <div class="col-12"></div>
            </div>
            <div class="container row border-bottom border-info pb-3 pt-3">
                <div class="col-12 col-md-6 offset-md-3 border border-success rounded bg-light">
                    <form method="POST">
                        <div class="form-group mb-2">
                            <h2 class="text-center">Añadir vehiculo</h2>
                        </div>
                        <div class="form-group mb-2">
                            <label for="nombre">Matricula*</label> 
                            <input type="text" name="matricula" id="matricula" class="form-control" title="e.g 000FPZ" pattern="[0-9]{4}[A-Z]{3,4}" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="nombre">Marca*</label> 
                            <input type="text" name="marca" id="marca" class="form-control" title="e.g Pepe Gonzales Morales" pattern="[A-Za-z]{1,10}" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="nombre">Modelo*</label> 
                            <input type="text" name="modelo" id="modelo" class="form-control" title="e.g Pepe Gonzales Morales" pattern="[A-Za-z]{1,10}" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="nombre">Tipo*</label> 
                            <input type="text" name="tipo" id="tipo" class="form-control" title="e.g Pepe Gonzales Morales" pattern="[A-Za-z]{1,10}" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="nombre">Gama*</label> 
                            <select name="gama" id="gama" class="form-control" required>
                                <option>Baja</option>
                                <option selected>Media</option>
                                <option>Alta</option>
                            </select>
                        </div>
                        <p> <input type="submit" class="btn btn-primary w-100" name="registrar" value="Registrar"></p>
                    </form>
                </div>
            </div>
        </div>
      ';




      $user->load($dni);
    }



      if (isset($_POST['registrar'])) {
        $dni_c = $dni;
        $matricula = $_POST['matricula'];
        $marca = $_POST['marca'];
        $modelo = $_POST['modelo'];
        $tipo = $_POST['tipo'];
        $gama = $_POST['gama'];
        $user->registrar($dni_c,$matricula,$marca,$modelo,$tipo,$gama);
      } 

      if (isset($_POST['borrador'])) {
        $user->borrar($_POST['borrador']);
      }

      if (isset($_POST['vmodificar'])){
        $user->verModificar($_POST['vmodificar']);
      }

      if (isset($_POST['modificar'])){
        $user->modificar($_POST['modificar']);
      }
      

    ?>
    

    <?php
      //require '../footer.php';
    ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../vendor/jquery-3.3.1.slim.min.js"></script>
    <script src="../vendor/popper.min.js"></script>
    <script src="../vendor/bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
  </body>
</html>