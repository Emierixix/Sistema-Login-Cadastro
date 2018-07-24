<?php

try {
	$dbh= new PDO("mysql:host=localhost;dbname=mrx;","root","");
} catch (Exception $e) {
	echo "ERRO ".$e->getMessage();
}

?>