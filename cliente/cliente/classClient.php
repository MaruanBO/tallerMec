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
    
    <title>Cliente | Registrar</title>
  </head>
  <body>

<?php

class classClient extends Conn {

    public function __construct() {
        parent::__construct();
    }

        public function showClient() {
                
            $result = $this->connection->prepare('SELECT * FROM usuarios WHERE dni = ? AND tipo = "Cliente"');   
            $result->bindParam('1',$_SESSION['cliente']);   
            $result->execute();

            echo '<table class="table table-hover">
               <tr>
                <th>Nombre</th>
                <th>DNI</th>
                <th>Teléfono</th>
                <th>Acciones</th>
               </tr>';
                $row = $result->fetch(PDO::FETCH_ASSOC);
                    echo "<tr>";
                    echo "<td>".$row["nombre"]."</td>";
                    echo "<td>".$row["dni"]."</td>";
                    echo "<td>".$row["telefono"]."</td>";
                    echo "<td><form method='post' class='mr-5' action='../cliente/verRepar.php'><button type='submit' class='btn btn-primary w-100 w-md-50 pr-3' name='verFactura' value='".$row["dni"]."'>Facturas</button></form></td>";
                echo '</tr>';
                echo '</table>';                
        }

        public function insertClient($dni,$nombre,$telefono,$pass) {
                
            $nif = $this->connection->prepare('SELECT * FROM usuarios where dni=? AND tipo = "Cliente"');
            $tel = $this->connection->prepare('SELECT * FROM usuarios where telefono=? AND tipo = "Cliente"');

            $nif->bindParam('1', $dni);
            $tel->bindParam('1', $telefono);
                
            $nif->execute();
            $tel->execute();


                if($nif->fetch() > 1){
                    $fail[] = '
                    <div class="alert alert-danger mt-2" role="alert">
                        Dni ya existe!
                    </div>';
                }

                if($tel->fetch() > 1){
                    $fail[] = '
                    <div class="alert alert-danger mt-2" role="alert">
                        Telefono ya existe!
                    </div>';
                }


                if (empty($fail)){

                $hash = password_hash($pass, PASSWORD_DEFAULT);
                $tipo = "Cliente";
                $status = NULL;
                $result = $this->connection->prepare('INSERT INTO usuarios (dni,nombre,telefono,tipo,estado,password) values(?,?,?,?,?,?)');
                $result->bindParam('1', $dni);
                $result->bindParam('2', $nombre);
                $result->bindParam('3', $telefono);
                $result->bindParam('4', $tipo);
                $result->bindParam('5', $status);
                $result->bindParam('6', $hash);

                    if($result->execute()){
                        return '<div class="alert alert-success mt-2" role="alert">
                                ¡Cliente registrado correctamente!
                                </div>';
                    }

                    return null;
                }
                    if(isset($fail)){
                        foreach ($fail as $exec){
                          echo "$exec";
                        }
                    }
        }

        public function showClientToDel() {
                
        $result = $this->connection->prepare('SELECT * FROM usuarios where tipo = "Cliente"');   
            
        $result->execute();
            echo '<div class="container border border-info mt-2 mb-2 bg-light">';
            echo '<form method="post">';
            echo '<div class="form-group mb-2 pt-2">';
            echo '<label for="select">Selecciona el nombre del cliente:</label><br>';
            echo '<select name="cliente" id="select" class="form-control">';
            echo '<option selected>No has seleccionado nada</option>';
                
                while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    echo '<option value="'.$row["dni"].'">'.$row["nombre"].', '.$row["dni"].'</option>';
                }

            echo '</select></div><br>';
            echo '<input type="submit" name="submit" class="btn btn-primary mt-3" value="Eliminar"><br><br>';
            echo '</div>';
            echo '</form>';
            echo '</div>';

        }


        public function delClient($dni) {
                
            $result = $this->connection->prepare('DELETE FROM usuarios where dni = ? and tipo = "Cliente"');
            $result->bindParam('1', $dni);  
               if($result->execute()){
                    echo '<div class="alert alert-success mt-2" role="alert">
                          ¡Cliente eliminado correctamente!
                        </div>';  
                }          
        }

        public function verModificar(){
          $result = $this->connection->prepare('SELECT * FROM usuarios WHERE dni = ? and tipo = "Cliente"');
            $result->bindParam('1', $_SESSION['cliente']);
            $result->execute();
            $row = $result->fetch(PDO::FETCH_ASSOC);

            echo '<div class="container border border-info mt-2 mb-2 bg-white" id="unlock">
                <div class="row pb-3">
                  <div class="col-12"></div>
                </div>
                <div class="container row border-info pb-3 pt-3">
                  <div class="col-12 col-md-6 offset-md-3 border border-success rounded bg-light">
                    <form method="POST" name="">
                      <div class="form-group mb-2">
                        <label for="dni">DNI*</label>
                        <input type="text" class="form-control" name="dni" id="dni" title="e.g 11111111N" pattern="(([X-Z]{1})([-]?)(\d{7})([-]?)([A-Z]{1}))|((\d{8})([-]?)([A-Z]{1}))" required readonly value="'.$row["dni"].'"}">
                      </div>
                      <div class="form-group mb-2">
                        <label for="nombre">Nombre*</label> 
                        <input type="text" name="nombre" id="nombre" class="form-control" title="e.g Pepe Gonzales Morales" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,25}[ ]{1}[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ ]{2,25}"  required value="'.$row["nombre"].'"}">
                      </div>
                      <div class="form-group mb-2">
                        <label for="telefono">Teléfono*</label>
                        <input type="text" class="form-control" name="telefono" id="telefono" title="e.g 666666666" pattern="[0-9]{9}" required value="'.$row["telefono"].'"}">
                      </div>
                      <p> <input type="submit" class="btn btn-primary w-50 pr-3" name="modificar" value="Modificar"></p>
                    </form>
                  </div>
                </div>
              </div>';
        }

        public function modificar($nombre,$telefono,$dni) {
          $result = $this->connection->prepare("UPDATE clientes SET nombre = ?, telefono = ? WHERE dni = ? and tipo = 'Cliente' ");
          $result->bindParam('1', $nombre); 
          $result->bindParam('2', $telefono);
          $result->bindParam('3', $dni); 
          if($result->execute()){
              return classClient::verModificar().'<div class="alert alert-success mt-2" role="alert">
                    ¡Cliente actualizado correctamente!
                  </div>';
          }          
        } 
    }
    /*
        if(isset($_POST['submit'])){
        $user = new addClient();
        echo $user->insertClient($_POST['dni'],$_POST['nombre'],$_POST['telefono'],$_POST['pass']);
        }
    */
    /*
        if(isset($_POST['submit'])){
            echo delClient($_POST['cliente']);
        }             
    */

    ?>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../vendor/jquery-3.3.1.slim.min.js"></script>
    <script src="../vendor/popper.min.js"></script>
    <script src="../vendor/bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
  </body>
</html>
