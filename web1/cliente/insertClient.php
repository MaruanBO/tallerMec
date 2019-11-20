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
        require 'menuCliente.php';
        require_once '../Conn.php';

        class addClient extends Conn {

            protected $connection = null;

            public function __construct() {
            parent::__construct();
            }


            public function insertClient($dni,$nombre,$telefono,$pass) {
              
                $name = $this->connection->prepare('SELECT * FROM clientes where nombre =?');
                $nif = $this->connection->prepare('SELECT * FROM clientes where dni=?');
                $tel = $this->connection->prepare('SELECT * FROM clientes where telefono=?');
                $usuario = $this->connection->prepare('SELECT * FROM usuarios where user=?');

                $name->bindParam('1', $nombre);
                $nif->bindParam('1', $dni);
                $tel->bindParam('1', $telefono);
                $usuario->bindParam('1', $dni);
              
                $name->execute();
                $nif->execute();
                $tel->execute();
                $usuario->execute();


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
                    $register = $this->connection->prepare('INSERT INTO usuarios (user,password,tipo) values(?,?,?)');
                    $register->bindParam('1', $dni);
                    $register->bindParam('2', $hash);
                    $register->bindParam('3', $tipo);
                    $register->execute();

                    $result = $this->connection->prepare('INSERT INTO clientes (dni,nombre,telefono) values(?,?,?)');
                    $result->bindParam('1', $dni);
                    $result->bindParam('2', $nombre);
                    $result->bindParam('3', $telefono);

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
        }

        if(isset($_POST['submit'])){
            $user = new addClient();
            echo $user->insertClient($_POST['dni'],$_POST['nombre'],$_POST['telefono'],$_POST['pass']);
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
                        <label for="nombre">Nombre completo*</label> 
                        <input type='text' name='nombre' id="nombre" placeholder="Nombre completo" class="form-control" title="e.g Pepe Gonzales Morales" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,25}[ ]{1}[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ ]{2,25}" required>
                    </div>
                    <div class="form-group mb-2">
                        <label for="dni">DNI*</label>
                        <input type='text' class="form-control" placeholder="DNI" name='dni' id="dni" title="e.g 11111111N" pattern="(([X-Z]{1})([-]?)(\d{7})([-]?)([A-Z]{1}))|((\d{8})([-]?)([A-Z]{1}))" required>
                    </div>
                    <div class="form-group mb-2">
                        <label for="telefono">Teléfono*</label>
                        <input type='text' class="form-control" placeholder="Telefono" name='telefono' title="e.g 666666666" pattern="[0-9]{9}" required>
                    </div>
                    <div class="form-group mb-2">
                        <label for="pass">Contraseña*</label>
                        <input type='password' class="form-control" placeholder="Contraseña" name='pass' id="pass" title="e.g Pepe123/" required>
                    </div>
                    <p> <input type="submit" class="btn btn-primary w-100" name='submit' value="Registrar"></p>
                </form>
            </div>
        </div>
    </div>


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
