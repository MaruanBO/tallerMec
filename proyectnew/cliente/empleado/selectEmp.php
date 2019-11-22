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

        class selectEmp extends Conn {
            
            public function __construct() {
                parent::__construct();
            }
        
            public function load() {
                $result = $this->connection->prepare('SELECT nombre, dni FROM empleados order by nombre, dni');
                $result->execute();

<<<<<<< HEAD:proyectnew/empleado/selectEmp.php
                echo '<div class="container border border-info mt-2 mb-2 bg-light">';
                echo '<form method="post" action="verEmp.php">';
                echo '<div class="form-group mb-2 pt-2">';
                echo '<label for="select">Selecciona el nombre del empleado:</label><br>';
                echo '<select name="empleado" id="select" class="form-control">';
                echo '<option selected>No has seleccionado nada</option>';
                while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    echo '<option value="'.$row["dni"].'">'.$row["nombre"].'</option>';
                }
                echo '</select></div><br>';
                echo '
                    <div class="form-group mb-2 pt-2">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="exampleRadios" id="datos" value="option1" checked>
                            <label class="form-check-label" for="datos">Datos
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="exampleRadios" id="estado" value="option2">
                            <label class="form-check-label" for="estado">Estado
                          </label>
                        </div>
                    </div>
                ';
                echo '<input type="submit" name="submit" class="btn btn-primary mt-3" value="Buscar"><br><br>';
                echo '</div>';
                echo '</form>';
                echo '</div>';
            }
        }

        $emp1 = new selectEmp();
        $emp1->load();
=======

           public function searchClient($dni) {

                $name = $this->connection->prepare('SELECT * FROM clientes where dni =?');
                
                $name->bindParam('1', $nombre);


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

                    $result = $this->connection->prepare('SELECT * FROM clientes where nombre=?');  
                    $result->bindParam('1',$nombre); 
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

>>>>>>> 46bca7e0f5f507e70f67f5d764a310478b55bd2f:proyect/cliente/verClient.php
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