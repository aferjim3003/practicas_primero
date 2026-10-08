<?php
include_once(dirname(__FILE__) . "/cabecera.php");
//controlador
$barra=[
     [
       "TEXTO"=> "inicio",
       "ENLACE" =>"/index.php",
       "ADICIONAL"=>">>"],
     [ 
       "TEXTO"=> "otro"   
     ],  
     [ 
       "TEXTO"=> "index",
       "ADICIONAL"=> "&copy;&copy;"   
     ]
];

//dibuja la plantilla de la vista
inicioCabecera("Mi aplicacion");
cabecera();
finCabecera();
inicioCuerpo("2DAW APLICACION INDEX",$barra);
cuerpo();  //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera() 
{
    ?>
    <!-- esto va en el head -->
     <?php   


}

//vista
function cuerpo()
{
?>
    <br><br>
   <a href="./aplicacion/pruebas/index.php">Acceso a pruebas</a>
<?php
}