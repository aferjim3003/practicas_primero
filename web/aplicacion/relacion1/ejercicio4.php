<?php
require_once __DIR__ . "/../../cabecera.php";

// Declarar la constante FILAS que se rellenará con el número de filas que se deben crear. Repetir lo anterior usando FILAS para crear el array y visualizarlo.
const FILAS = 5;

// 4.- Generar un array con los siguientes valores mostrándolos posteriormente con foreach. El array se debe generar usando bucles for.

$triangulo = [];
for ($fila = 1; $fila <= 5; $fila++) {
    $triangulo[$fila] = [];
    for ($columna = 0; $columna < $fila; $columna++) {
        $triangulo[$fila][] = $fila;
    }
}

// Los datos se definirán en el controlador y se visualizarán en la vista.
$triangulo2 = [];
for ($fila2 = 1; $fila2 <= FILAS; $fila2++) {
    $triangulo2[$fila2] = [];
    for ($columna2 = 0; $columna2 < $fila2; $columna2++) {
        $triangulo2[$fila2][] = $fila2;
    }
}

$ubicacion = [
    ["TEXTO" => "Inicio", "ENLACE" => "/index.php"],
    ["TEXTO" => "Relacion 1", "ENLACE" => "/aplicacion/relacion1/index.php"],
    ["TEXTO" => "Ejercicio 4"],
];

inicioCabecera(" Ejercicio 4");
cabecera();
finCabecera();
inicioCuerpo("Arrays triangulares con bucles", $ubicacion);
cuerpo($triangulo, $triangulo2);
finCuerpo();

function cabecera()
{
}

function cuerpo(array $triangulo, array $triangulo2)
{
    echo "<h2>Triangulo de cinco filas</h2>" . PHP_EOL;
    mostrarTriangulo($triangulo);

    echo "<h2>Triangulo usando FILAS = " . FILAS . "</h2>" . PHP_EOL;
    mostrarTriangulo($triangulo2);
}

function mostrarTriangulo(array $datos)
{
    // mostrar los valores usando foreach
    foreach ($datos as $fila) {
        foreach ($fila as $valor) {
            echo $valor . " ";
        }
        echo "<br>";
    }
}
