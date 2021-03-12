<?php
require "versession.php";
?>
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <?php
        include "tags.php";
        ?>
        <meta http-equiv="refresh" content="600">
        <link rel="stylesheet" href="lib/fontawesome/css/font-awesome.css">
        <link rel="stylesheet" href="lib/weather-icons/css/weather-icons.css">
        <link rel="stylesheet" href="lib/jquery-toggles/toggles-full.css">
        <link rel="stylesheet" href="lib/jquery-ui/jquery-ui.css">
        <link rel="stylesheet" href="lib/Hover/hover.css">
        <link rel="stylesheet" href="lib/ionicons/css/ionicons.css">
        <link rel="stylesheet" href="lib/morrisjs/morris.css">
        <link rel="stylesheet" href="css/quirk.css">
        <script src="lib/modernizr/modernizr.js"></script>
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
                    <!-- ################## LEFT PANEL PROFILE ################## -->
                    <?php
                    include "leftpanel.php";
                    include "menu.php";
                    ?>                    
                </div><!-- leftpanelinner -->
            </div><!-- leftpanel -->
            <div class="mainpanel">
                <div class="col-md-8">
                </div>
                <div class="col-md-4">
                </div>                
            </div><!-- contentpanel -->
        </section>
        <script src="lib/jquery/jquery.js"></script>
        <script src="lib/jquery-ui/jquery-ui.js"></script>
        <script src="lib/bootstrap/js/bootstrap.js"></script>
        <script src="lib/jquery-toggles/toggles.js"></script>
        <script src="lib/jquery-autosize/autosize.js"></script>
        <script src="lib/select2/select2.js"></script>
        <script src="lib/jquery-maskedinput/jquery.maskedinput.js"></script>
        <script src="lib/timepicker/jquery.timepicker.js"></script>
        <script src="lib/dropzone/dropzone.js"></script>
        <script src="lib/bootstrapcolorpicker/js/bootstrap-colorpicker.js"></script>
        <script src="js/quirk.js"></script>

        <script>
            $(function () {
                var loadScriptTime = (new Date).getTime()
                $('#datepicker-inline').datepicker();
            });
        </script>
    </body>
</html>
