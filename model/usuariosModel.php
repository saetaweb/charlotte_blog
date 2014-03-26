<?php
class Usuarios extends Configuracion
{
	private $conexionPDO;
	private $usuarios;
	private $estado;
	private $autenticado;
	
	public function __construct()
	{
		/*$this->conexionPDO = new PDO("mysql:host=localhost; dbname=portafolio_charlotte", "elvis", "siouxsie");*/
		$this->conexionPDO = parent::conectarPDO();
		$this->usuarios = array();
		$this->autenticado = array();
	}
	

	private function set_names_UTF8()
    {
        return $this->conexionPDO->query("SET NAMES 'utf8'");    
    }
	
	public function add_usuario()
	{
		/*VALIDAMOS QUE NO HAYAN CAMPOS SIN LLENAR O MAL LLENADOS*/
		if(empty($_POST["nombres"]) or empty($_POST["apellidos"]) or empty($_POST["email"]) or empty($_POST["password"]) or empty($_POST["password2"]) or Configuracion::valida_correo($_POST["email"]) == false)
		{
			header("Location: " . Configuracion::ruta() . "?controlador=registrar_usuario&msj=1");
			exit;
		}
		
		/*SI EL USUARIO NO SUBE NINGUNA FOTO*/
		if(empty($_FILES["foto"]["name"]))
		{
			/*verificamos primero que el email no este ya en la DB*/
			$sqlconsulta2 = "select count(*) from usuarios where email = ?";	
			$PDOsoporte2 = $this->conexionPDO->prepare($sqlconsulta2);
			$elemail2 = Configuracion::guerreras_magicas($_POST["email"]);
			$PDOsoporte2->bindValue(1,$elemail2,PDO::PARAM_STR);
			$PDOsoporte2->execute();
				
			/*si el email es nuevo en la DB entonces iniciamos la insercion del nvo registro*/
			if($PDOsoporte2->fetchColumn() == 0)
			{
				/*preparamos el nombre que va a tener la foto si el usuario no sube ninguna*/
				$lafoto="por_defecto.jpg";
				
				self::set_names_UTF8();	
				$sqlconsulta = "insert into usuarios values (null, ?, ?, ?, ?, ?, ?, ?, 'desactivado')";
				$PDOsoporte = $this->conexionPDO->prepare($sqlconsulta);
					
				/*filtramos con guerreras magicas() para evitar ataques xsl*/
				$losnombres = Configuracion::guerreras_magicas($_POST["nombres"]);
				$losapellidos = Configuracion::guerreras_magicas($_POST["apellidos"]);
				$elemail = Configuracion::guerreras_magicas($_POST["email"]);
				$elpassword = Configuracion::guerreras_magicas($_POST["password"]);
				$elpassword2 = md5(Configuracion::guerreras_magicas($_POST["password"]));
				
				/*procesamos el usuario level a insertar en la db si es normal o admin*/
				if(isset($_POST["usuario_level"]))
				{
					if($_POST["usuario_level"] == "registrado" or $_POST["usuario_level"] == "admin")
					{
						$elusuariolevel = Configuracion::guerreras_magicas($_POST["usuario_level"]);
					}
					else
					{
						$elusuariolevel = "registrado";
					}
				}
				else
				{
					$elusuariolevel = "registrado";
				}
				
					
				$PDOsoporte->bindValue(1,$losnombres,PDO::PARAM_STR);
				$PDOsoporte->bindValue(2,$losapellidos,PDO::PARAM_STR);
				$PDOsoporte->bindValue(3,$elemail,PDO::PARAM_STR);
				$PDOsoporte->bindValue(4,$lafoto,PDO::PARAM_STR);
				$PDOsoporte->bindValue(5,$elpassword,PDO::PARAM_STR);
				$PDOsoporte->bindValue(6,$elpassword2,PDO::PARAM_STR);
				$PDOsoporte->bindValue(7,$elusuariolevel,PDO::PARAM_STR);
					
				if($PDOsoporte->execute())
				{
					
					
					
		/*si la insercion a la DB del nuevo usuario es exitosa, entonces le mandamos un correo a su email...*/
					
								/*pequeña prueba preliminar ...
								echo $elemail;
								echo "<br>";
								echo "La ultima id insertada en la DB es...  " . $this->conexionPDO->lastInsertId();
								exit;
								... fin pequeña prueba preliminar*/
		
					
						$fecha=date("d-m-Y");
						$hora=date("H:m:s");
						$correo=$elemail;
						$remitente="Remitente <noreply@saetaweb.com>";
						$asunto="Confirme su registro en saetaweb.com";
						$cuerpo="
						<div align='left'>
						Estimado (a) $losnombres gracias por registrarse con nosotros
						<br>
						<br>
						Por favor haga clic en el siguiente link para terminar y confirmar su registro:
						<br>
						<br>
						<a href='http://www.apps.saetaweb.com/charlotte_blog/?controlador=activacion&tokem=".$this->conexionPDO->lastInsertId()."&f=$fecha&h=$hora'>
						http://www.apps.saetaweb.com/charlotte_blog/?controlador=activacion&tokem=".$this->conexionPDO->lastInsertId()."&f=$fecha&h=$hora
						</a>
						<br>
						<br>
						Si lo prefiere tome el link y péguelo en la barra de direcciones de su navegador favorito
						<br>
						<br>
						Gracias por registrarse en apps.saetaweb.com
						</div>
						";
						$sheader="From:".$remitente."\nReply-To:".$remitente."\n";
						$sheader=$sheader."X-Mailer:PHP/".phpversion()."\n";
						$sheader=$sheader."Mime-Version: 1.0\n";
						$sheader=$sheader."Content-Type: text/html";
						
						mail($correo,$asunto,$cuerpo,$sheader);		
					
		/*fin de la gestion del email*/
		
		
					$this->conexionPDO=null;
					header("Location: " . Configuracion::ruta() . "?controlador=registrar_usuario&msj=3");	
				}
				else
				{
					$this->conexionPDO=null;
					header("Location: " . Configuracion::ruta() . "?controlador=registrar_usuario&msj=2");		
				}			
			}
			else
			{
					$this->conexionPDO=null;
					header("Location: " . Configuracion::ruta() . "?controlador=registrar_usuario&msj=4");				
			}
			
			
			
		}
		/*SI EL USUARIO SI SUBE SU FOTO...*/
		else
		{
			/*VERIFICAMOS QUE LA IMAGEN SEA JPG*/
			if($_FILES['foto']['type']=='image/jpeg')
			{
				/*verificamos primero que el email no este ya en la DB*/
				$sqlconsulta2 = "select count(*) from usuarios where email = ?";	
				$PDOsoporte2 = $this->conexionPDO->prepare($sqlconsulta2);
				$elemail2 = Configuracion::guerreras_magicas($_POST["email"]);
				$PDOsoporte2->bindValue(1,$elemail2,PDO::PARAM_STR);
				$PDOsoporte2->execute();
				
				/*si el email es nuevo en la DB entonces iniciamos la insercion del nvo registro*/
				if($PDOsoporte2->fetchColumn() == 0)
				{
					$lafoto = Configuracion::guerreras_magicas($_POST["nombres"]) . ".jpg";
					
					/*subimos la foto a la aplicacion*/
					copy($_FILES["foto"]["tmp_name"], "public/images/fotos/" . $lafoto);
					
					self::set_names_UTF8();	
					$sqlconsulta = "insert into usuarios values (null, ?, ?, ?, ?, ?, ?, ?, 'desactivado')";
					$PDOsoporte = $this->conexionPDO->prepare($sqlconsulta);
					
					/*filtramos con guerreras magicas() para evitar ataques xsl*/
					$losnombres = Configuracion::guerreras_magicas($_POST["nombres"]);
					$losapellidos = Configuracion::guerreras_magicas($_POST["apellidos"]);
					$elemail = Configuracion::guerreras_magicas($_POST["email"]);
					$elpassword = Configuracion::guerreras_magicas($_POST["password"]);
					$elpassword2 = md5(Configuracion::guerreras_magicas($_POST["password"]));
					
					/*procesamos el usuario level a insertar en la db si es normal o admin*/
					if(isset($_POST["usuario_level"]))
					{
						if($_POST["usuario_level"] == "registrado" or $_POST["usuario_level"] == "admin")
						{
							$elusuariolevel = Configuracion::guerreras_magicas($_POST["usuario_level"]);
						}
						else
						{
							$elusuariolevel = "registrado";
						}
					}
					else
					{
						$elusuariolevel = "registrado";
					}
					
					$PDOsoporte->bindValue(1,$losnombres,PDO::PARAM_STR);
					$PDOsoporte->bindValue(2,$losapellidos,PDO::PARAM_STR);
					$PDOsoporte->bindValue(3,$elemail,PDO::PARAM_STR);
					$PDOsoporte->bindValue(4,$lafoto,PDO::PARAM_STR);
					$PDOsoporte->bindValue(5,$elpassword,PDO::PARAM_STR);
					$PDOsoporte->bindValue(6,$elpassword2,PDO::PARAM_STR);
					$PDOsoporte->bindValue(7,$elusuariolevel,PDO::PARAM_STR);
					
					if($PDOsoporte->execute())
					{
						
					
		/*si la insercion a la DB del nuevo usuario es exitosa, entonces le mandamos un correo a su email...*/	
					
						$fecha=date("d-m-Y");
						$hora=date("H:m:s");
						$correo=$elemail;
						$remitente="Remitente <noreply@saetaweb.com>";
						$asunto="Confirme su registro en saetaweb.com";
						$cuerpo="
						<div align='left'>
						Estimado (a) $losnombres gracias por registrarse con nosotros
						<br>
						<br>
						Por favor haga clic en el siguiente link para terminar y confirmar su registro:
						<br>
						<br>
						<a href='http://www.apps.saetaweb.com/charlotte_blog/?controlador=activacion&tokem=".$this->conexionPDO->lastInsertId()."&f=$fecha&h=$hora'>
						http://www.apps.saetaweb.com/charlotte_blog/?controlador=activacion&tokem=".$this->conexionPDO->lastInsertId()."&f=$fecha&h=$hora
						</a>
						<br>
						<br>
						Si lo prefiere tome el link y péguelo en la barra de direcciones de su navegador favorito
						<br>
						<br>
						Gracias por registrarse en apps.saetaweb.com
						</div>
						";
						$sheader="From:".$remitente."\nReply-To:".$remitente."\n";
						$sheader=$sheader."X-Mailer:PHP/".phpversion()."\n";
						$sheader=$sheader."Mime-Version: 1.0\n";
						$sheader=$sheader."Content-Type: text/html";
						
						mail($correo,$asunto,$cuerpo,$sheader);		
					
		/*fin de la gestion del email*/						
						$this->conexionPDO=null;
						header("Location: " . Configuracion::ruta() . "?controlador=registrar_usuario&msj=3");	
					}
					else
					{
						$this->conexionPDO=null;
						header("Location: " . Configuracion::ruta() . "?controlador=registrar_usuario&msj=2");		
					}					
	
				}
				else
				{
					header("Location: " . Configuracion::ruta() . "?controlador=registrar_usuario&msj=4");
					exit;				
				}
								
			}
			else
			{
				header("Location: " . Configuracion::ruta() . "?controlador=registrar_usuario&msj=2");
				exit;
			}
		
		}

	}	
	
