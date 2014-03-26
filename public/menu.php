<!-- SECCION BODY HEADER -->

<body>
	<header>
    	<a href="<?php echo Configuracion::ruta();?>">
			<img src="<?php echo Configuracion::ruta();?>public/images/cabecera.jpg" style="width:100%;" alt="Charlotte Blog" border="0">
        </a>
            
    <nav>
<!----><div style="width:100%; clear:both;"><?php /*if(isset($_SESSION['usuario_level'])){print_r($_SESSION);}else{echo "NO HAY VARIABLE DE SESION!!!";}*/?> </div>
        <div class="navegadorizquierda">
        
        <?php 
		
		if(isset($_SESSION["usuario_level"]))
		{
			/*si esta registrado como usuario admin muestra lo siguiente...*/
			if($_SESSION["usuario_level"] == "admin")
			{
				?>
				<a href="<?php echo Configuracion::ruta();?>" class="enlacenav">Portada</a> |
				<a href="<?php echo Configuracion::ruta();?>?controlador=publicar_noticia&usuario_id=<?php echo $_SESSION["usuario_id"];?>" class="enlacenav">Publicar Noticia</a> |
				<a href="<?php echo Configuracion::ruta();?>?controlador=ver_usuarios" class="enlacenav">Adm. Usuarios</a> |
				<a href="<?php echo Configuracion::ruta();?>?controlador=ver_categorias" class="enlacenav">Adm. Categorias</a>
				<?php 		
			}
			else
			{
				?>
				<a href="<?php echo Configuracion::ruta();?>" class="enlacenav">Portada</a> |
				<a href="<?php echo Configuracion::ruta();?>?controlador=publicar_noticia&usuario_id=<?php echo $_SESSION["usuario_id"];?>" class="enlacenav">Publicar Noticia</a>
				<?php 			
			}		
		}
		else
		{
			 ?>
            <a href="<?php echo Configuracion::ruta();?>" class="enlacenav">Portada</a> |
            <!--<a href="<?php /*echo Configuracion::ruta();*/?>?controlador=publicar_noticia" class="enlacenav">Publicar Noticia</a> |-->
            <a href="<?php echo Configuracion::ruta();?>?controlador=registrar_usuario" class="enlacenav">Registrarse</a>
            <b><--- Registrate para publicar tus noticias!!</b>		 
			 <?php		
		}

		?>               
        </div>		
        
        <div class="navegadorderecha">
        
        <?php
        if(isset($_SESSION["usuario_level"]))
		{
			/*si esta registrado como usuario admin muestra lo siguiente...*/
			if($_SESSION["usuario_level"] == "admin")
			{
				?>
				<a href="<?php echo Configuracion::ruta();?>?controlador=ver_noticias_por_usuario&usuario_id=<?php echo $_SESSION["usuario_id"];?>" class="enlacenav">Ver mis noticias</a> |
				<!--<a href="micuenta.php" class="enlacenav">Ver mi cuenta</a> |-->
				<a href="<?php echo Configuracion::ruta();?>?controlador=logout" class="enlacenav">Salir</a>
				<?php 		
			}
			else
			{
				?>
				<a href="<?php echo Configuracion::ruta();?>?controlador=ver_noticias_por_usuario&usuario_id=<?php echo $_SESSION["usuario_id"];?>" class="enlacenav">Ver mis noticias</a> |
				<a href="<?php echo Configuracion::ruta();?>?controlador=editar_usuario&usuario_id=<?php echo $_SESSION["usuario_id"];?>" class="enlacenav">Ver mi cuenta</a> |
				<a href="<?php echo Configuracion::ruta();?>?controlador=logout" class="enlacenav">Salir</a>
				<?php 			
			}		
		}
		else
		{
			 ?>
            <!--<a href="<?php //echo Configuracion::ruta();?>?controlador=jquerylogin" class="enlacenav">Login ( jQuery )</a>
            <center><a href="#loginmodal" class="flatbtn" id="modaltrigger">Modal Login</a></center>-->
            <a href="#loginmodal" class="enlacenav" id="modaltrigger">Login ( jQuery )</a>	 
            <a href="<?php echo Configuracion::ruta();?>?controlador=login" class="enlacenav">Login</a>		 
			 <?php		
		}

		?>

		</div>

        <div style="width:100%; clear:both;">
        
        
        	<?php
			if(isset($_SESSION["usuario_level"]))
			{
				?>
					<div style="width:100%; clear:both; height:15px;"></div>
					<div class="muestrausuario">
					<img src="<?php echo Configuracion::ruta() . 'public/images/fotos/' . $_SESSION['foto']; ?>" width=60 height=60> 
					Bienvenido: <br/>
					<b><?php echo $_SESSION['nombres'] . " (" . $_SESSION['usuario_level'] . ")";?></b>
					</div>
				<?php 			
			}
 
            ?>         
        
        
        </div>
	</nav>
    
	</header>
    
    
<!-- SECCION BODY HEADER FIN --> 

<!-- LA SECCION DEL FORMULARIO EN JQUERY -->
<?php /**/require_once("public/jquerymodal.php"); ?>
<!-- LA SECCION DEL FORMULARIO EN JQUERY FIN -->
