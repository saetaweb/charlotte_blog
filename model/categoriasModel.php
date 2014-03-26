<?php
class Categorias extends Configuracion
{
	private $conexionPDO;
	private $categorias;
	
	public function __construct()
	{
		/*$this->conexionPDO = new PDO("mysql:host=localhost; dbname=portafolio_charlotte", "elvis", "siouxsie");*/
		$this->conexionPDO = parent::conectarPDO();
		$this->categorias = array();
	}
	

	private function set_names_UTF8()
    {
        return $this->conexionPDO->query("SET NAMES 'utf8'");    
    }
	
	public function get_categorias()
	{
		self::set_names_UTF8();
		$sqlconsulta = "select categoria_id, nombre, categoria_imagen from categorias order by categoria_id asc";
		
		foreach($this->conexionPDO->query($sqlconsulta) as $registro)
		{
			$this->categorias[] = $registro;
		}
		
		return $this->categorias;
		
		$this->conexionPDO = null;		
	}

	public function add_categoria_admin()
	{
		/*VALIDAMOS QUE NO HAYAN CAMPOS SIN LLENAR O MAL LLENADOS*/
		if(empty($_POST["nombre"]) or empty($_FILES["cat_image"]["name"]) )
		{
			header("Location: " . Configuracion::ruta() . "?controlador=crear_categoria&msj=1");
			exit;
		}
		
		/*VERIFICAMOS QUE LA IMAGEN SEA JPG*/
		if($_FILES['cat_image']['type']=='image/jpeg')
		{
			/*verificamos primero que la categoria no este ya en la DB*/
			$sqlconsulta2 = "select count(*) from categorias where nombre = ?";	
			$PDOsoporte2 = $this->conexionPDO->prepare($sqlconsulta2);
			$elnombre = Configuracion::guerreras_magicas($_POST["nombre"]);
			$PDOsoporte2->bindValue(1,$elnombre,PDO::PARAM_STR);
			$PDOsoporte2->execute();
			
			/*si la categoria es nuevo en la DB entonces iniciamos la insercion del nvo registro*/
			if($PDOsoporte2->fetchColumn() == 0)
			{
				$lafoto = Configuracion::guerreras_magicas($_POST["nombre"]) . ".jpg";	
				
				/*subimos la foto a la aplicacion*/
				copy($_FILES["cat_image"]["tmp_name"], "public/images/categorias/" . $lafoto);
					
				self::set_names_UTF8();	
				$sqlconsulta = "insert into categorias values (null, ?, ?)";
				$PDOsoporte = $this->conexionPDO->prepare($sqlconsulta);
					
				/*filtramos con guerreras magicas() para evitar ataques xsl*/
				$elnombre = Configuracion::guerreras_magicas($_POST["nombre"]);
					
				$PDOsoporte->bindValue(1,$elnombre,PDO::PARAM_STR);
				$PDOsoporte->bindValue(2,$lafoto,PDO::PARAM_STR);

					
				if($PDOsoporte->execute())
				{
					$this->conexionPDO=null;
					header("Location: " . Configuracion::ruta() . "?controlador=crear_categoria&msj=3");	
				}
				else
				{
					$this->conexionPDO=null;
					header("Location: " . Configuracion::ruta() . "?controlador=crear_categoria&msj=2");		
				}					
			}
			else
			{
				header("Location: " . Configuracion::ruta() . "?controlador=crear_categoria&msj=4");
				exit;			
			}		
			
					
		}
		else
		{
			header("Location: " . Configuracion::ruta() . "?controlador=crear_categoria&msj=2");
			exit;		
		}
	}
	
