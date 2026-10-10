<?php
require_once __DIR__ . "/../../cabecera.php";

$ubicacion = [
    [
        "TEXTO" => "Inicio",
        "ENLACE" => "/index.php",
    ],
    [
        "TEXTO" => "Relacion 1",
    ],
];

inicioCabecera("Relacion 1 ");
cabecera();
finCabecera();
inicioCuerpo("Relacion 1", $ubicacion);
cuerpo();
finCuerpo();

function cabecera()
{
}

function cuerpo()
{
?>
    <?php // enlaces a los ejercicios de la relacion ?>
    <p>Ejercicios</p>
    <p><a href="/aplicacion/relacion1/ejercicio1.php">Ejercicio1</a></p>
    <p><a href="/aplicacion/relacion1/ejercicio2.php">Ejercicio 2</a></p>
    <p><a href="/aplicacion/relacion1/ejercicio3.php">Ejercicio 3</a></p>
    <p><a href="/aplicacion/relacion1/ejercicio4.php">Ejercicio4</a></p>
    <p><a href="/aplicacion/relacion1/ejercicio5.php">Ejercicio 5</a></p>
    <p><a href="/aplicacion/relacion1/ejercicio6.php">Ejercicio 6</a></p>
    <p><a href="/aplicacion/relacion1/ejercicio7.php">Ejercicio 7</a></p>
<?php
}
