<header>
  <nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <a class="navbar-brand" href="./admin.php">Administrador</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav mr-auto text-center">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarCliente" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Clientes
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarCliente">
            <form method="post">
              <input type="submit" class="btn btn-light col-12 mt-0" name="agregar" value="Agregar"></br>
              <input type="submit" class="btn btn-light col-12" name="ver" value="Ver">
            </form>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarVehiculo" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Vehiculo
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarVehiculo">
          <form method="post">
              <input type="submit" class="btn btn-light col-12 mt-0" name="agregarvehiculo" value="Agregar"></br>
              <input type="submit" class="btn btn-light col-12" name="vervehiculo" value="Ver">
            </form>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarFactura" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Empleados
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarFactura">
            <form method="post">
              <input type="submit" class="btn btn-light col-12 mt-0" name="agregarempleado" value="Agregar"></br>
              <input type="submit" class="btn btn-light col-12" name="verempleados" value="Ver">
            </form>
          </div>
        </li>
      </ul>
      <ul class="navbar-nav text-center">
        <li class="nav-item dropdown dropbottom ml-md-auto">
          <a class="nav-link dropdown-toggle" href="#" id="navbarCatalogo" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user"></i> <span class="text-success"> <?php echo $admin->getNombre() ?> </span>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarCatalogo">
            <a class="dropdown-item text-info">Estado: 
              <?php
                echo $emp1->getEstado($_SESSION['admin']);
              ?>
            </a>
            <div class="dropdown-divider"></div>
            <form method="post">
            <button type="submit" class="btn btn-light col-12 mt-0 text-success text-left" name="vermisdatos" ><i class="fas fa-glasses"></i> Mis datos</button></br>
            <button type="submit" class="btn btn-light col-12 mt-0 text-info text-left" name="actualizarperfil" ><i class="fas fa-user-edit"></i> Actualizar Perfil</button></br>
            </form>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item text-danger" href="../logout.php"><i class="fas fa-power-off"></i> Cerrar Sesión</a>
          </div>
        </li>
      </ul>
    </div>
  </nav>
</header>

      