	public function get_categoria_por_id_admin($categoria_id)
	{
		if(isset($categoria_id))
		{
			/*echo $categoria_id . "estoy en el metodo"; exit;*/
			
			self::set_names_UTF8();
			
			/*verificamos primero que la id que nos llega por GET si esta en la DB y no es trampa por GET*/
			$sqlconsulta = "select count(*) from categorias where categoria_id = ?";
			$PDOsoporte = $this->conexionPDO->prepare($sqlconsulta);
			$elidcategoria = Configuracion::guerreras_magicas($categoria_id);
        
        	$PDOsoporte->bindValue(1,$elidcategoria,PDO::PARAM_INT);
			
			if($PDOsoporte->execute())
			{
				/* echo "aqui vamos bien"; exit;*/
				
				/*si en efecto la id SI esta en la DB y no hay ninguna trampa.. */
				if($PDOsoporte->fetchColumn() > 0)
				{
						$sqlconsulta2 = "select categoria_id, nombre, categoria_imagen from categorias where categoria_id = ?";
						$PDOsoporte2 = $this->conexionPDO->prepare($sqlconsulta2);
						$el_id_categoria = Configuracion::guerreras_magicas($categoria_id);
						
						//COMO NO LE HIZO EL BINDVALUE ENTONCES SE LE PASA COMO ARRAY => array($el_id_usuario)	
						$PDOsoporte2->execute(array($el_id_categoria));
						while($registro = $PDOsoporte2->fetch())
						{
							$this->categorias[] = $registro;
						}
						return $this->categorias;
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

	public function edit_categoria_admin()
	{
		/*VALIDAMOS QUE NO HAYAN CAMPOS SIN LLENAR O MAL LLENADOS*/
		if(empty($_POST["nombre"]))
		{
			header("Location: " . Configuracion::ruta() . "?controlador=editar_categoria&msj=1");
			exit;
		}
		
		self::set_names_UTF8();
			
		/*verificamos primero que la id que nos llega por GET si esta en la DB y no es trampa por GET*/
		$sqlconsultaM = "select count(*) from categorias where usuario_id = ?";
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
		if(empty($_FILES["cat_image"]["name"]))
		{
			/*
			verificamos primero que el nombre de la categoria no este ya en la DB
			A MENOS QUE.. sea el mismo que ya tenia antes, 
			en cuyo caso el sistema debe permitir conservarlo, actualizando solo el otro valor
			*/
			
			$sqlconsulta2 = "select count(*) from categorias where nombre = ? and ? != ?";	
			$PDOsoporte2 = $this->conexionPDO->prepare($sqlconsulta2);
			$elnombre2 = Configuracion::guerreras_magicas($_POST["nombre"]);
			$elnombre3 = Configuracion::guerreras_magicas($_POST["antiguo_nombre"]);
			$PDOsoporte2->bindValue(1,$elnombre2,PDO::PARAM_STR);
			$PDOsoporte2->bindValue(2,$elnombre2,PDO::PARAM_STR);
			$PDOsoporte2->bindValue(3,$elnombre3,PDO::PARAM_STR);
			$PDOsoporte2->execute();
			
			/*si el nombre de la categoria es nuevo en la DB entonces iniciamos la actualizacion del nvo registro*/
			if($PDOsoporte2->fetchColumn() == 0)
			{
				/* ...dejamos la que estaba antes y actualizamos los demas datos */
				$lafoto=$_POST["antigua_foto"];	
				
				self::set_names_UTF8();	
				$sqlconsulta = "
				
				update categorias set 
				nombre = ?,
				categoria_imagen = ?
				where categoria_id = ?
				
				";	
				
				$PDOsoporte = $this->conexionPDO->prepare($sqlconsulta);
				
				/*filtramos con guerreras magicas() para evitar ataques xsl*/
				$elnombre = Configuracion::guerreras_magicas($_POST["nombre"]);
				$lacategoriaid = Configuracion::guerreras_magicas($_POST["categoria_id"]);
				
				$PDOsoporte->bindValue(1,$elnombre,PDO::PARAM_STR);
				$PDOsoporte->bindValue(2,$lafoto,PDO::PARAM_STR);
				$PDOsoporte->bindValue(3,$lacategoriaid,PDO::PARAM_INT);
				
				if($PDOsoporte->execute())
				{
					$this->conexionPDO=null;
					header("Location: " . Configuracion::ruta() . "?controlador=editar_categoria&msj=3&categoria_id=" . $_POST["categoria_id"]);	
				}
				else
				{
					$this->conexionPDO=null;
					header("Location: " . Configuracion::ruta() . "?controlador=editar_categoria&msj=2&categoria_id=" . $_POST["categoria_id"]);		
				}
			
			}
			else
			{
				$this->conexionPDO=null;
				header("Location: " . Configuracion::ruta() . "?controlador=editar_categoria&msj=4&categoria_id=" . $_POST["categoria_id"]);	
			}			
			
		}
		/*si se actualiza la foto entonces la actualiza en la DB*/
		else
		{
			/*verificamos que la imagen sea formato jpg*/
			if($_FILES['cat_image']['type']=='image/jpeg')
			{	
		
				/*
				verificamos primero que el nombre de la categoria no este ya en la DB
				A MENOS QUE.. sea el mismo que ya tenia antes, 
				en cuyo caso el sistema debe permitir conservarlo, actualizando solo el otro valor
				*/
				
				$sqlconsulta2 = "select count(*) from categorias where nombre = ? and ? != ?";	
				$PDOsoporte2 = $this->conexionPDO->prepare($sqlconsulta2);
				$elnombre2 = Configuracion::guerreras_magicas($_POST["nombre"]);
				$elnombre3 = Configuracion::guerreras_magicas($_POST["antiguo_nombre"]);
				$PDOsoporte2->bindValue(1,$elnombre2,PDO::PARAM_STR);
				$PDOsoporte2->bindValue(2,$elnombre2,PDO::PARAM_STR);
				$PDOsoporte2->bindValue(3,$elnombre3,PDO::PARAM_STR);
				$PDOsoporte2->execute();
				
				
				
				/*si el email es nuevo en la DB entonces iniciamos la actualizacion del nvo registro*/
				if($PDOsoporte2->fetchColumn() == 0)
				{				
					
					/*eliminamos la vieja foto de la aplicacion*/
					$vieja_foto = Configuracion::guerreras_magicas($_POST["antigua_foto"]);			
					unlink('public/images/categorias/' . $vieja_foto);

					/*preparamos el nombre que va a tener la foto*/
					$lafoto = Configuracion::guerreras_magicas($_POST["nombre"]) . ".jpg";	
					
					/*subimos la foto a la aplicacion*/
					copy($_FILES["cat_image"]["tmp_name"], "public/images/categorias/" . $lafoto);
					
					self::set_names_UTF8();	
					
					$sqlconsulta = "
					
					update categorias set 
					nombre = ?,
					categoria_imagen = ?
					where categoria_id = ?
					
					";
					
					$PDOsoporte = $this->conexionPDO->prepare($sqlconsulta);
					
					/*filtramos con guerreras magicas() para evitar ataques xsl*/
					$elnombre = Configuracion::guerreras_magicas($_POST["nombre"]);
					$lacategoriaid = Configuracion::guerreras_magicas($_POST["categoria_id"]);
					
					$PDOsoporte->bindValue(1,$elnombre,PDO::PARAM_STR);
					$PDOsoporte->bindValue(2,$lafoto,PDO::PARAM_STR);
					$PDOsoporte->bindValue(3,$lacategoriaid,PDO::PARAM_INT);
					
					if($PDOsoporte->execute())
					{
						$this->conexionPDO=null;
						header("Location: " . Configuracion::ruta() . "?controlador=editar_categoria&msj=3&categoria_id=" . $_POST["categoria_id"]);	
					}
					else
					{
						$this->conexionPDO=null;
						header("Location: " . Configuracion::ruta() . "?controlador=editar_categoria&msj=2&categoria_id=" . $_POST["categoria_id"]);		
					}
									
				}
				else
				{
					$this->conexionPDO=null;
					/*echo "EMAIL SI ENCONTRADO"; exit;*/
					header("Location: " . Configuracion::ruta() . "?controlador=editar_categoria&msj=4&categoria_id=" . $_POST["categoria_id"]);
				}
			}
			else
			{
				header("Location: " . Configuracion::ruta() . "?controlador=editar_categoria&msj=2&categoria_id=" . $_POST["categoria_id"]);
			}
		}
				
	}
	
	public function cuenta_dependientes_categoria_noticias($categoria_id)
	{
		if(isset($categoria_id))
		{
			self::set_names_UTF8();	
			
			/*verificamos que la id traida por get SI exista en la DB.  ANTI TRAMPA GET*/
			$sqlconsulta = "select count(*) nombre from categorias where categoria_id = ?";
			$PDOsoporte = $this->conexionPDO->prepare($sqlconsulta);
			
			$lacategoriaid = Configuracion::guerreras_magicas($categoria_id);
			
			$PDOsoporte->bindValue(1,$lacategoriaid,PDO::PARAM_INT);
			$PDOsoporte->execute();			

			/*si la verificacion es exitosa, entonces la id si existe en la DB...*/
			if($PDOsoporte->fetchColumn() > 0)
			{
				$sqlconsulta2 = "select count(*) as contados from noticias where categoria_id = ?";
				$PDOsoporte2 = $this->conexionPDO->prepare($sqlconsulta2);
				$la_id_categoria = $lacategoriaid;
			
				/*COMO NO LE HIZO EL BINDVALUE ENTONCES SE LE PASA COMO ARRAY => array($la_id_usuario)*/
				if($PDOsoporte2->execute(array($la_id_categoria)))
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
	

	public function delete_categoria_admin($categoria_id)
	{
		if(isset($categoria_id))
		{
			self::set_names_UTF8();		

			/*verificamos que la id traida por get SI exista en la DB.  ANTI TRAMPA GET*/
			$sqlconsulta2 = "select count(*) nombre from categorias where categoria_id = ?";
			$PDOsoporte2 = $this->conexionPDO->prepare($sqlconsulta2);
			$lacategoriaid = Configuracion::guerreras_magicas($categoria_id);
			$PDOsoporte2->bindValue(1,$lacategoriaid,PDO::PARAM_INT);
			$PDOsoporte2->execute();
				
			/*si la verificacion es exitosa, y hay al menos un resultado...*/
			if($PDOsoporte2->fetchColumn() > 0)
			{
				/*basandonos en la id del usuario obtenemos el nombre de su foto asociada*/
				$sqlconsulta3 = "select categoria_imagen from categorias where categoria_id = ?";
				$PDOsoporte3 = $this->conexionPDO->prepare($sqlconsulta3);
				$elusuarioid2 = Configuracion::guerreras_magicas($categoria_id);
				$PDOsoporte3->bindValue(1,$elusuarioid2,PDO::PARAM_INT);
				$PDOsoporte3->execute();
				
				/*transformamos el objeto de clase PDO en un array asociativo*/
				$gainax = $PDOsoporte3->fetch();
				
				/*print_r($gainax); exit;*/

				/*eliminamos la foto de la categoria de la aplicacion */			
				unlink('public/images/categorias/' . $gainax['categoria_imagen']);

				/*aqui eliminamos los demas datos de la categoria*/	
				$sqlconsulta = "delete from categorias where categoria_id = ?";
				$PDOsoporte = $this->conexionPDO->prepare($sqlconsulta);
			
				$la_id_categoria = Configuracion::guerreras_magicas($categoria_id);

				/*y aqui eliminamos las noticias asociadas con la categoria a eliminar*/
				$sqlconsulta2 = "delete from noticias where categoria_id = ?";
				$PDOsoporte2 = $this->conexionPDO->prepare($sqlconsulta2);
				
				$la_id_categoria2 = $la_id_categoria;
		

				if($PDOsoporte->execute(array($la_id_categoria)) and $PDOsoporte2->execute(array($la_id_categoria2)))
				{
					$this->conexionPDO=null;
					header("Location: " . Configuracion::ruta() . "?controlador=ver_categorias&msj=1");
				}
				else
				{
					$this->conexionPDO=null;
					header("Location: " . Configuracion::ruta() . "?controlador=ver_categorias&msj=2");
				}					
			
			}
			else
			{
			$this->conexionPDO=null;
			header("Location: " . Configuracion::ruta() . "?controlador=ver_categorias&msj=2");		
			}	
		}
		else
		{
			header("Location: " . Configuracion::ruta() . "?controlador=ver_categorias&msj=2");
		}	
	}
	

/* este es el fin de la clase  */
}

?>