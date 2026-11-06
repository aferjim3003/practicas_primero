<?php

/** comprueba el entero y sus límites */
function validaEntero(int &$var, int $min, int $max, int $defecto): bool {
    $validado = filter_var($var, FILTER_VALIDATE_INT, [
        'options' => ['min_range' => $min, 'max_range' => $max],
    ]);
    if ($min > $max || $validado === false) {
        $var = $defecto;
        return false;
    }
    $var = $validado;
    return true;
}

/** valida el número y luego mira que esté en el rango */
function validaReal(float &$var, float $min, float $max, float $defecto): bool {
    $validado = filter_var($var, FILTER_VALIDATE_FLOAT);
    if ($min > $max || $validado === false || is_nan((float) $validado) || $validado < $min || $validado > $max) {
        $var = $defecto;
        return false;
    }
    $var = (float) $validado;
    return true;
}

/** deja la fecha en formato dd/mm/aaaa */
function validaFecha(string &$var, string $defecto): bool {
    if (preg_match('~\A(\d{1,2})/(\d{1,2})/(\d{4})\z~', $var, $partes) !== 1) {
        $var = $defecto;
        return false;
    }
    $dia = (int) $partes[1];
    $mes = (int) $partes[2];
    $ano = (int) $partes[3];
    if (!checkdate($mes, $dia, $ano)) {
        $var = $defecto;
        return false;
    }
    $diaTexto = (string) $dia;
    $mesTexto = (string) $mes;
    if ($dia < 10) {
        $diaTexto = '0' . $diaTexto;
    }
    if ($mes < 10) {
        $mesTexto = '0' . $mesTexto;
    }
    $var = $diaTexto . '/' . $mesTexto . '/' . $partes[3];
    return true;
}

/** deja la hora en formato hh:mm:ss */
function validaHora(string &$var, string $defecto): bool {
    if (preg_match('~\A(\d{1,2}):(\d{1,2}):(\d{1,2})\z~', $var, $partes) !== 1) {
        $var = $defecto;
        return false;
    }
    $hora = (int) $partes[1];
    $minuto = (int) $partes[2];
    $segundo = (int) $partes[3];
    if ($hora > 23 || $minuto > 59 || $segundo > 59) {
        $var = $defecto;
        return false;
    }
    $horaTexto = (string) $hora;
    $minutoTexto = (string) $minuto;
    $segundoTexto = (string) $segundo;
    if ($hora < 10) {
        $horaTexto = '0' . $horaTexto;
    }
    if ($minuto < 10) {
        $minutoTexto = '0' . $minutoTexto;
    }
    if ($segundo < 10) {
        $segundoTexto = '0' . $segundoTexto;
    }
    $var = $horaTexto . ':' . $minutoTexto . ':' . $segundoTexto;
    return true;
}

/** limpia y comprueba la dirección de correo */
function validaEmail(string &$var, string $defecto): bool {
    $saneado = filter_var($var, FILTER_SANITIZE_EMAIL);
    if (!is_string($saneado) || filter_var($saneado, FILTER_VALIDATE_EMAIL) === false) {
        $var = $defecto;
        return false;
    }
    $var = $saneado;
    return true;
}

/** tiene en cuenta caracteres multibyte */
function validaCadena(string &$var, int $longitud, string $defecto): bool {
    if ($longitud < 0 || mb_strlen($var, 'UTF-8') > $longitud) {
        $var = $defecto;
        return false;
    }
    return true;
}

/** devuelve false cuando el patrón no coincide */
function validaExpresion(string &$var, string $expresion, string $defecto): bool {
    if (preg_match($expresion, $var) !== 1) {
        $var = $defecto;
        return false;
    }
    return true;
}

/** comprueba si el dato está en los valores o en las claves */
function validaRango(mixed $var, array $posibles, int $tipo = 1): bool {
    if ($tipo === 1) {
        return in_array($var, $posibles, true);
    }
    if ($tipo === 2) {
        return array_key_exists($var, $posibles);
    }
    return false;
}