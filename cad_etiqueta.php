<?php

include "conexao.php";
$pdo2 = conectar2("helpdesk");
$disponivel = "N";
$numero = filter_input(INPUT_POST, "etiqueta");
$stmtez = $pdo2->prepare("INSERT INTO etiqueta(numero, disponivel) "
        . "VALUES (:numero, :disponivel)");
$stmtez->bindParam(":numero", $numero, PDO::PARAM_STR);
$stmtez->bindParam(":disponivel", $disponivel, PDO::PARAM_STR);
$executa = $stmtez->execute();
header('Location: etiquetasti.php');
?>