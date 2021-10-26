<?php 
require '_app/Config.inc.php';

//CADASTRAR
$DataCreate['user_name'] = 'Dudu';
$DataCreate['user_lastname'] = 'Sampaio';
$DataCreate['user_create_date'] = date('Y-m-d H:i:s');

$Create = new Create();
//$Create->ExeCreate('users', $DataCreate);

//LER
$Read = new Read();
$Read->FullRead("SELECT * FROM users WHERE user_id = 3");
//Check::var_dump_json($Read->getResult());


//ATUALIZAR
$DataUpdate['user_name'] = 'Odelfrance';
$DataUpdate['user_lastname'] = 'Oliveira';
$DataUpdate['user_update_date'] = date('Y-m-d H:i:s');
$Update = new Update();


$Id = 2;
$Update->ExeUpdate("users", $DataUpdate, "WHERE user_id = :id", "id={$Id}");
//Check::var_dump_json($Update->getResult());


//DELETE
$Id = 3;
$Delete = new Delete();
$Delete->ExeDelete("users", "WHERE user_id = :id", "id={$Id}");
// var_dump($Read->getResult());


//$dbphp8 = "dbphp8";
// $usuario="root";
// $senha="";


// $conn = new PDO("mysql: host=127.0.0.1; dbname=dbphp8 ", $usuario, $senha);

// $stmt = $conn->prepare("INSERT INTO tb_usuarios (deslogin, dessenha) VALUES(:LOGIN, :PASSWORD)");



// $login = "jose";
// $password = "123456789"; 


// $stmt->bindParam(":LOGIN", $login);
// $stmt->bindParam(":PASSWORD", $password);

// try {
//     $stmt->execute();
// } catch (PDOException $e) {
//     var_dump($e);
// }



?>