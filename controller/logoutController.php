<?php


if(isset($_SESSION["usuario_level"]))
{
	/**/require_once("model/usuariosModel.php");
	$objeto = new Usuarios();
	$objeto->logout(); 
}
else
{
	header("Location: " . Configuracion::ruta() . "?controlador=error");
	exit;
}




?>