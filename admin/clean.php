<?php

require_once(__ROOT__ . '../config.php');

class MyDB extends SQLite3 {
        function __construct() {
                $this->open($sqLiteDB);
        }
}

$db = new MyDB();
if (!$db) {
	echo $db->lastErrorMsg();
        return 0;
}


$sql = "DELETE FROM macs WHERE idUsuario IN (SELECT id FROM usuarios WHERE dto < strftime('%s','now') OR dto LIKE '%ndefined' OR dfrom LIKE '%ndefined';DELETE FROM usuarios WHERE dto < strftime('%s','now');";

        $ret = $db->exec($sql);
        if (!$ret) {
                echo $db->lastErrorMsg();
        }
        $db->close();
?>
