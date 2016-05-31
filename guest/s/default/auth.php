<?php
//error_reporting(E_ALL);
//ini_set('display_errors', '1');

	require 'config.php';
	require 'functions.php';

	$user = trim($_POST['username']);
	$password = trim($_POST['password']);
	$mac = trim($_POST['mac']);
	$url = trim($_POST['url']);
	
	$time = auth_user($user,$password);
	if($time != 0) {
		//Minutes to authorize, change to suit your needs
		$minutes = $time;
		echo $time;
		sendAuthorization2($mac,$minutes,$url);
		echo "Login successful, I should redirect to: " . $url; //$_SESSION['url'];
        	sleep(8); // Small sleep to allow controller time to authorize
        	header('Location: ' . $url);//$_SESSION['url']);

	}

?>
