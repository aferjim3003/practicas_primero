<?php
require_once __DIR__ . "/../../cabecera.php";

// 3.- Se quiere:
// - Hacer lo anterior creando y rellenando el array usando varias sentencias.
// Los arrays se definirán en el controlador y se visualizarán en la vista.
// a) Crear una variable de tipo array.
$array = [];
// b) Rellenar las posiciones 1, 16, 54 con valores cualquiera.
$array[1] = "valor en posicion 1";
$array[16] = "valor en posicion 16";
$array[54] = "valor en posicion 54";
// c) Añadir el valor 34 al final
$array[] = 34;
// d) Añadir los valores “cadena”, true, 1.345 en las posiciones “uno”, “dos” y “tres”
$array["uno"] = "cadena";
$array["dos"] = true;
$array["tres"] = 1.345;
// e) Rellenar la posición “ultima” con el array (1,34,”nueva”).
$array["ultima"] = [1, 34, "nueva"];

// - Hacer lo anterior usando una sola sentencia con array;
$array2 = array(
    1 => "valor en posicion 1",
    16 => "valor en posicion 16",
    54 => "valor en posicion 54",
    55 => 34,
    "uno" => "cadena",
    "dos" => true,
    "tres" => 1.345,
    "ultima" => [1, 34, "nueva"],
);

// - Hacer lo anterior usando una sola sentencia con []
$array3 = [
    1 => "valor en posicion 1",
    16 => "valor en posicion 16",
    54 => "valor en posicion 54",
    55 => 34,
    "uno" => "cadena",
    "dos" => true,
    "tres" => 1.345,
    "ultima" => [1, 34, "nueva"],
];

$ubicacion = [
    ["TEXTO" => "Inicio", "ENLACE" => "/index.php"],
    ["TEXTO" => "Relacion 1", "ENLACE" => "/aplicacion/relacion1/index.php"],
    ["TEXTO" => "Ejercicio 3"],
];

inicioCabecera("Ejercicio 3");
cabecera();
finCabecera();
inicioCuerpo("Creacion de arrays", $ubicacion);
cuerpo($array, $array2, $array3);
finCuerpo();

function cabecera()
{
}

function cuerpo(array $array, array $array2, array $array3)
{
    echo "Arrays creados de tres formas distintas<br>";
    mostrarArray("Array creado con varias sentencias", $array);
    mostrarArray("Array creado con array()", $array2);
    mostrarArray("Array creado con []", $array3);
}

/*
* Funcin para recorrer los tres arrays usando foreach 
*/

function mostrarArray(string $titulo, array $datos)
{
    echo "<h2>" . $titulo . "</h2>";

    foreach ($datos as $indice => $valor) {
        echo $indice . ": ";

        if (is_array($valor)) {
            echo "[";
            foreach ($valor as $elemento) {
                echo $elemento . " ";
            }
            echo "]";
        } elseif (is_bool($valor)) {
            echo $valor ? "true" : "false";
        } else {
            echo $valor;
        }

        echo "<br>";
    }
}