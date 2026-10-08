<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador

$barra=[
     [
       "TEXTO"=> "inicio",
       "ENLACE" =>"/index.php",
     ],
       [ 
       "TEXTO"=> "pruebas"   
     ],  
];

//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("2DAW APLICACION", $barra);
cuerpo(); //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera() {}
//vista
function cuerpo()
{
?>
    <br><br>
    Elemento de pruebas
    <br><br>
    <a href="bas1icas.php">Funcionamiento básico</a><br>
    <a href="pasopar.php">Comunicacion controlador-vista</a><br>
    <a href="array.php">Array</a><br>
<?php
}