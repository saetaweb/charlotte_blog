<?php

if (isset($_GET["pos"]))
{
	$posicion=$_GET["pos"];
}
else
{
	$posicion=0;
}


require_once("model/noticiasModel.php");
$objeto = new Noticias();

$las_noticias = $objeto->get_noticias($posicion);
$cuantas_noticias = $objeto->cuenta_noticias();

$total_noticias = $cuantas_noticias[0]["contados"];
$resto=$total_noticias % 3;
$ultimo=$total_noticias-$resto;
require_once('view/ver_noticias.php');





?>