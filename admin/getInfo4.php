<?php
header('Content-type: application/json');
include "../phpxmlrpc/lib/xmlrpc.inc";
require_once(__ROOT__ . '../config.php');

//WuBook Zak credentials


	$wbTime = $_GET["time"];
	$xmlrpc_client = new xmlrpc_client('/zxrvs/', 'wubook.net', 443, 'https');
	//$xmlrpc_client->setDebug(1);
	$xmlrpc_client->setSSLVerifyPeer(0);
	$token_params = array(
        	new xmlrpcval($wbUser, 'string'),
       		new xmlrpcval($wbPassword, 'string'),
        	new xmlrpcval($wbPkey, 'string')
	);
	$xmlrpc_message = new xmlrpcmsg('acquire_token', $token_params);
	$xmlrpc_response = $xmlrpc_client->send($xmlrpc_message)->value();
	$token = php_xmlrpc_decode($xmlrpc_response)[1];

	/*$params = array(
                new xmlrpcval($token, 'string'),
        );
	$xmlrpc_message = new xmlrpcmsg('fetch_properties', $params);
        $xmlrpc_response = $xmlrpc_client->send($xmlrpc_message)->value();

        var_dump(php_xmlrpc_decode($xmlrpc_response));*/

	//chequear reservacion
	
	$params = array(
        	new xmlrpcval($token, 'string'),
        	new xmlrpcval($wbLcode, 'string'),
        	new xmlrpcval($wbTime, 'string')
	);
	$xmlrpc_message = new xmlrpcmsg('fetch_reservations_day', $params);
	$xmlrpc_response = $xmlrpc_client->send($xmlrpc_message)->value();
	$lista = php_xmlrpc_decode($xmlrpc_response);
	//array_walk_recursive($lista,'utf8_encode');
	echo "---------------------------- fetch_reservations_day --------------------------------\n";
	echo "Numero de reservas: " . count($lista) . "\n";
	foreach ($lista as $reserva) {
		print_r($reserva);
	}
	$params = array(
                new xmlrpcval($token, 'string')
        );
        $xmlrpc_message = new xmlrpcmsg('release_token', $params);
        $xmlrpc_response = $xmlrpc_client->send($xmlrpc_message)->value();



?>
