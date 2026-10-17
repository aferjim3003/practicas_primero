<?php
require_once __DIR__ . "/../../cabecera.php";

// Resultados calculados con funciones compatibles con caracteres UTF-8
$cadena = "Está la niña en casa";
$longitud = mb_strlen($cadena, "UTF-8");
$partes_por_caracter = [];

for ($indice = 0; $indice < $longitud; $indice++) {
    $partes_por_caracter[] = [
        "caracter" => mb_substr($cadena, $indice, 1, "UTF-8"),
        "indice" => $indice,
    ];
}

$caracteres_inversos = [];
for ($indice = 0; $indice < $longitud; $indice++) {
    $caracter = mb_substr($cadena, -($indice + 1), 1, "UTF-8");
    if ($indice % 2 === 0) {
        $caracter = mb_strtoupper($caracter, "UTF-8");
    } else {
        $caracter = mb_strtolower($caracter, "UTF-8");
    }
    $caracteres_inversos[] = [
        "caracter" => $caracter,
        "indice" => $indice,
    ];
}

$partes = explode("a", $cadena);
$posicion_nina = mb_strpos($cadena, "niña", 0, "UTF-8");
$cadena_modificada = $cadena;
if ($posicion_nina !== false) {
    $posicion_despues_nina = $posicion_nina + mb_strlen("niña", "UTF-8");
    $cadena_modificada = mb_substr($cadena, 0, $posicion_despues_nina, "UTF-8")
        . "/mujer "
        . mb_substr(
            $cadena,
            $posicion_despues_nina + 1,
            $longitud - $posicion_despues_nina - 1,
            "UTF-8"
        );
}

$ubicacion = [
    ["TEXTO" => "Inicio", "ENLACE" => "/index.php"],
    ["TEXTO" => "Relacion 2", "ENLACE" => "/aplicacion/relacion2/index.php"],
    ["TEXTO" => "Ejercicio 2"],
];

inicioCabecera("Relacion 2 - Ejercicio 2");
cabecera();
finCabecera();
inicioCuerpo("Operaciones con cadenas UTF-8", $ubicacion);
cuerpo($cadena, $partes_por_caracter, $caracteres_inversos, $partes, $cadena_modificada);
finCuerpo();

function cabecera()
{
}

function cuerpo(
    string $cadena,
    array $partes_por_caracter,
    array $caracteres_inversos,
    array $partes,
    string $cadena_modificada
) {
    // Estas formas acceden a bytes y no sirven para recorrer correctamente caracteres UTF-8
    // $caracter = $cadena[$indice];
    // $caracter = substr($cadena, $indice, 1);
    // para obtener un caracter UTF-8 se usa mb_substr
    echo "<p>Cadena: " . $cadena . "</p>";
    echo "<h2>Caracter por linea, con espacios segun su posicion</h2>";
    foreach ($partes_por_caracter as $elemento) {
        echo str_repeat("&nbsp;", $elemento["indice"]);
        echo $elemento["caracter"] . "<br>";
    }

    echo "<h2>Cadena inversa; mayusculas en posiciones pares</h2>";
    foreach ($caracteres_inversos as $elemento) {
        echo str_repeat("&nbsp;", $elemento["indice"]);
        echo $elemento["caracter"] . "<br>";
    }

    echo "<h2>Partes separadas por el caracter a</h2>";
    foreach ($partes as $parte) {
        echo $parte . "<br>";
    }

    echo "<h2>Reemplazo despues de \"niña\"</h2>";
    echo $cadena_modificada . "<br>";
    echo "<p><a href=\"/aplicacion/relacion2/index.php\">Volver a Relacion 2</a></p>";
}
