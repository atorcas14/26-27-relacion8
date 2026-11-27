<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador

$barra=[
     [
       "TEXTO"=> "inicio",
       "LINK" =>"/index.php",
     ],
       [ 
       "TEXTO"=> "Relacion 8" ,
       "LINK" => "/aplicacion/personalizar/index.php",
     ],
     [
        "TEXTO" => "Personalizar"
     ]
];

//Variables
$errores = [];
$guardado = false;
$actual = dameColoresPersonalizados();
$datos = ["fondo" => $actual["fondo"], "texto" => $actual["texto"]];
$fondo="";
$texto="";

if (isset($_POST["guardar"])) {
    $fondo = (isset($_POST["fondo"]) && is_string($_POST["fondo"])) ? $_POST["fondo"] : "";
    $texto = (isset($_POST["texto"]) && is_string($_POST["texto"])) ? $_POST["texto"] : "";
    $datos = ["fondo" => $fondo, "texto" => $texto];

    if (!array_key_exists($fondo, COLORESFONDO)) $errores["fondo"][] = "Color de fondo no válido";
    if (!array_key_exists($texto, COLORESTEXTO)) $errores["texto"][] = "Color de texto no válido";
    if ($fondo === $texto && !$errores) {
        $errores["texto"][] = "El texto y el fondo no pueden ser del mismo color";
    }

    if (!$errores) {
        $caduca = time() + 60 * 60 * 24 * 365;
        setcookie("color_fondo", $fondo, $caduca, "/");
        setcookie("color_texto", $texto, $caduca, "/");
        // La cookie no llega a $_COOKIE hasta la siguiente petición: se actualiza ya
        $_COOKIE["color_fondo"] = $fondo;
        $_COOKIE["color_texto"] = $texto;
        $guardado = true;
    }
}
$fondo = $_COOKIE["color_fondo"]??"white";
$texto = $_COOKIE["color_texto"]??"black";

//dibuja la plantilla de la vista
inicioCabecera("PERSONALIZAR");
cabecera($fondo,$texto);
finCabecera();
inicioCuerpo("Personalizar", $barra);
cuerpo($datos, $errores, $guardado); //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera($fondo,$texto) {
    ?><style>
        #documento{
            background-color: <?= $fondo ?>;
            color: <?= $texto ?>
        }
    </style><?php
}

//Funcion que selecciona el color
function selectColor(string $nombre, array $colores, string $seleccionado, array $errores)
{
    echo "<select name='$nombre'>";
    foreach ($colores as $clave => $info) {
        $sel = ($clave === $seleccionado) ? " selected" : "";
        echo "<option value='" . htmlspecialchars($clave) . "'$sel>" . htmlspecialchars($info["nombre"]) . "</option>";
    }
    echo "</select><br>";
    if (isset($errores[$nombre])) {
        foreach ($errores[$nombre] as $e) {
            echo "<span style='color:#b00020'>" . htmlspecialchars($e) . "</span><br>";
        }
    }
}

//vista
function cuerpo($datos,$errores,$guardado)
{
?>

    <br>
    <br>
    <a href="index.php">Ir a la pagina de inicio</a>
    <div id="documento">
        <h2>Configurar colores</h2>
        <?php if($guardado) ?><p>Colores guardados</p>
        <form method="post" action="<?php $_SERVER["PHP_SELF"]?>">
            <label for="">Color de fondo</label> <br>
            <?php selectColor("fondo", COLORESFONDO, $datos["fondo"], $errores)?>
            <label for="">Color del texto</label> <br>
            <?php selectColor("texto", COLORESTEXTO, $datos["texto"], $errores)?>
            <input type="submit" value="Guardar" name="guardar">
        </form>
    </div>
<?php
}
