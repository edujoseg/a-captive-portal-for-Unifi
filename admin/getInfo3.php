<?php
header('Content-type: application/json');
include "../phpxmlrpc/lib/xmlrpc.inc";
require_once(__ROOT__ . '../config.php');

//WuBook Zak credentials

if ($_POST["func"] != "getInvoicesInfo") {


	$wbCodeVoucher = $_GET["voucher"];
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
        	new xmlrpcval($wbCodeVoucher, 'string')
	);
	$xmlrpc_message = new xmlrpcmsg('fetch_invoices', $params);
	$xmlrpc_response = $xmlrpc_client->send($xmlrpc_message)->value();
	$lista = php_xmlrpc_decode($xmlrpc_response);
	array_walk_recursive($lista,'utf8_encode');
	echo "---------------------------- INVOICE --------------------------------\n";
	echo "Numero de invoices: " . count($lista) . "\n";
	foreach ($lista as $invoice) {
		print_r($invoice);
	}
	echo "---------------------------------------------------------------------\n";
	$ccode = $lista[0]["main_customer_id"];
	$xmlrpc_message = new xmlrpcmsg('fetch_reservation', $params);
        $xmlrpc_response = $xmlrpc_client->send($xmlrpc_message)->value();
	$reserva = php_xmlrpc_decode($xmlrpc_response);
	array_walk_recursive($reserva,'utf8_encode');
	//$reservacion = json_encode($reserva);
	echo "---------------------------- RESERVATION --------------------------------\n";
	print_r($reserva);
	echo "---------------------------------------------------------------------\n";

	echo "---------------------------- CUSTOMER --------------------------------\n";
	$params = array(
                new xmlrpcval($token, 'string'),
                new xmlrpcval($wbLcode, 'string'),
		new xmlrpcval(array('ccode' => new xmlrpcval($ccode, 'string')), 'struct')
        );
	$xmlrpc_message = new xmlrpcmsg('fetch_customer', $params);
        $xmlrpc_response = $xmlrpc_client->send($xmlrpc_message)->value();
	$lista = php_xmlrpc_decode($xmlrpc_response);
	array_walk_recursive($lista,'utf8_encode');
	print_r($lista);
	echo "---------------------------------------------------------------------\n";

	switch (json_last_error()) {
        case JSON_ERROR_NONE:
            echo ' - No errors';
        break;
        case JSON_ERROR_DEPTH:
            echo ' - Maximum stack depth exceeded';
        break;
        case JSON_ERROR_STATE_MISMATCH:
            echo ' - Underflow or the modes mismatch';
        break;
        case JSON_ERROR_CTRL_CHAR:
            echo ' - Unexpected control character found';
        break;
        case JSON_ERROR_SYNTAX:
            echo ' - Syntax error, malformed JSON';
        break;
        case JSON_ERROR_UTF8:
            echo ' - Malformed UTF-8 characters, possibly incorrectly encoded';
        break;
        default:
            echo ' - Unknown error';
        break;
    }	
}


?>
