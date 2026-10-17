<?php
require_once __DIR__ . "/../../cabecera.php";

$ubicacion = [
    ["TEXTO" => "Inicio", "ENLACE" => "/index.php"],
    ["TEXTO" => "Relacion 2"],
];

inicioCabecera("Relacion 2");
cabecera();
finCabecera();
inicioCuerpo("Relacion 2: Gestion de cadenas", $ubicacion);
cuerpo();
finCuerpo();

function cabecera()
{
}

function cuerpo()
{
    // enlaces a los ejercicios de la relacion
    echo "<h2>Ejercicios</h2>";
    echo "<ul>";
    echo "<li><a href=\"/aplicacion/relacion2/ejercicio1.php\">Ejercicio 1: tipos de cadenas</a></li>";
    echo "<li><a href=\"/aplicacion/relacion2/ejercicio2.php\">Ejercicio 2: operaciones con cadenas UTF-8</a></li>";
    echo "<li><a href=\"/aplicacion/relacion2/ejercicio3.php\">Ejercicio 3: cadenas aleatorias</a></li>";
    echo "<li><a href=\"/aplicacion/relacion2/ejercicio4.php\">Ejercicio 4: formato de numeros</a></li>";
    echo "<li><a href=\"/aplicacion/relacion2/ejercicio5.php\">Ejercicio 5: expresiones regulares</a></li>";
    echo "</ul>";
    echo "<p><a href=\"/aplicacion/relacion1/index.php\">Volver a Relacion 1</a></p>";
}
