<?php require_once("public/header.php"); ?>
<?php require_once("public/menu.php"); ?>


<!-- LO QUE VA EN LA VISTA -->
    <section id="contenido">
    	<section id="principal">
			<h1>VER LAS CATEGORIAS</h1>
            <?php /*print_r($las_noticias);*/
			
				if(isset($_GET["msj"]))
				{
					switch ($_GET["msj"])
					{
						case '1':
							?>
							<h2 style="color: green;">Categoria eliminada correctamente</h2>
							<?php
						break;
						case '2':
							?>
							<h2 style="color: red;">Error al eliminar la categoria</h2>
							<?php
						break;
					}
				}

			?>
<table>
<tr>
<td valingn="top" align="left" colspan="7">
<a href="<?php echo Configuracion::ruta(); ?>?controlador=crear_categoria" title="Agregar Categoria">Agregar Categoria</a>
<hr />
</td>
</tr>

<tr style="font-weight: bold;">
<td valign="top" align="center">Nombre</td>
<td valign="top" align="center">Foto</td>
<td valign="top" align="center">Editar</td>
<td valign="top" align="center">Eliminar</td>
</tr>

            <?php 
			/*print_r($las_categorias); exit;*/
			
			for($i = 0; $i < sizeof($las_categorias); $i++)
			{
			?>
        <tr style="background-color: #f0f0f0;">
			<td valign="top" align="center"><?php echo $las_categorias[$i]["nombre"];?></td>
            <td valign="top" align="center">
            <img src="<?php echo Configuracion::ruta() . 'public/images/categorias/' . $las_categorias[$i]["categoria_imagen"]; ?>" width="60" height="40"/>
            </td>
            
            
            <td valign="top" align="center"><a href="<?php echo Configuracion::ruta(); ?>?controlador=editar_categoria&categoria_id=<?php echo $las_categorias[$i]["categoria_id"]?>" title="Editar Categoria <?php echo $las_categorias[$i]["nombre"]?>">Editar</a></td>
            
            
            <td valign="top" align="center"><a href="<?php echo Configuracion::ruta(); ?>?controlador=pre_borrar_categoria&nombre=<?php echo $las_categorias[$i]["nombre"];?>&categoria_id=<?php echo $las_categorias[$i]["categoria_id"]?>" title="Borrar Categoria <?php echo $las_categorias[$i]["nombre"]?>">Borrar</a></td>
            
            
            
            
			<!--<td valign="top" align="center"><a href="javascript:void()" title="Eliminar Categoria <?php //echo $las_categorias[$i]["nombre"]?>" onclick="eliminar_registro('<?php //echo Configuracion::ruta(); ?>?controlador=borrar_categoria&categoria_id=<?php //echo $las_categorias[$i]["categoria_id"]?>&categoria_imagen=<?php //echo $las_categorias[$i]["categoria_imagen"]?>');">Borrar</a></td>-->
            
            
            
		</tr>
            
			<?php 
			}
			?>
            </table>
            <hr />

    	</section>
<!-- LO QUE VA EN LA VISTA FIN --> 

<?php require_once("public/sidebar.php"); ?>
<?php require_once("public/footer.php"); ?>