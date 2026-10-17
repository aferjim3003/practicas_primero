<?php
require_once __DIR__ . "/../../cabecera.php";

// texto de varias lineas y patrones para etiquetas, numeros y correos
$texto = <<<'DATOS'
Etiquetas:
<h1>Un titulo</h1>
<br />
Numeros:
8
2048
Direcciones:
alumno@centro.es
nombre.apellido@ejemplo.com
DATOS;

$expresion_etiqueta = '/<[^>]+>/';
$expresion_numero = '/[0-9]+/';
$expresion_correo = '/[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}/';
$coincidencia_etiqueta = [];
$coincidencia_numero = [];
$coincidencia_correo = [];

$hay_etiqueta = preg_match($expresion_etiqueta, $texto, $coincidencia_etiqueta, PREG_OFFSET_CAPTURE);
$hay_numero = preg_match($expresion_numero, $texto, $coincidencia_numero, PREG_OFFSET_CAPTURE);
$hay_correo = preg_match($expresion_correo, $texto, $coincidencia_correo, PREG_OFFSET_CAPTURE);
if ($hay_etiqueta === false || $hay_numero === false || $hay_correo === false) {
    throw new RuntimeException("No se pudieron ejecutar las expresiones regulares.");
}

$ubicacion = [
    ["TEXTO" => "Inicio", "ENLACE" => "/index.php"],
    ["TEXTO" => "Relacion 2", "ENLACE" => "/aplicacion/relacion2/index.php"],
    ["TEXTO" => "Ejercicio 5"],
];

inicioCabecera("Relacion 2 - Ejercicio 5");
cabecera();
finCabecera();
inicioCuerpo("Busquedas con expresiones regulares", $ubicacion);
cuerpo(
    $texto,
    $expresion_etiqueta,
    $expresion_numero,
    $expresion_correo,
    $hay_etiqueta,
    $coincidencia_etiqueta,
    $hay_numero,
    $coincidencia_numero,
    $hay_correo,
    $coincidencia_correo
);
finCuerpo();

function cabecera()
{
}

function cuerpo(
    string $texto,
    string $expresion_etiqueta,
    string $expresion_numero,
    string $expresion_correo,
    $hay_etiqueta,
    array $coincidencia_etiqueta,
    $hay_numero,
    array $coincidencia_numero,
    $hay_correo,
    array $coincidencia_correo
) {
    // Se muestran el texto fuente, cada patron y su primera coincidencia
    echo "<h2>Cadena analizada (NOWDOC)</h2>";
    $texto_visible = str_replace("<", "&lt;", $texto);
    $texto_visible = str_replace(">", "&gt;", $texto_visible);
    echo "<pre>" . $texto_visible . "</pre>";
    echo "<h2>Coincidencias</h2>";
    mostrarCoincidencia("Etiqueta", $expresion_etiqueta, $hay_etiqueta, $coincidencia_etiqueta);
    mostrarCoincidencia("Numero", $expresion_numero, $hay_numero, $coincidencia_numero);
    mostrarCoincidencia("Correo electronico", $expresion_correo, $hay_correo, $coincidencia_correo);
    echo "<p><a href=\"/aplicacion/relacion2/index.php\">Volver a Relacion 2</a></p>";
}

function mostrarCoincidencia(string $tipo, string $expresion, $resultado, array $coincidencia)
{
    echo "<h3>" . $tipo . "</h3>";
    $expresion_visible = str_replace("<", "&lt;", $expresion);
    $expresion_visible = str_replace(">", "&gt;", $expresion_visible);
    echo "<p>Expresion: <code>" . $expresion_visible . "</code></p>";
    if ($resultado === 1) {
        $elemento_visible = str_replace("<", "&lt;", $coincidencia[0][0]);
        $elemento_visible = str_replace(">", "&gt;", $elemento_visible);
        echo "<p>Elemento: " . $elemento_visible
            . "; posicion: " . $coincidencia[0][1] . "</p>";
    } else {
        echo "<p>No se encontro ninguna coincidencia.</p>";
    }
}
