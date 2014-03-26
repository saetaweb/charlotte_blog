<?php require_once("public/header.php"); ?>

<?php require_once("public/menu.php"); ?>


<!-- LO QUE VA EN LA VISTA -->
    <section id="contenido">
    	<section id="principal">
<?php 

header("Location: " . Configuracion::ruta() . "?controlador=ver_noticias");

?>
    	</section>
<!-- LO QUE VA EN LA VISTA FIN --> 

<?php require_once("public/sidebar.php"); ?>
<?php require_once("public/footer.php"); ?>