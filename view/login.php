<?php require_once("public/header.php"); ?>
<?php require_once("public/menu.php"); ?>


<!-- LO QUE VA EN LA VISTA -->
    <section id="contenido">
    	<section id="principal">
        <div style="text-align:center;">
			<h1>INGRESA TUS DATOS</h1>
			<br/><br/>
            
            
<?php             
if(isset($_GET["msj"]))
{
    switch ($_GET["msj"])
    {
        case '1':
            ?>
            <h2 style="color: red;">Hay campos del formulario sin llenar</h2>
            <?php
        break;
        case '2':
            ?>
            <h2 style="color: red;">Usuario o Contrase&ntilde;a incorrectos</h2>
            <?php
        break;
		case '3':
            ?>
            <h2 style="color: green;">La contrase&ntilde;a ha sido restablecida, ahora puedes ingresar</h2>
            <?php
        break;
    }
}
?>
            
            
            
            
            <form action="<?php $_SERVER['PHP_SELF'] ?>" name="login" method="post">
            
            <div class="campoform">
				Email:
				<br/>
                <input type="email" name="email" id="idemail" placeholder="escribe tu correo electronico" required="required" maxlength="50" size="35" />
            	<div id="error_email"></div>     
			</div>
            <div class="campoform">
				Password:
				<br/>
				<input type="password" name="password" required="required" size="35" maxlenght="250">
            	<div id="error_password"></div> 
			</div>
            <br/>
            <div class="campoform">
            	<input type="hidden" name="de_login" value="ok"/>
                <!--<input type="submit" value="Enviar" title="Registrarse" />
                <input type="reset" value="Borrar" title="Borrar"/><br/>-->
                <input type="button" id="boton" value="Enviar" title="Enviar" onClick="valida_login()"/>
                <input id="boton_2" type="button" value="No se puede Ingresar" title="No se puede Ingresar" style="display:none" />
                <input type="reset" value="Borrar" title="Borrar" onClick="limpiador_registrar_usuario()"/>
			</div>
            
            </form>
            
            <a href="<?php echo Configuracion::ruta();?>?controlador=olvido_contrasena">Olvido su contrase&ntilde;a?</a>

            <hr />
        </div>
    	</section>
<!-- LO QUE VA EN LA VISTA FIN --> 

<?php /*require_once("public/sidebar.php");*/ ?>
<?php require_once("public/footer.php"); ?>