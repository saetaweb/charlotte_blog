<?php
if(isset($_SESSION))
{
	if($_SESSION["usuario_level"] == "admin")
	{
		require_once("model/categoriasModel.php");
		$objeto = new Categorias();
		/*
		LLAMADO PARA LA [VERSION 01]
		$objeto->delete_usuario_admin($_GET["usuario_id"], $_GET["foto"]);
		*/
		/*LLAMADO PARA LA VERSION 02*/
		$objeto->delete_categoria_admin($_GET["categoria_id"]);
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