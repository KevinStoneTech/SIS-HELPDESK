<?php
session_start();
$sistema = base64_encode("SISTEMA HELP DESK");
$_SESSION['sistemahd'] = base64_decode($sistema);
$token = base64_decode(filter_input(INPUT_GET, "token"));
?>
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <?php
        include "tags.php";
        ?>
        <!--<link rel="shortcut icon" href="../images/favicon.png" type="image/png">-->
        <title>Help Desk</title>
        <link rel="stylesheet" href="lib/fontawesome/css/font-awesome.css">
        <link rel="stylesheet" href="css/quirk.css">
        <script src="lib/modernizr/modernizr.js"></script>
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="lib/html5shiv/html5shiv.js"></script>
        <script src="lib/respond/respond.src.js"></script>
        <![endif]-->
    </head>
    <body class="signwrapper">
        <div class="sign-overlay"></div>
        <div class="signpanel"></div>
        <div class="panel signin">
            <div class="panel-heading">
                <h1>Sistema Help Desk</h1>
                <h4 class="panel-title text-warning">2º Batalhão de Fronteira</h4>
                <?php
                if ($token <> "") {
                    echo("<h4 class='panel-body text-danger text-center'>" . $token . "</h4>");
                }
                ?>
            </div>            
            <div class="panel-body">                
                <form action="chkpass.php" method="post">
                    <div class="form-group mb10">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input type="text" name="login" class="form-control" placeholder="Usuário" required>
                        </div>
                    </div>
                    <div class="form-group nomargin">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input type="password" name="senha" class="form-control" placeholder="Senha" required>
                        </div>
                    </div>
                    <hr class="invisible">
                    <div class="form-group">
                        <button class="btn btn-success btn-quirk btn-block">Acessar o Sistema</button>
                    </div>
                </form>                
            </div>
        </div><!-- panel -->
    </body>
</html>