	public function activacion()
	{
		/*echo "hasta aqui vamos bien 01"; exit;*/
		
		if(isset($_GET["tokem"]))
		{
			self::set_names_UTF8();		

			/*verificamos que la id traida por get SI exista en la DB.  ANTI TRAMPA GET*/
			$sqlconsulta2 = "select count(*) from usuarios where usuario_id = ? and estado = 'desactivado'";
			$PDOsoporte2 = $this->conexionPDO->prepare($sqlconsulta2);
			$eltokem = Configuracion::guerreras_magicas($_GET["tokem"]);
			$PDOsoporte2->bindValue(1,$eltokem,PDO::PARAM_INT);
			$PDOsoporte2->execute();
				
			/*si la verificacion es exitosa, y hay al menos un resultado...*/
			if($PDOsoporte2->fetchColumn() > 0)
			{
				/*basandonos en la id del usuario obtenemos el nombre de su foto asociada*/
				$sqlconsulta3 = "update usuarios set estado = 'activado' where usuario_id =" . $eltokem;
				$PDOsoporte3 = $this->conexionPDO->prepare($sqlconsulta3);

				if($PDOsoporte3->execute())
				{
					$_SESSION["usuario_id"] = $eltokem;
					//header("Location: home.php");
					
					/*si quisieramos aqui podriamos enviarle otro correo 
					avisandole al usuario que su registro ha sido completado
					y dandole la bienvenida*/
					
					echo "<script type='text/javascript'>
					alert('Usted se ha registrado correctamente');
					window.location='http://localhost/PORTAFOLIO_charlotte/';
					</script>";				
				}
				else
				{
					$this->conexionPDO=null;
					header("Location: " . Configuracion::ruta() . "?controlador=error");				
				}
			}
			else
			{
				$this->conexionPDO=null;
				header("Location: " . Configuracion::ruta() . "?controlador=error");		
			}	
		}
		else
		{
			header("Location: " . Configuracion::ruta() . "?controlador=error");
		}	
	}	
	
