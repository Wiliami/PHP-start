<?php 

session_start();
//require_once("config.php");

echo $_SESSION["nome"] = "Dudu";

session_unset($_SESSION["nome"]);

echo $_SESSION["nome"]; 

session_destroy($_SESSION["nome"]);

echo $_SESSION["nome"];

?>