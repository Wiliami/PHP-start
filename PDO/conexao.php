<?php

$hostname = "127.0.0.1"; // localhost
$usuario = "root";
$senha = "";
$bancodedados = "dbphp8";



// $conn = new PDO($hostname, $bancodedados, $usuario, $senha);
$conn = new PDO("mysql:dbname=dbphp8; host=127.0.0.1", $usuario, $senha);

$stmt = $conn->prepare("SELECT * FROM tb_usuarios ORDER BY deslogin");


$stmt->execute();


$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
 
foreach($results as $row) {
    
    foreach($row as $key => $value) {

        echo "<strong>" .$key. ":</strong>".$value."<br />";
    } 

    echo "==============================================================<br/>";
}



?>