	public function get_usuarios_admin()
	{
		self::set_names_UTF8();	
		$sqlconsulta = "select * from usuarios";
			
		foreach($this->conexionPDO->query($sqlconsulta) as $registro)
		{
			$this->usuarios[] = $registro;
		}
		
		return $this->usuarios;
		
		$this->conexionPDO = null;
	}
	
	public function get_usuario_por_id_admin($usuario_id)
	{
		if(isset($usuario_id))
		{
			/*echo $usuario_id . "estoy en el metodo"; exit;*/
			
			self::set_names_UTF8();
			
			/*verificamos primero que la id que nos llega por GET si esta en la DB y no es trampa por GET*/
			$sqlconsulta = "select count(*) from usuarios where usuario_id = ?";
			$PDOsoporte = $this->conexionPDO->prepare($sqlconsulta);
			$elidusuario = Configuracion::guerreras_magicas($usuario_id);
        
        	$PDOsoporte->bindValue(1,$elidusuario,PDO::PARAM_INT);
			
			if($PDOsoporte->execute())
			{
				/*si en efecto la id SI esta en la DB y no hay ninguna trampa.. */
				if($PDOsoporte->fetchColumn() > 0)
				{
						$sqlconsulta2 = "select nombres, apellidos, email, foto from usuarios where usuario_id = ?";
						$PDOsoporte2 = $this->conexionPDO->prepare($sqlconsulta2);
						$el_id_usuario = Configuracion::guerreras_magicas($usuario_id);
						
						//COMO NO LE HIZO EL BINDVALUE ENTONCES SE LE PASA COMO ARRAY => array($el_id_usuario)	
						$PDOsoporte2->execute(array($el_id_usuario));
						while($registro = $PDOsoporte2->fetch())
						{
							$this->usuarios[] = $registro;
						}
						return $this->usuarios;
						$this->conexionPDO=null;				
				}
				else
				{
						$this->conexionPDO=null;
						header("Location: " . Configuracion::ruta() . "?controlador=error");				
				}

			}
			else
			{
				$this->conexionPDO=null;
				header("Location: " . Configuracion::ruta() . "?controlador=error");
			}			
					
		}
		else
		{
			header("Location: " . Configuracion::ruta() . "?controlador=error");
		}

	}

	
	public function edit_usuario_admin()
	{
		/*VALIDAMOS QUE NO HAYAN CAMPOS SIN LLENAR O MAL LLENADOS*/
		if(empty($_POST["nombres"]) or empty($_POST["apellidos"]) or empty($_POST["email"]) or empty($_POST["password"]) or empty($_POST["password2"]) or Configuracion::valida_correo($_POST["email"]) == false)
		{
			header("Location: " . Configuracion::ruta() . "?controlador=editar_usuario&msj=1");
			exit;
		}		
		
		self::set_names_UTF8();
			
		/*verificamos primero que la id que nos llega por GET si esta en la DB y no es trampa por GET*/
		$sqlconsultaM = "select count(*) from usuarios where usuario_id = ?";
		$PDOsoporteM = $this->conexionPDO->prepare($sqlconsultaM);
		$elidusuario = Configuracion::guerreras_magicas($_POST["usuario_id"]);
        
        $PDOsoporteM->bindValue(1,$elidusuario,PDO::PARAM_INT);		
		
		$PDOsoporteM->execute();
			
		/*si no se encuentra ningun resultado, entonces el dato que nos viene por POST es malicioso.. */
		if($PDOsoporteM->fetchColumn() == 0)
		{
			header("Location: " . Configuracion::ruta() . "?controlador=error");
			exit;				
		}		
		
		/* si el usuario no actualiza la foto... */
		if(empty($_FILES["foto"]["name"]))
		{
			/*
			verificamos primero que el email no este ya en la DB
			A MENOS QUE.. sea el mismo que ya tenia antes, 
			en cuyo caso el sistema debe permitir conservarlo, actualizando los demas valores
			*/
			
			$sqlconsulta2 = "select count(*) from usuarios where email = ? and ? != ?";	
			$PDOsoporte2 = $this->conexionPDO->prepare($sqlconsulta2);
			$elemail2 = Configuracion::guerreras_magicas($_POST["email"]);
			$elemail3 = Configuracion::guerreras_magicas($_POST["antiguo_email"]);
			$PDOsoporte2->bindValue(1,$elemail2,PDO::PARAM_STR);
			$PDOsoporte2->bindValue(2,$elemail2,PDO::PARAM_STR);
			$PDOsoporte2->bindValue(3,$elemail3,PDO::PARAM_STR);
			$PDOsoporte2->execute();
			
			/*si el email es nuevo en la DB entonces iniciamos la actualizacion del nvo registro*/
			if($PDOsoporte2->fetchColumn() == 0)
			{
				/* ...dejamos la que estaba antes y actualizamos los demas datos */
				$lafoto=$_POST["antigua_foto"];	
				
				self::set_names_UTF8();	
				$sqlconsulta = "
				
				update usuarios set 
				nombres = ?, 
				apellidos = ?, 
				email = ?, 
				foto = ?, 
				passwordjs = ?, 
				passwordjsphp = ?,
				usuario_level = ? 
				where usuario_id = ?
				
				";	
				
				$PDOsoporte = $this->conexionPDO->prepare($sqlconsulta);
				
				/*filtramos con guerreras magicas() para evitar ataques xsl*/
				$losnombres = Configuracion::guerreras_magicas($_POST["nombres"]);
				$losapellidos = Configuracion::guerreras_magicas($_POST["apellidos"]);
				$elemail = Configuracion::guerreras_magicas($_POST["email"]);
				$elpassword = Configuracion::guerreras_magicas($_POST["password"]);
				$elpassword2 = md5(Configuracion::guerreras_magicas($_POST["password"]));
				$elusuarioid = Configuracion::guerreras_magicas($_POST["usuario_id"]);
				
				/*procesamos el usuario level a insertar en la db si es normal o admin*/
				if(isset($_POST["usuario_level"]))
				{
					if($_POST["usuario_level"] == "registrado" or $_POST["usuario_level"] == "admin")
					{
						$elusuariolevel = Configuracion::guerreras_magicas($_POST["usuario_level"]);
					}
					else
					{
						$elusuariolevel = "registrado";
					}
				}
				else
				{
					$elusuariolevel = "registrado";
				}
				
				$PDOsoporte->bindValue(1,$losnombres,PDO::PARAM_STR);
				$PDOsoporte->bindValue(2,$losapellidos,PDO::PARAM_STR);
				$PDOsoporte->bindValue(3,$elemail,PDO::PARAM_STR);
				$PDOsoporte->bindValue(4,$lafoto,PDO::PARAM_STR);
				$PDOsoporte->bindValue(5,$elpassword,PDO::PARAM_STR);
				$PDOsoporte->bindValue(6,$elpassword2,PDO::PARAM_STR);
				$PDOsoporte->bindValue(7,$elusuariolevel,PDO::PARAM_STR);
				$PDOsoporte->bindValue(8,$elusuarioid,PDO::PARAM_INT);
				
				if($PDOsoporte->execute())
				{
					$this->conexionPDO=null;
					header("Location: " . Configuracion::ruta() . "?controlador=editar_usuario&msj=3&usuario_id=" . $_POST["usuario_id"]);	
				}
				else
				{
					$this->conexionPDO=null;
					header("Location: " . Configuracion::ruta() . "?controlador=editar_usuario&msj=2&usuario_id=" . $_POST["usuario_id"]);		
				}
			
			}
			else
			{
				$this->conexionPDO=null;
				header("Location: " . Configuracion::ruta() . "?controlador=editar_usuario&msj=4&usuario_id=" . $_POST["usuario_id"]);	
			}			
			
		}
		/*si se actualiza la foto entonces la actualiza en la DB*/
		else
		{
			/*verificamos que la imagen sea formato jpg*/
			if($_FILES['foto']['type']=='image/jpeg')
			{

				/*
				verificamos primero que el email no este ya en la DB
				A MENOS QUE.. sea el mismo que ya tenia antes, 
				en cuyo caso el sistema debe permitir conservarlo, actualizando los demas valores
				*//**/
				
				$sqlconsulta2 = "select count(*) from usuarios where email = ? and ? != ?";	
				$PDOsoporte2 = $this->conexionPDO->prepare($sqlconsulta2);
				$elemail2 = Configuracion::guerreras_magicas($_POST["email"]);
				$elemail3 = Configuracion::guerreras_magicas($_POST["antiguo_email"]);
				$PDOsoporte2->bindValue(1,$elemail2,PDO::PARAM_STR);
				$PDOsoporte2->bindValue(2,$elemail2,PDO::PARAM_STR);
				$PDOsoporte2->bindValue(3,$elemail3,PDO::PARAM_STR);
				$PDOsoporte2->execute();
				
				/*si el email es nuevo en la DB entonces iniciamos la actualizacion del nvo registro*/
				if($PDOsoporte2->fetchColumn() == 0)
				{				
					
					/*eliminamos la vieja foto de la aplicacion SOLO si NO es la foto por defecto de la aplicacion*/
					$vieja_foto = Configuracion::guerreras_magicas($_POST["antigua_foto"]);			
					if($vieja_foto != "por_defecto.jpg")
					{
						unlink('public/images/fotos/' . $vieja_foto);
					}
					
					
					/*preparamos el nombre que va a tener la foto*/
					$lafoto = Configuracion::guerreras_magicas($_POST["nombres"]) . ".jpg";	
					
					/*subimos la foto a la aplicacion*/
					copy($_FILES["foto"]["tmp_name"], "public/images/fotos/" . $lafoto);
					
					self::set_names_UTF8();	
					
					$sqlconsulta = "
					
					update usuarios set 
					nombres = ?, 
					apellidos = ?, 
					email = ?, 
					foto = ?, 
					passwordjs = ?, 
					passwordjsphp = ?,
					usuario_level = ? 
					where usuario_id = ?
					
					";
					
					$PDOsoporte = $this->conexionPDO->prepare($sqlconsulta);
					
					/*filtramos con guerreras magicas() para evitar ataques xsl*/
					$losnombres = Configuracion::guerreras_magicas($_POST["nombres"]);
					$losapellidos = Configuracion::guerreras_magicas($_POST["apellidos"]);
					$elemail = Configuracion::guerreras_magicas($_POST["email"]);
					$elpassword = Configuracion::guerreras_magicas($_POST["password"]);
					$elpassword2 = md5(Configuracion::guerreras_magicas($_POST["password"]));
					$elusuarioid = Configuracion::guerreras_magicas($_POST["usuario_id"]);
					
					/*procesamos el usuario level a insertar en la db si es normal o admin*/
					if(isset($_POST["usuario_level"]))
					{
						if($_POST["usuario_level"] == "registrado" or $_POST["usuario_level"] == "admin")
						{
							$elusuariolevel = Configuracion::guerreras_magicas($_POST["usuario_level"]);
						}
						else
						{
							$elusuariolevel = "registrado";
						}
					}
					else
					{
						$elusuariolevel = "registrado";
					}
					

					$PDOsoporte->bindValue(1,$losnombres,PDO::PARAM_STR);
					$PDOsoporte->bindValue(2,$losapellidos,PDO::PARAM_STR);
					$PDOsoporte->bindValue(3,$elemail,PDO::PARAM_STR);
					$PDOsoporte->bindValue(4,$lafoto,PDO::PARAM_STR);
					$PDOsoporte->bindValue(5,$elpassword,PDO::PARAM_STR);
					$PDOsoporte->bindValue(6,$elpassword2,PDO::PARAM_STR);
					$PDOsoporte->bindValue(7,$elusuariolevel,PDO::PARAM_STR);
					$PDOsoporte->bindValue(8,$elusuarioid,PDO::PARAM_INT);
					
					
					
					if($PDOsoporte->execute())
					{
						/*echo "TODO BIEN"; exit;*/
						$this->conexionPDO=null;
						header("Location: " . Configuracion::ruta() . "?controlador=editar_usuario&msj=3&usuario_id=" . $_POST["usuario_id"]);	
					}
					else
					{
						
						$this->conexionPDO=null;
						/*echo "AQUI HAY UN ERROR"; exit;*/
						header("Location: " . Configuracion::ruta() . "?controlador=editar_usuario&msj=2&usuario_id=" . $_POST["usuario_id"]);		
					}
									
				}
				else
				{
					$this->conexionPDO=null;
					/*echo "EMAIL SI ENCONTRADO"; exit;*/
					header("Location: " . Configuracion::ruta() . "?controlador=editar_usuario&msj=4&usuario_id=" . $_POST["usuario_id"]);
				}
			}
			else
			{
				header("Location: " . Configuracion::ruta() . "?controlador=editar_usuario&msj=2&usuario_id=" . $_POST["usuario_id"]);
			}
		}
	}


/* [version 01]  ESTA VERSION DEL METODO ESTA PROBADA Y FUNCIONA TODO OK
SOLO QUE NO ES TAN RIGUROSA COMO LA VERSION 2 QUE ES ANTI TRAMPA POR GET
DE TODAS FORMAS AQUI HAY CIETRA PROTECCION POR QUE EL GET SE MANDA A TRAVES DE JS
	
	public function delete_usuario_admin($usuario_id, $foto)
	{	
		if(isset($usuario_id) and isset($foto))
		{
			self::set_names_UTF8();
			
			if($foto != "por_defecto.jpg")
			{
				unlink('public/images/fotos/' . $foto);
			}
					
			$sqlconsulta = "delete from usuarios where usuario_id = ?";
			$PDOsoporte = $this->conexionPDO->prepare($sqlconsulta);
			
			$la_id_usuario = Configuracion::guerreras_magicas($usuario_id);
	
			//COMO NO LE HIZO EL BINDVALUE ENTONCES SE LE PASA COMO ARRAY => array($la_id_noticia)
            if($PDOsoporte->execute(array($la_id_usuario)))
            {
                $this->conexionPDO=null;
				header("Location: " . Configuracion::ruta() . "?controlador=ver_usuarios&msj=1");
            }
			else
			{
				$this->conexionPDO=null;
				header("Location: " . Configuracion::ruta() . "?controlador=ver_usuarios&msj=2");
			}					
		
		}
		else
		{
			header("Location: " . Configuracion::ruta() . "?controlador=ver_usuarios&msj=2");
		}	
	}
*/

