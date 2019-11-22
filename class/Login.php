<?php 
	class Login extends Conn {
	  private $_nombre;
	  private $_telefono;
	  private $_dni;

	  public function __construct() {
	    parent::__construct();
	  }

	  public function cliente($session) {
	  	$result = $this->connection->prepare('SELECT * FROM clientes WHERE dni = ?');
	  	$result->bindParam('1', $session);
	  	$result->execute();
	  	$row = $result->fetch(PDO::FETCH_ASSOC);
	  	$this->_nombre = $row["nombre"];
	  	$this->_telefono = $row["telefono"];
	  	$this->_dni = $row["dni"];
	  }

	  public function empleado($session) {
	  	$result = $this->connection->prepare('SELECT * FROM empleados WHERE dni = ?');
	  	$result->bindParam('1', $session);
	  	$result->execute();
	  	$row = $result->fetch(PDO::FETCH_ASSOC);
	  	$this->_nombre = $row["nombre"];
	  	$this->_telefono = $row["telefono"];
	  	$this->_dni = $row["dni"];
	  }

	  public function admin($session) {
	  	$result = $this->connection->prepare('SELECT * FROM usuarios WHERE user = ?');
	  	$result->bindParam('1', $_SESSION['admin']);
	  	$result->execute();
	  	$row = $result->fetch(PDO::FETCH_ASSOC);
	  	$this->_dni = $row["user"];
	  }

	  public function getNombre(){
	    return $this->_nombre;
	  }

	  public function getTelefono(){
	    return $this->_telefono;
	  }

	  public function getDni(){
	    return $this->_dni;
	  }
	}

?>