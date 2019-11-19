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
    
    <title>Cliente | Mostrar datos</title>
  </head>
  <body>
    <?php
      require '../header.php';
      require 'menuCliente.php';
      require_once 'conn.php';

        class clientesShow extends Conn {

            protected $connection = null;

            public function __construct() {
                parent::__construct();
            }

            public function showClientes() {
                
            $result = $this->connection->prepare('SELECT nombre FROM clientes');   
            
            $result->execute();
            
                echo '<div class="container border border-info mt-2 mb-2 bg-light">';
                echo '<form method="post" action="tableClient.php">';
                echo '<div class="form-group mb-2 pt-2">';
                echo '<label for="select">Selecciona el nombre del cliente:</label><br>';
                echo '<select name="cliente" id="select" class="form-control">';
                echo '<option selected>No has seleccionado nada</option>';
                while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo '<option>'.$row['nombre'].'</option>';
                }
                echo '</select></div><br>';
                echo '<input type="submit" name="submit" class="btn btn-primary mt-3" value="Buscar"><br><br>';
                echo '</div>';
                echo '</form>';
                echo '</div>'; 
                
            }
        }

        $user = new clientesShow();
        $user->showClientes();

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