<?php 

require_once("config.php"); // isso faz chamar as classes dentro do meu projeto (require: eu tengo certeza que o arquivo exita);

$cad = new Cadastro();


$cad -> setNome("Julio César");
$cad -> setEmail("juliocesar@gmail.com");
$cad -> setSenha("123456");

echo ($cad);

?>