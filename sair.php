<?php
session_start();

$ssn_user = $_SESSION['usuario'];
$ssn_chv = $_SESSION['CHV'];

if (isset($ssn_user) && !empty($ssn_user) && !empty($ssn_chv) && !empty($ssn_chv)) {
	session_destroy();
	header("Location:Login.php");
	exit();
}else{
	header("location: Login.php");
	exit();
}