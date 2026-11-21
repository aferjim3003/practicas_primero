<?php
require_once __DIR__ . "/../../cabecera.php";
require_once __DIR__ . "/funciones.php";

cargarPuntos();
$errores = [
    "x" => "",
    "y" => "",
    "color" => "",
    "grosor" => "",
    "borrar" => "",
    "fichero" => "",
];
$valorX = isset($_POST["x"]) && is_string($_POST["x"]) ? $_POST["x"] : "";
$valorY = isset($_POST["y"]) && is_string($_POST["y"]) ? $_POST["y"] : "";
$valorColor = isset($_POST["color"]) && is_string($_POST["color"]) ? $_POST["color"] : "";
$valorGrosor = isset($_POST["grosor"]) && is_string($_POST["grosor"]) ? $_POST["grosor"] : "";
$valorBorrar = isset($_POST["borrar_punto"]) && is_string($_POST["borrar_punto"])
    ? $_POST["borrar_punto"] : "";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["guardar"])) {
    $xValido = esEnteroTexto($valorX) && (int) $valorX <= 500;
    $yValido = esEnteroTexto($valorY) && (int) $valorY <= 500;
    $colorValido = isset(Punto::COLORES[$valorColor]);
    $grosorValido = esEnteroTexto($valorGrosor)
        && isset(Punto::GROSORES[(int) $valorGrosor]);

    if (!$xValido) {
        $errores["x"] = "Introduce un entero entre 0 y 500.";
    }
    if (!$yValido) {
        $errores["y"] = "Introduce un entero entre 0 y 500.";
    }
    if (!$colorValido) {
        $errores["color"] = "Selecciona un color.";
    }
    if (!$grosorValido) {
        $errores["grosor"] = "Selecciona un grosor.";
    }

    if ($xValido && $yValido && $colorValido && $grosorValido) {
        $Puntos[] = new Punto((int) $valorX, (int) $valorY, $valorColor, (int) $valorGrosor);
        guardarPuntos();
        guardarImagenPuntos($Puntos);
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["borrar"])) {
    if (!esEnteroTexto($valorBorrar) || !isset($Puntos[(int) $valorBorrar])) {
        $errores["borrar"] = "Selecciona un punto existente.";
    } else {
        unset($Puntos[(int) $valorBorrar]);
        $Puntos = array_values($Puntos);
        guardarPuntos();
        guardarImagenPuntos($Puntos);
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["subir"])) {
    if (!isset($_FILES["fichero"]["error"])
        || $_FILES["fichero"]["error"] !== UPLOAD_ERR_OK
        || !isset($_FILES["fichero"]["tmp_name"])
        || !is_string($_FILES["fichero"]["tmp_name"])) {
        $errores["fichero"] = "Selecciona un fichero TXT valido.";
    } else {
        $fichero = fopen($_FILES["fichero"]["tmp_name"], "r");
        if (!$fichero) {
            $errores["fichero"] = "No se pudo leer el fichero subido.";
        } else {
            $cantidadAgregada = 0;
            while (($linea = fgets($fichero)) !== false) {
                if (trim($linea) === "") {
                    continue;
                }

                $punto = puntoDesdeLinea($linea);
                if ($punto !== null) {
                    $Puntos[] = $punto;
                    $cantidadAgregada++;
                }
            }
            fclose($fichero);

            if ($cantidadAgregada > 0) {
                guardarPuntos();
                guardarImagenPuntos($Puntos);
            }
        }
    }
}

if (!file_exists(obtenerArchivoImagen())) {
    guardarImagenPuntos($Puntos);
}
$urlImagen = "/imagenes/puntos/imagen_" . obtenerIdentificadorCliente() . ".jpg?v="
    . $_SERVER["REQUEST_TIME"];

$ubicacion = [
    ["TEXTO" => "Inicio", "ENLACE" => "/index.php"],
    ["TEXTO" => "Relacion 7"],
];

inicioCabecera("Relacion 7: Ficheros");
cabecera();
finCabecera();
inicioCuerpo("Relacion 7: Puntos y ficheros", $ubicacion);
cuerpo(
    $Puntos,
    $errores,
    $valorX,
    $valorY,
    $valorColor,
    $valorGrosor,
    $valorBorrar,
    $urlImagen
);
finCuerpo();

