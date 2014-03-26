<?php

		require_once("model/usuariosModel.php");
		$objeto = new Usuarios();
		if(isset($_POST['de_registrarusuario']) and $_POST['de_registrarusuario'] == 'ok')
		{
			$objeto->add_usuario(); 
			exit;
		}
		require_once('view/registrar_usuario.php');


?>