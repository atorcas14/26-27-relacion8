<?php 

include_once(dirname(__FILE__) . "/aplicacion/clases/curso2026/Muebles.php"); 

error_reporting(0);

date_default_timezone_set('Europe/Berlin');


define("RUTABASE", dirname(__FILE__));
//define("MODO_TRABAJO","produccion"); //en "produccion o en desarrollo
define("MODO_TRABAJO","desarrollo"); //en "produccion o en desarrollo

if (MODO_TRABAJO=="produccion")
    error_reporting(0);
    else 
        error_reporting(E_ALL);  

spl_autoload_register(function ($clase){
    $ruta=RUTABASE."/scripts/clases/";
    $fichero=$ruta."$clase.php";
    
    if (file_exists($fichero))
        {
            require_once($fichero);
        }
      else
        {
            throw new Exception("La clase $clase no se ha encontrado.");
        }
});

include(RUTABASE."/aplicacion/plantilla/plantilla.php");

//creo todos los objetos que necesita mi aplicación

//colores tanto de fondo como de texto
const COLORESTEXTO = [
    "black" => ["nombre" => "Negro",   "css" => "black"],
    "blue"  => ["nombre" => "Azul",    "css" => "blue"],
    "white" => ["nombre" => "Blanco",  "css" => "white"],
    "red"   => ["nombre" => "Rojo",    "css" => "rgb(200,0,0)"],
    "green" => ["nombre" => "Verde",   "css" => "rgb(0,120,0)"],
];

const COLORESFONDO = [
    "white"  => ["nombre" => "Blanco",   "css" => "white"],
    "red"    => ["nombre" => "Rojo",     "css" => "rgb(255,150,150)"],
    "green"  => ["nombre" => "Verde",    "css" => "rgb(150,230,150)"],
    "yellow" => ["nombre" => "Amarillo", "css" => "yellow"],
    "cyan"   => ["nombre" => "Cian",     "css" => "cyan"],
    "gray"   => ["nombre" => "Gris",     "css" => "lightgray"],
];

/**
 * Funcion que devuelve un array con los colores seleccionados tanto para el fondo como para el texto
 *
 * @return array
 */
function dameColoresPersonalizados():array{
    $fondo = $_COOKIE["color fondo"] ?? "white";
    $texto = $_COOKIE["color texto"] ?? "black";
    if(!is_string($fondo) || !array_key_exists($fondo, COLORESFONDO))
        $fondo = "white";
    if(!is_string($texto) || !array_key_exists($texto, COLORESTEXTO))
        $texto = "black";
    return ["fondo" => $fondo, "texto" =>$texto];
}

/**
 * Funcion que pone el estilo con los colores seleccionados
 *
 * @return string
 */
function estiloPersonalizado():string {
    $c = dameColoresPersonalizados();
    return "<style>#documento{background-color: }". COLORESFONDO[$c["fondo"]["css"]].
            "; color: ". COLORESTEXTO[$c["texto"]["css"]];
}