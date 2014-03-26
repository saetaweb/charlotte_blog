<?php
require_once("model/noticiasModel.php");
require_once("model/categoriasModel.php");

$objeto = new Noticias();
$objeto2 = new Categorias();
$las_categorias = $objeto2->get_categorias();


if(isset($_POST['de_publicanoticia']) and $_POST['de_publicanoticia'] == 'ok')
{
	$objeto->add_noticia(); 
	exit;
}

require_once('view/publicar_noticia.php');

?>