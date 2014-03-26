<?php require_once("public/header.php"); ?>
<?php require_once("public/menu.php"); ?>


<!-- LO QUE VA EN LA VISTA -->
    <section id="contenido">
    	<section id="principal">
        <h1>EDITAR CATEGORIA</h1>
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
            <h2 style="color: red;">Error en la edicion de la categoria</h2>
            <?php
        break;
        case '3':
            ?>
            <h2 style="color: green;">Categoria editada exitosamente</h2>
            <?php
        break;
        case '4':
            ?>
            <h2 style="color: red;">Error en la edicion de la categoria <br/> 
            el nombre ya esta ocupado. prueba otro</h2>
            <?php
        break;
    }
}
?>
			<?php /*print_r($las_categorias);*/ ?>
    
			<form action="<?php $_SERVER['PHP_SELF']?>" name="editarcategoria" method="post" enctype="multipart/form-data">
					<div class="campoform">
						Nombre:
						<br/>
						<input type="text" name="nombre" placeholder="Digita tu(s) nombre(s)" required="required" size="35" autofocus="autofocus" maxlenght="250" value="<?php echo $la_categoria[0]['nombre'];?>" onBlur="hikaru2(document.editarcategoria.nombre.value,'<?php echo $la_categoria[0]['nombre'];?>','error_nombres','ajax/valida_editar_categorias.php')">
                    <div id="error_nombres"></div>    
					</div>  
                    <div class="campoform">
						Seleccione Imagen: <strong>Solo formato [.jpg]</strong>
                        
                        <img src="<?php Configuracion::ruta()?>public/images/categorias/<?php echo $la_categoria[0]["categoria_imagen"];?>" width="60" height="40">
                        
						<br/>
						<input type="file" name="cat_image"/>
					</div>
                    <br/>
					<div class="campoform">
                    
                    	<input type="hidden" name="de_editarcategoria" value="ok"/>
                        <input type="hidden" name="categoria_id" value="<?php echo $_GET["categoria_id"];?>"> 
    					<input type="hidden" name="antigua_foto" value="<?php echo $la_categoria[0]["categoria_imagen"];?>">
                        <input type="hidden" name="antiguo_nombre" value="<?php echo $la_categoria[0]["nombre"];?>">

                        <!--
                        <input type="submit" value="Enviar" title="Registrarse" />
                        <input type="reset" value="Borrar" title="Borrar"/><br/>
                        -->    					
                    	<input type="button" id="boton" value="Enviar" title="Enviar" onClick="valida_editar_categoria()"/>
                        <input id="boton_2" type="button" value="No se puede Ingresar" title="No se puede Ingresar" style="display:none" />
                        <input type="reset" value="Borrar" title="Borrar" onClick="limpiador_editar_categoria()"/>
					</div>
				</form>
    	</section>
<!-- LO QUE VA EN LA VISTA FIN --> 

<?php require_once("public/sidebar.php"); ?>
<?php require_once("public/footer.php"); ?>