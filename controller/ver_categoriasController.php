<?php
if(isset($_SESSION))
{
	if($_SESSION["usuario_level"] == "admin")
	{
		require_once("model/categoriasModel.php");
		$objeto = new Categorias();
		$las_categorias = $objeto->get_categorias();
		require_once('view/ver_categorias.php');	
	}
	else
	{
		header("Location: " . Configuracion::ruta() . "?controlador=error");
		exit;
	}
}
else
{
	header("Location: " . Configuracion::ruta() . "?controlador=error");
	exit;
}

?>