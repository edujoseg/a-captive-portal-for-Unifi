<?php
//error_reporting(E_ALL);
//ini_set('display_errors', '1');

	require 'config.php';
	require 'functions.php';

	$nombre = trim($_POST['nombre']);
	$apellido = trim($_POST['apellido']);
	$password = trim($_POST['password']);
	$mac = trim($_POST['mac']);
	$url = trim($_POST['url']);
	
	$time = auth_user2($nombre, $apellido, $password, $mac);
	if($time == -999) {
		readfile("reject.html");
		exit(0);
	}
	if($time != 0) {
		//Minutes to authorize, change to suit your needs
		$minutes = $time;
		sendAuthorization2($mac,$minutes,$url);
		//echo "Login successful, I should redirect to: " . $url; //$_SESSION['url'];
		sleep(10); // Small sleep to allow controller time to authorize
	}
	//echo $time;	
        $log = $_SERVER['REMOTE_ADDR'].' - '.date("F j, Y, g:i a").PHP_EOL.
        "Aceptado?: ".($time |= 0?'Si':'No').PHP_EOL.
        "Usuario: ".$nombre." ".$apellido.PHP_EOL.
        "Clave: ".$password.PHP_EOL.
	"MAC: ".$mac.PHP_EOL.
	"Url: ".$url.PHP_EOL.
        "-------------------------".PHP_EOL;
	file_put_contents('../../../admin/log/log.txt', $log, FILE_APPEND);
	header('Location: http://www.hotelcasabaluarte.co');
	//header('Location: ' . $url);//$_SESSION['url']);

?>
