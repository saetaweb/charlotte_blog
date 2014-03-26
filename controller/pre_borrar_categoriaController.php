<?php
if(isset($_SESSION))
{
	if($_SESSION["usuario_level"] == "admin")
	{
		require_once("model/categoriasModel.php");
		$objeto = new Categorias();
		$lacategoriaid = $_GET["categoria_id"];
		$elnombrecategoria = $_GET["nombre"];
		$cuantas_noticias = $objeto->cuenta_dependientes_categoria_noticias($lacategoriaid);
		$total_noticias = $cuantas_noticias[0]["contados"];
		require_once('view/pre_borrar_categoria.php');
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