<?php 

function ola($name) {
    
   $argumentos = func_get_arg($name);

   return $argumentos;
}

var_dump(ola("Bom dia"));


?>  