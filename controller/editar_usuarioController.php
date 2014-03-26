<?php
if(isset($_SESSION))
{
	if($_SESSION["usuario_level"] == "admin")
	{
		require_once("model/usuariosModel.php");
		$objeto = new Usuarios();
		$usuario_id = $_GET["usuario_id"];
		$el_usuario = $objeto->get_usuario_por_id_admin($usuario_id);
		if(isset($_POST['de_editarusuario']) and $_POST['de_editarusuario'] == 'ok')
		{	
			$objeto->edit_usuario_admin(); 
			exit;
		}
		require_once('view/editar_usuario.php');
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