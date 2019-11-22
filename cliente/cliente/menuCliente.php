    <header>
      <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <a class="navbar-brand" href="http://localhost/ejer/objet/poo/cliente/cliente/cliente.php">Cliente</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav ml-auto text-center">
            <li class="nav-item dropdown dropleft">
              <a class="nav-link dropdown-toggle" href="#" id="navbarCatalogo" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user"></i> <span class="text-success"> <?php echo $cliente->getNombre() ?> </span>
              </a>
                <div class="dropdown-menu bg-dark" aria-labelledby="navbarCatalogo">
                <a class="dropdown-item text-info">Estado: <span class="text-success">ONLINE</span></a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item text-info" href="http://localhost/ejer/objet/poo/cliente/cliente/verVehic.php"><i class="fas fa-car"></i> Mi coche</a>
                <a class="dropdown-item text-info" href="http://localhost/ejer/objet/poo/cliente/cliente/tableClient.php"><i class="fas fa-glasses"></i> Mis datos</a>
                <a class="dropdown-item text-info" href="http://localhost/ejer/objet/poo/cliente/cliente/modClient.php"><i class="fas fa-user-edit"></i> Actualizar Perfil</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item text-danger" href="http://localhost/ejer/objet/poo/cliente/logout.php"><i class="fas fa-power-off"></i> Cerrar Sesión</a>
              </div>
            </li>
          </ul>
        </div>
      </nav>
    </header>