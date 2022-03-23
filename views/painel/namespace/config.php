<?php 

spl_autoload_register(function($nameClass) {

    $dirClass = "class"; 
    $filename = $dirClass . DIRECTORY_SEPARATOR . $nameClass. ".php";

    if(file_exists($filename)) {
        require_once($filename);
    }

});

// function MyAutoLoad($Class) {
//     $cDir = ['Class', 'Cliente']; // nome das pastas que eu quero usar...
//     $iDir = null;
//     foreach($cDir as $dirName) {
//         $filename = str_replace ("\\", "/", $dirClass . DIRECTORY_SEPARATOR . $Class . ".php");
//         // $File = __DIR__ . '/' . $dirName . '/' . $Class. '.class.php';
//         if(!$iDir && file_exists($File) && !is_dir($File)) {
//             include_once($File); 
//             $iDir = true;                                        
//         }
//     }
// }


// spl_autoload_register('MyAutoLoad');

?>   