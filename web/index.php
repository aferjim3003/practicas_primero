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
    <h2>Relaciones</h2>
    <ul>
        <li><a href="/aplicacion/relacion1/index.php">Relacion 1</a></li>
        <li><a href="/aplicacion/relacion2/index.php">Relacion 2</a></li>
        <li><a href="/aplicacion/relacion3/index.php">Relacion 3</a></li>
        <li><a href="/aplicacion/relacion4/index.php">Relacion 4</a></li>
        <li><a href="/aplicacion/relacion5/index.php">Relacion 5</a></li>
        <li><a href="/aplicacion/relacion6/index.php">Relacion 6</a></li>
        <li><a href="/aplicacion/relacion7/index.php">Relacion 7</a></li>
    </ul>
    <a href="/aplicacion/pruebas/index.php">Acceso a pruebas</a>
<?php
}