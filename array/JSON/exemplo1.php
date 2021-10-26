<?php


$pessoas = array();

array_push($pessoas, array(
    'nome' => 'João',
    'idade' => 20,
));


array_push($pessoas, array(
    'nome' => 'Fábio',
    'idade' => 25
));


echo json_encode($pessoas);
echo '<br>';
echo 'Não está funcionando...';


?>