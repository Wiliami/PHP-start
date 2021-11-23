<?php

const HOST = '';
const USER = '';
const PASS = '';
const DBSA = '';

function MyAutoLoad($Class) {
    $cDir = ['Conn', 'Helpers'];
    $iDir = null;
    foreach($cDir as $dirName) {
        $File = __DIR__ . '/' . $dirName . '/' . $Class. '.class.php';
        if(!$iDir && file_exists($File) && !is_dir($File)) {
            include_once($File);
            $iDir = true;
        }
    }
}

spl_autoload_register('MyAutoLoad');

/** Personaliza o gatilho do PHP e salva no banco de dados para ser enviado ao desenvolvedor futuramente
 * @param string $ErrNo
 * @param string $ErrMsg
 * @param string $ErrFile
 * @param string $ErrLine
 */
function error_handler($ErrNo, $ErrMsg, $ErrFile, $ErrLine) {
    echo "<div class='alert alert-success alert-dismissable'><button aria-hidden='true' data-dismiss='alert' class='close' type='button'>×</button> {$ErrMsg} - {$ErrFile}: {$ErrLine}</div>";
}

/** Personaliza o gatilho do PHP e salva no banco de dados para ser enviado ao desenvolvedor futuramente
 * @param array $exception - Contendo os dados do erro
 */
function exception_handler($exception) {
    echo "<div class='alert alert-danger alert-dismissable'><button aria-hidden='true' data-dismiss='alert' class='close' type='button'>×</button>{$exception->getCode()} - {$exception->getMessage()} - {$exception->getFile()}:{$exception->getLine()}</div>";
}

set_error_handler('error_handler');
set_exception_handler('exception_handler');
