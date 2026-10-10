<?php
require_once __DIR__ . "/../../cabecera.php";

$ubicacion = [
    [
        "TEXTO" => "Inicio",
        "ENLACE" => "/index.php",
    ],
    [
        "TEXTO" => "Relacion 1",
        "ENLACE" => "/aplicacion/relacion1/index.php",
    ],
    [
        "TEXTO" => "Ejercicio 1",
    ],
];

inicioCabecera("Ejercicio 1");
cabecera();
finCabecera();
inicioCuerpo("Funciones matematicas y bases", $ubicacion);
cuerpo();
finCuerpo();

function cabecera()
{
}

function cuerpo()
{
    // 1.- Mostrar el funcionamiento de diversas funciones Matemáticas (round, floor, pow, sqrt, entero a
    // hexadecimal, de base 4 a base 8 y al menos dos funciones mas distintas de las anteriores) (buscar la
    // información sobre las funciones matemáticas en http://php.net/manual/es/book.math.php). Definir
    // variables inicializadas con valores en binario, octal y hexadecimal. Mostrar el valor de esas variables
    // tanto en decimal como en la base en la que se han definido.
    // Hacer este ejercicio directamente en la vista (definiciones de las variables y visualización de las mismas)
    $binario = 0b101101;
    $octal = 0o755;
    $hexadecimal = 0x2A;

    echo "<h2>Funciones matematicas</h2>" . PHP_EOL;
    echo "round: " . round(4.6) . PHP_EOL;
    echo "floor: " . floor(4.9) . PHP_EOL;
    echo "pow: " . pow(2, 3) . PHP_EOL;
    echo "sqrt: " . sqrt(81) . PHP_EOL;
    echo "abs: " . abs(-12) . PHP_EOL;
    echo "max: " . max(3, 9, 5) . PHP_EOL;

    echo "<h2>Numeros en bases</h2>" . PHP_EOL;
    echo "0b101101 -> " . $binario . " en decimal y " . decbin($binario) . " en binario" . PHP_EOL;
    echo "0o755 -> " . $octal . " en decimal y " . decoct($octal) . " en octal" . PHP_EOL;
    echo "0x2A -> " . $hexadecimal . " en decimal y " . dechex($hexadecimal) . " en hexadecimal" . PHP_EOL;
    echo "132 en base 4: " . base_convert('132', 4, 8) . " en base 8" . PHP_EOL;
}