<?php require_once("public/header.php"); ?>
<?php require_once("public/menu.php"); ?>


<!-- LO QUE VA EN LA VISTA -->
    <section id="contenido">
    	<section id="principal">
        <script type="text/javascript">/*
			$(document).ready(function(){
			alert('hola, SOY JQUERY');
			});*/
		</script>
			<h1>VER LAS NOTICIAS</h1>
            <?php /*print_r($las_noticias);*/
			
				if(isset($_GET["msj"]))
				{
					switch ($_GET["msj"])
					{
						case '1':
							?>
							<h2 style="color: green;">Noticia eliminada correctamente</h2>
							<?php
						break;
						case '2':
							?>
							<h2 style="color: red;">Error al eliminar la noticia</h2>
							<?php
						break;
					}
				}
				
				
			if(empty($las_noticias))
			{
				?>
				<h2 style="color: red;">No se encontraron noticias.</h2>
				<?php			
			
			}

			?>
            

            
            
            
            <?php 
			$impresos=0;
			for($i = 0; $i < sizeof($las_noticias); $i++)
			{
			$impresos++;
			?>

            <div class='lineaanuncio'>
				<p><b><?php echo $las_noticias[$i]["titulo"]?></b>
				<br>
				<p><?php echo $las_noticias[$i]["contenido"]?></p>
				<div class="datosadicionales">
					<a href="#"><img border="0" src="<?php echo Configuracion::ruta(); ?>public/images/categorias/<?php echo $las_noticias[$i]["categoria_imagen"]; ?>"></a>
				</div>

				<p>Categoria: <b><?php echo $las_noticias[$i]["nombre"]?></b></p>
				<p>Publicado: <?php echo $las_noticias[$i]["format_publicado_fecha"]?></p>

                
<?php 	
		if(isset($_SESSION["usuario_level"]))
		{
			/*si esta registrado como usuario admin muestra lo siguiente...*/
			if($_SESSION["usuario_level"] == "admin")
			{
				?>
                
                <p><a href="<?php echo Configuracion::ruta(); ?>?controlador=editar_noticia&id_noticia=
				<?php echo $las_noticias[$i]["id"]?>" 
                title="Editar Noticia <?php echo $las_noticias[$i]["titulo"]?>">Editar</a></p>
                
                <p><a href="javascript:void()" title="Eliminar Noticia <?php echo $las_noticias[$i]["titulo"]?>" 
                onclick="eliminar_registro('<?php echo Configuracion::ruta(); ?>?controlador=borrar_noticia&id_noticia=<?php echo 		                $las_noticias[$i]["id"]?>');">Borrar</a></p>
                
				<?php 		
			}		
		}
		
?>                
     
			</div>
            
			<?php 
			}
			
			?>
            <hr />
            
            <?php /**/
			if(!empty($las_noticias))
				{
			?>
                    <div class="paginador">
					<?php require_once("public/navigator_ver_noticias.php"); ?>
					</div>
			<?php		
				}
			?>
            
    	</section>
<!-- LO QUE VA EN LA VISTA FIN --> 

<?php require_once("public/sidebar.php"); ?>
<?php require_once("public/footer.php"); ?>