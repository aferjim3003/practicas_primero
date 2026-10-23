<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");

include_once ("./mis_funciones.php");

include_once ("./mis_funciones.php");

        
        
//controlador

$barra=[
     [
       "TEXTO"=> "inicio",
       "ENLACE" =>"/index.php",
     ],
       [ 
       "TEXTO"=> "pruebas",   
       "ENLACE" =>"/aplicacion/pruebas/index.php",
     ], 
       [ 
       "TEXTO"=> "eje. funciones",   
     ] 
];

$numero=doble(25);
//comprobacion
if ($numero===false)
    {
        //hay un error lo resuelve
        $numero=5;
    }

//if (($numero=doble($numero))===false)
if (!$numero=doble($numero))
    {
        exit;
    }


//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("pruebas basicas",$barra);
cuerpo($numero); //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera() {}
//vista


/**
 * funcion que me permite mostrar la vista
 *
 * @return void
 */
function cuerpo(int $n)
{
        echo "el doble del numero es $n".PHP_EOL;
        echo "el numero $n es el doble de otro ".PHP_EOL;

}