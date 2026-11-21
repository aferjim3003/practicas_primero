<?php

$Puntos = [];

function obtenerIdentificadorCliente(): string
{
    $ip = isset($_SERVER["REMOTE_ADDR"]) ? $_SERVER["REMOTE_ADDR"] : "desconocida";
    $ip = str_replace([".", ":"], "_", $ip);
    $agente = isset($_SERVER["HTTP_USER_AGENT"]) ? strtolower($_SERVER["HTTP_USER_AGENT"]) : "";
    $navegador = "otro";

    if (strpos($agente, "edg/") !== false) {
        $navegador = "edge";
    } elseif (strpos($agente, "firefox/") !== false) {
        $navegador = "firefox";
    } elseif (strpos($agente, "chrome/") !== false) {
        $navegador = "chrome";
    } elseif (strpos($agente, "safari/") !== false) {
        $navegador = "safari";
    }

    return $ip . "_" . $navegador;
}

function obtenerArchivoPuntos(): string
{
    return RUTABASE . "/temp/puntos_" . obtenerIdentificadorCliente() . ".dat";
}

function obtenerArchivoImagen(): string
{
    return RUTABASE . "/imagenes/puntos/imagen_" . obtenerIdentificadorCliente() . ".jpg";
}

function prepararDirectoriosPuntos(): void
{
    $directorioDatos = RUTABASE . "/temp";
    if (!file_exists($directorioDatos) && !mkdir($directorioDatos)) {
        throw new RuntimeException("No se pudo crear el directorio de datos");
    }

    $directorioImagenes = RUTABASE . "/imagenes/puntos";
    if (!file_exists($directorioImagenes) && !mkdir($directorioImagenes)) {
        throw new RuntimeException("No se pudo crear el directorio de imagenes");
    }
}

function esEnteroTexto($valor): bool
{
    if (!is_string($valor) || $valor === "") {
        return false;
    }

    for ($i = 0; $i < strlen($valor); $i++) {
        if ($valor[$i] < "0" || $valor[$i] > "9") {
            return false;
        }
    }

    return true;
}

function puntoDesdeLinea(string $linea): ?Punto
{
    $campos = explode(";", trim($linea));
    if (count($campos) !== 4) {
        return null;
    }

    $x = trim($campos[0]);
    $y = trim($campos[1]);
    $color = trim($campos[2]);
    $grosor = trim($campos[3]);
    if (!esEnteroTexto($x) || !esEnteroTexto($y) || !esEnteroTexto($grosor)) {
        return null;
    }

    $x = (int) $x;
    $y = (int) $y;
    $grosor = (int) $grosor;
    if ($x > 500 || $y > 500 || !isset(Punto::COLORES[$color])
        || !isset(Punto::GROSORES[$grosor])) {
        return null;
    }

    return new Punto($x, $y, $color, $grosor);
}

function cargarPuntos(): void
{
    global $Puntos;
    prepararDirectoriosPuntos();
    $archivo = obtenerArchivoPuntos();

    if (!file_exists($archivo)) {
        $Puntos = [
            new Punto(50, 50, "red", 1),
            new Punto(250, 250, "blue", 2),
            new Punto(450, 450, "green", 3),
        ];
        guardarPuntos();
        return;
    }

    $fichero = fopen($archivo, "r");
    if (!$fichero) {
        throw new Exception("No se pudo abrir el fichero de puntos");
    }

    $numeroLinea = 0;
    while (($linea = fgets($fichero)) !== false) {
        $numeroLinea++;
        if (trim($linea) === "") {
            continue;
        }

        $punto = puntoDesdeLinea($linea);
        if ($punto === null) {
            fclose($fichero);
            throw new Exception("La linea " . $numeroLinea . " del fichero de puntos no es valida");
        }

        $Puntos[] = $punto;
    }

    fclose($fichero);
}

function guardarPuntos(): void
{
    global $Puntos;
    prepararDirectoriosPuntos();
    $fichero = fopen(obtenerArchivoPuntos(), "w");
    if (!$fichero) {
        throw new Exception("No se pudo guardar el fichero de puntos");
    }

    foreach ($Puntos as $punto) {
        $linea = $punto->getX() . " ; " . $punto->getY() . " ; "
            . $punto->getColor() . " ; " . $punto->getGrosor() . "\r\n";
        if (fputs($fichero, $linea) === false) {
            fclose($fichero);
            throw new Exception("No se pudo escribir el fichero de puntos");
        }
    }

    fclose($fichero);
}

function crearLienzoPuntos(array $puntos)
{
    $imagen = imagecreatetruecolor(501, 501);
    if (!$imagen) {
        throw new Exception("No se pudo crear la imagen");
    }

    $blanco = imagecolorallocate($imagen, 255, 255, 255);
    $negro = imagecolorallocate($imagen, 0, 0, 0);
    imagefill($imagen, 0, 0, $blanco);
    imagerectangle($imagen, 0, 0, 500, 500, $negro);

    foreach ($puntos as $punto) {
        $rgb = Punto::COLORES[$punto->getColor()]["rgb"];
        $color = imagecolorallocate($imagen, $rgb[0], $rgb[1], $rgb[2]);
        $diametro = $punto->getGrosor() * 2 - 1;
        imagefilledellipse(
            $imagen,
            $punto->getX(),
            $punto->getY(),
            $diametro,
            $diametro,
            $color
        );
    }

    return $imagen;
}

function guardarImagenPuntos(array $puntos): void
{
    prepararDirectoriosPuntos();
    $imagen = crearLienzoPuntos($puntos);
    $resultado = imagejpeg($imagen, obtenerArchivoImagen());
    imagedestroy($imagen);

    if (!$resultado) {
        throw new Exception("No se pudo guardar la imagen de puntos");
    }
}
