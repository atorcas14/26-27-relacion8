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



if(isset($_COOKIE["accesos"])){
    $accesos = (int)$_COOKIE["accesos"]+1;
}
else{
  $accesos = 0;
}
setcookie("accesos", (string)$accesos, time()+60*60*24*365,"/");

$fondo="";
$texto="";

//Comprobar que exista el color del fondo
if(isset($_COOKIE["color_fondo"])){
  $fondo = $_COOKIE["color_fondo"];
}
else{
  $fondo = "white";
}

//Comprobar que exista el color del texto
if(isset($_COOKIE["color_texto"])){
  $texto = $_COOKIE["color_texto"];
}
else{
  $texto = "black";
}


//dibuja la plantilla de la vista
inicioCabecera("RELACION 8");
cabecera($fondo,$texto);
finCabecera();
inicioCuerpo("Relacion 8", $barra);
cuerpo($accesos); //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera($fondo, $texto) {
  ?><style>
        #documento{
            background-color: <?= $fondo ?>;
            color: <?= $texto ?>
        }
    </style><?php
}
//vista
function cuerpo($accesos)
{
?>

    <br>
    <br>
    <a href="personalizar.php">Personalizar fondo</a>
    <a href="../texto/verTextos.php">Pagina con textos</a>
    <div id="documento">
        <h2>Pagina de informacion</h2>
        <p>Aqui se muestra los colores que se haya configurado</p>
        <p>Se ha accedido a esta pagina <?= $accesos ?> veces</p>
    </div>
<?php
}
