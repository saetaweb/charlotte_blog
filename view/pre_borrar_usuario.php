<?php require_once("public/header.php"); ?>
<?php require_once("public/menu.php"); ?>


<!-- LO QUE VA EN LA VISTA -->
    <section id="contenido">
    	<section id="principal">
        <div style="text-align:center;">
			<h1>CONFIRMACION DE ELIMINACI&Oacute;N</h1>
			<br/><br/>
            
            <p>Esta usted seguro??</p>
            
            <p>El usuario: <b><font color="#FF0000"><?php echo $elnombreusuario;?></font></b> que usted va a eliminar, <br/>tiene asociadas: <b><font color="#FF0000"><?php echo $total_noticias;?></font></b> noticias que tambien seran eliminadas.</p>
            
            <br /><br />
            
            <hr />

            
            <a href="<?php echo Configuracion::ruta();?>?controlador=borrar_usuario&usuario_id=<?php echo $elusuarioid;?>">CONFIRMAR BORRADO</a><br />
            <a href="<?php echo Configuracion::ruta();?>?controlador=ver_usuarios">CANCELAR</a>
            

            <hr />
        </div>
    	</section>
<!-- LO QUE VA EN LA VISTA FIN --> 

<?php /*require_once("public/sidebar.php");*/ ?>
<?php require_once("public/footer.php"); ?>