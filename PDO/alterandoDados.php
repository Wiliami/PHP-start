<?php 

//$dbphp8 = "dbphp8";
$usuario="root";
$senha="";


$conn = new PDO("mysql: dbname=dbphp8; host=127.0.0.1", $usuario, $senha);

$stmt = $conn ->prepare("UPDATE tb_usuarios SET deslogin = :LOGIN,  dessenha = : PASSWORD WHERE idusuario = :ID");


$login = "jose";
$password = "123456789";


$stmt -> bindParam(":LOGIN", $login);
$stmt -> bindParam(":PASSWORD", $password);

$stmt -> execute();

echo "dados inseridos, ok";



?>