<?php require_once("public/header.php"); ?>
<?php require_once("public/menu.php"); ?>


<!-- LO QUE VA EN LA VISTA -->
    <section id="contenido">
    	<section id="principal">
			<h1>VER LOS USUARIOS</h1>
            <?php /*print_r($las_noticias);*/
			
				if(isset($_GET["msj"]))
				{
					switch ($_GET["msj"])
					{
						case '1':
							?>
							<h2 style="color: green;">Usuario eliminado correctamente</h2>
							<?php
						break;
						case '2':
							?>
							<h2 style="color: red;">Error al eliminar el usuario</h2>
							<?php
						break;
					}
				}

			?>
<table>
<tr>
<td valingn="top" align="left" colspan="7">
<a href="<?php echo Configuracion::ruta(); ?>?controlador=registrar_usuario" title="Agregar Usuario">Agregar Usuario</a>
<hr />
</td>
</tr>

<tr style="font-weight: bold;">
<td valign="top" align="center" width="45">Nombres - Apellidos</td>
<td valign="top" align="center">Nivel Usuario</td>
<td valign="top" align="center">Email</td>
<td valign="top" align="center">Foto</td>
<td valign="top" align="center">Editar</td>
<td valign="top" align="center">Eliminar</td>
</tr>

            <?php 
			for($i = 0; $i < sizeof($los_usuarios); $i++)
			{
			?>
        <tr style="background-color: #f0f0f0;">
			<td valign="top" align="center"><?php echo $los_usuarios[$i]["nombres"]." - ".$los_usuarios[$i]["apellidos"];?></td>
			<td valign="top" align="center"><?php echo $los_usuarios[$i]["usuario_level"];?></td>
			<td valign="top" align="center"><?php echo $los_usuarios[$i]["email"];?></td>
            <td valign="top" align="center">
            <img src="<?php echo Configuracion::ruta() . 'public/images/fotos/' . $los_usuarios[$i]["foto"]; ?>" width="100" height="100"/>
            </td>
            <td valign="top" align="center"><a href="<?php echo Configuracion::ruta(); ?>?controlador=editar_usuario&usuario_id=<?php echo $los_usuarios[$i]["usuario_id"]?>" title="Editar Usuario <?php echo $los_usuarios[$i]["nombres"]?>">Editar</a></td>
            
            <td valign="top" align="center"><a href="<?php echo Configuracion::ruta(); ?>?controlador=pre_borrar_usuario&nombres=<?php echo $los_usuarios[$i]["nombres"]?>&usuario_id=<?php echo $los_usuarios[$i]["usuario_id"]?>" title="Borrar Usuario <?php echo $los_usuarios[$i]["nombres"]?>">Borrar</a></td>
            
            
			<!--</h1><td valign="top" align="center"><a href="javascript:void()" title="Eliminar Usuario <?php //echo $los_usuarios[$i]["nombres"]?>" onclick="eliminar_registro('<?php //echo Configuracion::ruta(); ?>?controlador=borrar_usuario&usuario_id=<?php //echo $los_usuarios[$i]["usuario_id"]?>&foto=<?php //echo $los_usuarios[$i]["foto"]?>');">Borrar</a></td>-->
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