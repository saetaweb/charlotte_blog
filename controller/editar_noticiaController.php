<?php

if($_GET["usuario_id"] != $_SESSION["usuario_id"])
{
	header("Location: " . Configuracion::ruta() . "?controlador=error");
	exit;
}

require_once("model/noticiasModel.php");
require_once("model/categoriasModel.php");

$objeto = new Noticias();
$objeto2 = new Categorias();
$las_categorias = $objeto2->get_categorias();

$id_noticia = $_GET["id_noticia"];
$usuario_id = $_GET["usuario_id"];
$la_noticia = $objeto->get_noticia_por_id($id_noticia, $usuario_id);

if(isset($_POST['de_editarnoticia']) and $_POST['de_editarnoticia'] == 'ok')
{
	/*print_r($_SESSION);
	echo "<hr>";
	print_r($_POST);*/
	if($_POST["usuario_id"] != $_SESSION["usuario_id"])
	{
		header("Location: " . Configuracion::ruta() . "?controlador=error");
		exit;
	}	

	$objeto->edit_noticia(); 
	exit;
}

require_once('view/editar_noticia.php');

?>