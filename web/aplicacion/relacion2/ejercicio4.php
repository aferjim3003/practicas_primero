<?php
require_once __DIR__ . "/../../cabecera.php";

// se aplican separadores locales y se rellenan ambos valores hasta 15 caracteres
$primer_valor = 17.5;
$segundo_valor = 379987.24;
$primer_valor_numerico = number_format($primer_valor, 1, ",", ".");
$segundo_valor_numerico = number_format($segundo_valor, 2, ",", ".");
$primer_valor_formateado = str_repeat("0", 15 - mb_strlen($primer_valor_numerico, "UTF-8"))
    . $primer_valor_numerico;
$segundo_valor_formateado = str_repeat(" ", 15 - mb_strlen($segundo_valor_numerico, "UTF-8"))
    . $segundo_valor_numerico;
$ubicacion = [
    ["TEXTO" => "Inicio", "ENLACE" => "/index.php"],
    ["TEXTO" => "Relacion 2", "ENLACE" => "/aplicacion/relacion2/index.php"],
    ["TEXTO" => "Ejercicio 4"],
];

inicioCabecera("Relacion 2 - Ejercicio 4");
cabecera();
finCabecera();
inicioCuerpo("Formato de numeros", $ubicacion);
cuerpo($primer_valor_formateado, $segundo_valor_formateado);
finCuerpo();

function cabecera()
{
}

function cuerpo(string $primer_valor_formateado, string $segundo_valor_formateado)
{
    echo "<p>Los valores numericos tienen 15 caracteres. Se usa coma decimal y punto de miles.</p>";
    echo "<pre>";
    echo "el primer valor -" . $primer_valor_formateado . "-,\n";
    echo "el segundo valor -" . $segundo_valor_formateado . "-";
    echo "</pre>";
    echo "<p><a href=\"/aplicacion/relacion2/index.php\">Volver a Relacion 2</a></p>";
}
