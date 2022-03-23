<?php 

interface Veiculo {
     public function acelerar($velocidade);
     public function frenar($velocidade);
     public function trocar_marcha($marcha);
}

class Civic implements Veiculo { 
    
    public function acelerar($velocidade) {
        echo "O veículo acelerou até " . $velocidade . " km/h";
    }
    public function frenar($velocidade) {
        echo "O veículo freou até " . $velocidade . "km/h";
    }
    public function trocar_marcha($marcha) {
        echo "O veículo engatou a marcha " . $marcha;
    }
}

$carro = new Civic();
$carro -> trocar_marcha(1);
?>