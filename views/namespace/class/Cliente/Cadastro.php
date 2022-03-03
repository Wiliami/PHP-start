<?php 

namespace Cliente;

class Cadastro extends \Cadastro {
     
    public function registrarVenda() {
        echo "Uma venda foi feita para o clinte" .$this->getNome();
    }
} 


?>