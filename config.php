<?
session_start();
include 'conexion.php';

	$UserName = htmlspecialchars($_POST['username']);
	if (!empty($UserName)) {
	$query= mysql_query("SELECT UserName FROM usuarios WHERE UserName = '$UserName'");
	if (mysql_num_rows($query)==0)
	{
		mysql_query("INSERT INTO usuarios (UserName) VALUES ('$UserName')");
	}
	$_SESSION['USERNAME'] = $UserName;
}
	header('Location: index.php');


?>