<?php 

// escopo de variável 

$name = "Carlos"; 

function teste() {

    global $name;
    echo $name;
}

function teste1() {
        echo $name;
    }

    teste();

?>