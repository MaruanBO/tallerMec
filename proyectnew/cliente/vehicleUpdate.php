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
    session_start();
      require 'menuCliente.php';
      require_once 'conn.php';

class updateVehicle extends Conn {

    public function __construct() {
        parent::__construct();
    }

    public function modificar(){
                
        $dni_c = $_SESSION['cliente'];
        $marca = $_POST['marca'];
        $modelo = $_POST['modelo'];
        $tipo = $_POST['tipo'];
        $gama = $_POST['gama'];
        $result = $this->connection->prepare('UPDATE vehiculos SET marca= ?,modelo= ?,tipo= ?,gama= ? where dni_c = "'.$dni_c.'"');
        $result->bindParam('1', $marca);
        $result->bindParam('2', $modelo);
        $result->bindParam('3', $tipo);
        $result->bindParam('4', $gama);      

        if($result->execute()){
             echo '<div class="alert alert-success mt-2" role="alert">
                    !Coche actualizado correctamente!
            </div>';
        }

        return null;
            
    } 
}

    $coche = new updateVehicle();
    $coche->modificar();

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