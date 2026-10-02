<?php
require_once __DIR__ . "/../../cabecera.php";
//controlador

$usuario=getenv("MYSQL_USER");

//dibuja la plantilla de la vista
inicioCabecera("Relacion 1 ejercicios");
cabecera();
finCabecera();
inicioCuerpo("Relacion 1 Ejercicios");
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
