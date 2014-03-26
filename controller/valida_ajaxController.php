<?php
require_once("model/usuariosModel.php");

$objeto = new Usuarios();
$resultado = $objeto->valida_ajax();

require_once('view/valida_ajax.php');

?>