<?php
if(isset($_SESSION))
{
	if($_SESSION["usuario_level"] == "admin")
	{
		require_once("model/usuariosModel.php");
		$objeto = new Usuarios();
		$los_usuarios = $objeto->get_usuarios_admin();
		require_once('view/ver_usuarios.php');	
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