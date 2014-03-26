/******************************************************************************************************************/
/*   FUNCIONES GENERALES PÒR DEFECTO    */
/******************************************************************************************************************/

function valida_correo(correo) 
{
		  if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(correo))
		  {	
		   return true;
		  } 
		  else 
		  {
		   return false;
		  }
}
//*********************************************************************************************************************************
//valida números
function valida_numero(numero)
{
	if (!/^([0-9])*$/.test(numero))
	{
		return false;
	}
	else
	{
		return true;
	}
}
//*******************************************************************************************************
//función para validar cadenas de solo letras
function valida_cadena(texto)
	{
		var RegExPattern = "[1-9]";
		 if (texto.match(RegExPattern))
		 {
		 	return false;
		 }
		 else
		 {
		 	return true;
		 }
	}


/******************************************************************************************************************/
/*   FUNCIONES PROPIAS DE ESTE DESARROLLO    */
/******************************************************************************************************************/

/*VALIDAMOS EL FORMULARIO PARA PUBLICAR NOTICIAS*/
function valida_publicar_noticia()
{		
		/*creamos una nva variable para abreviar el llamado a nuestro formulario...*/
		var piluform_01 = document.publicanoticia;
		
		
		/*VALIDAMOS QUE EL CAMPO DEL TITULO NO QUEDE VACIO....*/
		if(piluform_01.titulo_noticia.value == 0)
		{
			alert("Debe llenar el titulo de la noticia");       /*aviso de error al usuario*/
			piluform_01.titulo_noticia.value == "";   		    /*resetea a un string vacio el campo del formulario*/
			piluform_01.titulo_noticia.focus();                 /*situa el cursor en este campo por defecto*/
			return false; 	                                    /*el return false detiene el resto de la ejecucion del script*/
		}
		
		/*VALIDAMOS QUE EL CAMPO DEL CONTENIDO NO QUEDE VACIO....*/
		if(piluform_01.contenido_noticia.value == 0)
		{
			alert("Debe llenar el contenido de la noticia");      
			piluform_01.contenido_noticia.value == "";   
			piluform_01.contenido_noticia.focus();                
			return false; 	                     
		}	
		
		/*VALIDAMOS QUE EL CAMPO DEL PAIS NO QUEDE VACIO....*/
		if(piluform_01.categoria_noticia.value == 0)
		{
			alert("Debe elegir una categoria");        
			piluform_01.categoria_noticia.focus();                
			return false; 	                     
		}	
		
		
		/*SI SUPERA EXITOSAMENTE TODAS LAS VALIDACIONES ENTONCES SI ENVIAMOS EL FORMULARIO*/
		piluform_01.submit();		
}

function limpiador_publicanoticia()
{
	/*la funcion reset() limpia el formulario dejando vacio todos sus campos*/
	document.publicanoticia.reset();
		
	/*una vez reseteado situa el cursor por defecto en el campo de name: "titulo_noticia"*/
	document.publicanoticia.titulo_noticia.focus();
}

/*VALIDAMOS EL FORMULARIO PARA EDITAR NOTICIAS*/
function valida_editar_noticia()
{		
		/*creamos una nva variable para abreviar el llamado a nuestro formulario...*/
		var piluform_02 = document.editarnoticia;
		
		
		/*VALIDAMOS QUE EL CAMPO DEL TITULO NO QUEDE VACIO....*/
		if(piluform_02.titulo_noticia.value == 0)
		{
			alert("Debe llenar el titulo de la noticia");       /*aviso de error al usuario*/
			piluform_01.titulo_noticia.value == "";   		    /*resetea a un string vacio el campo del formulario*/
			piluform_01.titulo_noticia.focus();                 /*situa el cursor en este campo por defecto*/
			return false; 	                                    /*el return false detiene el resto de la ejecucion del script*/
		}
		
		/*VALIDAMOS QUE EL CAMPO DEL CONTENIDO NO QUEDE VACIO....*/
		if(piluform_02.contenido_noticia.value == 0)
		{
			alert("Debe llenar el contenido de la noticia");      
			piluform_01.contenido_noticia.value == "";   
			piluform_01.contenido_noticia.focus();                
			return false; 	                     
		}	
		
		/*VALIDAMOS QUE EL CAMPO DEL PAIS NO QUEDE VACIO....*/
		if(piluform_02.categoria_noticia.value == 0)
		{
			alert("Debe elegir una categoria");        
			piluform_01.categoria_noticia.focus();                
			return false; 	                     
		}	
		
		
		/*SI SUPERA EXITOSAMENTE TODAS LAS VALIDACIONES ENTONCES SI ENVIAMOS EL FORMULARIO*/
		piluform_02.submit();		
}


