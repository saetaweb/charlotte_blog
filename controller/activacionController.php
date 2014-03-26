<?php
require_once("model/usuariosModel.php");
/*
echo "hola este es el controlador de activacion y el el tokem es... " . $_GET['tokem'];

exit;
*/
$objeto = new Usuarios();
$objeto->activacion();

?>