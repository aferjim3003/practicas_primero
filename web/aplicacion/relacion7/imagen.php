<?php
require_once __DIR__ . "/../../cabecera.php";
require_once __DIR__ . "/funciones.php";

cargarPuntos();
$imagen = crearLienzoPuntos($Puntos);
$nombreSalida = "imagen_" . obtenerIdentificadorCliente() . ".jpg";
header("Content-Type: image/jpeg");
header('Content-Disposition: attachment; filename="' . $nombreSalida . '"');
if (!imagejpeg($imagen)) {
    imagedestroy($imagen);
    throw new RuntimeException("No se pudo generar la imagen para descargar");
}
imagedestroy($imagen);
