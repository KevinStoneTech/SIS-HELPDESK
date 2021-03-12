<?php

require "versession.php";
include "conexao.php";
$pdo = conectar("helpdesk");
$dataabertura = date("d/m/Y");
$horaabertura = date("H:i:s");
$chamado = filter_input(INPUT_POST, "textoh");
$arquivo = isset($_FILES["arquivo"]) ? $_FILES["arquivo"] : FALSE;
$numchamado = base64_decode(filter_input(INPUT_GET, "numchamado"));
$diretorio = "anexo/" . $numchamado;
$chamado = $chamado . "\n Criado em " . $dataabertura . " às " . $horaabertura . " pelo " . $_SESSION['user_pgradsimpleshd'] . " " . $_SESSION['user_guerrahd'] . " (ID:" . $_SESSION['user_idhd'] . ")";
echo($numchamado . "<br>");

if (!empty($arquivo["name"])) {
    if (!file_exists($diretorio)) {
        mkdir($diretorio, 0777);
    }
    $extensao = strtolower(end(explode(".", $arquivo["name"])));
    // Gera um nome Ãºnico para a imagem
    $nome_imagem = md5(uniqid(time())) . "." . $extensao;
    // Caminho de onde ficarÃ¡ a imagem
    $caminho_imagem = $diretorio . "/" . $nome_imagem;
    // Faz o upload da imagem para seu respectivo caminho
    move_uploaded_file($arquivo["tmp_name"], $caminho_imagem);
    // Insere os dados no banco com arquivo inclusive
} else {
    $caminho_imagem = "";
}
try {
    $grav = $pdo->prepare("INSERT INTO historico(numchamado, texto,"
            . " anexo, data, hora) "
            . "VALUES (:numchamado, :texto,"
            . " :anexo, :data, :hora)");
    $grav->bindParam(":numchamado", $numchamado, PDO::PARAM_STR);
    $grav->bindParam(":texto", $chamado, PDO::PARAM_LOB);
    $grav->bindParam(":anexo", $caminho_imagem, PDO::PARAM_STR);
    $grav->bindParam(":data", $dataabertura, PDO::PARAM_STR);
    $grav->bindParam(":hora", $horaabertura, PDO::PARAM_STR);
    $executa = $grav->execute();
    // se o chamado = 1 e o posto for feito pelo técnico, então, 
    // automaticamente o chamado passará a ser = 2 e atendido pelo tecnico    
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
header('Location: index.php');
?>