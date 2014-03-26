<?php
if(isset($_SESSION))
{
	if($_SESSION["usuario_level"] == "admin")
	{
		require_once("model/categoriasModel.php");
		$objeto = new Categorias();
		$categoria_id = $_GET["categoria_id"];
		$la_categoria = $objeto->get_categoria_por_id_admin($categoria_id);
		if(isset($_POST['de_editarcategoria']) and $_POST['de_editarcategoria'] == 'ok')
		{
			$objeto->edit_categoria_admin(); 
			exit;
		}
		require_once('view/editar_categoria.php');	
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