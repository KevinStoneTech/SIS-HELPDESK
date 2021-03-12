<?php ?>
<div class="tab-content">
    <!-- ################# MAIN MENU ################### -->
    <div class="tab-pane active" id="mainmenu">
        <ul class="nav nav-pills nav-stacked nav-quirk">
            <li class="nav-parent">
                <a href=""><i class="fa fa-ticket"></i> <span>Chamados</span></a>
                <ul class="children active">
                    <li>
                        <a href="novochamado.php">Abertura de chamado</a>
                    </li>
                    <li>
                        <a href="meuschamados.php">Meus chamados</a>
                    </li>
                    <?php
                    if ($_SESSION['user_numcontahd'] == "3") {                        
                        ?>
                        <li>
                            <a href="todoschamados.php?ref=0">Chamados Abertos</a>
                        </li>
                        <li>
                            <a href="todoschamados.php?ref=3">Chamados Finalizados</a>
                        </li>
                    <?php }
                    ?>
                </ul>
            </li>
            <?php
            if ($_SESSION['user_numcontahd'] == "3") {
                ?>
                <li class="nav-parent">
                    <a href=""><i class="fa fa-gears"></i> <span>Dados Auxiliares</span></a>
                    <ul class="children">
                        <li>
                            <a href="sistoper.php">Sistemas Operacionais</a>
                        </li>
                        <li>
                            <a href="etiquetasti.php">Etiquetas STI</a>
                        </li>
                        <li>
                            <a href="ip.php">IP</a>
                        </li>
                        <li>
                            <a href="servicos.php">Serviços</a>
                        </li>
                        <li>
                            <a href="">Item</a>
                        </li>
                        <li>
                            <a href="">Material</a>
                        </li>
                        <li>
                            <a href="secoes.php">Seções</a>
                        </li>
                    </ul>
                </li>
            <?php }
            ?>
            <li class="nav">
                <a href="logout.php"><i class="fa fa-power-off"></i> <span>Sair do Sistema</span></a>
            </li>
        </ul>
    </div><!-- tab-pane -->
</div><!-- tab-content -->