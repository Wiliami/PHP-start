<?php 


spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

$carro = new DelRey();

$carro -> acelerar(80);


?>