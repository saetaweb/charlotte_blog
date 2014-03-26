<?php
if(isset($_SESSION))
{
	if($_SESSION["usuario_level"] == "admin")
	{
		require_once("model/categoriasModel.php");
		$objeto = new Categorias();
		if(isset($_POST['de_crearcategoria']) and $_POST['de_crearcategoria'] == 'ok')
		{
			$objeto->add_categoria_admin(); 
			exit;
		}
		require_once('view/crear_categoria.php');	
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