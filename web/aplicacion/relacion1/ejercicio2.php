<?php
require_once __DIR__ . "/../../cabecera.php";

const numlanza = 100;


// 2.- Simular el lanzamiento de un dado (6 veces) (usar un bucle for, mt_rand con parametros).
$tiradasseis = [];
for ($i = 0; $i < 6; $i++) {
    $tiradasseis[] = mt_rand(1, 6);
}

$frecuencias = array_fill(1, 6, 0);
$lanzamiento = 0;
while ($lanzamiento < numlanza) {
    $cara = (mt_rand() % 6) + 1;
    $frecuencias[$cara]++;
    $lanzamiento++;
}

$ubicacion = [
    ["TEXTO" => "Inicio", "ENLACE" => "/index.php"],
    ["TEXTO" => "Relacion 1", "ENLACE" => "/aplicacion/relacion1/index.php"],
    ["TEXTO" => "Ejercicio 2"],
];

inicioCabecera("Ejercicio 2");
cabecera();
finCabecera();
inicioCuerpo("Lanzamiento de dados", $ubicacion);
cuerpo($tiradasseis, $frecuencias);
finCuerpo();

function cabecera()
{
}

function cuerpo(array $tiradasseis, array $frecuencias)
{
    echo "<h2>Seis tiradas</h2>";
    foreach ($tiradasseis as $tirada) {
        echo $tirada . "<br>";
    }

    echo "<h2>Frecuencia en " . numlanza . " lanzamientos</h2>";
    foreach ($frecuencias as $cara => $cantidad) {
        echo "La cara " . $cara . " ha salido " . $cantidad . " veces<br>";
    }
}