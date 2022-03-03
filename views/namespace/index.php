<?php 

require_once("config.php"); // isso faz chamar as classes dentro do meu projeto (require: eu tenho certeza que o arquivo existe)

use Cliente\Cadastro;

$Cadastro = new Cadastro();
$Cadastro->setNome("Julio César");
$Cadastro->setEmail("juliocesar@gmail.com");
$Cadastro->setSenha("123456");
$Cadastro->registrarVenda(); 