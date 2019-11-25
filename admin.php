<?php 
  session_start(); 
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="../imgs/factura.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../vendor/bootstrap-4.3.1-dist/css/bootstrap.min.css">
    <!-- FontAwesome CSS -->
    <link rel="stylesheet" href="../vendor/fontawesome-5.11.2/css/all.min.css">
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="../vendor/styles.css">
    
    <title>Panel | Empleado </title>
  </head>
  <body>
  <?php
    if (empty($_SESSION['admin'])){
      header("Location:../login.php");
    } 
    else {  
      require_once '../class/Conn.php';
      require_once '../class/ValidateLogin.php';
      require_once '../class/ClassClient.php';
      require_once '../class/ClassVehic.php';
      require_once '../class/ClassEmp.php';
      require_once '../class/ClassReparar.php';
      $admin = new ValidateLogin();
      $admin->empleado($_SESSION['admin']);
      
      $emp1 = new ClassEmp();
      $reparar = new ClassReparar();
      
      $vehiculo = new ClassVehic();
      $cliente = new ClassClient();

      require_once 'menuAdmin.php';
  ?>
    <body>
      <div class="container-fluid bg-white">
        <div class="row">
          <div class="col-12">
            <?php
              if (empty($_POST)) {
                echo "<div class='alert alert-primary m-2 bg-light' role='alert'>Bienvenido,". $admin->getNombre()." !</div>";
              }
            ?>
            
            <?php
            if (isset($_POST['agregar'])) {
              $cliente->addClient();
            }

            if(isset($_POST['registrar'])){
              $cliente->insert($_POST['dni'],$_POST['nombre'],$_POST['telefono'],$_POST['pass']);
            }

            if(isset($_POST['ver'])){
              $cliente->findCliente();
              $cliente->showAll();
            }

            if(isset($_POST['agregarvehiculo'])){
              $vehiculo->VerInsertar();
            }

            if(isset($_POST['registrarvehiculo'])){
              $vehiculo->registrar($_POST['dni'],$_POST['matricula'],$_POST['marca'],$_POST['modelo'],$_POST['tipo'],$_POST['gama']);
            }

            if(isset($_POST['vervehiculo'])){
              $vehiculo->findCliente();
              $vehiculo->loadAll();
            }

            if(isset($_POST['vmodificar'])){
              $vehiculo->verModificar($_POST['vmodificar']);
            }

            if(isset($_POST['modificarvehiculo'])){
              $vehiculo->modificar($_POST['matricula']);
            }
            
            if(isset($_POST['agregarfactura'])){
              $reparar->VerInsert();
            }

            if(isset($_POST['registrarfactura'])){
                //Aceite
                if (empty($_POST['1'])) {
                  $_POST['1'] = 0;
                }
                //Motor
                if (empty($_POST['2'])) {
                  $_POST['2'] = 0;
                }
                //Rueda
                if (empty($_POST['3'])) {
                  $_POST['3'] = 0;
                }
                //Ventana
                if (empty($_POST['4'])) {
                  $_POST['4'] = 0;
                }

              $reparar->cargaDinero($_POST['Empleado'],$_POST['matricula'],$_POST['1'],$_POST['2'],$_POST['3'],$_POST['4'],);
            }


            if(isset($_POST['verfacturas'])){
              $reparar->findFacturas();
              $reparar->showAllFacturas();
            }

            if(isset($_POST['verfacturavehiculobuscado'])){
              $reparar->cargaFacturas($_POST['dni_c']);
            }

            if(isset($_POST['verclientevehiculobuscado'])){
              $vehiculo->load($_POST['dni_c']);
            }

            if(isset($_POST['verclientebuscado'])){
              $cliente->showClient($_POST['dni_c']);
            }

            if(isset($_POST['vermisdatos'])){
              $emp1->showEmp($empleado->getDni());
            }

            if(isset($_POST['actualizarperfil'])){
              $emp1->verModificar($empleado->getDni());
            }

            if(isset($_POST["modificarmeami"])) {
              $emp1->modificar($_POST["dni"],$_POST["nombre"],$_POST["telefono"],$_POST["estado"]);
            } 

            ?>
          </div>
        </div>
      </div>
    </body>
    <?php
      require_once '../footer.php';
    }
    ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../vendor/jquery-3.3.1.slim.min.js"></script>
    <script src="../vendor/popper.min.js"></script>
    <script src="../vendor/bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
  </body>
</html>