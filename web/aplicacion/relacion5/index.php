<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
include_once(dirname(__FILE__) . "/../../scripts/librerias/validacion.php");

date_default_timezone_set("Europe/Madrid");

$barra = [
    ["TEXTO" => "Inicio", "ENLACE" => "/index.php"],
    ["TEXTO" => "Relación 5"],
];

// valores para la primera vez que se abre la página
$valores = [
    "nombre" => "",
    "nacimiento" => "",
    "dia" => "",
    "mes" => "",
    "annio" => "",
    "hora" => "",
    "estado" => "",
    "estudios" => [],
    "hermanos" => "0",
    "sueldo" => "1100.00",
];
$errores = [];
$enviado = isset($_POST["enviar"]);

if ($enviado) {
    // nombre
    $nombre = mb_strtoupper(trim(textoPost("nombre")), "UTF-8");
    if ($nombre === "") {
        $errores["nombre"][] = "Debes escribir el nombre.";
    } elseif (!validaCadena($nombre, 25, "")) {
        $errores["nombre"][] = "El nombre no puede superar 25 caracteres.";
    } elseif (mb_substr($nombre, 0, 1, "UTF-8") === "H") {
        $errores["nombre"][] = "El nombre no puede empezar por H.";
    }
    $valores["nombre"] = $nombre;

    // contraseña: una mayúscula, minúscula, un numero y un simbolo permitido
    $contrasena = textoPost("contrasena");
    $expresion = '~^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[$_;<>@-])[A-Za-z\d$_;<>@-]{8,15}$~';
    if (!validaCadena($contrasena, 15, "") || preg_match($expresion, $contrasena) !== 1) {
        $errores["contrasena"][] = 'Debe tener de 8 a 15 caracteres, con mayúscula, minúscula, cifra y uno de estos símbolos: $_-;<>@.';
    }

    // fecha de nacimiento
    $nacimiento = trim(textoPost("nacimiento"));
    if (!validaFecha($nacimiento, "")) {
        $errores["nacimiento"][] = "La fecha debe existir y escribirse como dd/mm/aaaa.";
    } else {
        $fechaNacimiento = DateTime::createFromFormat("d/m/Y", $nacimiento);
        $hoy = DateTime::createFromFormat("d/m/Y", date("d/m/Y"));
        if ($fechaNacimiento === false || $fechaNacimiento > $hoy) {
            $errores["nacimiento"][] = "La fecha de nacimiento no puede ser futura.";
        }
    }
    $valores["nacimiento"] = $nacimiento;

    // las tres partes del carnet se juntan para validar la fecha
    $dia = trim(textoPost("dia"));
    $mes = trim(textoPost("mes"));
    $annio = trim(textoPost("annio"));
    $valores["dia"] = $dia;
    $valores["mes"] = $mes;
    $valores["annio"] = $annio;
    $fechaCarnetTexto = $dia . "/" . $mes . "/" . $annio;

    if (!validaFecha($fechaCarnetTexto, "")) {
        $errores["carnet"][] = "La fecha del carnet no existe.";
    } elseif (!isset($fechaNacimiento) || isset($errores["nacimiento"])) {
        $errores["carnet"][] = "Corrige antes la fecha de nacimiento.";
    } else {
        $fechaCarnet = DateTime::createFromFormat("d/m/Y", $fechaCarnetTexto);
        $hoy = DateTime::createFromFormat("d/m/Y", date("d/m/Y"));
        $fechaCarnetMenos18 = clone $fechaCarnet;
        $fechaCarnetMenos18->sub(new DateInterval("P18Y"));
        $diferencia = $fechaNacimiento->diff($fechaCarnetMenos18);

        if ($fechaCarnet > $hoy) {
            $errores["carnet"][] = "La fecha del carnet no puede ser futura.";
        } elseif ($diferencia->invert === 1) {
            $errores["carnet"][] = "El carnet debe ser de cuando ya tenías 18 años.";
        } else {
            $partesCarnet = explode("/", $fechaCarnetTexto);
            $valores["dia"] = $partesCarnet[0];
            $valores["mes"] = $partesCarnet[1];
            $valores["annio"] = $partesCarnet[2];
        }
    }

    // hora de levantarse
    $hora = trim(textoPost("hora"));
    if (!validaHora($hora, "")) {
        $errores["hora"][] = "La hora debe tener formato hh:mm:ss.";
    }
    $valores["hora"] = $hora;

    // estado
    $estadoTexto = textoPost("estado");
    if (preg_match('~^[1-5]$~', $estadoTexto) === 1) {
        $estado = (int) $estadoTexto;
    } else {
        $estado = 0;
    }
    if (!validaRango($estado, [1, 2, 3, 4])) {
        $errores["estado"][] = "Selecciona un estado válido.";
    } else {
        $valores["estado"] = (string) $estado;
    }

    // estudios
    $estudiosRecibidos = [];
    if (isset($_POST["estudios"])) {
        if (is_array($_POST["estudios"])) {
            $estudiosRecibidos = $_POST["estudios"];
        } else {
            $errores["estudios"][] = "La selección de estudios no es válida.";
        }
    }

    $estudios = [];
    foreach ($estudiosRecibidos as $estudioTexto) {
        if (is_string($estudioTexto) && preg_match('~^\d+$~', $estudioTexto) === 1) {
            $estudio = (int) $estudioTexto;
            if (validaRango($estudio, [0, 1, 2, 3, 4, 5])) {
                $estudios[] = $estudio;
            } else {
                $errores["estudios"][] = "Hay una opción de estudios incorrecta.";
            }
        } else {
            $errores["estudios"][] = "Hay una opción de estudios incorrecta.";
        }
    }
    if (count($estudios) === 0) {
        $errores["estudios"][] = "Selecciona al menos una opción.";
    } elseif (in_array(0, $estudios, true) && count($estudios) > 1) {
        $estudios = [0];
        $errores["estudios"][] = "Sin estudios no se puede combinar con otras opciones.";
    }
    $valores["estudios"] = $estudios;

    // número de hermanos
    $hermanosTexto = textoPost("hermanos");
    if (preg_match('~^\d+$~', $hermanosTexto) === 1) {
        $hermanos = (int) $hermanosTexto;
        if (!validaEntero($hermanos, 0, 20, 0)) {
            $errores["hermanos"][] = "Debe ser un número entre 0 y 20.";
        }
    } else {
        $hermanos = 0;
        $errores["hermanos"][] = "Escribe un número entero entre 0 y 20.";
    }
    $valores["hermanos"] = (string) $hermanos;

    // sueldo
    $sueldoTexto = trim(textoPost("sueldo"));
    $sueldoValidado = filter_var($sueldoTexto, FILTER_VALIDATE_FLOAT);
    if ($sueldoValidado === false) {
        $sueldo = 1100.0;
        $errores["sueldo"][] = "Escribe un sueldo entre 1000 y 150000 euros.";
    } else {
        $sueldo = (float) $sueldoValidado;
        if (!validaReal($sueldo, 1000.0, 150000.0, 1100.0)) {
            $errores["sueldo"][] = "El sueldo debe estar entre 1000 y 150000 euros.";
        }
    }
    $valores["sueldo"] = number_format($sueldo, 2, ".", "");
}

