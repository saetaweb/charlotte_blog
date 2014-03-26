<?php 
session_start();
class Configuracion
{
/*ESTE BLOQUE QUE TENEMEOS ES EL INTENTO DE HEREDAR A LAS OTRAS CLASES LA CONEXION PDO... SIII FUNCIONA!!! :)   */

	private $conexionPDO;
	private $mi_host = "localhost";
	private $mi_dbname = "portafolio_charlotte";
	private $mi_user = "elvis";
	private $mi_password = "siouxsie";
	
	public function conectarPDO()
	{
		//$this->conexionPDO = new PDO("mysql:host=localhost; dbname=portafolio_charlotte", "elvis", "siouxsie");
		
		$this->conexionPDO = new PDO("mysql:host=".$this->mi_host."; dbname=".$this->mi_dbname."", $this->mi_user, $this->mi_password);
		
		return $this->conexionPDO;
	}
/*FIN DEL BLOQUE DE CODIGO QUE HEREDA LA CONEXION PDO...*/	
	
	

	public static function ruta()
	{
		/*este metodo nos devuelve la ruta absoluta de la raiz de la aplicacion*/
		return 'http://localhost/PORTAFOLIO_charlotte/';
	}
	
    public function guerreras_magicas($valor)
	{
		// Retirar las barras
		if (get_magic_quotes_gpc()) 
		{
			$valor = stripslashes($valor);
		}
	
		// Colocar comillas si no es entero
		if (!is_numeric($valor)) 
		{
			/*ESTA LINEA ORIGINAL DEL METODO LA DESACTIVAMOS XQ AL COMBINARLA CON PDO NOS DA PROBLEMAS
			DEJANDO ENTRECOMILLADO TODOS LOS VALORES EN LA DB
			$valor = "'" . mysql_real_escape_string($valor) . "'";*/
			
			$valor = htmlspecialchars(mysql_real_escape_string(strip_tags(trim($valor))));	
			
		}
		return $valor;
	}
	
	
	public static function valida_correo($email)
	{
    	$mail_correcto = 0;
		
    	//compruebo unas cosas primeras
    	if ((strlen($email) >= 6) && (substr_count($email,"@") == 1) && (substr($email,0,1) != "@") && (substr($email,strlen($email)-1,1) != "@"))
		{
       			if ((!strstr($email,"'")) && (!strstr($email,"\"")) && (!strstr($email,"\\")) && (!strstr($email,"\$")) && (!strstr($email," "))) 
				{
						//miro si tiene caracter .
						if (substr_count($email,".")>= 1)
						{
								//obtengo la terminacion del dominio
								$term_dom = substr(strrchr($email, '.'),1);
								//compruebo que la terminaci?n del dominio sea correcta
								if (strlen($term_dom)>1 && strlen($term_dom)<5 && (!strstr($term_dom,"@")))
								{
										//compruebo que lo de antes del dominio sea correcto
										$antes_dom = substr($email,0,strlen($email) - strlen($term_dom) - 1);
										$caracter_ult = substr($antes_dom,strlen($antes_dom)-1,1);
									
										if ($caracter_ult != "@" && $caracter_ult != ".")
										{
											$mail_correcto = 1;
										}
								}
						}
       			}
    	}
		
		
		if ($mail_correcto)
		{
			return true;
		}  
		else
		{
			return false;
		}
   
	}

/*aqui termina la clase*/
}

?>