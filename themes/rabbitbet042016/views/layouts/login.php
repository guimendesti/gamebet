<?php
$baseUrl = Yii::app()->baseUrl;
$baseUrlTheme = Yii::app()->theme->baseUrl;

$control = Yii::app()->getController()->getId();
$action = Yii::app()->getController()->getAction()->getId();
?>
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
        <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; minimum-scale=1.0; user-scalable=no; target-densityDpi=device-dpi;" />
        <link href='https://fonts.googleapis.com/css?family=Ubuntu:400,500,300,300italic,400italic&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Rabbitbet - Autenticação</title>
        <link rel='stylesheet' id='fmr_bootstrap-css'  href='<?php echo $baseUrlTheme; ?>/css/bootstrap.min.css' type='text/css' media='all' />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <link rel='stylesheet' id='fmr_bootstrap-tokenfield-css'  href='<?php echo $baseUrlTheme; ?>/css/bootstrap-tokenfield.min.css' type='text/css' media='all' />
        <link rel='stylesheet' id='fmr_lada_css-css'  href='<?php echo $baseUrlTheme; ?>/css/ladda.min.css' type='text/css' media='all' />
        <link rel='stylesheet' id='fmr_owl_css-css'  href='<?php echo $baseUrlTheme; ?>/css/owl.carousel.css' type='text/css' media='all' />
        <link rel='stylesheet' id='fmr_owl_theme-css'  href='<?php echo $baseUrlTheme; ?>/css/owl.theme.css' type='text/css' media='all' />
        <link rel='stylesheet' id='fmr_fonts_icon-css'  href='<?php echo $baseUrlTheme; ?>/css/style.css' type='text/css' media='all' />




        <link rel='stylesheet' id='fmr_is_admin-css'  href='<?php echo $baseUrlTheme; ?>/css/media.css' type='text/css' media='all' />
        <link rel='stylesheet' id='fmr_animate-css'  href='<?php echo $baseUrlTheme; ?>/css/animate.css' type='text/css' media='all' />

        <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


    </head>

    <body id="myid" class="authorization-page page-id-7 page-template page-template-template-members page-template-template-members-php logged-in admin-bar no-customize-support  single-post st_classic menustyle_classic headstyle_classic transparentmenu_no head_stickyonscroll_no footerstyle_light subheaderbg_undermenu has_topline page-members">

        <?php echo $content; ?>


        <script type='text/javascript' src='<?php echo $baseUrlTheme; ?>/js/jquery/jquery.js'></script>
        <script type='text/javascript' src='<?php echo $baseUrlTheme; ?>/js/ion.rangeSlider.js'></script>
        <script type='text/javascript' src='<?php echo $baseUrlTheme; ?>/js/bootstrap.min.js'></script>
        <script type='text/javascript' src='<?php echo $baseUrlTheme; ?>/js/bootstrap-tagsinput.min.js'></script>
        <script type='text/javascript' src='<?php echo $baseUrlTheme; ?>/js/jquery.masonry.js'></script>
        <script type='text/javascript' src='<?php echo $baseUrlTheme; ?>/js/ladda.min.js'></script>
        <script type='text/javascript' src='<?php echo $baseUrlTheme; ?>/js/owl.carousel.min.js'></script>
        <script type='text/javascript' src='<?php echo $baseUrlTheme; ?>/js/bootstrap-select.js'></script>
        <script type='text/javascript' src='<?php echo $baseUrlTheme; ?>/js/bootstrap-tokenfield.min.js'></script>
        <script type='text/javascript' src='<?php echo $baseUrlTheme; ?>/js/common.js'></script>

    </body>
</html>


