<?php require_once("public/header.php"); ?>
<?php require_once("public/menu.php"); ?>


<!-- LO QUE VA EN LA VISTA -->
    <section id="contenido">
    	<section id="principal">
        <h1>EDITA TU NOTICIA</h1>
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
            <h2 style="color: red;">Error en la edicion de la noticia</h2>
            <?php
        break;
        case '3':
            ?>
            <h2 style="color: green;">La noticia se ha editado exitosamente</h2>
            <?php
        break;
    }
}
?>
			<?php /*print_r($la_noticia); exit; */?>
    
			<form action="<?php $_SERVER['PHP_SELF']?>" name="editarnoticia" method="post">
					<div class="campoform">
						T&iacute;tulo de la noticia
						<br/>
						<input type="text" name="titulo_noticia" placeholder="titulo de la noticia" required="required" size="35" maxlenght="250" value="<?php /**/echo $la_noticia[0]['titulo'];?>">
					</div>
					<div class="campoform">
						Contenido de la noticia
						<br/>
						<textarea cols="30" name="contenido_noticia"  placeholder="contenido de la noticia" required="required" rows="10"><?php /**/echo $la_noticia[0]['contenido'];?></textarea>
					</div>
                    <div class="campoform">
						Categoria de la noticia
						<br/>
						<select name="categoria_noticia" required="required">
                        	<option value="0">Seleccione...</option>
                            <?php 
							
							for($i = 0; $i < sizeof($las_categorias); $i++)
							{
							?>
								<option value="<?php echo $las_categorias[$i]["categoria_id"];?>" 
                                title="<?php echo $las_categorias[$i]["nombre"];?>"
                                
                                	<?php 
									/**/
									if($las_categorias[$i]["categoria_id"] ==  $la_noticia[0]['categoria_id'])
									{
										echo "selected = 'selected'";
									} 
									?>
                                
                                >
								<?php echo $las_categorias[$i]["nombre"];?></option>
							<?php	
							}
							
							?>
                        </select>
					</div>
                    
                    <br/>
					<div class="campoform">
                    	<input type="hidden" name="de_editarnoticia" value="ok"/>
                        <input type="hidden" name="usuario_id" value="<?php echo $_SESSION['usuario_id'];?>"/>
                        <input type="hidden" name="id_noticia" value="<?php echo $_GET['id_noticia'];?>"/>
                    	<input type="button" value="Enviar" title="Enviar" onClick="valida_editar_noticia()"/>
                        <input type="reset" value="Borrar" title="Borrar" onClick="limpiador_editarnoticia()"/>
					</div>
				</form>
    	</section>
<!-- LO QUE VA EN LA VISTA FIN --> 

<?php require_once("public/sidebar.php"); ?>
<?php require_once("public/footer.php"); ?>