<?php
if(isset($_SESSION))
{
	if($_SESSION["usuario_level"] == "admin")
	{
		require_once("model/usuariosModel.php");
		$objeto = new Usuarios();
		/*
		LLAMADO PARA LA [VERSION 01]
		$objeto->delete_usuario_admin($_GET["usuario_id"], $_GET["foto"]);
		*/
		/*LLAMADO PARA LA VERSION 02*/
		$objeto->delete_usuario_admin($_GET["usuario_id"]);
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