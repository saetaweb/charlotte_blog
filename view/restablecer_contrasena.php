<?php require_once("public/header.php"); ?>
<?php require_once("public/menu.php"); ?>


<!-- LO QUE VA EN LA VISTA -->
    <section id="contenido">
    	<section id="principal">
        <div style="text-align:center;">
			<h1>RESTABLECER CONTRASE&Ntilde;A</h1>
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
            <h2 style="color: red;">Error al restablecer la contrase&ntilde;a</h2>
            <?php
        break;
        case '3':
            ?>
            <h2 style="color: green;">La contrase&ntilde;a ha sido restablecida, ahora puedes <a href="<?php echo Configuracion::ruta();?>?controlador=login">ingresar</a></h2>
            <?php
        break;		
    }
}
?>
     
            <form action="<?php $_SERVER['PHP_SELF'] ?>" name="restablecer_contrasena" method="post">

            <div class="campoform">
			Password:
			<br/>
			<input type="password" name="password" required="required" size="35" maxlenght="250">
            <div id="error_password"></div> 
			</div>
            
            <div class="campoform">
			Repetir Password:
			<br/>
			<input type="password" name="password2" required="required" size="35" maxlenght="250">
			</div>

            <br/>
            <div class="campoform">
            	<input type="hidden" name="de_restablecercontrasena" value="ok"/>
                <!--<input type="submit" value="Enviar" title="Registrarse" />
                <input type="reset" value="Borrar" title="Borrar"/><br/>-->
                <input type="hidden" name="tokem" value="<?php echo $_GET["tokem"]; ?>">
                <input type="button" id="boton" value="Enviar" title="Enviar" onClick="valida_restablecer_contrasena()"/>
                <input type="reset" value="Borrar" title="Borrar" onClick="limpiador_restablecer_contrasena()"/>
			</div>
            
            </form>

            <hr />
        </div>
    	</section>
<!-- LO QUE VA EN LA VISTA FIN --> 

<?php /*require_once("public/sidebar.php");*/ ?>
<?php require_once("public/footer.php"); ?>