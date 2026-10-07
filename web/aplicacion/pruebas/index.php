<?php
require_once __DIR__ . "/../../cabecera.php";
//controlador

$barra =[
    [
    "TEXTO"=>"inicio",
    "ENLACE" =>"/index.php",
    "ADICIONAL" => ">>"],
    [
    "TEXTO"=> "otro"
    ],
    [
        "TEXTO"=>"index",
        "ADICIONAL" => "&copy;&copy;"
        ]
];

$usuario=getenv("MYSQL_USER");

//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("2DAW Aplicacion", $barra);
cuerpo();  //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera() 
{}

//vista
function cuerpo()
{
?>
    <br><br>
    Elemento de pruebas

    <br><br>
<a href="basicas.php">Funcionamieno basico</a>

<?php

}
