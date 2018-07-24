<?php
error_reporting(0);
session_start();

$ssn_user = $_SESSION['usuario'];
$ssn_chv = $_SESSION['CHV'];

if (isset($ssn_user) && !empty($ssn_user) && !empty($ssn_chv) && !empty($ssn_chv)) {

	require 'config.php';
    	$stmt = $dbh->prepare("
        	 SELECT * FROM emierixix WHERE usuario = (:usuario) AND chave = (:chave) 
        ");
         $stmt->bindParam(':usuario',$ssn_user);
         $stmt->bindParam(':chave',$ssn_chv);
         $stmt->execute();

         if ($stmt->rowCount()>=1) {
         	 $user = htmlentities($ssn_user, ENT_HTML5 | ENT_QUOTES, 'UTF-8');
         }else{
         	echo "Você não tem permisão para ficar nesta página ! chave invalida";
            session_destroy();
            header("location:login.php");
            exit();
         }
}else{
	echo "Você não tem permisão para ficar nesta página ! ERRO";
    session_destroy();
    header("location:login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Emierixix</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
    <body>
        <header>
            <h2 class='titulo'><?php echo "Bem vindo, ".$user; ?></h2>
            <h2 class='sair'><a href="sair.php">Sair</a></h2>
        </header>
    </body>
</html>