function limpiador_editarnoticia()
{
	/*la funcion reset() limpia el formulario dejando vacio todos sus campos*/
	document.publicanoticia.reset();
		
	/*una vez reseteado situa el cursor por defecto en el campo de name: "titulo_noticia"*/
	document.publicanoticia.titulo_noticia.focus();
}


function eliminar_registro(ruta)
{
    if(confirm("realmente desea eliminar este registro ?"))
    {
        window.location=ruta;
    }
}


/*VALIDAMOS EL FORMULARIO PARA REGISTRAR USUARIOS*/

function valida_registrar_usuario()
{
	var piluform_03 = document.registrarusuario;

	if(piluform_03.nombres.value == 0)
	{
		document.getElementById("error_nombres").innerHTML="<font color='red'>Debe escribir su Nombre.</font>";
		piluform_03.nombres.value = "";
		piluform_03.nombres.focus();
		return false;
	}
	else
	{
		/*SI EL USUARIO HA LLENADO BIEN EL CAMPO ENTONCES VACIAMOS EL DIV QUE MUESTRA EL ERROR*/
		document.getElementById("error_nombres").innerHTML="";
	}
	
	
	if(piluform_03.apellidos.value == 0)
	{
		document.getElementById("error_apellidos").innerHTML="<font color='red'>Debe escribir sus Apellidos.</font>";
		piluform_03.apellidos.value = "";
		piluform_03.apellidos.focus();
		return false;
	}
	else
	{
		/*SI EL USUARIO HA LLENADO BIEN EL CAMPO ENTONCES VACIAMOS EL DIV QUE MUESTRA EL ERROR*/
		document.getElementById("error_apellidos").innerHTML="";
	}
	
	
	if(piluform_03.email.value == 0)
	{
		document.getElementById("error_email").innerHTML="<font color='red'>Debe escribir su Email.</font>";
		piluform_03.email.value = "";
		piluform_03.email.focus();
		return false;
	}
	else
	{
		/*SI EL USUARIO HA LLENADO BIEN EL CAMPO ENTONCES VACIAMOS EL DIV QUE MUESTRA EL ERROR*/
		document.getElementById("error_email").innerHTML="";
	}
	
	
	if (valida_correo(piluform_03.email.value) == false)
	{
		//alert("Ingrese su Login");
		document.getElementById("error_email").innerHTML="<font color='red'>El E-Mail ingresado no es válido</font><hr>";
		piluform_03.email.value="";
		piluform_03.email.focus();
		return false;
	}
	else
	{
		document.getElementById("error_email").innerHTML="";
	}
	
	
	if (piluform_03.password.value == 0)
	{
		//alert("Ingrese su Login");
		document.getElementById("error_password").innerHTML="<font color='red'>El Password está vacío</font><hr>";
		piluform_03.password.value="";
		piluform_03.password.focus();
		return false;
	}
	else
	{
		document.getElementById("error_password").innerHTML="";
	}
	
	if (piluform_03.password.value != piluform_03.password2.value)
	{
		document.getElementById("error_password").innerHTML="<font color='red'>Los Password ingresados no coinciden</font>";
		piluform_03.password.value="";
		piluform_03.password2.value="";
		piluform_03.password.focus();		
		return false;
	}
	else
	{
		document.getElementById("error_password").innerHTML="";
	}	
	
	piluform_03.password.value = calcMD5(piluform_03.password.value);
	piluform_03.submit();
		
}

function limpiador_registrarusuario()
{
	/*la funcion reset() limpia el formulario dejando vacio todos sus campos*/
	document.registrarusuario.reset();
		
	/*una vez reseteado situa el cursor por defecto en el campo de name: "titulo_noticia"*/
	document.registrarusuario.nombres.focus();
}



/*VALIDAMOS EL FORMULARIO PARA EDITAR USUARIOS*/

