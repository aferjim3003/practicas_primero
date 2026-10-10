<?php
require_once __DIR__ . "/../../cabecera.php";

$ubicacion = [
    ["TEXTO" => "Inicio", "ENLACE" => "/index.php"],
    ["TEXTO" => "Relacion 1", "ENLACE" => "/aplicacion/relacion1/index.php"],
    ["TEXTO" => "Ejercicio 7"],
];

inicioCabecera("Ejercicio 7");
cabecera();
finCabecera();
inicioCuerpo("Fechas y horas", $ubicacion);
cuerpo();
finCuerpo();

function cabecera()
{
}

function cuerpo()
{
    // 7.- Mostrar el funcionamiento de las fechas. Se harán todos los apartados usando la serie de funciones
    // para gestión de fecha. Se repetirán todos los ejercicios usando la clase DateTime.
    // - Mostrar la fecha actual en el formato “d/m/Y”
    // - Mostrar la fecha actual en el formato “dia d, mes mmmm, año yyyy, dia de la semana dd”.
    // - Mostrar la hora actual en el formato “hh:mm:ss”
    // - Mostrar los tres apartados anteriores para la fecha 29/3/2024 a 12:45.
    // - Mostrar los tres apartados anteriores para la fecha actual menos 12 días y 4 horas
    // Se definirán las fechas y se visualizarán directamente en la vista. ( no se definirán en el
    // controlador)
    $ahora = time();
    $fecha = mktime(12, 45, 0, 3, 29, 2024);
    $fecha2 = strtotime("-12 days -4 hours", $ahora);

    $nombres = [
        1 => "enero", "febrero", "marzo", "abril", "mayo", "junio",
        "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre",
    ];
    $nombres2 = [
        1 => "lunes", "martes", "miercoles", "jueves", "viernes", "sabado", "domingo",
    ];
    echo "Usando funciones de fecha<br>";
    mostrarFechaFunciones("Fecha actual", $ahora, $nombres, $nombres2);
    mostrarFechaFunciones("29/3/2024 a las 12:45", $fecha, $nombres, $nombres2);
    mostrarFechaFunciones("Fecha actual menos 12 dias y 4 horas", $fecha2, $nombres, $nombres2);

    echo "Usando la clase DateTime<br>";
    $fecha3 = new DateTime();
    $fecha4 = DateTime::createFromFormat("!j/n/Y H:i", "29/3/2024 12:45");
    $fecha5 = clone $fecha3;
    $fecha5->modify("-12 days -4 hours");

    if ($fecha4 === false) {
        throw new RuntimeException("No se pudo crear la fecha fija del ejercicio.");
    }

    mostrarFechaDateTime("Fecha actual", $fecha3, $nombres, $nombres2);
    mostrarFechaDateTime("29/3/2024 a las 12:45", $fecha4, $nombres, $nombres2);
    mostrarFechaDateTime("Fecha actual menos 12 dias y 4 horas", $fecha5, $nombres, $nombres2);
}

/*
* fuyncion para mostrar la fecha con funciones
*/


function mostrarFechaFunciones(string $titulo, int $instante, array $nombres, array $nombres2)
{
    $diasemana = (int) date("N", $instante);
    $mes = (int) date("n", $instante);
    echo $titulo . "<br>";
    echo "Fecha: " . date("d/m/Y", $instante) . "<br>";
    echo "Dia " . date("d", $instante) . ", mes " . $nombres[$mes]
        . ", año " . date("Y", $instante) . ", dia de la semana "
        . $nombres2[$diasemana] . "<br>";
    echo "Hora: " . date("H:i:s", $instante) . "<br>";
}

/*
* Funcion para mostrar las fechas con date time
*/ 

function mostrarFechaDateTime(string $titulo, DateTime $fecha, array $nombres, array $nombres2)
{
    $diasemana = (int) $fecha->format("N");
    $mes = (int) $fecha->format("n");
    echo $titulo . "<br>";
    echo "Fecha: " . $fecha->format("d/m/Y") . "<br>";
    echo "Dia " . $fecha->format("d") . ", mes " . $nombres[$mes]
        . ", año " . $fecha->format("Y") . ", dia de la semana "
        . $nombres2[$diasemana] . "<br>";
    echo "Hora: " . $fecha->format("H:i:s") . "<br>";
}