	public function cuenta_dependientes_usuario_noticias($elusuarioid)
	{
		if(isset($elusuarioid))
		{
			/*
			echo $elusuarioid; exit;*/
			
			self::set_names_UTF8();	
			
			/*verificamos que la id traida por get SI exista en la DB.  ANTI TRAMPA GET*/
			$sqlconsulta = "select count(*) nombres from usuarios where usuario_id = ?";
			$PDOsoporte = $this->conexionPDO->prepare($sqlconsulta);
			
			$el_usuarioid = Configuracion::guerreras_magicas($elusuarioid);
			
			$PDOsoporte->bindValue(1,$el_usuarioid,PDO::PARAM_INT);
			$PDOsoporte->execute();			

			/*si la verificacion es exitosa, entonces la id si existe en la DB...*/
			if($PDOsoporte->fetchColumn() > 0)
			{
				$sqlconsulta2 = "select count(*) as contados from noticias where usuario_id = ?";
				$PDOsoporte2 = $this->conexionPDO->prepare($sqlconsulta2);
				$el_id_usuario = $el_usuarioid;
			
				/*COMO NO LE HIZO EL BINDVALUE ENTONCES SE LE PASA COMO ARRAY => array($la_id_usuario)*/
				if($PDOsoporte2->execute(array($el_id_usuario)))
				{	
					while($registro = $PDOsoporte2->fetch())
					{
						$this->total[]=$registro;
					}
					
					/*$total_noticias = $this->total[0]["contados"];*/
					return $this->total;

					$this->conexionPDO = null;			
				}

			}				
		}
		else
		{
			header("Location: " . Configuracion::ruta() . "?controlador=error");		
		}	
	}



/*  [version 02] usa solo un parametro y es mas compleja, por que tiene mas peticiones SQL
 pero mas segura y anti trampas por GET*/
	public function delete_usuario_admin($usuario_id)
	{	
		if(isset($usuario_id))
		{
			self::set_names_UTF8();		

			/*verificamos que la id traida por get SI exista en la DB.  ANTI TRAMPA GET*/
			$sqlconsulta2 = "select count(*) foto from usuarios where usuario_id = ?";
			$PDOsoporte2 = $this->conexionPDO->prepare($sqlconsulta2);
			$elusuarioid = Configuracion::guerreras_magicas($usuario_id);
			$PDOsoporte2->bindValue(1,$elusuarioid,PDO::PARAM_INT);
			$PDOsoporte2->execute();
				
			/*si la verificacion es exitosa, y hay al menos un resultado...*/
			if($PDOsoporte2->fetchColumn() > 0)
			{
				/*basandonos en la id del usuario obtenemos el nombre de su foto asociada*/
				$sqlconsulta3 = "select foto from usuarios where usuario_id = ?";
				$PDOsoporte3 = $this->conexionPDO->prepare($sqlconsulta3);
				$elusuarioid2 = Configuracion::guerreras_magicas($usuario_id);
				$PDOsoporte3->bindValue(1,$elusuarioid2,PDO::PARAM_INT);
				$PDOsoporte3->execute();
				
				/*transformamos el objeto de clase PDO en un array asociativo*/
				$gainax = $PDOsoporte3->fetch();

				/*eliminamos la foto de la aplicacion SOLO si NO es la por defecto de la aplicacion*/			
				if($gainax['foto'] != "por_defecto.jpg")
				{
					unlink('public/images/fotos/' . $gainax['foto']);
				}

				/*aqui eliminamos los demas datos del registro*/	
				$sqlconsulta = "delete from usuarios where usuario_id = ?";
				$PDOsoporte = $this->conexionPDO->prepare($sqlconsulta);
			
				$la_id_usuario = Configuracion::guerreras_magicas($usuario_id);
				
				/*y aqui eliminamos las noticias asociadas con el usuario a eliminar*/
				$sqlconsulta2 = "delete from noticias where usuario_id = ?";
				$PDOsoporte2 = $this->conexionPDO->prepare($sqlconsulta2);
				
				$la_id_usuario2 = $la_id_usuario;

				/*COMO NO LE HIZO EL BINDVALUE ENTONCES SE LE PASA COMO ARRAY => array($la_id_usuario)*/
				if($PDOsoporte->execute(array($la_id_usuario)) and $PDOsoporte2->execute(array($la_id_usuario2)))
				{
					$this->conexionPDO=null;
					header("Location: " . Configuracion::ruta() . "?controlador=ver_usuarios&msj=1");
				}
				else
				{
					$this->conexionPDO=null;
					header("Location: " . Configuracion::ruta() . "?controlador=ver_usuarios&msj=2");
				}					
			
			}
			else
			{
			$this->conexionPDO=null;
			header("Location: " . Configuracion::ruta() . "?controlador=ver_usuarios&msj=2");		
			}	
		}
		else
		{
			header("Location: " . Configuracion::ruta() . "?controlador=ver_usuarios&msj=2");
		}	
	}

