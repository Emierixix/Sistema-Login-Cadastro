<?php
error_reporting(0);
session_start();
if (empty($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
}
$token = $_SESSION['token'];

$mrxmsg = array(
    'nome'    => "",
    'usuario' => "",
    'aviso'   => "Fazer Cadastro, Caracteres especiais não serão aceitos !",
);
require 'config.php';
if (
    isset($_POST['nome']) && !empty($_POST['nome']) &&
    isset($_POST['user']) && !empty($_POST['user']) &&
    isset($_POST['senha']) && !empty($_POST['senha']) 
) {
     if (!empty($_POST['token'])) {
        if (hash_equals($_SESSION['token'], $_POST['token'])) {

            $nome = htmlentities($_POST["nome"], ENT_HTML5 | ENT_QUOTES, 'UTF-8');
            $mrxmsg['nome'] = $nome;
            $usuario =htmlentities($_POST["user"], ENT_HTML5 | ENT_QUOTES, 'UTF-8');
            $mrxmsg['usuario'] = $usuario;
            $senha = md5($_POST['senha']);
            $chave = md5($_POST["user"].$_POST["senha"]);
            $chave_F = mb_substr($chave, 4, 20);

            $end_ip = $_SERVER['REMOTE_ADDR'];

            $mrx = array(
                'nome'    => $nome    ,
                'usuario' => $usuario ,
                'senha'   => $senha   ,
                'chave'   => $chave   ,
                'end_ip' => $end_ip , 
                'chave_F' => $chave_F
            );

            if (isset($mrx) && !empty($mrx)) {
                 $stmt = $dbh->prepare("
                    SELECT * FROM emierixix WHERE end_ip = (:end_ip)
                ");

                 $end_mac = $mrx['end_ip'];
                 $stmt->bindParam(':end_ip',$end_ip);
                 $stmt->execute();

                 if ($stmt->rowCount()>=4) {
                     $mrxmsg['aviso'] = "Desculpe, você já criou mais de 5 contas. seu ip esta bloqueado temporariamente";
                 }else{

                 }
                 $stmt = $dbh->prepare("
                    SELECT * FROM emierixix WHERE Usuario = (:usuario)
                ");

                 $stmt->bindParam(':usuario',$mrx['usuario']);
                 $stmt->execute();

                 if ($stmt->rowCount()>=1) {
                    $mrxmsg['aviso'] ="O Usuario ".$mrx['usuario']." Já foi Cadastrado !";
                 }else{
                    require 'insert.php';

                }
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Cadastro</title>
        <link rel="stylesheet" type="text/css" href="css/lstyle.css">
    </head>
    <body>
         <header>
            <h2 class="titulo"> <?php echo $mrxmsg['aviso']; ?> </h2>
        </header>
        <form method="POST">
            <input type="text" name="nome" placeholder="Nome" pattern="[a-zA-Z0-9- ]+" autocomplete="off" min="5" max="20" value="<?php echo $mrxmsg['usuario']; ?>" required /><br/>
            <input value="<?php echo $mrxmsg['usuario']; ?>" type="text" name="user" placeholder="Usuario" pattern="[a-zA-Z0-9]+" autocomplete="off" min="5" max="10" required /><br/>
            <input type="password" name="senha" placeholder="Senha" pattern="[a-zA-Z0-9]+" min="8" max="30" required /><br/>
            <input type="submit" class="btn" value="Cadastrar">
            <input type="hidden" name="token" value="<?php echo $token; ?>">
        </form>
         <center><a href="login.php"><button class="btn">Entrar</button></a></center>
    </body>
</html>