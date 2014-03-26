<?php require_once("public/header.php"); ?>
<?php require_once("public/menu.php"); ?>


<!-- LO QUE VA EN LA VISTA -->
    <section id="contenido">
    	<section id="principal">
        <h1>EDITAR USUARIO</h1>
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
            <h2 style="color: red;">Error en la edicion del usuario</h2>
            <?php
        break;
        case '3':
            ?>
            <h2 style="color: green;">Usuario editado exitosamente</h2>
            <?php
        break;
        case '4':
            ?>
            <h2 style="color: red;">Error en la edicion del nuevo usuario <br/> 
            email ya esta ocupado. prueba otro</h2>
            <?php
        break;
    }
}
?>
			<?php /*print_r($las_categorias);*/ ?>
    
			<form action="<?php $_SERVER['PHP_SELF']?>" name="editarusuario" method="post" enctype="multipart/form-data">
					<div class="campoform">
						Nombre:
						<br/>
						<input type="text" name="nombres" placeholder="Digita tu(s) nombre(s)" required="required" size="35" autofocus="autofocus" maxlenght="250" value="<?php echo $el_usuario[0]['nombres'];?>">
                    <div id="error_nombres"></div>    
					</div>
					<div class="campoform">
						Apellidos:
						<br/>
						<input type="text" name="apellidos" placeholder="Digita tu(s) apellido(s)" required="required" size="35" maxlenght="250" value="<?php echo $el_usuario[0]['apellidos'];?>">
					<div id="error_apellidos"></div> 
                    </div>
					<div class="campoform">
						Email:
						<br/>
                        <!--onBlur="hikaru(document.editarusuario.email.value,'error_email','test_ajax.php')"-->
                        <input type="email" name="email" id="idemail" placeholder="escribe tu correo electronico" required="required" maxlength="50" value="<?php echo $el_usuario[0]['email'];?>" onBlur="hikaru2(document.editarusuario.email.value,'<?php echo $el_usuario[0]['email'];?>','error_email','ajax/valida_editar_usuarios.php')"/>
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
                        
                        <img src="<?php Configuracion::ruta()?>public/images/fotos/<?php echo $el_usuario[0]["foto"];?>" width="100" height="100">
                        
						<br/>
						<input type="file" name="foto"/>
					</div>
                    <br/>
                    

                    <div class="campoform">
                    Seleccione Nivel del Usuario: 
                    <br/>
                    <select name="usuario_level">
                    	<option value="registrado" title="registrado">Registrado</option>
                    	<option value="admin" title="registrado">Administrador</option>
                    </select>
                    </div>
                   
                    
					<div class="campoform">
                    
                    	<input type="hidden" name="de_editarusuario" value="ok"/>
                        <input type="hidden" name="usuario_id" value="<?php echo $_GET["usuario_id"];?>"> 
    					<input type="hidden" name="antigua_foto" value="<?php echo $el_usuario[0]["foto"];?>">
                        <input type="hidden" name="antiguo_email" value="<?php echo $el_usuario[0]["email"];?>">

                        <!--<input type="submit" value="Enviar" title="Registrarse" />
                        <input type="reset" value="Borrar" title="Borrar"/><br/>-->    					
                    	<input type="button" id="boton" value="Enviar" title="Enviar" onClick="valida_editar_usuario()"/>
                        <input id="boton_2" type="button" value="No se puede Ingresar" title="No se puede Ingresar" style="display:none" />
                        <input type="reset" value="Borrar" title="Borrar" onClick="limpiador_editar_usuario()"/>
					</div>
				</form>
    	</section>
<!-- LO QUE VA EN LA VISTA FIN --> 

<?php require_once("public/sidebar.php"); ?>
<?php require_once("public/footer.php"); ?>