	public function valida_ajax()/*se q estoy cerca pero esta validacion en ajax aun no funciona*/
	{
			self::set_names_UTF8();	
			
			$sqlconsulta2 = "select count(*) email from usuarios where email = ?";	
			$PDOsoporte2 = $this->conexionPDO->prepare($sqlconsulta2);
			$elemail2 = Configuracion::guerreras_magicas($_GET["el_valor"]);
			$PDOsoporte2->bindValue(1,$elemail2,PDO::PARAM_STR);
			$PDOsoporte2->execute();
				
			if($PDOsoporte2->fetchColumn() == 0)
			{
				
				$this->conexionPDO=null;
				/*return true;*/
				$this->estado = "disponible";
				return $this->estado;
			}
			else
			{
				
				$this->conexionPDO=null;
				/*return false;*/
				$this->estado = "ocupado";
				return $this->estado;
			}	
	}

	public function login()
	{
	
			/*VALIDAMOS QUE NO HAYAN CAMPOS SIN LLENAR O MAL LLENADOS*/
			if(empty($_POST["email"]) or empty($_POST["password"]))
			{
				header("Location: " . Configuracion::ruta() . "?controlador=login&msj=1");
				exit;
			}
				
				self::set_names_UTF8();		
	
				/*verificamos si los datos del usuario estan en la DB*/
				$sqlconsulta2 = "select * from usuarios where email = ? and passwordjsphp = ? and estado = 'activado'";	
				$PDOsoporte2 = $this->conexionPDO->prepare($sqlconsulta2);
	
				$elemail = Configuracion::guerreras_magicas($_POST["email"]);
				$elpassword = md5(Configuracion::guerreras_magicas($_POST["password"]));
	
	
				$PDOsoporte2->bindValue(1,$elemail,PDO::PARAM_STR);
				$PDOsoporte2->bindValue(2,$elpassword,PDO::PARAM_STR);
	
				$PDOsoporte2->execute();
	
				if($autenticado = $PDOsoporte2->fetch())
				{	
					
					/*print_r($this->autenticado); exit;*/
	
					$_SESSION['usuario_id'] = $autenticado['usuario_id'];
					$_SESSION['nombres'] = $autenticado['nombres'];
					$_SESSION['apellidos'] = $autenticado['apellidos'];
					$_SESSION['email'] = $autenticado['email'];
					$_SESSION['foto'] = $autenticado['foto'];
					$_SESSION['usuario_level'] = $autenticado['usuario_level'];
					$_SESSION['estado'] = $autenticado['estado'];
					
					header("Location: " . Configuracion::ruta() . "?controlador=ver_noticias");
					exit;
					
		
				}
				else
				{
					header("Location: " . Configuracion::ruta() . "?controlador=login&msj=2");
					exit;
				}
	}
	
