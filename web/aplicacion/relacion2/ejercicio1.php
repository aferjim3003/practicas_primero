<?php
require_once __DIR__ . "/../../cabecera.php";

// Ejemplos con comillas, HEREDOC y NOWDOC
$nombre = "Lucia";
$cadena_dobles = "Comillas dobles: $nombre; apostrofo ' y comillas \"dobles\"; "
    . "acentos: á, é, ñ; etiqueta: <strong>texto</strong>.";
$cadena_simples = 'Comillas simples: $nombre no se interpreta; apostrofo \' y comillas "dobles"; '
    . 'acentos: á, é, ñ; etiqueta: <em>texto</em>.';
$cadena_heredoc = <<<TEXTO
HEREDOC expande la variable: $nombre.
Incluye apostrofo ', comillas "dobles", acentos á, é, ñ y la etiqueta <p>que se mostrara como texto</p>.
TEXTO;
$cadena_nowdoc = <<<'TEXTO'
NOWDOC no expande la variable: $nombre.
Incluye apostrofo ', comillas "dobles", acentos á, é, ñ y la etiqueta <p>que se mostrara como texto</p>.
TEXTO;

$cadenas = [
    "Comillas dobles" => $cadena_dobles,
    "Comillas simples" => $cadena_simples,
    "HEREDOC" => $cadena_heredoc,
    "NOWDOC" => $cadena_nowdoc,
];
$ubicacion = [
    ["TEXTO" => "Inicio", "ENLACE" => "/index.php"],
    ["TEXTO" => "Relacion 2", "ENLACE" => "/aplicacion/relacion2/index.php"],
    ["TEXTO" => "Ejercicio 1"],
];

inicioCabecera("Relacion 2 - Ejercicio 1");
cabecera();
finCabecera();
inicioCuerpo("Cadenas y delimitadores", $ubicacion);
cuerpo($cadenas);
finCuerpo();

function cabecera()
{
}

function cuerpo(array $cadenas)
{
    // se conservan los saltos de linea y se escapan las etiquetas para mostrarlas como texto
    echo "<p>Las etiquetas HTML aparecen escapadas para que se lean y no se interpreten.</p>";
    echo "<pre>";
    foreach ($cadenas as $tipo => $cadena) {
        echo $tipo . ":\n";
        $cadena_visible = str_replace("<", "&lt;", $cadena);
        $cadena_visible = str_replace(">", "&gt;", $cadena_visible);
        echo $cadena_visible . "\n\n";
    }
    echo "</pre>";
    echo "<p><a href=\"/aplicacion/relacion2/index.php\">Volver a Relacion 2</a></p>";
}
