<?@session_start();
//usuarios almacenados en un array
$UserName=array(); 
$UserName[0] = 'Demo1';
$UserName[1] = 'Demo2';
$UserName[2] = 'Demo3';
$UserName[3] = 'Demo4';
$UserName[4] = 'Demo5';
?><!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Mensajeria</title>
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="author" href="humans.txt">
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
		<script src="http://js.pusher.com/1.12/pusher.min.js"></script>
		<script>
			$(document).ready(function(){
			  var pusher = new Pusher('02b3ba8ad0fef8e1414d');
			  var canal  = pusher.subscribe('canal_prueba');
			  canal.bind('nuevo_<?=$_SESSION["USERNAME"]?>', function(respuesta){
			  	if (respuesta.mensaje) {
			    $('#mensajes').append('<tr><td><span class="label label-important">'+respuesta.userconnect + '</span>:' + respuesta.mensaje+'</td></tr>')
			    };
			  });
			  $('#msj').submit(function(){
			    $.post('ajax.php', { 
			        username : '<?=$_GET["username"]?>',
			        msj : $('#send').val(),

			          }, function(respuesta){
			          	if ($('#send').val()) {
				          	$('#mensajes').append('<tr><td><span class="label label-info">yo</span>:' + $('#send').val() +'</td></tr>');
				            $('#send').val("");
			            };
			      }, 'json');
			    return false;
			  });
			  
			});
</script>			
</head>
<body>
    <div class="container well span5">
<?

/*Ahora necesitamos mostrar 3 capas: la del usuario sin logear, 
la del usuarios logeado y la del usuario con el que se va a chatear!*/
$user = htmlspecialchars($_GET['username']);
//detectamos si no hay 1 usuario conectado

if (empty($_SESSION['USERNAME'])) {
	echo 'Usa uno de estos usuarios:<br/>
	<ul><li>Demo1</li><li>Demo2</li><li>Demo3</li><li>Demo4</li><li>Demo5</li></ul>
	<form id="login" method="post" action="index.php"><input type="text" id="username" name="username" placeholder="ingrese su nombre"></form>';
	$login = htmlspecialchars($_POST['username']);
	for ($i=0; $i <count($UserName) ; $i++) { 
		if ($UserName[$i] == $login) {
			$_SESSION['USERNAME'] = $login;
			echo 'Session correcta.<br/>Click en <a href="index.php">Recargar</a>';
		}
	}
//detectamos si el usuario esta en logeado para mostrarle la lista de usuario
}elseif (!empty($_SESSION['USERNAME']) && empty($user)) {
	echo 'Welcome '.$_SESSION['USERNAME'].'<br/>Elije uno de estos usuarios para chatear<br/>';

	for($i = 0; $i<count($UserName);$i++) {
		if ($UserName[$i]!=$_SESSION['USERNAME']) {
			echo '<a href="index.php?username='.$UserName[$i].'">'.$UserName[$i].'</a><br/>';
		}
		
	}
//seccion donde se podra chatear con otro usuario
}elseif (!empty($user)) {
	echo '<h3>Welcome '.$_SESSION['USERNAME'].'</h3>Mensaje para :'.$user;
	echo '
	<table class="table table-striped">
              <thead>
                <tr>
                  <th>Chat Privado</th>
                </tr>
              </thead>
              <tbody id="mensajes">
              </tbody>
            </table>
	<form id="msj">
	<input type="text" id="send" name="send" placeholder="ingrese su mensaje"></form>';
}

?>
	</div>
</body>
</html>

