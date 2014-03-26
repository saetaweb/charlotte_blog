<?php require_once("public/header.php"); ?>
<?php require_once("public/menu.php"); ?>


<!-- LO QUE VA EN LA VISTA -->

            
  <div id="loginmodal">
    <h1>User Login</h1>
    <form id="loginform" name="loginform" method="post" action="index.html">
      <label for="username">Username:</label>
      <input type="text" name="username" id="username" class="txtfield" tabindex="1">
      
      <label for="password">Password:</label>
      <input type="password" name="password" id="password" class="txtfield" tabindex="2">
      
      <div class="center"><input type="submit" name="loginbtn" id="loginbtn" class="flatbtn-blu hidemodal" value="Log In" tabindex="3"></div>
    </form>
  </div>
            
            
            
            
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


<!-- LO QUE VA EN LA VISTA FIN --> 

<?php /*require_once("public/sidebar.php");*/ ?>
<?php /*require_once("public/footer.php");*/ ?>