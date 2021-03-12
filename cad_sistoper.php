<?php
include "conexao.php";
$pdo2 = conectar2("helpdesk");
$sistoper = filter_input(INPUT_POST, "sistoper");
$stmtez = $pdo2->prepare("INSERT INTO sistoper(sistema) "
        . "VALUES (:sistoper)");
$stmtez->bindParam(":sistoper", $sistoper, PDO::PARAM_STR);
$executa = $stmtez->execute();
header('Location: sistoper.php');
?>