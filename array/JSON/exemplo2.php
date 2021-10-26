<?php 

$json = '[{"nome":"Jo\u00e3o","idade":20},{"nome":"F\u00e1bio","idade":25}]';

json_decode($json, true);

?>