<?php require_once("public/header.php"); ?>
<?php require_once("public/menu.php"); ?>


<!-- LO QUE VA EN LA VISTA -->
    <section id="contenido">
    	<section id="principal">
        <div style="text-align:center;">
			<h1>OLVID&Eacute; MI CONTRASE&Ntilde;A</h1>
			<br/><br/>
            
            
<?php             
if(isset($_GET["msj"]))
{
    switch ($_GET["msj"])
    {
        case '1':
            ?>
            <h2 style="color: red;">El email ingresado no existe en la Base de Datos</h2>
            <?php
        break;
        case '2':
            ?>
            <h2 style="color: green;">Se enviaron las instrucciones al mail indicado</h2>
            <?php
        break;
        case '3':
            ?>
            <h2 style="color: red;">El email ingresado invalido</h2>
            <?php
        break;
    }
}
?>
            
            
            
            
            <form action="<?php $_SERVER['PHP_SELF'] ?>" name="olvido_contrasena" method="post">
            
            <div class="campoform">
				Email:
				<br/>
                <input type="email" name="email" id="idemail" placeholder="escribe tu correo electronico" required="required" maxlength="50" size="35" />
            	<div id="error_email"></div>     
			</div>
            <br/>
            <div class="campoform">
            	<input type="hidden" name="de_olvidocontrasena" value="ok"/>
                <!--<input type="submit" value="Enviar" title="Registrarse" />
                <input type="reset" value="Borrar" title="Borrar"/><br/>-->
                <input type="button" id="boton" value="Enviar" title="Enviar" onClick="valida_olvido_contrasena()"/>
                <input type="reset" value="Borrar" title="Borrar" onClick="limpiador_olvido_contrasena()"/>
			</div>
            
            </form>

            <hr />
        </div>
    	</section>
<!-- LO QUE VA EN LA VISTA FIN --> 

<?php /*require_once("public/sidebar.php");*/ ?>
<?php require_once("public/footer.php"); ?>