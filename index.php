<?php 


require_once('lib/config.php');
if(isset($_GET['controlador']))
{
	$el_controlador = $_GET['controlador'];
}
else
{
	$el_controlador = 'inicio';
}

if(is_file("controller/" . $el_controlador . "Controller.php"))
{
	require_once("controller/" . $el_controlador . "Controller.php");
}
else
{
	require_once('controller/errorController.php');
}

?>