<nav class="navbar navbar-expand-md navbar-light bg-light">
  <div class="collapse navbar-collapse" id="menu2">
    <ul class="navbar-nav mr-auto text-center">
      <li class="nav-item">
        <a class="nav-link" href="../cliente/insertClient.php">Insertar</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../cliente/ShowClientUp.php">Actualizar</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../cliente/tableClient.php">Ver cliente</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../cliente/delClient.php">Borrar cliente</a>
      </li>
    </ul>
  </div>
      <form method='post' action='verClient.php'>
        <div class='input-group-append'>
          <input name='nombre' class='form-control' placeholder="Buscar cliente" required  title='e.g Pepe Gonzales Morales' pattern='[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,25}[ ]{1}[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ ]{2,25}' type='text' aria-label='Search'>
          <button class='btn btn-secondary' type='submit'>Buscar</button>
        </div>
      </form>  
</nav>