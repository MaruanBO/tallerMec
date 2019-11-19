<?php

//Si usamos el metodo factory debemos de tratar cada objeto nuevo con una función
interface Vehicles {
    public function whoIm($modelo);
}

    class Coche implements Vehicles{
        private $modelo=array();

        public function whoIm($modelo){
        $this->modelo[]=$modelo;
        }

        public function vermodelo(){
            foreach ($this->modelo as $key) {
                return $key;
            }
        }
    }
?>