<?php
require_once 'conn.php';

class vehiculos extends Conn {
    public function __construct() {
        parent::__construct();

    }

    public function loadAll() {
                
        $result = $this->connection->prepare('SELECT * FROM vehiculos');
        
        $result->execute();

        echo    
            '<table class="table table-hover">
                <tr>
                    <th>Matricula</th>
                    <th>DNI</th>
                    <th>marca</th>
                    <th>modelo</th>
                    <th>tipo</th>
                    <th>gama</th>
                </tr>'
        ;

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>".$row["matricula"]."</td>";
            echo "<td>".$row["dni_c"]."</td>";
            echo "<td>".$row["marca"]."</td>";
            echo "<td>".$row["modelo"]."</td>";
            echo "<td>".$row["tipo"]."</td>";
            echo "<td>".$row["gama"]."</td>";
            echo 
                "<td><form method='post' class='mr-5' action='verVehiculo.php'>
                    <button class='btn btn-primary w-50 pr-3' 
                            type='submit' id='borrador' name='borrador'
                            value='".$row["matricula"]."'>
                                Borrar
                    </button>
                    <button class='btn btn-primary w-50 pr-3' 
                            type='submit' id='vmodificar' name='vmodificar'
                            value='".$row["matricula"]."'>
                                Modificiar
                    </button>
                </form></td>";
        }
        echo '</tr>';
        echo '</table>';  

    }

    public function load($dni) {
                
        $result = $this->connection->prepare('SELECT * FROM vehiculos where dni_c = ?');
        $result->bindParam('1', $dni);
        $result->execute();

        echo    
            '<table class="table table-hover">
                <tr>
                    <th>Matricula</th>
                    <th>DNI</th>
                    <th>marca</th>
                    <th>modelo</th>
                    <th>tipo</th>
                    <th>gama</th>
                </tr>'
        ;

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>".$row["matricula"]."</td>";
            echo "<td>".$row["dni_c"]."</td>";
            echo "<td>".$row["marca"]."</td>";
            echo "<td>".$row["modelo"]."</td>";
            echo "<td>".$row["tipo"]."</td>";
            echo "<td>".$row["gama"]."</td>";
            echo 
                "<td><form method='post' class='mr-5' action='verVehiculo.php'>
                    <button class='btn btn-primary w-50 pr-3' 
                            type='submit' id='borrador' name='borrador'
                            value='".$row["matricula"]."'>
                                Borrar
                    </button>
                    <button class='btn btn-primary w-50 pr-3' 
                            type='submit' id='vmodificar' name='vmodificar'
                            value='".$row["matricula"]."'>
                                Modificiar
                    </button>
                </form></td>";
        }
        echo '</tr>';
        echo '</table>';                
    }

    public function registrar($dni_c,$matricula,$marca,$modelo,$tipo,$gama) {
                
        $result = $this->connection->prepare('INSERT INTO vehiculos (dni_c,matricula,marca,modelo,tipo,gama) values(?,?,?,?,?,?)');
        $result->bindParam('1', $dni_c);
        $result->bindParam('2', $matricula);
        $result->bindParam('3', $marca);
        $result->bindParam('4', $modelo);
        $result->bindParam('5', $tipo);
        $result->bindParam('6', $gama);
        
        $check =  $this->connection->prepare('SELECT dni from clientes;');
        $check->execute();
        if (in_array($dni_c, $check->fetch(PDO::FETCH_ASSOC))){

            $check =  $this->connection->prepare('SELECT dni from clientes;');
            $check->execute();
            if (in_array($dni_c, $result->fetch(PDO::FETCH_ASSOC))){
                echo '<p class="p-3 mb-2 bg-light text-dark">La matricula ya existe en la base de datos.<p>';

            } else {
                if($result->execute()){
                    echo "El vehiculo se ha añadido correctamente";
                }

                return null;

            }
        } else {
            echo '<p class="p-3 mb-2 bg-light text-dark">El dni no existe en la base de datos.<p>';
        }
    }

    public function borrar($matricula){

        $result = $this->connection->prepare('DELETE FROM vehiculos where matricula=?');
        $result->bindParam('1', $matricula);

        if($result->execute()){
            echo "El vehiculo se ha borrado correctamente";
        } else {
            echo '<p class="p-3 mb-2 bg-light text-dark">El vehiculo no se ha eliminado por alguna razon<p>';

        }
        
    }

    public function verModificar($matricula){

        $result = $this->connection->prepare('SELECT * FROM vehiculos WHERE matricula = ?');
        $result->bindParam('1', $matricula);
        $result->execute();
        $row = $result->fetch(PDO::FETCH_ASSOC);
        echo '<div class="container border border-info mt-2 mb-2 bg-white">
                <div class="row pb-3">
                    <div class="col-12"></div>
                </div>
                <div class="container row border-bottom border-info pb-3 pt-3">
                    <div class="col-12 col-md-6 offset-md-3 border border-success rounded bg-light">
                        <form method="POST" name="">
                            <div class="form-group mb-2">
                                <h1 class="text-center">Modificar datos del vehiculo</h1>
                                <label for="dni">DNI*</label>
                                <input value="'.$row["dni_c"].'" type="text" class="form-control" name="dni_c" id="dni_c" title="e.g 11111111N" pattern="(([X-Z]{1})([-]?)(\d{7})([-]?)([A-Z]{1}))|((\d{8})([-]?)([A-Z]{1}))" required>
                            </div>
                            <div class="form-group mb-2">
                                <label for="nombre">Matricula*</label> 
                                <input value="'.$row["matricula"].'" type="text" name="matricula" id="matricula" class="form-control" title="e.g 0000FPZ" pattern="[0-9]{4}[A-Z]{3,4}" required>
                            </div>
                            <div class="form-group mb-2">
                                <label for="nombre">Marca*</label> 
                                <input value="'.$row["marca"].'" type="text" name="marca" id="marca" class="form-control" title="e.g Pepe Gonzales Morales" pattern="[A-Za-z]{1,10}" required>
                            </div>
                            <div class="form-group mb-2">
                                <label for="nombre">Modelo*</label> 
                                <input value="'.$row["modelo"].'" type="text" name="modelo" id="modelo" class="form-control" title="e.g Pepe Gonzales Morales" pattern="[A-Za-z]{1,10}" required>
                            </div>
                            <div class="form-group mb-2">
                                <label for="nombre">Tipo*</label> 
                                <input value="'.$row["tipo"].'" type="text" name="tipo" id="tipo" class="form-control" title="e.g Pepe Gonzales Morales" pattern="[A-Za-z]{1,10}" required>
                            </div>
                            <div class="form-group mb-2">
                                <label for="nombre">Gama*</label> 
                                <select name="gama" id="gama" class="form-control" required>
                                        <option selected>'.$row["gama"].'</option>
                                        <option>Baja</option>
                                    <option>Media</option>
                                    <option>Alta</option>
                                </select>
                            </div>
                            <p> <input type="submit" class="btn btn-primary w-50 pr-3" name="modificar" value="Modificar"></p>
                        </form>
                    </div>
                </div>
            </div>';
        
    }

    public function modificar($matricula){
                
        $dni_c = $_POST['dni_c'];
        $matricula = $_POST['matricula'];
        $marca = $_POST['marca'];
        $modelo = $_POST['modelo'];
        $tipo = $_POST['tipo'];
        $gama = $_POST['gama'];

        $result = $this->connection->prepare('UPDATE vehiculos SET dni_c = ?,matricula= ?,marca= ?,modelo= ?,tipo= ?,gama= ? where matricula = "'.$matricula.'"');
        $result->bindParam('1', $dni_c);
        $result->bindParam('2', $matricula);
        $result->bindParam('3', $marca);
        $result->bindParam('4', $modelo);
        $result->bindParam('5', $tipo);
        $result->bindParam('6', $gama);
        
        $check =  $this->connection->prepare('SELECT * from clientes where dni = "'. $dni_c .'";');
        $check->execute();

        if ($check->rowCount() > 0){

                if($result->execute()){
                    echo "El vehiculo se ha modificado correctamente";
                }

                return null;
            
        } else {
            echo '<p class="p-3 mb-2 bg-light text-dark">El dni no existe en la base de datos.<p>';
        }
        
    }

    public function findCliente() {
                
        $result = $this->connection->prepare('SELECT dni FROM clientes');   
        
        $result->execute();

          echo '<form method="post" >';
          echo '<p class="p-3 mb-2 bg-light text-dark">Selecciona el DNI del vehiculo:</p>';
          echo '<select name="dni_c" class="selectpicker" data-style="bg-dark text-light">';
            while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo '<p><option>'.$row["dni"].'</option></p>';
            }
          echo '</select>';
          echo '<br><br>';
          echo '<input type="submit" name="ver"  class="btn btn-light" value="Ver"><br><br>';
          echo '</form>';
            
        }

}

?>