<?php require_once("public/header.php"); ?>
<?php require_once("public/menu.php"); ?>


<!-- LO QUE VA EN LA VISTA -->
    <section id="contenido">
    	<section id="principal">
        <h1>CREA UNA CATEGORIA</h1>
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
            <h2 style="color: red;">Error en la creacion de la nueva categoria</h2>
            <?php
        break;
        case '3':
            ?>
            <h2 style="color: green;">Categoria creada exitosamente</h2>
            <?php
        break;
        case '4':
            ?>
            <h2 style="color: red;">Error en el registro de la nueva categoria <br/> 
            el nombre ya esta ocupado. prueba otro</h2>
            <?php
        break;
    }
}
?>
			<?php /*print_r($las_categorias);*/ ?>
    
			<form action="<?php $_SERVER['PHP_SELF']?>" name="crearcategoria" method="post" enctype="multipart/form-data">
					<div class="campoform">
						Nombre:
						<br/>
						<input type="text" name="nombre" placeholder="Digita tu(s) nombre(s)" required="required" size="35" autofocus="autofocus" maxlenght="250" onBlur="hikaru(document.crearcategoria.nombre.value,'error_nombres','ajax/valida_crear_categorias.php')">
                    <div id="error_nombres"></div>    
					</div>     
                    <div class="campoform">
						Seleccione Imagen: <strong>Solo formato [.jpg]</strong>
						<br/>
						<input type="file" name="cat_image"/>
                    <div id="error_imagen"></div>
					</div>
                    <br/>
					<div class="campoform">
                    	<input type="hidden" name="de_crearcategoria" value="ok"/>
                        <!--
                        <input type="submit" value="Enviar" title="Registrarse" />
                        <input type="reset" value="Borrar" title="Borrar"/><br/>-->
                    	<input type="button" id="boton" value="Enviar" title="Enviar" onClick="valida_crear_categoria()"/>
                        <input id="boton_2" type="button" value="No se puede Ingresar" title="No se puede Ingresar" style="display:none" />
                        <input type="reset" value="Borrar" title="Borrar" onClick="limpiador_crear_categoria()"/>
					</div>
				</form>
    	</section>
<!-- LO QUE VA EN LA VISTA FIN --> 

<?php require_once("public/sidebar.php"); ?>
<?php require_once("public/footer.php"); ?>