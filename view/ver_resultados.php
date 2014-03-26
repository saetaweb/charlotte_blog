<?php require_once("public/header.php"); ?>
<?php require_once("public/menu.php"); ?>


<!-- LO QUE VA EN LA VISTA -->
    <section id="contenido">
    	<section id="principal">
			<h1>VER LAS NOTICIAS</h1>
            <?php /*print_r($las_noticias);*/
			
			
			if(empty($las_noticias))
			{
				?>
				<h2 style="color: red;">Lo sentimos, palabra no encontrada</h2>
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
				<p><b>
				<?php 
				/*echo $las_noticias[$i]["titulo"];*/
				echo str_replace("".$_GET["search"]."", "<b>".$_GET["search"]."</b>", $las_noticias[$i]["titulo"]);
				?>
                </b>
				<br>
				<p>
				<?php 
				/*echo $las_noticias[$i]["contenido"];*/
				echo str_replace("".$_GET["search"]."", "<b>".$_GET["search"]."</b>", $las_noticias[$i]["contenido"]);
				?>
                </p>
                <div style="clear:both; width:100%; height:20px;"></div>
                <p>Publicado: <?php echo $las_noticias[$i]["publicado_fecha"]?></p>
                
                <!-- ESTE BLOQUE NOS QUEDA PENDIENTE CUANDO RESOLVAMOS LA SONSULTA SQL PARA MOSTRAR LAS CATEGORIAS -->
                <!--<div class="datosadicionales">
					<a href="#"><img border="0" src="<?php //echo Configuracion::ruta(); ?>public/images/categorias/<?php //echo $las_noticias[$i]["categoria_imagen"]; ?>"></a>
				</div>
				<p>Categoria: <a href="#"><b><?php //echo $las_noticias[$i]["nombre"]?></b></a></p>-->

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
					<?php require_once("public/navigator_ver_resultados.php"); ?>
					</div>
			<?php		
				}
			?>					
			
    	</section>
<!-- LO QUE VA EN LA VISTA FIN --> 

<?php require_once("public/sidebar.php"); ?>
<?php require_once("public/footer.php"); ?>