<?php
require_once "vehiculo.php";

class priceVehicles{
    public static function getVehicles($precio){
        switch($precio){
            case 'OkeyCoche':
                return new Coche();
            break;
            default:
                throw new InvalidArgumentException('Presupuesto no aprobado');
            break;
        }
    }
}

$vehiculo = priceVehicles::getVehicles('OkeyCoche');
echo $vehiculo->whoIm('hola');
echo $vehiculo->vermodelo();

?>