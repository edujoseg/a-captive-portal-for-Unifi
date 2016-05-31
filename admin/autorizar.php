<?php

require_once(__ROOT__ . '../config.php');

class MyDB extends SQLite3 {
	function __construct() {
        	$this->open($sqLiteDB);
	}
}




if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$db = new MyDB();
	if (!$db) {
		echo $db->lastErrorMsg();
	}
	$sql = "INSERT OR REPLACE INTO usuarios (id, nombre,apellido,voucher,n_mac,clave,dfrom,dto,activo) VALUES ((SELECT id from usuarios where voucher = " . $_POST["voucher"]. ")," . $_POST["nombre"] . "," . $_POST["apellido"] . "," . $_POST["voucher"] . "," . $_POST["n_mac"] . "," . $_POST["clave"] . "," . $_POST["dfrom"] . "," . $_POST["dto"] . ",'" . $_POST["activo"] . "');";

	$ret = $db->exec($sql);
	if (!$ret) {
		echo $db->lastErrorMsg();
	} else {
		echo "Autorizado !";
	}
	$db->close();

}
?>
