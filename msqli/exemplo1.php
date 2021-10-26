<?php 

$hostname = "localhost";
$usuario = "root";
$senha = "";
$bancodedados =  "dbphp8";


$conn = new mysqli($hostname, $usuario, $senha, $bancodedados);

if ($conn -> connect_error) {

    echo "Error: ". $conn -> connect_error;
    exit;

} else { 
       echo "Connected successfully";
    }



$stmt = $conn->prepare("INSERT INTO tb_usuarios (deslogin, dessenha) VALUES (?, ?)");

$stmt ->bind_param("ss", $login, $pass);


// cadastrando o usuário
$login = "user";
$pass = "12345";    

$stmt -> execute();

echo "Cadastro realizado!";


?>