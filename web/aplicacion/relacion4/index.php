<?php
require_once __DIR__ . "/../../cabecera.php";

// Se preparan ejemplos sencillos para probar las clases
$instrumento = new InstrumentoViento("madera");
$instrumento->setDescripcion("clarinete");
$instrumento->envejecer();

$flauta = Flauta::CrearDesdeArray(["material" => "metal", "edad" => 8]);
$flauta_clonada = clone $flauta;

$casos_estado = EstadoCivil::casos();
$valores_estado = [];
foreach ($casos_estado as $caso_estado) {
    $valores_estado[] = $caso_estado->valor();
}
$estado_aleatorio = EstadoCivil::from($valores_estado[rand(0, count($valores_estado) - 1)]);
$persona = Persona::registrarPersona(
    "Ana",
    "15/05/2002",
    "carrera 12",
    "Antequera",
    $estado_aleatorio
);

$serie = new SerieFibonacci(10);
$serie_generador = SerieFibonacci::fFibonacci(10);

$objeto = new ClaseMisPropiedades();
$objeto->propPublica = "publica";
$objeto->propiedad1 = 25;
$objeto->propiedad2 = "cadena de texto";
$objeto->propiedad_temporal = "valor temporal";
$existe_propiedad_temporal = isset($objeto->propiedad_temporal);
unset($objeto->propiedad_temporal);
$existe_despues_de_unset = isset($objeto->propiedad_temporal);

$ubicacion = [
    ["TEXTO" => "Inicio", "ENLACE" => "/index.php"],
    ["TEXTO" => "Relacion 4"],
];

inicioCabecera("Relacion 4");
cabecera();
finCabecera();
inicioCuerpo("Relacion 4: Clases, objetos y enumeraciones", $ubicacion);
cuerpo(
    $instrumento,
    $flauta,
    $flauta_clonada,
    $persona,
    $serie,
    $serie_generador,
    $objeto,
    $casos_estado,
    $existe_propiedad_temporal,
    $existe_despues_de_unset
);
finCuerpo();

function cabecera()
{
}

function cuerpo(
    InstrumentoViento $instrumento,
    Flauta $flauta,
    Flauta $flauta_clonada,
    Persona $persona,
    SerieFibonacci $serie,
    Generator $serie_generador,
    ClaseMisPropiedades $objeto,
    array $casos_estado,
    bool $existe_propiedad_temporal,
    bool $existe_despues_de_unset
) {
    // Se muestran la descripcion, el sonido, el afinado y la edad del instrumento
    echo "<h2>Instrumentos</h2>";
    echo "<p>" . $instrumento . "</p>";
    echo "<p>Sonido: " . $instrumento->sonido() . "</p>";
    echo "<p>Como afinar: " . $instrumento->afinar() . "</p>";
    echo "<p>" . $flauta . "</p>";
    echo "<p>Sonido: " . $flauta->sonido() . "</p>";
    echo "<p>Fabricacion: " . $flauta->metodoFabricacion() . "</p>";
    echo "<p>Reciclado: " . $flauta->metodoReciclado() . "</p>";
    echo "<p>Edad de la flauta clonada: " . $flauta_clonada->getEdad() . "</p>";

    echo "<h2>Estados civiles y persona</h2>";
    foreach ($casos_estado as $caso_estado) {
        echo "<p>" . $caso_estado->descripcion() . ": " . $caso_estado->valor() . "</p>";
    }
    echo "<p>" . $persona->toString() . "</p>";
    echo "<p>Nombre obtenido con get: " . $persona->getNombre() . "</p>";

    echo "<h2>Serie Fibonacci con Iterator</h2>";
    foreach ($serie as $valor) {
        echo $valor . "&nbsp;";
    }

    echo "<h2>Serie Fibonacci con generador</h2>";
    foreach ($serie_generador as $valor) {
        echo $valor . "&nbsp;";
    }

    echo "<h2>Propiedades dinamicas</h2>";
    echo "<p>isset antes de unset: " . ($existe_propiedad_temporal ? "true" : "false") . "</p>";
    echo "<p>isset despues de unset: " . ($existe_despues_de_unset ? "true" : "false") . "</p>";
    echo "<p>propiedad1: " . $objeto->propiedad1 . "</p>";
    echo "<p>propiedad2: " . $objeto->propiedad2 . "</p>";
    echo "<p>Recorrido con foreach:</p>";
    foreach ($objeto as $clave => $valor) {
        echo $clave . ": " . $valor . "<br>";
    }

    echo "<p><a href=\"/index.php\">Volver al inicio</a></p>";
}
