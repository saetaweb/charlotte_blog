<?php
		if (!$posicion==0)
		{
			?>
			<a href="<?php echo Configuracion::ruta();?>?controlador=ver_resultados&search=<?php echo $_GET["search"]?>&pos=0" title="Primero">
			<img src="<?php echo Configuracion::ruta();?>public/images/navigator/inicio.png"/>
			</a>
			<?php
		}
		else
		{
			?>
		
			<img src="<?php echo Configuracion::ruta();?>public/images/navigator/neutro.png"/>
			<?php
		}
		
		/*-------------------------------------------------*/
		
		if ($posicion==0)
		{
			?>
			<img src="<?php echo Configuracion::ruta();?>public/images/navigator/neutro.png"/>
			<?php
		}
		else
		{
			?>
			<a href="<?php echo Configuracion::ruta();?>?controlador=ver_resultados&search=<?php echo $_GET["search"]?>&pos=<?php echo $posicion - 3;?>" title="Anteriores">
			<img src="<?php echo Configuracion::ruta();?>public/images/navigator/atras.png"/>
			</a>
			<?php
		}
		
		
		/*-------------------------------------------------*/
		
		
		
		if ($impresos == 3)
		{
			?>
			<a href="<?php echo Configuracion::ruta();?>?controlador=ver_resultados&search=<?php echo $_GET["search"]?>&pos=<?php echo $posicion + 3;?>" title="Siguientes">
			<img src="<?php echo Configuracion::ruta();?>public/images/navigator/adelante.png"/>
			</a>
			<?php
		}
		else
		{
			?>
			<img src="<?php echo Configuracion::ruta();?>public/images/navigator/neutro.png"/>
			<?php
		}
		
		
		/*-------------------------------------------------*/
		
		
		if ($posicion == $ultimo)
		{
			?>
			<img src="<?php echo Configuracion::ruta();?>public/images/navigator/neutro.png"/>
			<?php
		}
		else
		{
		?>
			<a href="<?php echo Configuracion::ruta();?>?controlador=ver_resultados&search=<?php echo $_GET["search"]?>&pos=<?php echo $ultimo;?>" title="Ultimo">
			<img src="<?php echo Configuracion::ruta();?>public/images/navigator/final.png"/>
			</a>
		<?php
		}
?>
