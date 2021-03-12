<?php

require "versession.php";
include "conexao.php";
$pdo = conectar("helpdesk");
$numchamado = base64_decode(filter_input(INPUT_GET, "out"));
$situacao = "3";
$datafechamento = date("d/m/Y");
$horafechamento = date("H:i:s");
try {
    $psqchamado = $pdo->prepare("UPDATE chamado SET situacao = :situacao, datafechamento = :datafechamento, horafechamento = :horafechamento WHERE numchamado = :numchamado");
    $psqchamado->bindParam(":situacao", $situacao, PDO::PARAM_STR);
    $psqchamado->bindParam(":datafechamento", $datafechamento, PDO::PARAM_STR);
    $psqchamado->bindParam(":horafechamento", $horafechamento, PDO::PARAM_STR);
    $psqchamado->bindParam(":numchamado", $numchamado, PDO::PARAM_STR);
    $executa = $psqchamado->execute();
    if ($executa) {
        //mensagem de sucesso
    } else {
        session_destroy();
        $msgerro = base64_encode('Erro na tentativa de gravar os dados. Abandono de sistema!');
        header('Location: signin.php?token=' . $msgerro);
    }
} catch (PDOException $e) {
    session_destroy();
    $msgerro = base64_encode($e->getMessage());
    header('Location: signin.php?token=' . $msgerro);
}
header('Location: todoschamados.php?ref=3');
?>