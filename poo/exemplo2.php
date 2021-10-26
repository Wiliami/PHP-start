<?php



class Carro {
   private $modelo;
   private $motor;
   private $ano;
   
   public function getModelo() {
       return $this -> $modelo;

   }
   public function setModelo($modelo) {
       $this -> modelo = $modelo;
   }

   public function getMotor() {
       return $this -> $motor;
   }

   public function setMotor($motor) {
        $this -> motor = $motor;
   }

   public function getAno() {
       return $this -> $ano;
   }

   public function setAno() {
       $this -> ano = $ano;
   }

   public function exibir() {
       
       return array(
           "modelo" => $this -> getModelo(),
           "motor" => $this -> getMotor(),
           "ano" => $this -> getAno(),
       );
   }


}

$uno = new Carro();
$uno -> $setmodelo = "Fiat Uno";
$uno -> $setMotor = "1.6";
$uno -> $setAno = "2017";


print_r($uno -> exibir());


?>