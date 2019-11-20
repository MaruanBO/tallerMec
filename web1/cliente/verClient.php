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
      require '../menuCliente.php';
      require_once '../Conn.php';

        class clientesShow extends Conn {

            protected $connection = null;

            public function __construct() {
                parent::__construct();
            }


           public function searchClient($dni) {

                $name = $this->connection->prepare('SELECT * FROM clientes where dni =?');
                $name->bindParam('1', $dni);
                $name->execute();

                if($name->fetch() == 0){
                    $fail[] = '
                    <div class="alert alert-danger mt-2" role="alert">
                        El nombre introducido no existe en la base de datos!
                    </div>';
                }

                    if(isset($fail)){
                        foreach ($fail as $exec){
                          echo "$exec";
                        }
                    }

                if (empty($fail)){

                    $result = $this->connection->prepare('SELECT * FROM clientes where dni=?');  
                    $result->bindParam('1',$dni); 
                    $result->execute();
                   echo '<table class="table table-hover">
                   <tr>
                    <th>Nombre</th>
                    <th>DNI</th>
                    <th>Teléfono</th>
                    <th>Acciones</th>
                   </tr>';
                    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td>".$row["nombre"]."</td>";
                        echo "<td>".$row["dni"]."</td>";
                        echo "<td>".$row["telefono"]."</td>";
                        echo "<td><form method='post' class='mr-5' action='verRepar.php'><button type='submit' class='btn btn-primary w-50 pr-3' name='verFactura' value='".$row["dni"]."'>Facturas</button></form></td>";
                    }
                    echo '</tr>';
                    echo '</table>';  
                } 
            }
        }
        
        if($_POST){
            $user = new clientesShow();
            $user->searchClient($_POST['dni']);
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