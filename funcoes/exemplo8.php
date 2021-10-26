<?php 

function soma(int ...$valores): int {
    return array_sum($valores);
} 

echo var_dump(soma(2, 2));
echo "<br>";
echo soma(50, 50);
echo "<br>";
echo soma(1.2, 5.6);
echo "<br>";
echo soma(4.8, 4.5);


?>