<?php

require_once("model/categoriasModel.php");

$objeto = new Categorias();
$las_categorias = $objeto->get_categorias();

require_once('view/sidebar_ver_categorias.php');

?>