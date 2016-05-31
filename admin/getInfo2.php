<?php
header('Content-type: application/json');
include "../phpxmlrpc/lib/xmlrpc.inc";
require_once(__ROOT__ . '../config.php');

//WuBook Zak credentials

if ($_POST["func"] == "getInvoicesInfo") {

	$wbCodeVoucher = $_POST["voucher"];
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
	$customer = array_map('utf8_encode', php_xmlrpc_decode($xmlrpc_response)[0]);
	//var_dump($customer);
	echo json_encode($customer);



/*	switch (json_last_error()) {
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
    }	*/
}


?>
