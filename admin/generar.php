<?php
/*
 * jQuery File Upload Plugin PHP Example
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */

error_reporting(E_ALL | E_STRICT);
require('UploadHandler.php');
include "../phpxmlrpc/lib/xmlrpc.inc";
require_once(__ROOT__ . '../config.php');

$upload_handler = new UploadHandler();
$response = $upload_handler->response;
$files = $response['files'];
$file_count = count($files);

        
        //$wbCodeVoucher = $_GET["voucher"];
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



/*
Se necesitaría: id de la reserva zak, número de la factura, valor de IVA, valor total de l reserva, valor total pagado, datos del cliente ( tipo de documento, # documento, fecha de cumpleaños, nombre completo, nacionalidad), tipo de pago y cuánto pagó por cada tipo de pago, número de clientes , tipo de habitación
*/


for ($c = 0; $c < $file_count; $c++) {
	$past_data = "";
	$myfile = fopen("files/" . $files[$c]->name, "r") or die("Unable to open file!");
	$outfile = fopen("files/out.csv", "w") or die("Unable to open file!");
	$n_invoices = 0;
	$flag = false;
	while (($data = fgetcsv($myfile, 1000, ",")) !== FALSE) {

		if (!$flag) {
			$token_params = array(
                		new xmlrpcval($wbUser, 'string'),
                		new xmlrpcval($wbPassword, 'string'),
                		new xmlrpcval($wbPkey, 'string')
        		);
        		$xmlrpc_message = new xmlrpcmsg('acquire_token', $token_params);
        		$xmlrpc_response = $xmlrpc_client->send($xmlrpc_message)->value();
        		$token = php_xmlrpc_decode($xmlrpc_response)[1];
			$flag = true;
		}
		
		if ($data[0] != $past_data) {
			$params = array(
                		new xmlrpcval($token, 'string'),
                		new xmlrpcval($wbLcode, 'string'),
                		new xmlrpcval($data[0], 'string')
        		);
        		$xmlrpc_message = new xmlrpcmsg('fetch_invoices', $params);
        		$xmlrpc_response = $xmlrpc_client->send($xmlrpc_message)->value();
        		$lista = php_xmlrpc_decode($xmlrpc_response);
			$ccode = (isset($lista[0]["main_customer_id"]))?$lista[0]["main_customer_id"]:"";
			$params = array(
                		new xmlrpcval($token, 'string'),
                		new xmlrpcval($wbLcode, 'string'),
                		new xmlrpcval(array('ccode' => new xmlrpcval($ccode, 'string')), 'struct')
        		);
        		$xmlrpc_message = new xmlrpcmsg('fetch_customer', $params);
        		$xmlrpc_response = $xmlrpc_client->send($xmlrpc_message)->value();
        		$customer = php_xmlrpc_decode($xmlrpc_response);
        		array_walk_recursive($customer,'utf8_encode');
			$first_name = $customer[0]["first_name"];
			$last_name = $customer[0]["last_name"];
			$gen_doc_type = $customer[0]["gen_doc_type"];
			$gen_doc_number = $customer[0]["gen_doc_number"];
			$birthdate = $customer[0]["birthday"] . "/" . $customer[0]["birthmonth"] . "/" . $customer[0]["birthyear"];			
			foreach($lista as $invoice) {
        			array_walk_recursive($lista,'utf8_encode');
				$sn = ($invoice["sn"] != "")?$invoice["sn"]:"S/N";
				$payinfo = $invoice["payinfo"];
				$vat_8 = isset($invoice["paidvats"]["8,0"])?"8%:" . $invoice["paidvats"]["8,0"]:"8%:0";
				$vat_16 = isset($invoice["paidvats"]["16,0"])?"16%:" . $invoice["paidvats"]["16,0"]:"16%:0";
				$pcamount = $invoice["pcamount"];
				$dpayamount = $invoice["dpayamount"];
				$payinfo = "'" . str_replace(",", ".", $invoice["payinfo"]) . "'";
				$resinfo = "'" . str_replace(",", ".", $invoice["resinfo"]) . "'";
				fputs($outfile, ++$n_invoices . "," . $data[0] . "," . $sn . "," . $vat_8. "," . $vat_16 . "," . $pcamount . "," . $dpayamount . "," . $payinfo . "," . $first_name . "," . $last_name . "," . $gen_doc_type . "," . $gen_doc_number . "," . $birthdate . "," . $resinfo . "\n");
				$flag = (($n_invoices % 49) == 0)?false:true;
			}
			$past_data = $data[0];
		}
		if (!$flag) {
			$params = array(
                		new xmlrpcval($token, 'string')
        		);
        		$xmlrpc_message = new xmlrpcmsg('release_token', $params);
        		$xmlrpc_response = $xmlrpc_client->send($xmlrpc_message)->value();
		}
	}

	fclose($myfile);
	fclose($outfile);
}

