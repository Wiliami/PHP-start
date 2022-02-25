<?php
require_once("nomeClass.php");

spl_autoload_register(function($nomeClass) {

    $carro = new DelRey();
    $carro->acelerar(80);
    


});


// try {
  
// } catch (Exception $e) {
//     echo 'Exceção capturada: ', $e ->getMessage();
// }



// spl_autoload_register(function ($class_name) {
//     include $class_name . '.php';
// });

// $carro = new DelRey();
// $carro -> acelerar(80);