	public function logout()
	{
			session_destroy();
			/*echo "destruido";*/
			header("Location: " . Configuracion::ruta()."?controlador=ver_noticias");
			exit;
	}
	
	public function olvido_contrasena()
	{
		if(empty($_POST["email"]) or Configuracion::valida_correo($_POST["email"])==false)
		{
			header("Location: " . Configuracion::ruta() . "?controlador=olvido_contrasena&msj=3");
			exit;
		}
			self::set_names_UTF8();			
		
			/*verificamos si los datos del usuario estan en la DB*/
			$sqlconsulta = "select * from usuarios where email = ?";	
			$PDOsoporte = $this->conexionPDO->prepare($sqlconsulta);
	
			$elemail = Configuracion::guerreras_magicas($_POST["email"]);
			
			/*COMO NO LE HIZO EL BINDVALUE ENTONCES SE LE PASA COMO ARRAY => array($la_id_usuario)
			if($PDOsoporte->execute(array($elemail)))
			{
				$autenticado = $PDOsoporte->fetch();*/
				
			$PDOsoporte->execute(array($elemail));
			$autenticado = $PDOsoporte->fetch();
				
			if(!empty($autenticado))
			{
				

				/*print_r($autenticado); exit;*/
				
				$elnombre = $autenticado["nombres"] . " - " . $autenticado["apellidos"];
				$elidusuario = $autenticado["usuario_id"];
				$elemail = $autenticado["email"]; 
				
				/*echo $elnombre . " - " . $elidusuario . " - " . $elemail; exit;*/
				
		/*si la insercion a la DB del nuevo usuario es exitosa, entonces le mandamos un correo a su email...*/	
					
						$fecha=date("d-m-Y");
						$hora=date("H:m:s");
						$correo=$elemail;
						$remitente="Remitente <noreply@saetaweb.com>";
						$asunto="Restauracion de contrasena en saetaweb.com";
						$cuerpo="
						<div align='left'>
						Estimado (a) $elnombre 
						<br>
						<br>
						Por favor haga clic en el siguiente link para reestablecer tu contrasena:
						<br>
						<br>
<a href='http://www.apps.saetaweb.com/charlotte_blog/?controlador=restablecer_contrasena&tokem=".base64_encode($id_usuario)."&f=$fecha&h=$hora'>
http://www.apps.saetaweb.com/charlotte_blog/?controlador=restablecer_contrasena&tokem=".base64_encode($id_usuario)."&f=$fecha&h=$hora
						</a>
						<br>
						<br>
						Si lo prefiere tome el link y péguelo en la barra de direcciones de su navegador favorito
						<br>
						<br>
						Atentamente, equipo de: apps.saetaweb.com
						</div>
						";
						$sheader="From:".$remitente."\nReply-To:".$remitente."\n";
						$sheader=$sheader."X-Mailer:PHP/".phpversion()."\n";
						$sheader=$sheader."Mime-Version: 1.0\n";
						$sheader=$sheader."Content-Type: text/html";
						
						mail($correo,$asunto,$cuerpo,$sheader);		
					
		/*fin de la gestion del email*/
		
								
				$this->conexionPDO=null;
				header("Location: " . Configuracion::ruta() . "?controlador=olvido_contrasena&msj=2");					
			}

			else
			{
				header("Location: " . Configuracion::ruta() . "?controlador=olvido_contrasena&msj=1");
				exit;
			}			
	}


