<div class="media leftpanel-profile">
    <div class="media-left">
        <img src="images/helpdesk.png" alt="" class="media-object img-circle">
    </div>
    <div class="media-body">
        <h4 class="media-heading">2º Batalhão de Fronteira<a data-toggle="collapse" data-target="#loguserinfo" class="pull-right"><i class="fa fa-angle-down"></i></a></h4>
        <span>Cáceres - MT</span>
    </div>
</div><!-- leftpanel-profile -->

<div class="leftpanel-userinfo collapse" id="loguserinfo">
    <h5 class="sidebar-title">DESENVOLVEDOR</h5>
    <address>
        2º Sgt Francês
    </address>
    <h5 class="sidebar-title">Dados de Acesso</h5>
    <ul class="list-group">
        <li class="list-group-item">
            <label class="pull-left">Usuário:</label>
            <span class="pull-right"><?php echo($_SESSION['user_pgradsimpleshd']." ".$_SESSION['user_guerrahd']); ?></span>
        </li>
        <li class="list-group-item">
            <label class="pull-left">Tipo de Acesso:</label>
            <span class="pull-right"><?php echo($_SESSION['user_tipocontahd']); ?></span>
        </li>
        <li class="list-group-item">
            <label class="pull-left">IP</label>
            <span class="pull-right"><?php echo($ip); ?></span>
        </li>
        <li class="list-group-item">
            <label class="pull-left">HOST</label>
            <span class="pull-right"><?php echo($user[1]); ?></span>
        </li>        
    </ul>
</div><!-- leftpanel-userinfo -->
