<?
//CONEXION BASE DE DATOS
$server = 'localhost';
$usuario = 'root';
$clave = '';
$sql = 'ninjacodetv';
$r = mysql_connect($server, $usuario, $clave);
if(!$r)
{
	die( mysql_error() );
}
mysql_select_db($sql,$r);
?>