inicioCabecera("Relación 5: introducción de información");
cabecera();
finCabecera();
inicioCuerpo("Relación 5: introducción de información", $barra);
cuerpo($valores, $errores, $enviado);
finCuerpo();

function textoPost(string $nombre): string {
    if (isset($_POST[$nombre]) && is_string($_POST[$nombre])) {
        return $_POST[$nombre];
    }
    return "";
}

function escapar(string $texto): string {
    $texto = str_replace("&", "&amp;", $texto);
    $texto = str_replace("<", "&lt;", $texto);
    $texto = str_replace(">", "&gt;", $texto);
    $texto = str_replace('"', "&quot;", $texto);
    return str_replace("'", "&#039;", $texto);
}

function cabecera(): void {}

function cuerpo(array $valores, array $errores, bool $enviado): void {
    if ($enviado && count($errores) === 0) {
        resumen($valores);
    } else {
        formulario($valores, $errores);
    }
}

function formulario(array $valores, array $errores): void {
    $estados = [
        1 => "Estudiante",
        2 => "En paro",
        3 => "Trabajando",
        4 => "Jubilado",
        5 => "Incorrecta (prueba)",
    ];
    $estudios = [
        0 => "Sin estudios",
        1 => "Primaria",
        2 => "Secundaria",
        3 => "Bachillerato",
        4 => "Ciclo formativo",
        5 => "Universitarios",
        6 => "Incorrecta (prueba)",
    ];

    if (count($errores) > 0) {
        echo "<div class='error'><ul>";
        foreach ($errores as $lista) {
            foreach ($lista as $error) {
                echo "<li>" . escapar($error) . "</li>";
            }
        }
        echo "</ul></div>";
    }
?>
    <form action="" method="post">
        <p><label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" maxlength="25" required
                value="<?= escapar($valores["nombre"]); ?>"></p>
        <p><label for="contrasena">Contraseña:</label>
            <input type="password" name="contrasena" id="contrasena" maxlength="15" required></p>
        <p><label for="nacimiento">Fecha de nacimiento (dd/mm/aaaa):</label>
            <input type="text" name="nacimiento" id="nacimiento" maxlength="10" required
                value="<?= escapar($valores["nacimiento"]); ?>"></p>
        <fieldset>
            <legend>Fecha de carnet</legend>
            <label for="dia">Día:</label>
            <input type="text" name="dia" id="dia" maxlength="2" required
                value="<?= escapar($valores["dia"]); ?>">
            <label for="mes">Mes:</label>
            <input type="text" name="mes" id="mes" maxlength="2" required
                value="<?= escapar($valores["mes"]); ?>">
            <label for="annio">Año:</label>
            <input type="text" name="annio" id="annio" maxlength="4" required
                value="<?= escapar($valores["annio"]); ?>">
        </fieldset>
        <p><label for="hora">Hora de levantarse (hh:mm:ss):</label>
            <input type="text" name="hora" id="hora" maxlength="8" required
                value="<?= escapar($valores["hora"]); ?>"></p>
        <fieldset>
            <legend>Estado</legend>
            <?php foreach ($estados as $codigo => $texto) { ?>
                <label><input type="radio" name="estado" value="<?= $codigo; ?>"
                    <?= $valores["estado"] === (string) $codigo ? "checked" : ""; ?>>
                    <?= escapar($texto); ?></label><br>
            <?php } ?>
        </fieldset>
        <fieldset>
            <legend>Estudios</legend>
            <?php foreach ($estudios as $codigo => $texto) { ?>
                <label><input type="checkbox" name="estudios[]" value="<?= $codigo; ?>"
                    <?= in_array($codigo, $valores["estudios"], true) ? "checked" : ""; ?>>
                    <?= escapar($texto); ?></label><br>
            <?php } ?>
        </fieldset>
        <p><label for="hermanos">Hermanos:</label>
            <input type="number" name="hermanos" id="hermanos" min="0" max="20" required
                value="<?= escapar($valores["hermanos"]); ?>"></p>
        <p><label for="sueldo">Sueldo (€):</label>
            <input type="number" name="sueldo" id="sueldo" min="1000" max="150000" step="0.01" required
                value="<?= escapar($valores["sueldo"]); ?>"></p>
        <button type="submit" name="enviar" value="1">Enviar</button>
    </form>
    <p><a href="/aplicacion/relacion4/index.php">Volver a Relación 4</a></p>
<?php
}

