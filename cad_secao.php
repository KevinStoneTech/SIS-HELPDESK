<?php
include "conexao.php";
$pdo2 = conectar2("helpdesk");
$secao = filter_input(INPUT_POST, "secao");
$stmtez = $pdo2->prepare("INSERT INTO secao(secao) "
        . "VALUES (:secao)");
$stmtez->bindParam(":secao", $secao, PDO::PARAM_STR);
$executa = $stmtez->execute();
header('Location: secoes.php');
?>