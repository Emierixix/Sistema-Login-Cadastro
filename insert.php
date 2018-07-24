<?php

$stmt = $dbh->prepare("
      INSERT INTO emierixix (nome, usuario,senha,chave,end_mac) VALUES (:nome, :usuario,:senha,:chave,:end_mac)
      ");

      $nome =    $mrx['nome'];
      $usuario = $mrx['usuario'];
      $senha =   $mrx['senha'];
      $chave =   $mrx['chave'];
      $end_mac = $mrx['end_mac'];

      $stmt->bindParam(':nome', $nome);
      $stmt->bindParam(':usuario', $usuario);
      $stmt->bindParam(':senha', $senha);
      $stmt->bindParam(':chave', $chave_F);
      $stmt->bindParam(':end_mac',$end_mac);
      $stmt->execute();
      $mrxmsg['aviso'] = "Usuario : ".$usuario." Cadastrado com sucesso !";
?>