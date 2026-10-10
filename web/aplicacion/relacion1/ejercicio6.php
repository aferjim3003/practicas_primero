<?php
require_once __DIR__ . "/../../cabecera.php";

// 6.- Con el array $vector=array("primera" =>12.56, 24=>true, 67 =>23.76);
$vector = [
    "primera" => 12.56,
    24 => true,
    67 => 23.76,
];

$ubicacion = [
    ["TEXTO" => "Inicio", "ENLACE" => "/index.php"],
    ["TEXTO" => "Relacion 1", "ENLACE" => "/aplicacion/relacion1/index.php"],
    ["TEXTO" => "Ejercicio 6"],
];

inicioCabecera("Ejercicio 6");
cabecera();
finCabecera();
inicioCuerpo("Recorrido de arrays", $ubicacion);
cuerpo($vector);
finCuerpo();

function cabecera()
{
}

function cuerpo(array $vector)
{
    // - Simular el funcionamiento de foreach ($array as $indice => $valor) usando las funciones de
    // recorrido para mostrar tanto los índices como los valores del array anterior.
    echo "Recorrido con key(), current() y next()<br>";
    reset($vector);
    while (($indice = key($vector)) !== null) {
        $valor = current($vector);
        echo "Indice " . $indice . ": "
            . (is_bool($valor) ? ($valor ? "true" : "false") : $valor) . "<br>";
        next($vector);
    }

    // - Simular el funcionamiento de foreach usando las funciones array_keys y array_values para
    // mostrar tanto los índices como los valores del array anterior.
    // El array se definirá en el controlador y se realizarán las operaciones en la vista.
    echo "Recorrido con array_keys() y array_values()<br>";
    $indices = array_keys($vector);
    $valores = array_values($vector);
    for ($i = 0; $i < count($indices); $i++) {
        echo "Indice " . $indices[$i] . ": "
            . (is_bool($valores[$i]) ? ($valores[$i] ? "true" : "false") : $valores[$i]) . "<br>";
    }
}
