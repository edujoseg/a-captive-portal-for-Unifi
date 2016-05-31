<?php

include "../../../phpxmlrpc/lib/xmlrpc.inc";
include "class.unifi.php";

class MyDB extends SQLite3 {
        function __construct() {
                $this->open('databaseSQlite');
        }
}


function auth_user($username,$password) {
        global $wbUser;
        global $wbPassword;
        global $wbPkey;
        global $wbUrl;
        global $wbLcode;
        $xmlrpc_client = new xmlrpc_client('/zxrvs/', 'wubook.net', 443, 'https');
        $xmlrpc_client->setDebug(1);
        $xmlrpc_client->setSSLVerifyPeer(0);
        $token_params = array(
                new xmlrpcval($wbUser, 'string'),
                new xmlrpcval($wbPassword, 'string'),
                new xmlrpcval($wbPkey, 'string')
        );
        $xmlrpc_message = new xmlrpcmsg('acquire_token', $token_params);
        $xmlrpc_response = $xmlrpc_client->send($xmlrpc_message)->value();
        $token = php_xmlrpc_decode($xmlrpc_response)[1];


        //chequear reservacion
	/*
        $params = array(
                new xmlrpcval($token, 'string'),
                new xmlrpcval($wbLcode, 'string'),
                new xmlrpcval($password, 'string')
        );
        $xmlrpc_message = new xmlrpcmsg('fetch_reservation', $params);
        $xmlrpc_response = $xmlrpc_client->send($xmlrpc_message)->value();

        $customer = php_xmlrpc_decode($xmlrpc_response);
	*/

	$params = array(
                new xmlrpcval($token, 'string'),
                new xmlrpcval($wbLcode, 'string'),
                //array(new xmlrpcval("'first_name': '" . $username . "'", 'string'),
		//      new xmlrpcval("'last_name': '" . $password . "'", 'string'))
		new xmlrpcval(array(
		      "first_name" => new xmlrpcval($username, 'string'),
		      "last_name" => new xmlrpcval($password, 'string')), "struct")
        );
	$xmlrpc_message = new xmlrpcmsg('fetch_customer', $params);
        $xmlrpc_response = $xmlrpc_client->send($xmlrpc_message)->value();


        // Release Token

        $xmlrpc_message = new xmlrpcmsg('release_token', array(new xmlrpcval($token, 'string')));
        $xmlrpc_response = $xmlrpc_client->send($xmlrpc_message)->value();


        if (array_key_exists("first_name", $customer)) {
                $dto = $customer["dto"];
                $time = $dto - time();
                if ($time > 0) return intval($time / 60);
        }

        return 0;

}


function sendAuthorization($id, $minutes, $url) {
        global $unifiServer;
        global $unifiUser;
        global $unifiPass;

        // Start Curl for login
        $ch = curl_init();
        // We are posting data
        curl_setopt($ch, CURLOPT_POST, TRUE);
	curl_setopt($ch, CURLOPT_VERBOSE, true);
   	curl_setopt($ch, CURLOPT_STDERR, $fp);
        // Set up cookies
        $cookie_file = "/tmp/unifi_cookie";
        curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file);
        // Allow Self Signed Certs
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        // Force SSL3 only
        curl_setopt($ch, CURLOPT_SSLVERSION, 3);
        // Login to the UniFi controller
        curl_setopt($ch, CURLOPT_URL, "$unifiServer/login");
        curl_setopt($ch, CURLOPT_POSTFIELDS,"login=login&username=$unifiUser&password=$unifiPass");
        curl_exec ($ch);
        curl_close ($ch);
        // Send user to authorize and the time allowed
        $data = json_encode(array(
                'cmd'=>'authorize-guest',
        'mac'=>$id,
        'minutes'=>$minutes));
        $ch = curl_init();
        // We are posting data
        curl_setopt($ch, CURLOPT_POST, TRUE);
        // Set up cookies
        $cookie_file = "/tmp/unifi_cookie";
        curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file);
        // Allow Self Signed Certs
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        // Force SSL3 only
        curl_setopt($ch, CURLOPT_SSLVERSION, 3);
        // Make the API Call
        curl_setopt($ch, CURLOPT_URL, $unifiServer.'/api/cmd/stamgr');
        curl_setopt($ch, CURLOPT_POSTFIELDS, 'json='.$data);
        curl_exec ($ch);
        curl_close ($ch);

        // Logout of the connection
        $ch = curl_init();
        // We are posting data
        curl_setopt($ch, CURLOPT_POST, TRUE);
        // Set up cookies
        $cookie_file = "/tmp/unifi_cookie";
        curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file);
        // Allow Self Signed Certs
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        // Force SSL3 only
        curl_setopt($ch, CURLOPT_SSLVERSION, 3);
        // Make the API Call
        curl_setopt($ch, CURLOPT_URL, $unifiServer.'/logout');
        curl_exec ($ch);
        curl_close ($ch);
}

function sendAuthorization2($id, $minutes, $url) {
	global $unifiServer;
        global $unifiUser;
        global $unifiPass;

	$unifi = new unifiapi($unifiUser, $unifiPass, $unifiServer, "default", "3.0");
	$unifi->login();
	$unifi->authorize_guest($id, $minutes);
}

function auth_user2($nombre, $apellido, $password, $mac) {

	$db = new MyDB();
        if (!$db) {
                echo $db->lastErrorMsg();
		return 0;
        }	
	$sql = "SELECT id,dto,n_mac FROM usuarios WHERE nombre = '" . strtolower($nombre) . "' AND apellido = '" . strtolower($apellido) . "' AND clave = '" . $password . "';";
	$ret = $db->querySingle($sql, true);
        if (!$ret) {
                return 0;
       	}
 	if ((time() < $ret["dfrom"]) or (time() > $ret["dto"])) return 0;	
       	$time = $ret["dto"] - time(); 
	$n_mac = $ret["n_mac"];
	$id = $ret["id"];

	$sql = "SELECT count(*) FROM macs WHERE idUsuario=" . $id . ";";
	$ret = $db->querySingle($sql);
	if ($ret >= $n_mac) return -999;

	$sql = "INSERT OR REPLACE INTO macs (id,mac,idUsuario) VALUES ((SELECT id from macs where mac='" . $mac . "'),'" . $mac . "'," . $id . ");";

       	$ret = $db->exec($sql);
       	if (!$ret) {
        	echo $db->lastErrorMsg();
       	}
       	$db->close();

	if ($time > 0) return intval($time / 60);
}


?>