function cabecera()
{
}

function cuerpo(
    array $Puntos,
    array $errores,
    string $valorX,
    string $valorY,
    string $valorColor,
    string $valorGrosor,
    string $valorBorrar,
    string $urlImagen
): void {
    echo "<h2>Puntos almacenados</h2>";
    echo "<textarea rows='8' cols='55' readonly>";
    foreach ($Puntos as $punto) {
        echo $punto->getX() . " ; " . $punto->getY() . " ; "
            . $punto->getColor() . " ; " . $punto->getGrosor() . "\n";
    }
    echo "</textarea>";
    echo "<p><img src='" . escaparHtml($urlImagen)
        . "' alt='Imagen con los puntos' width='501' height='501'></p>";
    echo "<p><a href='/aplicacion/relacion7/imagen.php'>Descargar imagen JPG</a></p>";

    echo "<h2>Añadir punto</h2>";
    echo "<form method='post' action='/aplicacion/relacion7/index.php'>";
    echo "<label>Coordenada x: <input type='text' name='x' value='"
        . escaparHtml($valorX) . "'></label> ";
    echo "<span class='error'>" . $errores["x"] . "</span><br>";
    echo "<label>Coordenada y: <input type='text' name='y' value='"
        . escaparHtml($valorY) . "'></label> ";
    echo "<span class='error'>" . $errores["y"] . "</span><br>";

    echo "<label>Color: <select name='color'><option value=''>Selecciona un color</option>";
    foreach (Punto::COLORES as $clave => $color) {
        $seleccionado = $valorColor === $clave ? " selected" : "";
        echo "<option value='" . $clave . "'" . $seleccionado . ">"
            . $color["nombre"] . "</option>";
    }
    echo "</select></label> <span class='error'>" . $errores["color"] . "</span><br>";

    echo "<span>Grosor:</span> ";
    foreach (Punto::GROSORES as $clave => $grosor) {
        $seleccionado = $valorGrosor === (string) $clave ? " checked" : "";
        echo "<label><input type='radio' name='grosor' value='" . $clave . "'"
            . $seleccionado . ">" . $grosor . "</label> ";
    }
    echo "<span class='error'>" . $errores["grosor"] . "</span><br>";
    echo "<button type='submit' name='guardar'>Guardar</button></form>";

    echo "<h2>Borrar punto</h2>";
    echo "<form method='post' action='/aplicacion/relacion7/index.php'>";
    echo "<label>Punto: <select name='borrar_punto'>";
    foreach ($Puntos as $indice => $punto) {
        $seleccionado = $valorBorrar === (string) $indice ? " selected" : "";
        echo "<option value='" . $indice . "'" . $seleccionado . ">Punto " . ($indice + 1)
            . ": " . $punto->getX() . " ; " . $punto->getY() . " ; "
            . $punto->getColor() . " ; " . $punto->getGrosor() . "</option>";
    }
    echo "</select></label> <span class='error'>" . $errores["borrar"] . "</span> ";
    echo "<button type='submit' name='borrar'" . (count($Puntos) === 0 ? " disabled" : "")
        . ">Borrar</button></form>";

    echo "<h2>Subir puntos desde un fichero TXT</h2>";
    echo "<p>Una linea por punto, con el formato: x ; y ; color ; grosor.</p>";
    echo "<form method='post' action='/aplicacion/relacion7/index.php' enctype='multipart/form-data'>";
    echo "<input type='hidden' name='MAX_FILE_SIZE' value='1000000'>";
    echo "<label>Fichero: <input type='file' name='fichero' accept='.txt,text/plain'></label> ";
    echo "<span class='error'>" . $errores["fichero"] . "</span> ";
    echo "<button type='submit' name='subir'>Subir</button></form>";
}

function escaparHtml(string $texto): string
{
    return str_replace(
        ["&", "<", ">", "\"", "'"],
        ["&amp;", "&lt;", "&gt;", "&quot;", "&#039;"],
        $texto
    );
}