	public function restablecer_contrasena()
	{
		if(empty($_POST["password"]) or empty($_POST["password2"]))
		{
			header("Location: " . Configuracion::ruta() . "?controlador=restablecer_contrasena&msj=1");
			exit;
		}	
			self::set_names_UTF8();	
			
			/*verificamos si los datos del usuario estan en la DB*/
			$sqlconsulta = "select usuario_id from usuarios where usuario_id = ?";	
			$PDOsoporte = $this->conexionPDO->prepare($sqlconsulta);
	
			$elusuarioid = Configuracion::guerreras_magicas(base64_decode($_POST["tokem"]));
			
			
			$PDOsoporte->execute(array($elusuarioid));
			$autenticado = $PDOsoporte->fetch();
				
			if(!empty($autenticado))
			{	
				$sqlconsulta2 = "
				
					update usuarios set  
					passwordjs = ?, 
					passwordjsphp = ?
					where usuario_id = ?
					
					";	
			
				$PDOsoporte2 = $this->conexionPDO->prepare($sqlconsulta2);
				
				/*filtramos con guerreras magicas() para evitar ataques xsl*/
				$elpassword = Configuracion::guerreras_magicas($_POST["password"]);
				$elpassword2 = md5(Configuracion::guerreras_magicas($_POST["password"]));
				
				$PDOsoporte2->bindValue(1,$elpassword,PDO::PARAM_STR);
				$PDOsoporte2->bindValue(2,$elpassword2,PDO::PARAM_STR);
				$PDOsoporte2->bindValue(3,$elusuarioid,PDO::PARAM_INT);
				
				if($PDOsoporte2->execute())
				{
					$this->conexionPDO=null;
					header("Location: " . Configuracion::ruta() . "?controlador=login&msj=3");	
				}
				else
				{
					$this->conexionPDO=null;
					header("Location: " . Configuracion::ruta() . "?controlador=restablecer_contrasena&msj=2");			
				}					
			}
			else
			{
				header("Location: " . Configuracion::ruta() . "?controlador=restablecer_contrasena&msj=1");
				exit;			
			}		

	}



/* este es el fin de la clase  */
}

?>