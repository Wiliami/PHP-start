<?php 

class Person {
    
    public $name; // atributo

    public function falar() { // método
        return "O meu nome é:  ".$this-> $name;       
    }
}


$wiliamis = new Person(); // instância da classe
$wiliamis -> $name = "Dudu Sampaio";
echo $wiliamis -> falar(); 

 
?>