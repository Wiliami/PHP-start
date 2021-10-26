<?php 

class Pessoa {
    public $nome = "Rasmus Lerdorf";
    protected $idade = 48;
    private $senha = "123456";


    public function verDados() {
        echo $this -> nome . "<br/>";
        echo $this -> idade . "<br/>";
        echo $this -> senha . "<br/>";

    }
        
}


class Programador extends Pessoa { // herança da classe Pessoa
    public function verDados() {

        echo get_class($this) . "<br/>";

        echo $this -> nome . "<br/>";
        echo $this -> idade . "<br/>";
        echo $this -> senha . "<br/>";
    }
}

$objeto = new Programador();


$objeto = new Pessoa();
echo $objeto -> nome . "<br/>";
echo $objeto -> idade . "<br/>";

$objeto -> verDados();

//  comentário


class Carro {
    
    public $modelo = "Chevrolet";
    public $marca = "onix";
    private $senha = 123456;


    public function exibir() {
        echo $this -> modelo . "<br>";
        echo $this -> senha . "<br>";

    }
}





?>