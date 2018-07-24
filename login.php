<?php
error_reporting(0);
session_cache_expire(8);
session_start();
if (empty($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
}
$token = $_SESSION['token'];
$mrxmsg = array(
    'usuario' => "",
    'msg'     => "Fazer Login.",
);

require 'config.php';
if (
    isset($_POST['user']) && !empty($_POST['user']) &&
    isset($_POST['senha']) && !empty($_POST['senha']) 
) {
    if (strlen($_POST['user']) >=5 && strlen($_POST['senha']) >= 8) {
        if (!empty($_POST['token'])) {
            if (hash_equals($_SESSION['token'], $_POST['token'])) {
                $usuario =htmlentities($_POST["user"], ENT_HTML5 | ENT_QUOTES, 'UTF-8');
                $mrxmsg['usuario'] = $usuario;
                $senha = md5($_POST['senha']);
                $chave = md5($_POST["user"].$_POST["senha"]);
                $chave_F = mb_substr($chave, 4, 20);
                
                $mrx = array(
                    'usuario' => $usuario ,
                    'senha'   => $senha   ,
                    'chave_F' => $chave_F
                );

                if (isset($mrx) && !empty($mrx)) {
                     $stmt = $dbh->prepare("
                        SELECT * FROM emierixix WHERE usuario = (:usuario) AND senha = (:senha) AND chave = (:chave)
                    ");

                     $usuario = $mrx['usuario'];
                     $senha = $mrx['senha'];
                     $stmt->bindParam(':usuario',$usuario);
                     $stmt->bindParam(':senha',$senha);
                     $stmt->bindParam(':chave',$chave_F);
                     $stmt->execute();

                     if ($stmt->rowCount()>=1) {

                        foreach ($stmt->fetchAll() as $dadosmrx) {
                            $_SESSION['CHV'] = $dadosmrx['chave'];
                            $_SESSION['usuario'] = $dadosmrx['usuario'];
                            $_SESSION['usuariomd5'] = md5($dadosmrx['usuario']);
                            header("location:/Emierixix");
                            exit;
                        }

                     }else{
                       $mrxmsg['msg'] =  "Usuario ou senha incorretos";
                     }

                }
            }else{
            
            }
        }
    } else{
        $mrxmsg['msg'] =  "Digite um Usuario com  no minimo 5 digitos, e uma senha com no minimo 8 digitos.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <link rel="stylesheet" type="text/css" href="css/lstyle.css">
    </head>
    <body>
        <header>
            <h2 class="titulo"> <?php echo $mrxmsg['msg']; ?> </h2>
        </header>
        <form method="POST">
            <input type="text" name="user" placeholder="Usuario" pattern="[a-zA-Z0-9]+" minlength="5" max="20" value="<?php echo $mrxmsg['usuario']; ?>" autocomplete="off" required /><br/>
            <input type="password" name="senha" placeholder="Senha" pattern="[a-zA-Z0-9]+" minlength="8" max="30" autocomplete="off" required /><br/>
             <input type="submit" class="btn" value="Entrar"><br/>
             <input type="hidden" name="token" value="<?php echo $token; ?>">
        </form>
            <center><a href="cadastro.php"><button class="btn">Cadastrar</button></a></center>
    </body>
</html>