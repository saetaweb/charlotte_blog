    <div id="loginmodal" style="display:none;">
    <h1>Logueate</h1>
    <form id="loginform" name="loginform" method="post" action="<?php echo Configuracion::ruta();?>?controlador=login">
      <label for="username">Email:</label>
      <input type="text" name="email" id="email" class="txtfield" tabindex="1">
      
      <label for="password">Password:</label>
      <input type="password" name="password" id="password" class="txtfield" tabindex="2">
      <div class="center"><input type="submit"value="Log In" tabindex="3"></div>
      <input type="hidden" name="de_login" value="ok"/>
    </form>
  </div>
  
  
<script type="text/javascript">
$(function(){
  $('#loginform').submit(function(e){
    return false;
  });
  $('#modaltrigger').leanModal({ top: 110, overlay: 0.45, closeButton: ".hidemodal" });
});
</script>