function resumen(array $valores): void {
    
    $estados = [1 => "Estudiante", 2 => "En paro", 3 => "Trabajando", 4 => "Jubilado"];
    $estudios = [0 => "Sin estudios", 1 => "Primaria", 2 => "Secundaria", 3 => "Bachillerato", 4 => "Ciclo formativo", 5 => "Universitarios"];
    $estudiosElegidos = [];
    foreach ($valores["estudios"] as $codigo) {
        $estudiosElegidos[] = $estudios[$codigo];
    }
?>
    <h2>Resumen de datos</h2>
    <p>Nombre: <?= escapar($valores["nombre"]); ?></p>
    <p>Contraseña: no se muestra.</p>
    <p>Fecha de nacimiento: <?= escapar($valores["nacimiento"]); ?></p>
    <p>Fecha de carnet: <?= escapar($valores["dia"] . "/" . $valores["mes"] . "/" . $valores["annio"]); ?></p>
    <p>Hora de levantarse: <?= escapar($valores["hora"]); ?></p>
    <p>Estado: <?= escapar($estados[(int) $valores["estado"]]); ?></p>
    <p>Estudios: <?= escapar(implode(", ", $estudiosElegidos)); ?></p>
    <p>Hermanos: <?= escapar($valores["hermanos"]); ?></p>
    <p>Sueldo: <?= number_format((float) $valores["sueldo"], 2, ",", "."); ?> €</p>
    <p><a href="/aplicacion/relacion4/index.php">Volver a Relación 4</a></p>
<?php
}