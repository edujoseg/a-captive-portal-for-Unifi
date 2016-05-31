<?php

require_once(__ROOT__ . '../../../../config.php');
error_reporting(E_ALL);
ini_set('display_errors', '1');


//UniFi server credentials
$unifiServer = "https://UniFi:8443"; //Change to the IP/FQDN of your UniFi Server
//It's important to note that if this server is offsite, you need to have port 8443 forwarded through to it
$unifiUser = ""; //Change to your UniFi Username
$unifiPass = ""; //Change to your UniFi Password



?>