function valida_editar_usuario()
{
	var piluform_04 = document.editarusuario;

	if(piluform_04.nombres.value == 0)
	{
		document.getElementById("error_nombres").innerHTML="<font color='red'>Debe escribir su Nombre.</font>";
		piluform_04.nombres.value = "";
		piluform_04.nombres.focus();
		return false;
	}
	else
	{
		/*SI EL USUARIO HA LLENADO BIEN EL CAMPO ENTONCES VACIAMOS EL DIV QUE MUESTRA EL ERROR*/
		document.getElementById("error_nombres").innerHTML="";
	}
	
	
	if(piluform_04.apellidos.value == 0)
	{
		document.getElementById("error_apellidos").innerHTML="<font color='red'>Debe escribir sus Apellidos.</font>";
		piluform_04.apellidos.value = "";
		piluform_04.apellidos.focus();
		return false;
	}
	else
	{
		/*SI EL USUARIO HA LLENADO BIEN EL CAMPO ENTONCES VACIAMOS EL DIV QUE MUESTRA EL ERROR*/
		document.getElementById("error_apellidos").innerHTML="";
	}
	
	
	if(piluform_04.email.value == 0)
	{
		document.getElementById("error_email").innerHTML="<font color='red'>Debe escribir su Email.</font>";
		piluform_04.email.value = "";
		piluform_04.email.focus();
		return false;
	}
	else
	{
		/*SI EL USUARIO HA LLENADO BIEN EL CAMPO ENTONCES VACIAMOS EL DIV QUE MUESTRA EL ERROR*/
		document.getElementById("error_email").innerHTML="";
	}
	
	
	if (valida_correo(piluform_04.email.value) == false)
	{
		//alert("Ingrese su Login");
		document.getElementById("error_email").innerHTML="<font color='red'>El E-Mail ingresado no es válido</font><hr>";
		piluform_04.email.value="";
		piluform_04.email.focus();
		return false;
	}
	else
	{
		document.getElementById("error_email").innerHTML="";
	}
	
	
	if (piluform_04.password.value == 0)
	{
		//alert("Ingrese su Login");
		document.getElementById("error_password").innerHTML="<font color='red'>El Password está vacío</font><hr>";
		piluform_04.password.value="";
		piluform_04.password.focus();
		return false;
	}
	else
	{
		document.getElementById("error_password").innerHTML="";
	}
	
	if (piluform_04.password.value != piluform_04.password2.value)
	{
		document.getElementById("error_password").innerHTML="<font color='red'>Los Password ingresados no coinciden</font>";
		piluform_04.password.value="";
		piluform_04.password2.value="";
		piluform_04.password.focus();		
		return false;
	}
	else
	{
		document.getElementById("error_password").innerHTML="";
	}	
	
	piluform_04.password.value = calcMD5(piluform_04.password.value);
	piluform_04.submit();
		
}

function limpiador_editarusuario()
{
	/*la funcion reset() limpia el formulario dejando vacio todos sus campos*/
	document.editarusuario.reset();
		
	/*una vez reseteado situa el cursor por defecto en el campo de name: "titulo_noticia"*/
	document.editarusuario.nombres.focus();
}


/*VALIDAMOS EL FORMULARIO PARA CREAR CATEGORIAS*/

function valida_crear_categoria()
{
	var piluform_04 = document.crearcategoria;

	if(piluform_04.nombre.value == 0)
	{
		document.getElementById("error_nombres").innerHTML="<font color='red'>Debe escribir el Nombre.</font>";
		piluform_04.nombre.value = "";
		piluform_04.nombre.focus();
		return false;
	}
	else
	{
		/*SI EL USUARIO HA LLENADO BIEN EL CAMPO ENTONCES VACIAMOS EL DIV QUE MUESTRA EL ERROR*/
		document.getElementById("error_nombres").innerHTML="";
	}
	
	if(piluform_04.cat_image.value == 0)
	{
		document.getElementById("error_imagen").innerHTML="<font color='red'>Debe ingresar una imagen.</font>";
		piluform_04.cat_image.value = "";
		piluform_04.cat_image.focus();
		return false;
	}
	else
	{
		/*SI EL USUARIO HA LLENADO BIEN EL CAMPO ENTONCES VACIAMOS EL DIV QUE MUESTRA EL ERROR*/
		document.getElementById("error_imagen").innerHTML="";
	}
	
	
	piluform_04.submit();
		
}

function limpiador_crear_categoria()
{
	/*la funcion reset() limpia el formulario dejando vacio todos sus campos*/
	document.crearcategoria.reset();
		
	/*una vez reseteado situa el cursor por defecto en el campo de name: "titulo_noticia"*/
	document.crearcategoria.nombres.focus();
}


/*VALIDAMOS EL FORMULARIO PARA EDITAR CATEGORIAS*/

function valida_editar_categoria()
{
	var piluform_05 = document.editarcategoria;

	if(piluform_05.nombre.value == 0)
	{
		document.getElementById("error_nombres").innerHTML="<font color='red'>Debe escribir el Nombre.</font>";
		piluform_05.nombre.value = "";
		piluform_05.nombre.focus();
		return false;
	}
	else
	{
		/*SI EL USUARIO HA LLENADO BIEN EL CAMPO ENTONCES VACIAMOS EL DIV QUE MUESTRA EL ERROR*/
		document.getElementById("error_nombres").innerHTML="";
	}
	
	piluform_05.submit();
		
}

function limpiador_editar_categoria()
{
	/*la funcion reset() limpia el formulario dejando vacio todos sus campos*/
	document.editarcategoria.reset();
		
	/*una vez reseteado situa el cursor por defecto en el campo de name: "titulo_noticia"*/
	document.editarcategoria.nombres.focus();
}


