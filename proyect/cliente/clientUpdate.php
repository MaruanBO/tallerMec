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

        class updateClient extends Conn {

            public function __construct() {
                parent::__construct();
            }

           public function applyUpdate($nombre,$telefono,$dni) {
                
                $result = $this->connection->prepare("UPDATE clientes SET nombre =?, telefono =? WHERE dni =?");
                $result->bindParam('1', $nombre); 
                $result->bindParam('2', $telefono);
                $result->bindParam('3', $dni); 
                if($result->execute()){
                    echo '<div class="alert alert-success mt-2" role="alert">
                          ¡Cliente actualizado correctamente!
                        </div>';
                }          
            }
        }

        if($_POST){
        $user = new updateClient();
        $user->applyUpdate($_POST['nombre'],$_POST['telefono'],$_POST['dni']);
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