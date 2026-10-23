<?php

function paginaError($mensaje)
{
  header("HTTP/1.0 404 $mensaje");
  inicioCabecera("PRACTICA");
  finCabecera();
  inicioCuerpo("ERROR");
  echo "<br />\n";
  echo $mensaje;
  echo "<br />\n";
  echo "<br />\n";  echo "<br />\n";
  echo "<a href='/index.php'>Ir a la pagina principal</a>\n";
  
  finCuerpo();  
}

function inicioCabecera($titulo)
{
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">

        <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
        Remove this if you use the .htaccess -->
            <meta http-equiv="X-UA-Compatible"  content="IE=edge,chrome=1">

        <title><?php echo $titulo ?></title>
        <meta name="description" content="">
        <meta name="author" content="Administrador">

        <meta name="viewport" content="width=device-width; initial-scale=1.0">

        <!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
        <link rel="shortcut icon" href="/favicon.ico">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">
        
        <link rel="stylesheet" type="text/css" href="/estilos/base.css">
<?php
}

function finCabecera()
{
?>
    </head>
<?php   
}

function inicioCuerpo($cabecera, array $barraUbi=[])
{
    global $acceso;

?>
    <body>
        <div id="documento">
        
            <header>
                <span id="logo"><a href="/"><img src="/imagenes/logo.png"></a></span>
                <span id="titulo"><?php echo $cabecera;?></span>
            </header>
            
            <div id="barraLogin">
                
            </div>
            <div id="barraMenu">
                <ul>
                    <li><a href="/aplicacion/pruebas/index.php">Ej Basicos</a></li>
                    <li><a href="/aplicacion/relacion1/index.php">Rel 1</a></li>
                    <li><a href="/aplicacion/relacion2/index.php">Rel-2</a></li>
                 </ul> 
                
            </div>
            <div id="barraUbicacion"><?php
                if (isset($barraUbi))
                    {
                        $primero=true;
                        foreach ($barraUbi as $elemento) 
                            {
                                if (isset($elemento["TEXTO"]))
                                {
                                    if (!$primero)
                                        echo " >> ";        
                                    if (isset($elemento["LINK"]) && $elemento["LINK"])
                                            echo " <a href=\"{$elemento["LINK"]}\" >";
                                    
                                    echo $elemento["TEXTO"];

                                    if (isset($elemento["LINK"]) && $elemento["LINK"])
                                            echo " </a>";
                                    
                                    $primero=false;
                                }

                            }
                    }
                ?>
            </div>
    
            <div>
<?php   
}

function finCuerpo()
{
?>
                <br />
                <br />
            </div>
            <footer>
                <hr width="90%"  />  
                <div>
                    &copy; Copyright 
                </div>
            </footer>
        </div>
    </body>
</html>
<?php
}