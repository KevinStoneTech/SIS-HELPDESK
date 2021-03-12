<?php
require "versession.php";
include "conexao.php";
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
                        <li><a href="#">Dados Auxiliares</a></li>
                        <li class="active">Serviços</li>
                    </ol>
                    <div class="row">
                        <form id="basicForm" action="cad_servico.php" class="form-horizontal" method="post">
                            <div class="col-md-4">
                                <div class="panel">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">Serviços</h4>
                                    </div>
                                    <div class="panel-body">
                                        <div class="col-md-12">
                                            <div class="form-group mb20">
                                                <input type="text" name="servico" maxlength="50" placeholder="Serviço" class="form-control" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="panel-body">
                                                <div class="btn-demo">
                                                    <button class="btn btn-warning btn-primary btn-quirk mr5">Gravar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- panel-body -->

                                </div><!-- panel -->
                            </div>
                            <div class="col-md-8">
                                <div class="panel">
                                    <div class="panel-heading">                                        
                                        <h4 class="panel-title">Serviços já cadastrados</h4>                                        
                                    </div>
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <table id="dataTable1" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Serviço</th>
                                                        <th>Solicitados</th>                                                        
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Serviço</th>
                                                        <th>Solicitados</th>                                                       
                                                    </tr>
                                                </tfoot>
                                                <tbody>
                                                    <?php
                                                    $pdo = conectar("helpdesk");
                                                    $filtro = $pdo->prepare("SELECT * FROM servico");
                                                    $filtro->execute();
                                                    while ($reg2 = $filtro->fetch(PDO::FETCH_ASSOC)) :
                                                        /* Para recuperar um ARRAY utilize PDO::FETCH_ASSOC */
                                                        echo("<tr>");
                                                        echo("<td>" . $reg2['id'] . "</td>");
                                                        echo("<td>" . $reg2['servico'] . "</td>");
                                                        echo("<td>" . $reg2['qtdservico'] . "</td>");
                                                        echo("</tr>");
                                                    endwhile;
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div><!-- panel -->
                            </div>
                        </form>
                    </div><!-- row -->
                    <div class="row">
                        
                    </div>
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
