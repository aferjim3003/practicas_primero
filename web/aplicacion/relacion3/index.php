<?php
require_once __DIR__ . "/../../cabecera.php";
require_once __DIR__ . "/libreria.php";

$ubicacion = [
	["TEXTO" => "Inicio", "LINK" => "/index.php"],
	["TEXTO" => "Relacion 3"],
];
inicioCabecera("Relacion 3: funciones");
cabecera();
finCabecera();
inicioCuerpo("Relacion 3: funciones", $ubicacion);
cuerpo();
finCuerpo();

/**
 * Vista de cabecera de la relacion.
 */
function cabecera()
{
}

/**
 * Muestra los ejemplos de uso de las funciones de la libreria.
 *
 */

function cuerpo(): void
{
	echo "<h2>Funciones</h2>";

    /*
    * 1
    */

	echo "<section><h3>1. cuentaVeces</h3>";
	$vector = [];
	$numeroLlamada = 0;
	if (cuentaVeces($vector, "1osicion", 7, $numeroLlamada)) {
		echo "<p>Llamada correcta: numero de llamada {$numeroLlamada}.</p>";
	}
	if (cuentaVeces($vector, "otra", 2, $numeroLlamada)) {
		echo "<p>Llamada correcta: numero de llamada {$numeroLlamada}.</p>";
	}
	if (!cuentaVeces($vector, "2daw", 9, $numeroLlamada)) {
		echo "<p class='error'>La posicion 2daw se ha rechazado</p>";
	}

    /*
    * 2
    */

	echo "<section><h3>2. generarCadena</h3>";
	$cadena = generarCadena(7);
	if ($cadena !== false) {
		echo "<p>Cadena de 7 caracteres: " . $cadena . "</p>";
	} 
    else {
		echo "<p class='error'>No se pudo generar la cadena.</p>";
	}
	if (generarCadena(0) === false) {
		echo "<p class='error'>longitud cero</p>";
	}
	echo "<p>Cadena de longitud predeterminada: " . generarCadena() . "</p></section>";



    /*
    * 3
    */
    
	echo "<section><h3>3. operaciones</h3>";


	echo "<p>Suma: " . operaciones(1, 2, 5, 7, 3, 4) . "</p>";
	echo "<p>Resta: " . operaciones(2, 2, 5, 7, 3, 4) . "</p>";
	echo "<p>Producto: " . operaciones(3, 2, 5, 7, 3, 4) . "</p>";
	echo "<p>Operacion diferente: " . operaciones(5, 2, 5, 7, 3, 4) . "</p>";
	if (operaciones(1, 2) === false) {
		echo "<p class='error'>La llamada con menos de tres parametros se ha rechazado correctamente</p>";
	}
	echo "</section>";

    /*
    * 4
    */


	echo "<section><h3>4. devuelve</h3>";
	$valorTresParametros = 2;
	$producto = devuelve($valorTresParametros, 4, 6);
	echo "<p>Tres parametros: suma en el primer parametro = {$valorTresParametros}, producto = {$producto}.</p>";

	$valorSoloPrimero = 3;
	$producto = devuelve($valorSoloPrimero);
	echo "<p>Solo el primero: suma = {$valorSoloPrimero}, producto = {$producto}.</p>";

	$valorDosParametros = 4;
	$producto = devuelve($valorDosParametros, 2);
	echo "<p>Primero y segundo: suma = {$valorDosParametros}, producto = {$producto}.</p>";

	$valorPrimeroYTercero = 5;
	$producto = devuelve($valorPrimeroYTercero, tercero: 3);
	echo "<p>Primero y tercero (argumento con nombre): suma = {$valorPrimeroYTercero}; producto = {$producto}.</p></section>";



    /*
    * 5
    */

	echo "<section><h3>5. hacerOperacion</h3>";
	$resultadoOperacion = hacerOperacion("resta", 3, 1);
	echo "<p>Resta: " . $resultadoOperacion . "</p>";
	if (hacerOperacion("division", 3, 1) === false) {
		echo "<p class='error'>La operacion no valia ha sido rechazada</p>";
	}
	echo "</section>";


    /*
    * 6
    */


	echo "<section><h3>6. llamadaAFuncion</h3>";
	$primero = 8;
	$segundo = 3;
	echo "<p>Suma: " . llamadaAFuncion($primero, $segundo, "suma") . "</p>";
	echo "<p>Resta: " . llamadaAFuncion($primero, $segundo, "resta") . "</p>";
	echo "<p>Multiplicacion: " . llamadaAFuncion($primero, $segundo, "multiplicacion") . "</p>";
	echo "</section>";


    /*
    * 7
    */

	echo "<section><h3>7. ordenar</h3>";
	$vectorOrdenado = ["uno", "grande", "caminos", "a"];
	if (ordenar($vectorOrdenado)) {
		echo print_r($vectorOrdenado, true);
	} else {
		echo "<p class='error'>El array no contiene solo cadenas.</p>";
	}
	echo "</section>";

	echo "<p><a href='/aplicacion/relacion2/index.php'>Volver a Relacion 2</a></p>";

}
