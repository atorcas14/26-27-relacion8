<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador

$barra=[
     [
       "TEXTO"=> "inicio",
       "LINK" =>"/index.php",
     ],
       [ 
       "TEXTO"=> "Relacion 8"   
     ],  
];

$accesos = 1;

if(isset($_COOKIE["accesos"]) && is_string($_COOKIE["accesos"]) && ctype_digit($_COOKIE["accesos"])){
    $accesos = (int)$_COOKIE["accesos"]+1;
}

setcookie("accesos", (string)$accesos, time()+60*60*24*365,"/");

//dibuja la plantilla de la vista
inicioCabecera("RELACION 8");
cabecera();
finCabecera();
inicioCuerpo("Relacion 8", $barra);
cuerpo($accesos); //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera() {}
//vista
function cuerpo($accesos)
{
?>

    <br>
    <br>
    <a href="personalizar.php">Personalizar fondo</a>
    <div id="documento">
        <h2>Pagina de informacion</h2>
        <p>Aqui se muestra los colores que se haya configurado</p>
        <p>Se ha accedido a esta pagina <?php $accesos ?> veces</p>
    </div>
<?php
}
