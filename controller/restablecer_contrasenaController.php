<?php

/*

EL CONDICIONAL QUE APARECE AQUI DEBERIAMOS INCLUIRLO ENLA VIDA PRACTICA, ES PARA DARLE UN TOQUE MAS DE SEGURIDAD, TENIENDO ENCUENTA LA URL QUE NOS MANDA ELMETODO RESTABLECER CONTRASEÑA DE LA CLASE:
http://www.apps.saetaweb.com/charlotte_blog/?controlador=restablecer_contrasena&tokem=".base64_encode($id_usuario)."&f=$fecha&h=$hora

ENTONCES CONFIRMAMOS QUE ESTOS VALORES VENGAN TAMBIEN, LA FECHA "f" Y LA HORA "h" ASI, SI ALGUIEN NOS QUIERE HACKEAR DEBE TAMBIEN METER ESOS VALORES.

DE TODAS FORMAS PARA LA VIDA REAL ES MEJOR HACERLO DE LA SIGUIENTE MANAERA AUN MAS DIFICIL Y CONFUSA

http://www.apps.saetaweb.com/charlotte_blog/?controlador=restablecer_contrasena&tokem=".base64_encode($id_usuario)."&tolem=".base64_encode($id_usuario + 1)."&totem=".base64_encode($id_usuario + 3)." 

ASI EL HACKER NO SABRA CUAL ES LA QUE NECESITA ADIVINAR... SI TOKEM, TOTEM O TOLEM... :) JEJEJEJEJEJE...
ENTONCES EL CONDICIONAL SERIA.. if(empty($_GET["tokem"]) or empty($_GET["totem"]) or empty($_GET["tolem"]) )



if(empty($_GET["f"]) or empty($_GET["h"]))
{
	header("Location: " . Configuracion::ruta() . "?controlador=error");
	exit;	
}
*/






require_once("model/usuariosModel.php");
$objeto = new Usuarios();	
if(isset($_POST['de_restablecercontrasena']) and $_POST['de_restablecercontrasena'] == 'ok')
{
	$objeto->restablecer_contrasena();
	exit;
}
require_once('view/restablecer_contrasena.php');

?>