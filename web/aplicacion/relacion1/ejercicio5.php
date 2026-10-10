<?php
require_once __DIR__ . "/../../cabecera.php";

// 5.- Rellenar un array con el siguiente contenido.
// $vector=array();
// $vector[1]="esto es una cadena";
// $vector["posi1"]=25.67;
// $vector[]=false;
// $vector["ultima"]=array(2,5,96);
// $vector[56]=23;
// El array se definirá en el controlador y se visualizará en la vista.
$vector = [];
$vector[1] = "esto es una cadena";
$vector["posi1"] = 25.67;
$vector[] = false;
$vector["ultima"] = [2, 5, 96];
$vector[56] = 23;

$ubicacion = [
    ["TEXTO" => "Inicio", "ENLACE" => "/index.php"],
    ["TEXTO" => "Relacion 1", "ENLACE" => "/aplicacion/relacion1/index.php"],
    ["TEXTO" => "Ejercicio 5"],
];

inicioCabecera("Ejercicio 5");
cabecera();
finCabecera();
inicioCuerpo("Valores y tipos de un array", $ubicacion);
cuerpo($vector);
finCuerpo();

function cabecera()
{
}

function cuerpo(array $vector)
{
    // Mostrar mediante bucles foreach el contenido del array con la siguiente salida:
    // - posicion XXX contenido (tipo) YYYYY
    // - Según el tipo del contenido
     // o Si es un array mostrarlo mediante un foreach.
   // o Si es un entero poner Entero con valor DDD, en binario BBB
    // o Si es un real DDD que al cuadrado es DDD
    // o Si es una cadena -CCCC
    // o Si es un booleano BBB y su opuesto XXX
    // Las palabras en mayúscula representan un valor concreto de lo pedido
     // El array se definirá en el controlador y se visualizará en la vista.
    foreach ($vector as $posicion => $contenido) {
        echo "Posicion " . $posicion . " contenido (" . gettype($contenido) . "): ";

        if (is_array($contenido)) {
            // si es un array, mostrar sus elementos con foreach
            echo "<br>";
            foreach ($contenido as $indice => $valor) {
                echo $indice . " => " . $valor . "<br>";
            }
        } elseif (is_int($contenido)) {
            // si es entero, mostrarlo en decimal y binario
            echo "Entero con valor " . $contenido . ", en binario " . decbin($contenido) . "<br>";
        } elseif (is_float($contenido)) {
            // si es real, mostrar su valor al cuadrado
            echo $contenido . " al cuadrado es " . ($contenido * $contenido) . "<br>";
        } elseif (is_string($contenido)) {
            // si es cadena, mostrar su contenido
            echo "-" . $contenido . "-<br>";
        } elseif (is_bool($contenido)) {
            // si es booleano, mostrar su valor y su opuesto
            echo ($contenido ? "true" : "false")
                . " y su opuesto " . ($contenido ? "false" : "true") . "<br>";
        }
    }
}
