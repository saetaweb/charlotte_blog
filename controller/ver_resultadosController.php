<?php
if (isset($_GET["pos"]))
{
	$posicion=$_GET["pos"];
}
else
{
	$posicion=0;
}

$keyword = $_GET['search'];



require_once("model/noticiasModel.php");

$objeto = new Noticias();
$las_noticias = $objeto->buscar($posicion, $keyword);
/*
print_r($las_noticias);
exit;
*/
$cuantas_noticias = $objeto->buscar_cuenta_noticias($keyword);

$total_noticias = $cuantas_noticias[0]["contados"];
$resto=$total_noticias % 3;
$ultimo=$total_noticias-$resto;




require_once("view/ver_resultados.php");

?>