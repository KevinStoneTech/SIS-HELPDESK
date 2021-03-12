<?php
include "conexao.php";
$pdo2 = conectar2("helpdesk");
$servico = filter_input(INPUT_POST, "servico");
$stmtez = $pdo2->prepare("INSERT INTO servico(servico) "
        . "VALUES (:servico)");
$stmtez->bindParam(":servico", $servico, PDO::PARAM_STR);
$executa = $stmtez->execute();
header('Location: servicos.php');
?>