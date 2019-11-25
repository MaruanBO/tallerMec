<?php
	class ClassReparar extends Conn {

		public function __construct() {
			parent::__construct();
		}


		public function cargaFacturas($dni) {

      $datos = $this->connection->prepare('SELECT id,usuarios.dni as dni,reparar.matricula as matricula,fechaEntrada,fechaSalida,coste,vehiculos.dni_c as dni_c, vehiculos.marca as marca, vehiculos.modelo as modelo, usuarios.nombre as nombre FROM reparar JOIN vehiculos ON reparar.matricula = vehiculos.matricula JOIN usuarios ON usuarios.dni = vehiculos.dni_c where vehiculos.dni_c = ?');
      $datos->bindParam('1',$dni);
      $datos->execute();
      echo '<table class="table table-hover bg-light">
       <tr>
        <th>Nombre Empleado</th>
        <th>Dni Cliente</th>
        <th>Matricula</th>
        <th>Marca</th>
        <th>Modelo</th>
        <th>Fecha Reparacion</th>
        <th>Coste</th>
        <th>Acciones</th>
       </tr>
       ';
      while($linea = $datos->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>".$linea["nombre"]."</td>";
        echo "<td>".$linea["dni_c"]."</td>";
        echo "<td>".$linea["matricula"]."</td>";
        echo "<td>".$linea["marca"]."</td>";
        echo "<td>".$linea["modelo"]."</td>";
        echo "<td>".$linea["fechaEntrada"]."</td>";
        echo "<td>".$linea["coste"]."€</td>";
        echo "<td><form method='post' class='mr-5' action='../cliente/invoice.php'><button type='submit' class='btn btn-primary w-100 pr-3' name='verFacturaExt' value='".$linea["id"]."'>Factura Extendida</button></form></td>";
        echo '</tr>';
      }
      echo '</table>';
    }
    
    public function FacturaExtendida($id) {
            $datos = $this->connection->prepare('SELECT id,reparar.matricula as matriculareparar,fechaSalida,coste,aceite,motor,ventanas,ruedas,usuarios.nombre as nombrecliente,usuarios.dni as dnicliente,usuarios.telefono as telefonocliente,vehiculos.dni_c as dnipropietario,vehiculos.matricula as matriculavehiculo ,vehiculos.marca as marcavehiculo, vehiculos.modelo as modelovehiculo FROM reparar JOIN vehiculos ON reparar.matricula = vehiculos.matricula JOIN usuarios ON vehiculos.dni_c = usuarios.dni where id='.$id);
            $datos->execute();
            $row = $datos->fetch(PDO::FETCH_BOTH);
            echo '<td>'.$row['nombrecliente'].'<br>'.$row['dnicliente'].'<br>'.$row['telefonocliente'].'</td></tr></table><span>Vehiculo: '.$row['marcavehiculo'].'   
            '.$row['modelovehiculo'].'</span><span style="float:right;">Matricula: '.$row['matriculareparar'].'</span></td></tr><tr class="heading"><td>Reparacion</td>
            <td>Precio</td></tr>';
            if ($row['aceite'] != 0) {
                echo '<tr class="item"><td>Aceite</td><td>'.$row['aceite'].'€</td></tr>';
            }
            if ($row['motor'] != 0) {
                echo '<tr class="item"><td>Motor</td><td>'.$row['motor'].'€</td></tr>';
            }
            if ($row['ventanas'] != 0) {
                echo '<tr class="item"><td>Ventana</td><td>'.$row['ventana'].'€</td></tr>';
            }
            if ($row['ruedas'] != 0) {
                echo '<tr class="item"><td>Ruedas</td><td>'.$row['ruedas'].'€</td></tr>';
            }
            echo '<tr class="total"><td></td><td>Total: '.$row['coste'].'€</td></tr>';
        }
  }

?>