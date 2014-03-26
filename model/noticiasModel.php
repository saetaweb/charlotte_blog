<?php
class Noticias extends Configuracion
{
	private $conexionPDO;
	private $noticias;
	private $total;
	
	public function __construct()
	{
		/*$this->conexionPDO = new PDO("mysql:host=localhost; dbname=portafolio_charlotte", "elvis", "siouxsie");*/
		$this->conexionPDO = parent::conectarPDO();
		$this->noticias = array();
		$this->total = array();
	}
	

	private function set_names_UTF8()
    {	
		/*parent::__construct();*/
        return $this->conexionPDO->query("SET NAMES 'utf8'");    
    }

	public function get_noticias($posicion)
	{
		/**/
		self::set_names_UTF8();
		
		/*este condicional es agregador para hacer funcionar el select dinamico 
		de las categorias de noticias que tenemos en el sidebar*/
		if(isset($_GET['categoria']))
		{
			/*verificamos que la id traida por get SI exista en la DB.  ANTI TRAMPA GET*/
			$sqlconsultaK = "select count(*) from categorias where categoria_id = ?";
			$PDOsoporteK = $this->conexionPDO->prepare($sqlconsultaK);
			$lacategoria = Configuracion::guerreras_magicas($_GET['categoria']);
			$PDOsoporteK->bindValue(1,$lacategoria,PDO::PARAM_INT);
			$PDOsoporteK->execute();
				
			/*si la verificacion es exitosa, y hay al menos un resultado...*/
			if($PDOsoporteK->fetchColumn() > 0)
			{

				$sqlconsulta = "
							
							select 
							new.id, 
							new.titulo, 
							new.contenido, 
							new.categoria_id, 
							concat_ws('-',day(publicado_fecha),month(publicado_fecha),year(publicado_fecha)) as format_publicado_fecha, 
							new.expiracion_fecha, 
							catg.categoria_id, 
							catg.nombre, 
							catg.categoria_imagen 
							from noticias as new, categorias as catg 
							where new.categoria_id = catg.categoria_id
							and catg.categoria_id = ?
							order by new.id asc
							limit $posicion, 3
							";
				
							/* esta es la version sin el formateo de fecha MySQL => concat_ws()
							$sqlconsulta = "
							
							select 
							new.id, 
							new.titulo, 
							new.contenido, 
							new.categoria_id, 
							new.publicado_fecha, 
							new.expiracion_fecha, 
							catg.categoria_id, 
							catg.nombre, 
							catg.categoria_imagen 
							from noticias as new, categorias as catg 
							where new.categoria_id = catg.categoria_id
							and catg.categoria_id = ?
							order by new.id asc
							limit $posicion, 3
							";
							*/
							
							$PDOsoporte = $this->conexionPDO->prepare($sqlconsulta);
							
							$la_id_categoria = Configuracion::guerreras_magicas($_GET['categoria']);
						
							/*COMO NO LE HIZO EL BINDVALUE ENTONCES SE LE PASA COMO ARRAY => array($la_id_usuario)*/
							if($PDOsoporte->execute(array($la_id_categoria)))
							{	
								while($registro = $PDOsoporte->fetch())
								{
									$this->noticias[]=$registro;
								}
								
								return $this->noticias;
								
								$this->conexionPDO = null;			
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
		
			$sqlconsulta = "
			
			select 
			new.id, 
			new.titulo, 
			new.contenido, 
			new.categoria_id, 
			concat_ws('-',day(publicado_fecha),month(publicado_fecha),year(publicado_fecha)) as format_publicado_fecha, 
			new.expiracion_fecha, 
			catg.categoria_id, 
			catg.nombre, 
			catg.categoria_imagen 
			from noticias as new, categorias as catg 
			where new.categoria_id = catg.categoria_id 
			order by new.id asc
			limit $posicion, 3
			
			";		
		
			/* esta es la version sin el formateo de fecha MySQL => concat_ws()
			$sqlconsulta = "
			
			select 
			new.id, 
			new.titulo, 
			new.contenido, 
			new.categoria_id, 
			new.publicado_fecha, 
			new.expiracion_fecha, 
			catg.categoria_id, 
			catg.nombre, 
			catg.categoria_imagen 
			from noticias as new, categorias as catg 
			where new.categoria_id = catg.categoria_id 
			order by new.id asc
			limit $posicion, 3
			
			";
			*/
			foreach($this->conexionPDO->query($sqlconsulta) as $registro)
			{
				$this->noticias[] = $registro;
			}
			
			return $this->noticias;
			
			$this->conexionPDO = null;		
		}
	}


	public function get_noticias_por_usuario($posicion)
	{
		/**/
		self::set_names_UTF8();
		
		/*este condicional es agregador para hacer funcionar el select dinamico 
		de las categorias de noticias que tenemos en el sidebar
		
		OJO QUE ESTE IF DE ESTE CONDICIONAL NO LO ESTAMOS USANDO EN LA APLICACION,
		SOLO EL ELSE.
		POR AHORA NO VAMOS A CRUZAR NOTICIAS POR USUARIO + CATEGORIAS.
		*/
		if(isset($_GET['categoria']))
		{
		
			$sqlconsulta = "
			
			select 
			new.id, 
			new.titulo, 
			new.contenido, 
			new.categoria_id, 
			new.usuario_id,
			concat_ws('-',day(publicado_fecha),month(publicado_fecha),year(publicado_fecha)) as format_publicado_fecha, 
			new.expiracion_fecha, 
			catg.categoria_id, 
			catg.nombre, 
			catg.categoria_imagen 
			from noticias as new, categorias as catg 
			where new.categoria_id = catg.categoria_id
			and catg.categoria_id = ?
			and new.usuario_id = ?
			order by new.id asc
			limit $posicion, 3
			";
			
			/* esta es la version sin el formateo de fecha MySQL => concat_ws()
			$sqlconsulta = "
			
			select 
			new.id, 
			new.titulo, 
			new.contenido, 
			new.categoria_id, 
			new.publicado_fecha, 
			new.expiracion_fecha, 
			catg.categoria_id, 
			catg.nombre, 
			catg.categoria_imagen 
			from noticias as new, categorias as catg 
			where new.categoria_id = catg.categoria_id
			and catg.categoria_id = ?
			and new.usuario_id = ?
			order by new.id asc
			limit $posicion, 3
			";
			*/

			$PDOsoporte = $this->conexionPDO->prepare($sqlconsulta);
			
			$la_id_categoria = Configuracion::guerreras_magicas($_GET["categoria"]);
			$elusuarioid = Configuracion::guerreras_magicas($_GET["usuario_id"]);
			
			$PDOsoporte->bindValue(1,$la_id_categoria,PDO::PARAM_INT);
			$PDOsoporte->bindValue(2,$elusuarioid,PDO::PARAM_INT);
		
			/*COMO NO LE HIZO EL BINDVALUE ENTONCES SE LE PASA COMO ARRAY => array($la_id_usuario)*/
			if($PDOsoporte->execute())
			{	
				while($registro = $PDOsoporte->fetch())
                {
                    $this->noticias[]=$registro;
                }
				
				return $this->noticias;
				
				$this->conexionPDO = null;			
			}
		}
		else
		{

			/*verificamos que la id traida por get SI exista en la DB.  ANTI TRAMPA GET*/
			$sqlconsultaK = "select count(*) from usuarios where usuario_id = ?";
			$PDOsoporteK = $this->conexionPDO->prepare($sqlconsultaK);
			$elusuarioid = Configuracion::guerreras_magicas($_GET['usuario_id']);
			$PDOsoporteK->bindValue(1,$elusuarioid,PDO::PARAM_INT);
			$PDOsoporteK->execute();
				
			/*si la verificacion es exitosa, y hay al menos un resultado...*/
			if($PDOsoporteK->fetchColumn() > 0)
			{

				$sqlconsulta = "
			
				select 
				new.id, 
				new.titulo, 
				new.contenido, 
				new.categoria_id, 
				concat_ws('-',day(publicado_fecha),month(publicado_fecha),year(publicado_fecha)) as format_publicado_fecha, 
				new.expiracion_fecha, 
				catg.categoria_id, 
				catg.nombre, 
				catg.categoria_imagen 
				from noticias as new, categorias as catg 
				where new.categoria_id = catg.categoria_id 
				and new.usuario_id = ?
				order by new.id asc
				limit $posicion, 3
				
				";		
			
				/*
				$sqlconsulta = "
				
				select 
				new.id, 
				new.titulo, 
				new.contenido, 
				new.categoria_id, 
				new.publicado_fecha, 
				new.expiracion_fecha, 
				catg.categoria_id, 
				catg.nombre, 
				catg.categoria_imagen 
				from noticias as new, categorias as catg 
				where new.categoria_id = catg.categoria_id 
				and new.usuario_id = ?
				order by new.id asc
				limit $posicion, 3
				
				";	
				*/
				
				$PDOsoporte = $this->conexionPDO->prepare($sqlconsulta);
				
				$elusuarioid = Configuracion::guerreras_magicas($_GET['usuario_id']);
			
				/*COMO NO LE HIZO EL BINDVALUE ENTONCES SE LE PASA COMO ARRAY => array($la_id_usuario)*/
				if($PDOsoporte->execute(array($elusuarioid)))
				{	
					while($registro = $PDOsoporte->fetch())
					{
						$this->noticias[]=$registro;
					}
					
					return $this->noticias;
					
					$this->conexionPDO = null;			
				}

			}
			else
			{
				$this->conexionPDO=null;
				header("Location: " . Configuracion::ruta() . "?controlador=error");		
			}


								
		}
	}

/*
	public function cuenta_noticias()
	{
		self::set_names_UTF8();
		$sqlconsulta = "select count(*) as contados from noticias";
		
		foreach($this->conexionPDO->query($sqlconsulta) as $registro)
		{
			$this->total[] = $registro;
		}
		
		return $this->total;
		
		$this->conexionPDO = null;
	}
*/

	public function cuenta_noticias()
	{
		self::set_names_UTF8();
	
		/*este condicional es agregador para hacer funcionar el select dinamico 
		de las categorias de noticias que tenemos en el sidebar*/
		if(isset($_GET['categoria']))
		{
			$sqlconsulta = "select count(*) as contados from noticias where categoria_id = ?";

			$PDOsoporte = $this->conexionPDO->prepare($sqlconsulta);
			
			$la_id_categoria = Configuracion::guerreras_magicas($_GET['categoria']);
		
			/*COMO NO LE HIZO EL BINDVALUE ENTONCES SE LE PASA COMO ARRAY => array($la_id_usuario)*/
			if($PDOsoporte->execute(array($la_id_categoria)))
			{	
				while($registro = $PDOsoporte->fetch())
                {
                    $this->total[]=$registro;
                }
				
				return $this->total;
				
				$this->conexionPDO = null;			
			}					
		}
		else
		{
			
			$sqlconsulta = "select count(*) as contados from noticias";
			
			foreach($this->conexionPDO->query($sqlconsulta) as $registro)
			{
				$this->total[] = $registro;
			}
			
			return $this->total;
			
			$this->conexionPDO = null;
		
		}
	}


	public function cuenta_noticias_por_usuario()
	{	
		/*verificamos que la id traida por get SI exista en la DB.  ANTI TRAMPA GET*/
			$sqlconsultaK = "select count(*) from usuarios where usuario_id = ?";
			$PDOsoporteK = $this->conexionPDO->prepare($sqlconsultaK);
			$elusuarioid = Configuracion::guerreras_magicas($_GET['usuario_id']);
			$PDOsoporteK->bindValue(1,$elusuarioid,PDO::PARAM_INT);
			$PDOsoporteK->execute();
				
			/*si la verificacion es exitosa, y hay al menos un resultado...*/
			if($PDOsoporteK->fetchColumn() > 0)
			{

				self::set_names_UTF8();
				
				$sqlconsulta = "select count(*) as contados from noticias where usuario_id = ?";
				$PDOsoporte = $this->conexionPDO->prepare($sqlconsulta);
				$elusuarioid = Configuracion::guerreras_magicas($_GET['usuario_id']);
						
				/*COMO NO LE HIZO EL BINDVALUE ENTONCES SE LE PASA COMO ARRAY => array($la_id_usuario)*/
				if($PDOsoporte->execute(array($elusuarioid)))
				{	
					while($registro = $PDOsoporte->fetch())
					{
						$this->total[]=$registro;
					}
								
					return $this->total;
								
					$this->conexionPDO = null;			
				}

			}
			else
			{
				$this->conexionPDO=null;
				header("Location: " . Configuracion::ruta() . "?controlador=error");		
			}					
	}

	public function add_noticia()
	{
		/*comprobamos que no haya campos sin llenar */
		if(empty($_POST["titulo_noticia"]) or empty($_POST["contenido_noticia"]) or empty($_POST["categoria_noticia"]))
		{
			header("Location: " . Configuracion::ruta() . "?controlador=publicar_noticia&msj=1");
			exit;
		}
		
		
		self::set_names_UTF8();	
		
		/*OJO QUE EN EL TERECER VALOR LE DEJAMOS "1" SOLO PROVISIONALMENTE!!!*/	
		$sqlconsulta = "insert into noticias values (null,?,?,?,?,now(),now())";
		
		$PDOsoporte = $this->conexionPDO->prepare($sqlconsulta);
		
		/*filtramos con guerreras magicas() para evitar ataques xsl*/
		$eltitulo = Configuracion::guerreras_magicas($_POST["titulo_noticia"]);
		$elusuarioid = Configuracion::guerreras_magicas($_GET["usuario_id"]);
		$elcontenido = Configuracion::guerreras_magicas($_POST["contenido_noticia"]);
		$lacategoria = Configuracion::guerreras_magicas($_POST["categoria_noticia"]);
		
        $PDOsoporte->bindValue(1,$lacategoria,PDO::PARAM_INT);
		$PDOsoporte->bindValue(2,$elusuarioid,PDO::PARAM_INT);
        $PDOsoporte->bindValue(3,$eltitulo,PDO::PARAM_STR);
        $PDOsoporte->bindValue(4,$elcontenido,PDO::PARAM_STR);
		
		if($PDOsoporte->execute())
		{
			$this->conexionPDO=null;
			header("Location: " . Configuracion::ruta() . "?controlador=publicar_noticia&msj=3");	
		}
		else
		{
			$this->conexionPDO=null;
			header("Location: " . Configuracion::ruta() . "?controlador=publicar_noticia&msj=2");		
		}
	}	
/*	
	public function get_noticia_por_id($id_noticia)
	{
		if(isset($id_noticia))
		{
			self::set_names_UTF8();
			$sqlconsulta = "select categoria_id, titulo, contenido from noticias where id = ?";
			
			$PDOsoporte = $this->conexionPDO->prepare($sqlconsulta);
			
			$la_id_noticia = Configuracion::guerreras_magicas($id_noticia);
				
            if($PDOsoporte->execute(array($la_id_noticia)))
            {
                while($registro = $PDOsoporte->fetch())
                {
                    $this->noticias[] = $registro;
                }
                return $this->noticias;
                $this->conexionPDO=null;
            }
			else
			{
				$this->conexionPDO=null;
				header("Location: " . Configuracion::ruta() . "?controlador=editar_noticia&msj=2");
			}	
		}
		else
		{
			header("Location: " . Configuracion::ruta() . "?controlador=editar_noticia&msj=2");
		}
	}
*/	
/**/	
	public function get_noticia_por_id($id_noticia, $id_usuario)
	{
		if(isset($id_noticia))
		{
			self::set_names_UTF8();
			
			/*blindado anti trampa get*/
			$sqlconsulta = "select count(*) from noticias where id = ?";
			
			$PDOsoporte = $this->conexionPDO->prepare($sqlconsulta);
			$laidnoticia = Configuracion::guerreras_magicas($id_noticia);
        
        	$PDOsoporte->bindValue(1,$laidnoticia,PDO::PARAM_INT);
			
			if($PDOsoporte->execute())
			{
				if($PDOsoporte->fetchColumn() > 0)
				{
						//$sqlconsulta2 = "select categoria_id, titulo, contenido from noticias where id = ? and usuario_id = ?";
						$sqlconsulta2 = "select count(*) from noticias where id = ? and usuario_id = ?";
						$PDOsoporte2 = $this->conexionPDO->prepare($sqlconsulta2);
						$la_id_noticia = Configuracion::guerreras_magicas($id_noticia);
						$el_usuario_id = Configuracion::guerreras_magicas($id_usuario);
						
						$PDOsoporte2->bindValue(1,$la_id_noticia,PDO::PARAM_INT);
						$PDOsoporte2->bindValue(2,$el_usuario_id,PDO::PARAM_INT);
						
						$PDOsoporte2->execute();
						
						if($PDOsoporte2->fetchColumn() > 0)
						{
							
							$sqlconsulta3 = "select categoria_id, titulo, contenido from noticias where id = ? and usuario_id = ?";
							$PDOsoporte3 = $this->conexionPDO->prepare($sqlconsulta3);
							
							$PDOsoporte3->bindValue(1,$la_id_noticia,PDO::PARAM_INT);
							$PDOsoporte3->bindValue(2,$el_usuario_id,PDO::PARAM_INT);
						
							$PDOsoporte3->execute();						

							while($registro = $PDOsoporte3->fetch())
							{
								$this->noticias[] = $registro;
							}
							return $this->noticias;
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
				$this->conexionPDO=null;
				header("Location: " . Configuracion::ruta() . "?controlador=error");
			}
		}
		else
		{
			header("Location: " . Configuracion::ruta() . "?controlador=error");
		}
	}
	
	public function edit_noticia()
	{
		/*comprobamos que no haya campos sin llenar */
		if(empty($_POST["titulo_noticia"]) or empty($_POST["contenido_noticia"]) or $_POST["categoria_noticia"] == 0)
		{
			header("Location: " . Configuracion::ruta() . "?controlador=editar_noticia&msj=1");
			exit;
		}
		
		/*print_r($_POST); exit;*/
		self::set_names_UTF8();	
		
		/*verificamos que la id traida por get SI exista en la DB.  ANTI TRAMPA GET*/
		$sqlconsultaK = "select count(*) from noticias where id = ? and usuario_id = ?";
		$PDOsoporteK = $this->conexionPDO->prepare($sqlconsultaK);
		$lanoticiaid = Configuracion::guerreras_magicas($_POST["id_noticia"]);
		/*$elusuarioid = $_POST["usuario_id"];*/
		$elusuarioid = $_SESSION["usuario_id"];
		$PDOsoporteK->bindValue(1,$lanoticiaid,PDO::PARAM_INT);
		$PDOsoporteK->bindValue(2,$elusuarioid,PDO::PARAM_INT);
		$PDOsoporteK->execute();
				
		/*si la verificacion es exitosa, y hay al menos un resultado...*/
		if($PDOsoporteK->fetchColumn() > 0)
		{

			/*echo "hasta aqui vamos bien 01"; exit;*/
			
			/*OJO QUE EN EL TERCER VALOR LE DEJAMOS "1" SOLO PROVISIONALMENTE!!!*/	
					$sqlconsulta = "
					
					update noticias set 
					titulo = ?, 
					contenido = ?, 
					categoria_id = ?,
					publicado_fecha = now(), 
					expiracion_fecha = now() 
					where id = ? 
					
					";
					
					
					$PDOsoporte = $this->conexionPDO->prepare($sqlconsulta);
					
					/*filtramos con guerreras magicas() para evitar ataques xsl*/
					$eltitulo = Configuracion::guerreras_magicas($_POST["titulo_noticia"]);
					$elcontenido = Configuracion::guerreras_magicas($_POST["contenido_noticia"]);
					$lacategoria = Configuracion::guerreras_magicas($_POST["categoria_noticia"]);
					$laidnoticia = $lanoticiaid;
					
					
					$PDOsoporte->bindValue(1,$eltitulo,PDO::PARAM_STR);
					$PDOsoporte->bindValue(2,$elcontenido,PDO::PARAM_STR);
					$PDOsoporte->bindValue(3,$lacategoria,PDO::PARAM_INT);
					$PDOsoporte->bindValue(4,$laidnoticia,PDO::PARAM_INT);
					
					if($PDOsoporte->execute())
					{
						
						/*echo "hasta aqui vamos bien 02"; exit;*/
						
						/*print_r($_SESSION); exit;*/
						
						$this->conexionPDO=null;
						header("Location: " . Configuracion::ruta() . "?controlador=editar_noticia&msj=3&id_noticia=" . $_POST["id_noticia"] . "&usuario_id=" . $_POST["usuario_id"]);	
					}
					else
					{
						$this->conexionPDO=null;
						header("Location: " . Configuracion::ruta() . "?controlador=editar_noticia&msj=2&id_noticia=" . $_POST["id_noticia"]);	
					}

		}
		else
		{
			$this->conexionPDO=null;
			header("Location: " . Configuracion::ruta() . "?controlador=error");		
		}		
		
		
		
		
		
		
	}
	

	public function delete_noticia($id_noticia, $usuario_id)
	{
		if(isset($id_noticia) and isset($usuario_id))
		{
			self::set_names_UTF8();

			/*blindado anti trampa get*/
			$sqlconsulta = "select count(*) from noticias where id = ? and usuario_id = ?";
			
			$PDOsoporte = $this->conexionPDO->prepare($sqlconsulta);
			$laidnoticia = Configuracion::guerreras_magicas($id_noticia);
			$elidusuario = Configuracion::guerreras_magicas($usuario_id);
        
        	$PDOsoporte->bindValue(1,$laidnoticia,PDO::PARAM_INT);
			$PDOsoporte->bindValue(2,$elidusuario,PDO::PARAM_INT);
			
			$PDOsoporte->execute();
			
			if($PDOsoporte->fetchColumn() > 0)
			{
				$sqlconsulta2 = "delete from noticias where id = ?";
				
				$PDOsoporte2 = $this->conexionPDO->prepare($sqlconsulta2);
				
				$la_id_noticia = Configuracion::guerreras_magicas($id_noticia);
		
				/*COMO NO LE HIZO EL BINDVALUE ENTONCES SE LE PASA COMO ARRAY => array($la_id_noticia)*/
				if($PDOsoporte2->execute(array($la_id_noticia)))
				{
					$this->conexionPDO=null;
					header("Location: " . Configuracion::ruta() . "?controlador=ver_noticias&msj=1");
				}
				else
				{
					$this->conexionPDO=null;
					header("Location: " . Configuracion::ruta() . "?controlador=ver_noticias&msj=2");
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
			header("Location: " . Configuracion::ruta() . "?controlador=ver_noticias&msj=2");
		}
	}
	
	
	public function buscar($posicion, $keyword)
	{
		if(isset($posicion) and isset($keyword))
		{
			$lakeyword = self::guerreras_magicas($keyword);
			
			self::set_names_UTF8();

			/*OJO!!! EN ESTA CONSULTA LA EXPRESION '%?%' NO ME FUNCIONA, SUPONGO QUE NO ES VALIDA, POR ESO
			USAMOS DIRECTAMENTE LA VARIABLE PARA QUE NOS FUNCIONE EL BUSCADOR
			$sqlconsulta = "select * from noticias where titulo like '%?%' or contenido like '%?%' limit $posicion, 3";
			*/
			
			/**/
			$sqlconsulta = "
			select * from noticias where contenido 
			like '%" . $lakeyword . "%' or contenido like '%" . $lakeyword . "%'  limit $posicion, 3";
			
			
			/*
			BUENO AQUI HICIMOS UN INTENTO DE MOSTRAR EN LOS RESULTADOS DE BUSQUEDA TAMBIEN LA IMAGEN Y EL NOMBRE DE LA CATEGORIA DE CADA NOTICIA, PERO NOS DA ERROR, SE REPITE CADA REGISTRO ENCONTRADO POR CADA UNA DE LAS CATEGORIAS QUE EXISTEN EN LA DB, EL ERROR EN LA CONSULTA TIENE QUE VER CON LAS CATEGORIAS... NOS QUEDA PENDIENTE.
			
			$sqlconsulta = "

						select 
						new.id, 
						new.titulo, 
						new.contenido, 
						new.categoria_id, 
						new.publicado_fecha, 
						new.expiracion_fecha, 
						catg.categoria_id, 
						catg.nombre, 
						catg.categoria_imagen 
						from noticias as new, categorias as catg 
						where new.categoria_id = catg.categoria_id
						and contenido like '%" . $lakeyword . "%' or contenido like '%" . $lakeyword . "%' 
						//order by new.id asc limit $posicion, 3
			";*/
			
			

			
			
			
			
			
			$PDOsoporte = $this->conexionPDO->prepare($sqlconsulta);			
        
			/*COMO NO USAMOS COMODINES NO USAMOS BIND PARAM*/
			if($PDOsoporte->execute())
			{
				while($registro = $PDOsoporte->fetch())
                {
                    $this->noticias[]=$registro;
                }
				return $this->noticias;
				$this->conexionPDO = null;		
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
	
	
	public function buscar_cuenta_noticias($keyword)
	{
		self::set_names_UTF8();
		
		$lakeyword = Configuracion::guerreras_magicas($keyword);
		
		$sqlconsulta = "
			
		select count(*) as contados from noticias
		where
		titulo like '%" . $lakeyword . "%' 
		or
		contenido like '%" . $lakeyword . "%'			
			
		";
	
		$PDOsoporte = $this->conexionPDO->prepare($sqlconsulta);
		
		if($PDOsoporte->execute())
		{	
			while($registro = $PDOsoporte->fetch())
            {
                $this->total[]=$registro;
            }
				
			return $this->total;
			$this->conexionPDO = null;			
		}				
			
	}	
	
	

/* este es el fin de la clase */
}

?>