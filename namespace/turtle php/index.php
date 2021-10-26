<?php 

require 'classes/Cadastro.php';
require 'models/Cadastro.php';
require 'Alunos/Cadastro.php';
require 'Clientes/Cadastro.php';
require 'Colaboradores/Cadastro.php';



// namespace \classes\Produto; 


$prod = new \Colaboradores\Cadastro;
$prod->setName("Teste123");
$prod->setEmail("teste@gmail.com");
$prod->setSenha("123456")



//

?>