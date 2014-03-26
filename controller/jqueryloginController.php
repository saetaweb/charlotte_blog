<?php
if(isset($_SESSION["usuario_id"]))
{
	header("Location: " . Configuracion::ruta() . "?controlador=ver_noticias");
	
	/*echo $_SESSION["usuario_id"];*/
}

require_once("model/usuariosModel.php");
$objeto = new Usuarios();

if(isset($_POST['de_login']) and $_POST['de_login'] == 'ok')
{
	$objeto->login();
	
	 
	/*print_r($el_autenticado); exit;
					
	
	session_start();

	$_SESSION['usuario_id'] = $el_autenticado['usuario_id'];
	$_SESSION['nombres'] = $el_autenticado['nombres'];
	$_SESSION['apellidos'] = $el_autenticado['apellidos'];
	$_SESSION['email'] = $el_autenticado['email'];
	$_SESSION['foto'] = $el_autenticado['foto'];
	$_SESSION['usuario_level'] = $el_autenticado['usuario_level'];
	$_SESSION['estado'] = $el_autenticado['estado'];
	*/			

	/*			
	echo $_SESSION['usuario_level'] . "<br>";
	echo $_SESSION['nombres'];*/				
	exit;
				

}

require_once('view/jquerylogin.php');





?>