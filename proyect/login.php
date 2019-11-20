<div class="container row border-info pb-3 pt-3">
        <div class="col-12 col-md-6 offset-md-3 border border-success rounded bg-light">
          <?php
            session_start();
            require_once 'cliente/conn.php';
            
            class Login extends Conn {
              public function __construct() {
                  parent::__construct();
              }
              public function load($user,$password) {
                $login = $this->connection->prepare('SELECT * FROM usuarios WHERE user = ?');
                $login->bindParam('1',$user);
                $login->execute();
                $check_pass=$login->fetch();
  
                if(password_verify($password,$check_pass['password'])) {
                  switch ($check_pass['tipo']) {
                    case 'Cliente':
                      $_SESSION['cliente'] = $user;
                      header("Location:cliente/cliente.php");
                      break;
                    case 'Empleado':
                      $_SESSION['emp'] = $user;
                      header("Location:empleado/empleado.php");
                      break;
                    case 'Admin':
                      $_SESSION['admin'] = $user;
                      header("Location:admin/admin.php");
                      break;
                    default:
                      header("Location:index.php");
                      break;
                  }

                } else {
                  return '<div class="alert alert-danger mt-2" role="alert">
                        ¡Datos incorrectos!
                    </div>';
                }
              }
            }
          ?>
          <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" name="">
            <div class="form-group mb-2">
              <h1 class="text-center">Iniciar Sesión</h1>
              <label for="usuario">Usuario</label> 
              <input type='text' name='usuario' id="usuario" placeholder="" class="form-control" required>
            </div>
            <div class="form-group mb-2">
              <label for="password">Contraseña</label>
              <input type='password' class="form-control" name='password' id="password" required>
            </div>
            <p> <input type="submit" class="btn btn-primary w-100" name='submit' value="Iniciar Sesión"></p>
          </form>
          <?php
            if(isset($_POST['submit'])) {
              $log = new Login();
              echo $log->load($_POST["usuario"],$_POST["password"]);
            }
          ?>
        </div>
      </div>
    </div>