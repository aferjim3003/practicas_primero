<?php

/**
 * Guarda un valor en una posicion asociativa y devuelve el numero de llamada.
 *
 */

function cuentaVeces(array &$vector, string $posicion, int $valor, int &$numero): bool
{
	static $llamadas = 0;

	if (trim($posicion) === '' || in_array(strtolower(trim($posicion)), ['2daw', 'primera'], true)) {
		return false;
	}

	$vector[$posicion] = $valor;
	$llamadas++;
	$numero = $llamadas;

	return true;
}

/**
 * Genera una cadena aleatoria formada por letras y numeros.
 *
 */

function generarCadena(int $longitud = 10): string|false
{
	if ($longitud <= 0) {
		return false;
	}

	$caracteres = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
	$cadena = '';
	$limite = strlen($caracteres) - 1;

	for ($indice = 0; $indice < $longitud; $indice++) {
		$cadena .= $caracteres[random_int(0, $limite)];
	}

	return $cadena;
}

/**
 * Ejecuta una operacion sobre dos o mas operandos enteros.
 *
 */

function operaciones(int $tipo, int ...$operandos): int|false
{
	if (count($operandos) < 2) {
		return false;
	}

	switch ($tipo) {
		case 1:
			return array_sum($operandos);
		case 2:
			$resultado = array_shift($operandos);
			foreach ($operandos as $operando) {
				$resultado -= $operando;
			}
			return $resultado;
		case 3:
			return array_product($operandos);
		default:
			$pares = 0;
			$impares = 0;
			foreach ($operandos as $indice => $operando) {
				if (($indice + 1) % 2 === 0) {
					$pares += $operando;
				} 
                else {
					$impares += $operando;
				}
			}
			return $pares - $impares;
	}
}

/**
 * Suma los tres valores en el primer parametro y devuelve su producto.
 *
 */
function devuelve(int &$primero, int $segundo = 5, int $tercero = 10): int
{
	$producto = $primero * $segundo * $tercero;
	$primero += $segundo + $tercero;

	return $producto;
}

/**
 * Suma dos numeros enteros.
 *
 */
function suma(int $primero, int $segundo): int
{
	return $primero + $segundo;
}

/**
 * Resta dos numeros enteros.
 *
 */
function resta(int $primero, int $segundo): int
{
	return $primero - $segundo;
}

/**
 * Multiplica dos numeros enteros.
 *
 */
function multiplicacion(int $primero, int $segundo): int
{
	return $primero * $segundo;
}

/**
 * Ejecuta la operacion indicada mediante una variable funcion.
 *
 */
function hacerOperacion(string $operacion, int $primero, int $segundo): int|false
{
	if (!in_array($operacion, ['suma', 'resta', 'multiplicacion'], true)) {
		return false;
	}

	$funcion = $operacion;
	return $funcion($primero, $segundo);
}

/**
 * Llama a la funcion callback con dos operandos enteros
 *
 */
function llamadaAFuncion(int $primero, int $segundo, callable $callback): int|false
{
	$resultado = $callback($primero, $segundo);
	return is_int($resultado) ? $resultado : false;
}

/**
 * Ordena un array de cadenas por longitud, de mayor a menor.
 *
 */
function ordenar(array &$vector): bool
{
	foreach ($vector as $elemento) {
		if (!is_string($elemento)) {
			return false;
		}
	}

	return usort($vector, function (string $primero, string $segundo): int {
		return strlen($segundo) <=> strlen($primero);
	});
}
