<?php
if(isset($_SESSION))
{
	if($_SESSION["usuario_level"] == "admin")
	{
		require_once("model/usuariosModel.php");
		$objeto = new Usuarios();
		$elusuarioid = $_GET["usuario_id"];
		$elnombreusuario = $_GET["nombres"];
		$cuantas_noticias = $objeto->cuenta_dependientes_usuario_noticias($elusuarioid);
		$total_noticias = $cuantas_noticias[0]["contados"];
		require_once('view/pre_borrar_usuario.php');
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