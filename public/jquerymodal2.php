    <div id="loginmodal" style="display:none;">
    <h1>Logueate</h1>
    
    <form id="miloginform" action="<?php echo Configuracion::ruta();?>?controlador=login" name="login" method="post">
            
            <div class="campoform">
				Email:
				<br/>
                <input type="email" name="email" id="idemail" placeholder="escribe tu correo electronico" required="required" maxlength="50" size="35" />
            	<div id="error_email"></div>     
			</div>
            <div class="campoform">
				Password:
				<br/>
				<input type="password" name="password" required="required" size="35" maxlenght="250">
            	<div id="error_password"></div> 
			</div>
            <br/>
            <div class="campoform">
            	<input type="hidden" name="de_login" value="ok"/>
                <!--<input type="submit" value="Enviar" title="Registrarse" />
                <input type="reset" value="Borrar" title="Borrar"/><br/>-->
                <input type="button" id="boton" value="Enviar" title="Enviar" onClick="valida_login()"/>
                <input id="boton_2" type="button" value="No se puede Ingresar" title="No se puede Ingresar" style="display:none" />
                <input type="reset" value="Borrar" title="Borrar" onClick="limpiador_registrar_usuario()"/>
			</div>
            
            </form>
    
    
    
    
  </div>
  
  
<script type="text/javascript">
$(function(){
  $('#miloginform').submit(function(e){
    return false;
  });
  
  $('#modaltrigger').leanModal({ top: 110, overlay: 0.45, closeButton: ".hidemodal" });
});
</script>
