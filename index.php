<?php
session_start();
require_once '_app/Config.in.php';

$getURL = strip_tags(trim(filter_input(INPUT_GET, 'url', FILTER_DEFAULT)));
$setURL = (empty($getURL) ? 'index' : $getURL);
$URL  = explode('/', $getURL);
$URL[0] = (!empty($URL[0]) ? $URL[0] : 'index');


$Location = './views/' . implode('/', $URL) . '.php';
//Check::var_dump_json($Location, file_exists($Location));
if(file_exists($Location) && !is_dir($Location)) {
    require_once($Location);
} else {
    require_once('./views/pages/404.php');
}

