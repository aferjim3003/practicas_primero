<?php
require_once __DIR__ . "/../../cabecera.php";

function generarCadenaConArray(array $caracteres, int $longitud): string
{
    $cadena = "";
    $cantidad_caracteres = count($caracteres);

    for ($indice = 0; $indice < $longitud; $indice++) {
        $posicion = rand(0, $cantidad_caracteres - 1);
        $cadena .= $caracteres[$posicion];
    }

    return $cadena;
}

function generarCadenaConAscii(int $longitud): string
{
    // se recorren los codigos ASCII y se conservan solo letras y numeros
    $codigos_validos = [];
    for ($codigo = 48; $codigo <= 122; $codigo++) {
        if (($codigo >= 48 && $codigo <= 57)
            || ($codigo >= 65 && $codigo <= 90)
            || ($codigo >= 97 && $codigo <= 122)
        ) {
            $codigos_validos[] = $codigo;
        }
    }

    $cadena = "";
    $cantidad_codigos = count($codigos_validos);
    for ($indice = 0; $indice < $longitud; $indice++) {
        $posicion = rand(0, $cantidad_codigos - 1);
        $cadena .= chr($codigos_validos[$posicion]);
    }

    return $cadena;
}

$caracteres_permitidos = str_split("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789");
$longitud_cadena = 20;
$cadena_desde_array = generarCadenaConArray($caracteres_permitidos, $longitud_cadena);
$cadena_desde_ascii = generarCadenaConAscii($longitud_cadena);
$ubicacion = [
    ["TEXTO" => "Inicio", "ENLACE" => "/index.php"],
    ["TEXTO" => "Relacion 2", "ENLACE" => "/aplicacion/relacion2/index.php"],
    ["TEXTO" => "Ejercicio 3"],
];

inicioCabecera("Relacion 2 - Ejercicio 3");
cabecera();
finCabecera();
inicioCuerpo("Cadenas aleatorias", $ubicacion);
cuerpo($caracteres_permitidos, $cadena_desde_array, $cadena_desde_ascii, $longitud_cadena);
finCuerpo();

function cabecera()
{
}

function cuerpo(array $caracteres_permitidos, string $cadena_desde_array, string $cadena_desde_ascii, int $longitud_cadena)
{
    // Se muestran las cadenas generadas y el conjunto de caracteres permitido
    echo "<h2>a) A partir de un array</h2>";
    echo "<p>Caracteres posibles: " . implode("", $caracteres_permitidos) . "</p>";
    echo "<p>Cadena aleatoria (" . $longitud_cadena . " caracteres): <strong>"
        . $cadena_desde_array . "</strong></p>";
    echo "<h2>b) A partir de codigos ASCII</h2>";
    echo "<p>Se aceptan los codigos ASCII de los numeros, las mayusculas y las minusculas.</p>";
    echo "<p>Cadena aleatoria (" . $longitud_cadena . " caracteres): <strong>"
        . $cadena_desde_ascii . "</strong></p>";
    echo "<p><a href=\"/aplicacion/relacion2/index.php\">Volver a Relacion 2</a></p>";
}
