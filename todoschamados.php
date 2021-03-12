<?php
require "versession.php";
include "conexao.php";
$ref = filter_input(INPUT_GET, "ref");
if ($ref == "0") {
    $titulophp = "Chamados Abertos";
}
if ($ref == "3") {
    $titulophp = "Chamados Finalizados";
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <?php
        include "tags.php";
        ?>
        <link rel="stylesheet" href="lib/fontawesome/css/font-awesome.css">
        <link rel="stylesheet" href="lib/weather-icons/css/weather-icons.css">
        <link rel="stylesheet" href="lib/jquery-toggles/toggles-full.css">
        <link rel="stylesheet" href="lib/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css">
        <link rel="stylesheet" href="lib/select2/select2.css">
        <link rel="stylesheet" href="css/quirk.css">
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="lib/html5shiv/html5shiv.js"></script>
        <script src="lib/respond/respond.src.js"></script>
        <![endif]-->
    </head>
    <body>
        <?php
        include "header.php";
        ?>
        <section>
            <div class="leftpanel">
                <div class="leftpanelinner">
                    <?php
                    include "leftpanel.php";
                    include "menu.php";
                    ?>
                </div><!-- leftpanelinner -->
            </div><!-- leftpanel -->
            <div class="mainpanel">
                <div class="contentpanel">
                    <ol class="breadcrumb breadcrumb-quirk">
                        <li><a href="index.php"><i class="fa fa-home mr5"></i> Página Inicial</a></li>
                        <li><a href="#">Chamados</a></li>
                        <li class="active"><?php echo($titulophp); ?></li>
                    </ol>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><?php echo($titulophp); ?></h4>
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table id="dataTable1" class="table table-bordered table-striped table-condensed table-responsive">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Id</th>
                                                    <th class="text-center">Chamado</th>
                                                    <th class="text-center">Situação</th>
                                                    <th class="text-center">Serviço</th>
                                                    <th class="text-center">Assunto</th>
                                                    <th class="text-center">Seção</th>
                                                    <th class="text-center">Solicitante</th>
                                                    <th class="text-center">Ocorrências</th>
                                                    <th class="text-center">Atendimento</th>
                                                    <th class="text-center">Providência</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th class="text-center">Id</th>
                                                    <th class="text-center">Chamado</th>
                                                    <th class="text-center">Situação</th>
                                                    <th class="text-center">Serviço</th>
                                                    <th class="text-center">Assunto</th>
                                                    <th class="text-center">Seção</th>
                                                    <th class="text-center">Solicitante</th>
                                                    <th class="text-center">Ocorrências</th>
                                                    <th class="text-center">Atendimento</th>
                                                    <th class="text-center">Providência</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                <?php
                                                $pdo = conectar("helpdesk");
                                                $pdo2 = conectar2("membros");
                                                if ($ref == "0") {
                                                    $filtro = $pdo->prepare("SELECT * FROM chamado WHERE situacao != '3'");
                                                }
                                                if ($ref == "3") {
                                                    $filtro = $pdo->prepare("SELECT * FROM chamado WHERE situacao = '3'");
                                                }
                                                $filtro->execute();
                                                while ($reg2 = $filtro->fetch(PDO::FETCH_ASSOC)) :
                                                    /* Para recuperar um ARRAY utilize PDO::FETCH_ASSOC */
                                                    echo("<tr>");
                                                    $idcol = $reg2['id'];
                                                    echo("<td class='text-center'>$idcol</td>");
                                                    $linkchamado = $reg2['numchamado'];
                                                    $criptolink = base64_encode($linkchamado);
                                                    if ($reg2['situacao'] == "1") {
                                                        echo("<td class='text-center'>$linkchamado</td>");
                                                        echo("<td class='text-center'> Em espera</td>");
                                                    }
                                                    if ($reg2['situacao'] == "2") {
                                                        echo("<td class='text-center'><a href='chamadoatratar.php?out=$criptolink'>$linkchamado</a></td>");
                                                        echo("<td class='text-center'> Em atendimento</td>");
                                                    }
                                                    if ($reg2['situacao'] == "3") {
                                                        echo("<td class='text-center'><a href='chamadoatratar.php?out=$criptolink'>$linkchamado</a></td>");
                                                        echo("<td class='text-center'> Finalizado</td>");
                                                    }
                                                    $filtro2 = $pdo->prepare("SELECT * FROM servico WHERE id = :idservico");
                                                    $filtro2->bindParam(":idservico", $reg2['idservico']);
                                                    $filtro2->execute();
                                                    $idsv = $filtro2->fetchAll(PDO::FETCH_ASSOC);
                                                    $descsv = $idsv[0];
                                                    echo("<td class='text-center'>" . $descsv['servico'] . "</td>");
                                                    echo("<td class='text-center'>" . $reg2['assunto'] . "</td>");
                                                    $filtro3 = $pdo->prepare("SELECT * FROM secao WHERE id = :idsecao");
                                                    $filtro3->bindParam(":idsecao", $reg2['idsecao']);
                                                    $filtro3->execute();
                                                    $idsecao = $filtro3->fetchAll(PDO::FETCH_ASSOC);
                                                    $descsecao = $idsecao[0];
                                                    echo("<td class='text-center'>" . $descsecao['secao'] . "</td>");
                                                    //Pesquisa Usuário
                                                    $filtrosolic = $pdo2->prepare("SELECT * FROM usuarios WHERE id = :idusuario");
                                                    $filtrosolic->bindParam(":idusuario", $reg2['idsolicitante']);
                                                    $filtrosolic->execute();
                                                    $idusuario = $filtrosolic->fetchAll(PDO::FETCH_ASSOC);
                                                    $idusr = $idusuario[0];
                                                    //Pesquisa Posto/Grad Usuario
                                                    $filtropgrad = $pdo2->prepare("SELECT * FROM postograd WHERE id = :idpgrad");
                                                    $filtropgrad->bindParam(":idpgrad", $idusr['idpgrad']);
                                                    $filtropgrad->execute();
                                                    $idpgrad = $filtropgrad->fetchAll(PDO::FETCH_ASSOC);
                                                    $idpg = $idpgrad[0];
                                                    echo("<td class='text-center'>" . $idpg['pgradsimples'] . " " . $idusr['nomeguerra'] . "</td>");
                                                    //Pesquisa Quantidade de ocorrencias no chamado
                                                    $filtroO = $pdo->prepare("SELECT * FROM historico WHERE numchamado = :numchamado");
                                                    $filtroO->bindParam(":numchamado", $reg2['numchamado']);
                                                    $filtroO->execute();
                                                    $ocorrencias = $filtroO->fetchAll(PDO::FETCH_ASSOC);
                                                    $ultimaarray = end($ocorrencias);
                                                    echo("<td class='text-center'>" . $ultimaarray['data'] . " às " . $ultimaarray['hora'] . " (" . count($ocorrencias) . ")</td>");
                                                    if ($reg2['tecnico'] <> 0) {
                                                        $filtro4 = $pdo2->prepare("SELECT * FROM usuarios WHERE id = :idtecnico");
                                                        $filtro4->bindParam(":idtecnico", $reg2['tecnico']);
                                                        $filtro4->execute();
                                                        $idtecnico = $filtro4->fetchAll(PDO::FETCH_ASSOC);
                                                        $tecnico = $idtecnico[0];
                                                        $filtro5 = $pdo2->prepare("SELECT * FROM postograd WHERE id = :idpgrad");
                                                        $filtro5->bindParam(":idpgrad", $tecnico['idpgrad']);
                                                        $filtro5->execute();
                                                        $idpgrad = $filtro5->fetchAll(PDO::FETCH_ASSOC);
                                                        $descpgrad = $idpgrad[0];
                                                        echo("<td class='text-center'>" . $descpgrad['pgradsimples'] . " " . $tecnico['nomeguerra'] . "</td>");
                                                    } else {
                                                        echo("<td> </td>");
                                                    }
                                                    if ($reg2['situacao'] == "3") {
                                                        echo("<th class='text-center'><i class='fa fa-thumbs-o-up'></i></th>");
                                                    }
                                                    if ($reg2['situacao'] == "2") {
                                                        echo("<th class='text-center'><a href=encerrado.php?out=$criptolink><i class='glyphicon glyphicon-ok'></i></a></th>");
                                                    }
                                                    if ($reg2['situacao'] == "1") {
                                                        echo("<th class='text-center'><a href=tratado.php?out=$criptolink><i class='glyphicon glyphicon-floppy-open'></i></a></th>");
                                                    }
                                                    echo("</tr>");
                                                endwhile;
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div><!-- panel -->
                        </div>
                    </div><!-- row -->
                </div><!-- contentpanel -->
            </div><!-- mainpanel -->

        </section>
        <script src="lib/jquery/jquery.js"></script>
        <script src="lib/jquery-ui/jquery-ui.js"></script>
        <script src="lib/bootstrap/js/bootstrap.js"></script>
        <script src="lib/jquery-toggles/toggles.js"></script>
        <script src="lib/datatables/jquery.dataTables.js"></script>
        <script src="lib/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.js"></script>
        <script src="lib/select2/select2.js"></script>

        <script src="js/quirk.js"></script>
        <script>
            $(document).ready(function () {

                'use strict';

                $('#dataTable1').DataTable();

                var exRowTable = $('#exRowTable').DataTable({
                    responsive: true,
                    'fnDrawCallback': function (oSettings) {
                        $('#exRowTable_paginate ul').addClass('pagination-active-success');
                    },
                    'ajax': 'ajax/objects.txt',
                    'columns': [{
                            'class': 'details-control',
                            'orderable': false,
                            'data': null,
                            'defaultContent': ''
                        },
                        {'data': 'name'},
                        {'data': 'position'},
                        {'data': 'salary'}
                    ],
                    'order': [[1, 'asc']]
                });

                // Add event listener for opening and closing details
                $('#exRowTable tbody').on('click', 'td.details-control', function () {
                    var tr = $(this).closest('tr');
                    var row = exRowTable.row(tr);

                    if (row.child.isShown()) {
                        // This row is already open - close it
                        row.child.hide();
                        tr.removeClass('shown');
                    } else {
                        // Open this row
                        row.child(format(row.data())).show();
                        tr.addClass('shown');
                    }
                });

                function format(d) {
                    // `d` is the original data object for the row
                    return '<h4>' + d.name + '<small>' + d.position + '</small></h4>' +
                            '<p class="nomargin">..</p>';
                }

                // Select2
                $('select').select2({minimumResultsForSearch: Infinity});

            });
        </script>
    </body>
</html>
