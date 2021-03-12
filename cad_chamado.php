<?php

require "versession.php";
include "conexao.php";
$pdo = conectar("helpdesk");
$idsolicitante = $_SESSION['user_idhd'];
$idservico = filter_input(INPUT_POST, "servico");
$idsecao = filter_input(INPUT_POST, "secao");
$idetiqueta = filter_input(INPUT_POST, "etiqueta");
$dataabertura = date("d/m/Y");
$horaabertura = date("H:i:s");
$assunto = filter_input(INPUT_POST, "assunto");
$chamado = filter_input(INPUT_POST, "chamado");
$arquivo = isset($_FILES["arquivo"]) ? $_FILES["arquivo"] : FALSE;
$numchamado = time() . "" . $_SESSION['user_idhd']; //strrev() inverte a string
$diretorio = "anexo/" . $numchamado;
$situacao = "1"; // 1 - Em Aberto, 2 - Em Atendimento, 3 - Finalizado
$chamado = $chamado . "\n Criado em " . $dataabertura . " às " . $horaabertura . " pelo " . $_SESSION['user_pgradsimpleshd'] . " " . $_SESSION['user_guerrahd'] . " (ID:" . $_SESSION['user_idhd'] . ")";
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
    $gravchmdo = $pdo->prepare("INSERT INTO chamado(numchamado, situacao, idservico,"
            . " idsolicitante, idsecao, dataabertura, horaabertura, assunto, idetiqueta) "
            . "VALUES (:numchamado, :situacao, :idservico,"
            . " :idsolicitante, :idsecao, :dataabertura, :horaabertura, :assunto, :idetiqueta)");
    $gravchmdo->bindParam(":numchamado", $numchamado, PDO::PARAM_STR);
    $gravchmdo->bindParam(":situacao", $situacao, PDO::PARAM_STR);
    $gravchmdo->bindParam(":idservico", $idservico, PDO::PARAM_STR);
    $gravchmdo->bindParam(":idsolicitante", $idsolicitante, PDO::PARAM_STR);
    $gravchmdo->bindParam(":idsecao", $idsecao, PDO::PARAM_STR);
    $gravchmdo->bindParam(":dataabertura", $dataabertura, PDO::PARAM_STR);
    $gravchmdo->bindParam(":horaabertura", $horaabertura, PDO::PARAM_STR);
    $gravchmdo->bindParam(":assunto", $assunto, PDO::PARAM_STR);
    $gravchmdo->bindParam(":idetiqueta", $idetiqueta, PDO::PARAM_INT);
    $executa = $gravchmdo->execute();

    $grav = $pdo->prepare("INSERT INTO historico(numchamado, texto,"
            . " anexo, data, hora) "
            . "VALUES (:numchamado, :texto,"
            . " :anexo, :data, :hora)");
    $grav->bindParam(":numchamado", $numchamado, PDO::PARAM_STR);    
    $grav->bindParam(":texto", $chamado, PDO::PARAM_LOB);
    $grav->bindParam(":anexo", $caminho_imagem, PDO::PARAM_STR);
    $grav->bindParam(":data", $dataabertura, PDO::PARAM_STR);
    $grav->bindParam(":hora", $horaabertura, PDO::PARAM_STR);
    $execut = $grav->execute();

    $somachamado1 = "qtdservico+1"; // tabela servico
    $somachamado2 = "qtdchamados+1"; // tabela secao
    $totalchamados = "totalchamados+1"; // tabela etiquetas

    $gravsv = $pdo->prepare("UPDATE servico SET qtdservico = $somachamado1 WHERE id = :idservico");
    $gravsv->bindParam(":idservico", $idservico, PDO::PARAM_INT);
    $execsv = $gravsv->execute();

    $gravsec = $pdo->prepare("UPDATE secao SET qtdchamados = $somachamado2 WHERE id = :idsecao");
    $gravsec->bindParam(":idsecao", $idsecao, PDO::PARAM_INT);
    $execsec = $gravsec->execute();
    
    $gravetq = $pdo->prepare("UPDATE etiqueta SET totalchamados = $totalchamados WHERE id = :idetiqueta");
    $gravetq->bindParam(":idetiqueta", $idetiqueta, PDO::PARAM_INT);
    $execetq = $gravetq->execute();

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
header('Location: meuschamados.php');
?>