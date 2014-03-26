<?php

if($_GET["usuario_id"] != $_SESSION["usuario_id"])
{
	header("Location: " . Configuracion::ruta() . "?controlador=error");
	exit;
}


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

/*$usuario_id = $_GET["usuario_id"];*/

$las_noticias = $objeto->get_noticias_por_usuario($posicion);
$cuantas_noticias = $objeto->cuenta_noticias_por_usuario();

$total_noticias = $cuantas_noticias[0]["contados"];
$resto=$total_noticias % 3;
$ultimo=$total_noticias-$resto;
require_once('view/ver_noticias_por_usuario.php');





?>