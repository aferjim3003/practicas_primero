<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");

        
        
//controlador


$cadena='tienes 258 34 años';

//buscar años
$exp='/años/';
$resultado=[];

preg_match($exp,$cadena,$resultado,PREG_OFFSET_CAPTURE);

//buscar numero
$exp='/[0123456789]+/';
$exp='/[0-9]+/';
$exp='/\d+/';
$exp='/\d{1,}/';
$exp='/[[:digit:]]+/';


preg_match($exp,$cadena,$resultado,PREG_OFFSET_CAPTURE);

//busco un numero con 2 cifras
$exp='/\d{2}/';
preg_match($exp,$cadena,$resultado,PREG_OFFSET_CAPTURE);


//buscar un numero real
$cadena='tienes 54 Años 258.34 años';
$exp="/\d+\.\d+/";
preg_match($exp,$cadena,$resultado,PREG_OFFSET_CAPTURE);


//modificadores
//distingo entre mayusculas y minusculas
$exp='/años/';
preg_match($exp,$cadena,$resultado,PREG_OFFSET_CAPTURE);
//no distingo entre mayusculas y minusculas
$exp='/años/i';
preg_match($exp,$cadena,$resultado,PREG_OFFSET_CAPTURE);


//subpatrones
//quiero encontrar en un numero real la parte decimal 
$cadena='tienes 54 Años 258.34 años';
$exp="/\d+\.(\d+)/";
preg_match($exp,$cadena,$resultado,PREG_OFFSET_CAPTURE);

//cuantificador, como hacer perezoso
$cadena="/* primer comentario */ no comentado /* segundo comentario */";
$exp="#/\*.*?\*/#";
preg_match($exp,$cadena,$resultado,PREG_OFFSET_CAPTURE);

//busqueda
$exp="/\w+(?=;)/";
$cadena=" primera ; segunda tercera; cuarta ; quinta";
preg_match($exp,$cadena,$resultado,PREG_OFFSET_CAPTURE);

$exp="/\w+(?=.*;)/";
$cadena=" primera ; segunda tercera; cuarta ; quinta";
preg_match($exp,$cadena,$resultado,PREG_OFFSET_CAPTURE);

$exp="/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@!%*?&\-_+])[A-Za-z\d$@!%*?&\-_+]{8,15}$/";
$cadena="AAAAAbbbb11";
preg_match($exp,$cadena,$resultado,PREG_OFFSET_CAPTURE);

$exp="/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@!%*?&\-_+])[A-Za-z\d$@!%*?&\-_+]{8,15}$/";
$cadena="AAAbbbb11%?";
preg_match($exp,$cadena,$resultado,PREG_OFFSET_CAPTURE);

$exp="/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@!%*?&\-_+])[A-Za-z\d$@!%*?&\-_+]{8,15}$/";
$cadena="1A?A3Ab11%?";
preg_match($exp,$cadena,$resultado,PREG_OFFSET_CAPTURE);

$exp="/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@!%*?&\-_+])[A-Za-z\d$@!%*?&\-_+]{8,15}$/";
$cadena="1A?A3Ab11%? ";
preg_match($exp,$cadena,$resultado,PREG_OFFSET_CAPTURE);

$exp="/(?<=.*;)\w+/";
$cadena="; primero ; ";
preg_match($exp,$cadena,$resultado,PREG_OFFSET_CAPTURE);

$exp="/(?<=;\s)\w+/";
$cadena=";otro ; primero ; ";
preg_match($exp,$cadena,$resultado,PREG_OFFSET_CAPTURE);

//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("Expresiones regulares");
cuerpo(); //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera() {}
//vista
function cuerpo()
{


}