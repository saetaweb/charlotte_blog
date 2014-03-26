<?php 
/*
sleep(2);
$con=mysql_connect("localhost","elvis","siouxsie");
$bd=mysql_select_db("portafolio_charlotte");
*/

require_once("conexion.php");
sleep(2);

$sql="select nombre from categorias where 
nombre='" . $_GET["el_valor"] . "' and '" . $_GET["el_valor"] . "' != '" . $_GET["el_valor2"] . "'";

$res=mysql_query($sql,$con);
if (mysql_num_rows($res)==0)
{
	echo "disponible";
}
else
{
	echo "ocupado";
}

?>