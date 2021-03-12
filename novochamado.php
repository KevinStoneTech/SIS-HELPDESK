<?php
require "versession.php";
include "conexao.php";
$pdo = conectar("helpdesk");
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
                        <li class="active">Abertura de Chamados</li>
                    </ol>
                    <div class="row">
                        <form role="form" method="post" action="cad_chamado.php" enctype="multipart/form-data">
                            <div class="col-sm-8">
                                <div class="panel">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">Abertura de Chamados</h4>
                                        <p>Preencha o formulário abaixo de forma mais clara possível para que possamos atendê-lo da maneira mais eficiente.</p>
                                    </div>
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <select id="select1" class="form-control" name="servico" style="width: 100%" data-placeholder="Escolha o tipo de serviço" required>
                                                <option value="">&nbsp;</option>
                                                <?php
                                                $consulta6 = $pdo->prepare("SELECT * FROM servico ORDER BY servico ASC");
                                                $consulta6->execute();
                                                while ($reg = $consulta6->fetch(PDO::FETCH_ASSOC)) :
                                                    /* Para recuperar um ARRAY utilize PDO::FETCH_ASSOC */
                                                    echo("<option value=" . $reg['id'] . ">" . $reg['servico'] . "</option>");
                                                endwhile;
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <input name="assunto" class="form-control" type="text" placeholder="Assunto" required>
                                        </div>
                                        <div class="form-group">
                                            <textarea name="chamado" id="autosize" class="form-control" rows="4" placeholder="Motivo do chamado." required></textarea>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <select id="select1" class="form-control" name="secao" style="width: 100%" data-placeholder="Seção/Subunidade" required>
                                                        <option value="">&nbsp;</option>
                                                        <?php
                                                        $consulta = $pdo->prepare("SELECT * FROM secao ORDER BY secao ASC");
                                                        $consulta->execute();
                                                        while ($reg1 = $consulta->fetch(PDO::FETCH_ASSOC)) :
                                                            /* Para recuperar um ARRAY utilize PDO::FETCH_ASSOC */
                                                            echo("<option value=" . $reg1['id'] . ">" . $reg1['secao'] . "</option>");
                                                        endwhile;
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <select id="select1" class="form-control" name="etiqueta" style="width: 100%" data-placeholder="Número da Etiqueta do Computador" required>
                                                        <option value="">&nbsp;</option>
                                                        <?php
                                                        $consulta2 = $pdo->prepare("SELECT * FROM etiqueta ORDER BY numero ASC");
                                                        $consulta2->execute();
                                                        echo("<option value= '0'>Não é o caso</option>");
                                                        while ($reg2 = $consulta2->fetch(PDO::FETCH_ASSOC)) :
                                                            /* Para recuperar um ARRAY utilize PDO::FETCH_ASSOC */
                                                            echo("<option value=" . $reg2['id'] . ">" . $reg2['numero'] . "</option>");
                                                        endwhile;
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <hr class="invisible">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">                                                    
                                                    <input name="arquivo" type="file"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- panel -->
                            </div><!-- col-sm-6 -->
                            <!-- ####################################################### -->
                            <div class="col-sm-4">
                                <div class="panel">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">Solicitante:</h4>
                                        <p><?php echo($_SESSION['user_pgradsimpleshd'] . " " . $_SESSION['user_guerrahd'] . " (ID:" . $_SESSION['user_idhd'] . ")"); ?></p>
                                    </div>
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
