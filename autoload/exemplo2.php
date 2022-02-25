<?php 

function incluirClasses($nameClasse) {
    if (file_exists($nameClasse. ".php") === true) { 
        require_once($nomeClasse. ".php");
    }
}


spl_autoload_register("incluirClasses");
spl_autoload_register(function($nameClasse) {
    if (file_exists("Abstratas" . DIRECTORY_SEPARATOR . $nameClasse. " .php") === true) {
        require_once("Abstratas" . DIRECTORY_SEPARATOR . $nameClasse. " .php"); 
    }
});

$carro = new DelRey();
$carro -> acelerar(80);