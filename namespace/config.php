<?php 


// spl_autoload_register(function($nameClass){

//     $dirClass = "class"; 
//     $filename = $dirClass . DIRECTORY_SEPARATOR . $nameClass. ".php";

// });




function MyAutoLoad($Class) {
    $cDir = ['Cadastro', 'Helpers']; // nome das pastas que eu quero usar...
    $iDir = null;
    foreach($cDir as $dirName) {
        $filename = str_replace ("\\", "/", $dirClass . DIRECTORY_SEPARATOR . $Class . ".php");
        // $File = __DIR__ . '/' . $dirName . '/' . $Class. '.class.php';
        if(!$iDir && file_exists($File) && !is_dir($File)) {
            include_once($File); 
            $iDir = true;                                        
        }
    }
}


spl_autoload_register('MyAutoLoad');

?>   