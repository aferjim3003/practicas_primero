<?php
require_once __DIR__ . "/../plantilla/plantilla.php";
//controlador

define("NUME", 25);
const var1 = 0;



$usuario=getenv("MYSQL_USER");

//dibuja la plantilla de la vista



inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("pruebas basicas", []);
cuerpo();  //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera() 
{}

//vista
function cuerpo()
{




$real=null;

echo "el numero real $real";


$var=125;
$tipo = gettype($var);

$var=(string)$var;
$tipo = gettype($var);


$var=settype($var, "double");
$tipo = gettype($var);


$var=intval($var);
$tipo = gettype($var);



$var = "0";
if ($var)
    $cadena= "var no vale false";



?>
    <br><br>
<?php
}
