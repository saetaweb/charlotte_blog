<?php require_once("public/header.php"); ?>
<?php require_once("public/menu.php"); ?>


<!-- LO QUE VA EN LA VISTA -->
    <section id="contenido">
    	<section id="principal">
        <h1>REGISTRATE COMO USUARIO</h1>
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
            <h2 style="color: red;">Error en el registro del nuevo usuario</h2>
            <?php
        break;
        case '3':
            ?>
            <h2 style="color: green;">Te has registrado exitosamente, <br />te hemos enviado un mensaje a tu email para que te des de alta.</h2>
            <?php
        break;
        case '4':
            ?>
            <h2 style="color: red;">Error en el registro del nuevo usuario <br/> 
            email ya esta ocupado. prueba otro</h2>
            <?php
        break;
    }
}
?>
			<?php /*print_r($las_categorias);*/ ?>
    
			<form action="<?php $_SERVER['PHP_SELF']?>" name="registrarusuario" method="post" enctype="multipart/form-data">
					<div class="campoform">
						Nombre:
						<br/>
						<input type="text" name="nombres" placeholder="Digita tu(s) nombre(s)" required="required" size="35" autofocus="autofocus" maxlenght="250">
                    <div id="error_nombres"></div>    
					</div>
					<div class="campoform">
						Apellidos:
						<br/>
						<input type="text" name="apellidos" placeholder="Digita tu(s) apellido(s)" required="required" size="35" maxlenght="250">
					<div id="error_apellidos"></div> 
                    </div>
					<div class="campoform">
						Email:
						<br/>
                        <input type="email" name="email" id="idemail" placeholder="escribe tu correo electronico" required="required" maxlength="50" onBlur="hikaru(document.registrarusuario.email.value,'error_email','ajax/valida_registrar_usuarios.php')"/>
                    <div id="error_email"></div>     
					</div>
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
                    <div class="campoform">
						Seleccione Imagen: <strong>Solo formato [.jpg]</strong>
						<br/>
						<input type="file" name="foto"/>
					</div>
                    <br/>
					<div class="campoform">
                    
                    <?php 
					
					if(isset($_SESSION["usuario_level"]))
					{
						if($_SESSION["usuario_level"] == "admin")
						{
							?>
                                <div class="campoform">
                                    Seleccione Nivel del Usuario: 
                                    <br/>
                                    <select name="usuario_level">
                                    	<option value="registrado" title="registrado">Registrado</option>
                                        <option value="admin" title="registrado">Administrador</option>
                                    </select>
                                </div>
							<?php 		
						}					
					}
					
					?>
                    
                    
                    
                    	<input type="hidden" name="de_registrarusuario" value="ok"/>
                        <!--<input type="submit" value="Enviar" title="Registrarse" />
                        <input type="reset" value="Borrar" title="Borrar"/><br/>-->
                    	<input type="button" id="boton" value="Enviar" title="Enviar" onClick="valida_registrar_usuario()"/>
                        <input id="boton_2" type="button" value="No se puede Ingresar" title="No se puede Ingresar" style="display:none" />
                        <input type="reset" value="Borrar" title="Borrar" onClick="limpiador_registrar_usuario()"/>
					</div>
				</form>
    	</section>
<!-- LO QUE VA EN LA VISTA FIN --> 

<?php require_once("public/sidebar.php"); ?>
<?php require_once("public/footer.php"); ?>