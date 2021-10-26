<?php

namespace Colaboradores;


class Cadastro {
    
    // atributos (encapsulamento);
    public $name; 
    public $email;
    public $senha;



    // métodos gets
    public function getNome() {
       return $this->name;
    }

    public function getEmail() {
        return $this->email;

    }

    public function getSenha() {
        return $this->senha;
    }




    // métodos sets
    public function setNome($name) {
        $this->name = $name;
    }
    
    public function setEmail($email) {
        $this->email = $email;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }

}


?>