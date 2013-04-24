<?
session_start();
require 'lib/Pusher.php';
$user= htmlspecialchars($_POST['username']);
$userconnect = htmlspecialchars($_SESSION['USERNAME']);
$mensaje = htmlspecialchars($_POST['msj']);

$pusher = PusherInstance::get_pusher();

$pusher->trigger(
    'canal_prueba',
    'nuevo_'.$user,
    array('mensaje' => $mensaje,'userconnect' => $userconnect)
);
$final=array('mensaje' => $mensaje,'userconnect' => $userconnect);
echo json_encode($final);

?>