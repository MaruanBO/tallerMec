<?php

// Os dejo como realizar una conexión con sentencias preparadas y mediante PDO junto al bucle para recorrer el index de la tabla.

class User {

    protected $connection = null;

    public function __construct() {
        // Comprobación de la conexión y de la sentencia lanzada "ERRMODE_WARNING"

     
        try {
            $this->connection = new PDO("mysql:host=localhost;dbname=formulario", 'root', 'root',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));  
        }
        
        catch (PDOException $e) {
            // con echo tenemos acceso al mensaje de error
            echo 'Falló la conexión: ' . $e->getMessage();
        } 

    }

    public function load($id) {
        $result = $this->connection->prepare('SELECT * FROM formulario WHERE dni = '.(int) $id);      
        
        $result->execute();   

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            
            return $row['nombre'];
        
        }
        
        return null;
    }
}

$user = new User();
echo $user->load('11111111N');

?>