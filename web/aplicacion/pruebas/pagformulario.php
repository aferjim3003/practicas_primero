<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador

//header("refresh: 3;url=https:/www.iespedroespinosa.es");


$barra = [
    [
        "TEXTO" => "inicio",
        "LINK" => "/index.php",
    ],
    [
        "TEXTO" => "pruebas",
        "LINK" => "/aplicacion/pruebas/index.php",
    ],
    [
        "TEXTO" => "eje. formulario",
    ]
];


$res=filter_var(12, FILTER_VALIDATE_INT);

$o=[
    "options"=>[
        "min_range"=>100,
        "max_range"=>200,
        "default"=>100
    ]
];
$res=filter_var('0x81', FILTER_VALIDATE_INT, $o);

$o=[
    "options"=>[
        "min_range"=>100,
        "max_range"=>200,
        "default"=>100
    ],
    "flags"=>FILTER_FLAG_ALLOW_HEX 
];
$res=filter_var('0x81', FILTER_VALIDATE_INT, $o);


//inicializaciones
$datos = [
    "nombre" => "Vic",
    "precio" => 12
];
$errores = [];


if (isset($_POST["cr"])) 
    {
        //verifico nombre
        $nombre = "";
        if (isset($_POST["nombre"])) {
            $nombre = $_POST["nombre"];
            $nombre = mb_strtolower(mb_trim($nombre));
        }
        if ($nombre == "")
            $errores["nombre"][] = "Debe indicarse un nombre";
        if (mb_strlen($nombre) > 20)
            $errores["nombre"][] = "El nombre no puede tener mas de 20 caracteres";
        $datos["nombre"] = $nombre;
        
        //verifico precio
        $precio = 0;
        if (isset($_POST["precio"])) {
            $precio = floatval($_POST["precio"]);
        }
        if ($precio <= 0)
            {
                $errores["precio"][] = "Debe indicarse un precio";
                $precio=10;
            }
        $datos["precio"] = $precio;


        if (!$errores) //no hay errores hago la insercion
        {
            //codigo para el nuevo articulo
            $codigo = 1; //codigo
            //se guarda el articulo
            //ir a ver el articulo insertado
            //header("location: verArticulo.php?id=$codigo");
            exit;
        }
    }

//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("2DAW APLICACION", $barra);
cuerpo($datos, $errores); //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera() {}
//vista
function cuerpo(array $datos, array $errores)
{
?>
    <br>
    <br>
    <br>
<?php
    formulario($datos, $errores);
}

function formulario(array $datos, array $errores)
{
    if ($errores) { //mostrar los errores
        echo "<div class='error'>";
        foreach ($errores as $clave => $valor) {
            foreach ($valor as $error)
                echo "$clave => $error<br>" . PHP_EOL;
        }
        echo "</div><br><br>";
    }
?>
    <form action="" method="post">
        <label for="nombre">Nombre: </label>
        <input type="text" name="nombre" id="nombre"
            value="<?= $datos["nombre"]; ?>" size=21
            maxlength="30"><br>
        <?php
             if (isset($errores["nombre"]))
                {
                    echo "<div class='error'>";
                    foreach ($errores["nombre"] as $error)
                        {
                            echo "$error<br>".PHP_EOL;
                        }
                    echo "</div>";
                }?>
        <label for="precio">Precio: </label>
        <input type="text" name="precio" id="precio"
            value="<?php echo $datos["precio"]; ?>" size=4
            maxlength="3"><br>
        <?php
             if (isset($errores["precio"]))
                {
                    echo "<div class='error'>";
                    foreach ($errores["precio"] as $error)
                        {
                            echo "$error<br>".PHP_EOL;
                        }
                    echo "</div>";
                }?>

        Elige estas opciones:<br />
        <input type="checkbox" name="opciones[0]" value="menor" />
        Menor de edad <br />
        <input type="checkbox" name="opciones[10]" value="minusvalia" />
        Minusvalía<br />
        <input type="checkbox" name="opciones[20]" value="numerosa" />
        Familia numerosa <br />
        <input type="checkbox" name="opciones[30]" value="minima" />
        Renta mínima<br />

        <input type="submit" class="boton" value="Crear" name="cr">
    </form>
<?php
}