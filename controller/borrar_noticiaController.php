<?php
/**/
if($_GET["usuario_id"] != $_SESSION["usuario_id"])
{
	header("Location: " . Configuracion::ruta() . "?controlador=error");
	exit;
}

require_once("model/noticiasModel.php");


$objeto = new Noticias();

$id_noticia = $_GET["id_noticia"];
$usuario_id = $_GET["usuario_id"];

/*print_r($_GET); echo "<hr>"; print_r($_SESSION); exit;*/

$objeto->delete_noticia($id_noticia, $usuario_id);

/*
require_once('view/editar_noticia.php');
*/
?>