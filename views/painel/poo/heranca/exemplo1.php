<?php 

class Documento {
    
    private $numero; // encapsulamento 

    public function getNumero() { // 
        return $this -> numero;
    }

    public function setNumero() {
        $this -> numero = $n;
    }

}


class CPF extends Documento {

    public function validar(): bool {
        // validando o CPF do cidadão... 
        $numero = $this -> getNumero();
        return true;
    }
}

$doc = new CPF();

$doc -> setNumero("1122334345");

var_dump($doc -> validar());
echo "<br/>";

echo $doc -> getNumero();

echo "Que horas?";

?>