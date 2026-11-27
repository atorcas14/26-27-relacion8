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
        "TEXTO" => "verTextos"
     ]
];

//Variables
$textos = [];

//dibuja la plantilla de la vista
inicioCabecera("VER TEXTOS");
cabecera();
finCabecera();
inicioCuerpo("Ver Textos", $barra);
cuerpo($textos); //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera() {}



//vista
function cuerpo($textos)
{
?>

    <br>
    <br>
    <a href="../personalizar/index.php">Ir a la pagina de inicio</a>
    <div id="documento">
        <h2>Ver el texto</h2>
        
        <form method="post" action="<?php $_SERVER["PHP_SELF"]?>">
            <label for="">Texto</label>
            <input type="text" name="" id="">
            <br>
            <br>
            <textarea name="" id="" readonly></textarea>
            <br>
            <input type="submit" value="Registrar" name="Registrar">
            <input type="reset" value="Limpiar">
        </form>
    </div>
<?php
}