/* FUNCION PARA EL SELECT DINAMICO DE LA CATEGORIA EN EL SIDEBAR*/
function enviarcategoria()
{
	/*alert('pelusa');*/
	
	var lacategoria = document.getElementById('selector').value;
	if(lacategoria >= 1)
	{
		window.location = "?controlador=ver_noticias&categoria=" + lacategoria;
	}
	
}

/* FUNCION PARA EL BUSCADOR EN EL SIDEBAR*/
function enviarkeyword()
{	
	var lakeyword = document.getElementById('elsearch').value;
	if(lakeyword == 0)
	{
		alert("debe ingresar una palabra de busqueda");
	}
	else
	{
		window.location = "?controlador=ver_resultados&search=" + lakeyword;
	}	
}


/*VALIDAMOS EL FORMULARIO DE LOGIN*/
function valida_login()
{
	var piluform_06 = document.login;	
	
	if(piluform_06.email.value == 0)
	{
		document.getElementById("error_email").innerHTML="<font color='red'>Debe escribir su Email.</font>";
		piluform_06.email.value = "";
		piluform_06.email.focus();
		return false;
	}
	else
	{
		/*SI EL USUARIO HA LLENADO BIEN EL CAMPO ENTONCES VACIAMOS EL DIV QUE MUESTRA EL ERROR*/
		document.getElementById("error_email").innerHTML="";
	}
	
	if (piluform_06.password.value == 0)
	{
		//alert("Ingrese su Login");
		document.getElementById("error_password").innerHTML="<font color='red'>El Password está vacío</font><hr>";
		piluform_06.password.value="";
		piluform_06.password.focus();
		return false;
	}
	else
	{
		document.getElementById("error_password").innerHTML="";
	}	
	
	piluform_06.password.value = calcMD5(piluform_06.password.value);
	piluform_06.submit();
		
}

function limpiador_login()
{
	/*la funcion reset() limpia el formulario dejando vacio todos sus campos*/
	document.login.reset();
		
	/*una vez reseteado situa el cursor por defecto en el campo de name: "titulo_noticia"*/
	document.login.email.focus();
}




/*VALIDAMOS EL FORMULARIO DE OLVIDO CONTRASEÑA*/
function valida_olvido_contrasena()
{
	var piluform_07 = document.olvido_contrasena;	
	
	if(piluform_07.email.value == 0)
	{
		document.getElementById("error_email").innerHTML="<font color='red'>Debe escribir su Email.</font>";
		piluform_07.email.value = "";
		piluform_07.email.focus();
		return false;
	}
	else
	{
		/*SI EL USUARIO HA LLENADO BIEN EL CAMPO ENTONCES VACIAMOS EL DIV QUE MUESTRA EL ERROR*/
		document.getElementById("error_email").innerHTML="";
	}
	
	if (valida_correo(piluform_07.email.value) == false)
	{
		//alert("Ingrese su Login");
		document.getElementById("error_email").innerHTML="<font color='red'>El E-Mail ingresado no es v&Aacute;lido</font><hr>";
		piluform_07.email.value="";
		piluform_07.email.focus();
		return false;
	}
	else
	{
		document.getElementById("error_email").innerHTML="";
	}	
	
	piluform_07.submit();
		
}

function limpiador_olvido_contrasena()
{
	/*la funcion reset() limpia el formulario dejando vacio todos sus campos*/
	document.olvido_contrasena.reset();
		
	/*una vez reseteado situa el cursor por defecto en el campo de name: "titulo_noticia"*/
	document.olvido_contrasena.email.focus();
}


/*VALIDAMOS EL FORMULARIO DE OLVIDO CONTRASEÑA*/
function valida_restablecer_contrasena()
{
	var piluform_08 = document.restablecer_contrasena;	
	
	if (piluform_08.password.value == 0)
	{
		//alert("Ingrese su Login");
		document.getElementById("error_password").innerHTML="<font color='red'>El Password está vacío</font><hr>";
		piluform_08.password.value="";
		piluform_08.password.focus();
		return false;
	}
	else
	{
		document.getElementById("error_password").innerHTML="";
	}
	
	if (piluform_08.password.value != piluform_08.password2.value)
	{
		document.getElementById("error_password").innerHTML="<font color='red'>Los Password ingresados no coinciden</font>";
		piluform_08.password.value="";
		piluform_08.password2.value="";
		piluform_08.password.focus();		
		return false;
	}
	else
	{
		document.getElementById("error_password").innerHTML="";
	}

	piluform_08.password.value = calcMD5(piluform_08.password.value);
	piluform_08.submit();
		
}

function limpiador_restablecer_contrasena()
{
	/*la funcion reset() limpia el formulario dejando vacio todos sus campos*/
	document.restablecer_contrasena.reset();
		
	/*una vez reseteado situa el cursor por defecto en el campo de name: "titulo_noticia"*/
	document.restablecer_contrasena.password.focus();
}