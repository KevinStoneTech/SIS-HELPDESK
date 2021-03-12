<?php
require "versession.php";
include "conexao.php";
$numchamado = base64_decode(filter_input(INPUT_GET, "out"));
$pdo = conectar("helpdesk");
$pdo2 = conectar2("membros");
$filtro = $pdo->prepare("SELECT * FROM chamado WHERE numchamado = $numchamado");
$filtro->execute();
$regchamado = $filtro->fetchAll(PDO::FETCH_ASSOC);
$dadoschamado = $regchamado[0];
$idsolicitante = $dadoschamado['idsolicitante'];
$tempochamado = calculaData($dadoschamado['dataabertura'], $dadoschamado['horaabertura'], $dadoschamado['datafechamento'], $dadoschamado['horafechamento']);
$filtro2 = $pdo->prepare("SELECT * FROM historico WHERE numchamado = $numchamado");
$filtro2->execute();
//Pega os dados do Solicitante
$filtrosolic = $pdo2->prepare("SELECT * FROM usuarios WHERE id = :idusuario");
$filtrosolic->bindParam(":idusuario", $idsolicitante);
$filtrosolic->execute();
$idusuario = $filtrosolic->fetchAll(PDO::FETCH_ASSOC);
$idusr = $idusuario[0];
$filtropgrad = $pdo2->prepare("SELECT * FROM postograd WHERE id = :idpgrad");
$filtropgrad->bindParam(":idpgrad", $idusr['idpgrad']);
$filtropgrad->execute();
$idpgrad = $filtropgrad->fetchAll(PDO::FETCH_ASSOC);
$idpg = $idpgrad[0];
?>
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <?php
        include "tags.php";
        ?>
        <link rel="stylesheet" href="lib/jquery-ui/jquery-ui.css">
        <link rel="stylesheet" href="lib/select2/select2.css">
        <link rel="stylesheet" href="lib/dropzone/dropzone.css">
        <link rel="stylesheet" href="lib/jquery-toggles/toggles-full.css">
        <link rel="stylesheet" href="lib/fontawesome/css/font-awesome.css">
        <link rel="stylesheet" href="lib/timepicker/jquery.timepicker.css">
        <link rel="stylesheet" href="lib/bootstrapcolorpicker/css/bootstrap-colorpicker.css">
        <link rel="stylesheet" href="css/quirk.css">
        <script src="lib/modernizr/modernizr.js"></script>
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="../lib/html5shiv/html5shiv.js"></script>
        <script src="../lib/respond/respond.src.js"></script>
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
                        <li class="active">Chamado <?php echo($numchamado); ?></li>
                    </ol>
                    <div class="row">
                        <?php $criptolink = base64_encode($numchamado); ?>
                        <form role="form" method="post" action="<?php echo('cad_chamado2.php?numchamado=' . $criptolink); ?>" enctype="multipart/form-data">
                            <div class="col-sm-8">
                                <div class="panel">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">Chamado <?php echo($numchamado); ?></h4>
                                    </div>
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <?php
                                            $consulta6 = $pdo->prepare("SELECT * FROM servico WHERE id = :idservico");
                                            $consulta6->bindParam(":idservico", $dadoschamado['idservico']);
                                            $consulta6->execute();
                                            $regsv = $consulta6->fetch(PDO::FETCH_ASSOC)
                                            ?>
                                            <input value="Serviço: <?php echo($regsv['servico']); ?>" name="servico" class="form-control" type="text" placeholder="Serviço" disabled>
                                        </div>
                                        <div class="form-group">
                                            <input value="Assunto: <?php echo($dadoschamado['assunto']); ?>" name="assunto" class="form-control" type="text" placeholder="Assunto" disabled>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <?php
                                                    $consulta7 = $pdo->prepare("SELECT * FROM secao WHERE id = :idsecao");
                                                    $consulta7->bindParam(":idsecao", $dadoschamado['idsecao']);
                                                    $consulta7->execute();
                                                    $regsecao = $consulta7->fetch(PDO::FETCH_ASSOC);
                                                    ?>
                                                    <input value="Seção/SU: <?php echo($regsecao['secao']); ?>" name="secao" class="form-control" type="text" placeholder="Seção" disabled>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <?php
                                                    $consultaetq = $pdo->prepare("SELECT * FROM etiqueta WHERE id = :idetiqueta");
                                                    $consultaetq->bindParam(":idetiqueta", $dadoschamado['idetiqueta']);
                                                    $consultaetq->execute();
                                                    $regetq = $consultaetq->fetch(PDO::FETCH_ASSOC);
                                                    if ($dadoschamado['idetiqueta'] <> 0) {
                                                        $varetq = $regetq['numero'];
                                                    } else {
                                                        $varetq = "Não é o caso";
                                                    }
                                                    ?>
                                                    <input value="Número da Etiqueta do Computador: <?php echo($varetq); ?>" name="etiqueta" class="form-control" type="text" placeholder="Seção" disabled>
                                                </div>
                                            </div>
                                        </div>                                        
                                    </div>
                                </div><!-- panel -->
                                <?php
                                $consulta8 = $pdo->prepare("SELECT * FROM historico WHERE numchamado = :numchamado");
                                $consulta8->bindParam(":numchamado", $numchamado);
                                $consulta8->execute();
                                while ($reghist = $consulta8->fetch(PDO::FETCH_ASSOC)) :
                                    /* Para recuperar um ARRAY utilize PDO::FETCH_ASSOC */
                                    ?>
                                    <div class="panel">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-sm-11">
                                                    <div class="form-group">
                                                        <textarea name="chamado" id="autosize" class="form-control" rows="4" placeholder="Motivo do chamado." disabled><?php echo($reghist['texto']); ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-sm-1">
                                                    <div class="form-group">
                                                        <?php
                                                        if ($reghist['anexo'] <> "") {
                                                            ?>
                                                            <a href='<?php echo($reghist['anexo']); ?>' target="blank" title='Arquivo anexo'><span class='glyphicon glyphicon-paperclip'></span></a>
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- panel -->
                                    <?php
                                endwhile;
                                if ($dadoschamado['situacao'] <> '3') {
                                    ?>
                                    <div class="panel">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <textarea name="textoh" id="autosize" class="form-control" rows="4" placeholder="Relatar nova providência." required></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <div class="form-group">
                                                                <input name="arquivo" type="file"/>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <?php if ($dadoschamado['situacao'] <> '3') { ?>
                                                                <div class="panel-body">
                                                                    <div class="row">
                                                                        <div class="col-sm-12">
                                                                            <button type="submit" class="btn btn-success">
                                                                                <span class="glyphicon glyphicon-ok"></span>
                                                                                Enviar
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- panel -->
                                    <?php
                                }
                                ?>
                            </div><!-- col-sm-6 -->
                            <!-- ####################################################### -->
                            <div class="col-sm-4">
                                <div class="panel">
                                    <div class="panel-heading">

                                        <h4 class="panel-title">Solicitante: <?php echo($idpg['pgradsimples'] . " " . $idusr['nomeguerra'] . " (ID:" . $idusr['id'] . ")"); ?></h4>
                                        <br>
                                        <h4 class="panel-title">Tempo do chamado:</h4>
                                        <p><?php echo($tempochamado); ?></p><br>
                                        <h4 class="panel-title">Situação:</h4>
                                        <?php
                                        if ($dadoschamado['situacao'] == '1') {
                                            echo("<p>Aguardando atendimento</p>");
                                        }
                                        if ($dadoschamado['situacao'] == '2') {
                                            echo("<p>Em atendimento</p>");
                                        }
                                        if ($dadoschamado['situacao'] == '3') {
                                            echo("<p>Encerrado</p>");
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div><!-- col-sm-6 -->
                        </form>
                    </div><!-- row -->
                </div><!-- contentpanel -->
            </div><!-- mainpanel -->
        </section>
        <script src="lib/jquery/jquery.js"></script>
        <script src="lib/jquery-ui/jquery-ui.js"></script>
        <script src="lib/bootstrap/js/bootstrap.js"></script>
        <script src="lib/jquery-autosize/autosize.js"></script>
        <script src="lib/select2/select2.js"></script>
        <script src="lib/jquery-toggles/toggles.js"></script>
        <script src="lib/jquery-maskedinput/jquery.maskedinput.js"></script>
        <script src="lib/timepicker/jquery.timepicker.js"></script>
        <script src="lib/dropzone/dropzone.js"></script>
        <script src="lib/bootstrapcolorpicker/js/bootstrap-colorpicker.js"></script>

        <script src="js/quirk.js"></script>

        <script>
            $(function () {

                // Textarea Auto Resize
                autosize($('#autosize'));

                // Select2 Box
                $('#select1, #select2, #select3').select2();
                $("#select4").select2({maximumSelectionLength: 2});
                $("#select5").select2({minimumResultsForSearch: Infinity});
                $("#select6").select2({tags: true});

                // Toggles
                $('.toggle').toggles({
                    on: true,
                    height: 26
                });

                // Input Masks
                $("#date").mask("99/99/9999");
                $("#phone").mask("(999) 999-9999");
                $("#ssn").mask("999-99-9999");

                // Date Picker
                $('#datepicker').datepicker();
                $('#datepicker-inline').datepicker();
                $('#datepicker-multiple').datepicker({numberOfMonths: 2});

                // Time Picker
                $('#tpBasic').timepicker();
                $('#tp2').timepicker({'scrollDefault': 'now'});
                $('#tp3').timepicker();

                $('#setTimeButton').on('click', function () {
                    $('#tp3').timepicker('setTime', new Date());
                });

                // Colorpicker
                $('#colorpicker1').colorpicker();
                $('#colorpicker2').colorpicker({
                    customClass: 'colorpicker-lg',
                    sliders: {
                        saturation: {
                            maxLeft: 200,
                            maxTop: 200
                        },
                        hue: {maxTop: 200},
                        alpha: {maxTop: 200}
                    }
                });

            });
        </script>

    </body>
</html>
