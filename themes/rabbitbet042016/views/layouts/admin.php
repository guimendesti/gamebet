<?php
$baseUrl = Yii::app()->baseUrl;
$baseUrlTheme = Yii::app()->theme->baseUrl;
$baseUrlAdmin = Yii::app()->controller->module->baseUrl;

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
        <title>Administração Rabbitbet</title>
        <link rel='stylesheet' id='fmr_bootstrap-css'  href='<?php echo $baseUrlTheme; ?>/css/bootstrap.min.css' type='text/css' media='all' />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <link rel='stylesheet' id='fmr_bootstrap-tokenfield-css'  href='<?php echo $baseUrlTheme; ?>/css/bootstrap-tokenfield.min.css' type='text/css' media='all' />
        <link rel='stylesheet' id='fmr_lada_css-css'  href='<?php echo $baseUrlTheme; ?>/css/ladda.min.css' type='text/css' media='all' />
        <link rel='stylesheet' id='fmr_owl_css-css'  href='<?php echo $baseUrlTheme; ?>/css/owl.carousel.css' type='text/css' media='all' />
        <link rel='stylesheet' id='fmr_owl_theme-css'  href='<?php echo $baseUrlTheme; ?>/css/owl.theme.css' type='text/css' media='all' />
        <link rel='stylesheet' id='fmr_fonts_icon-css'  href='<?php echo $baseUrlTheme; ?>/css/style.css' type='text/css' media='all' />
        <style id='fmr_css_php-inline-css' type='text/css'></style>

        <link rel='stylesheet' id='fmr_is_admin-css'  href='<?php echo $baseUrlTheme; ?>/css/media.css' type='text/css' media='all' />
        <link rel='stylesheet' id='fmr_animate-css'  href='<?php echo $baseUrlTheme; ?>/css/animate.css' type='text/css' media='all' />

        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>

    <body id="myid" style='min-width: 450px;' class="layoutAdmin blog page-id-7 page-template page-template-template-members page-template-template-members-php logged-in admin-bar no-customize-support  single-post st_classic menustyle_classic headstyle_classic transparentmenu_no head_stickyonscroll_no footerstyle_light subheaderbg_undermenu has_topline page-members">


        <div class="top_mnu top_line">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 clearfix">
                        <div class="menu-top-right pull-right">
                            <?php if (Yii::app()->session["loginAdmin"] && $control != "site") { ?>

                                <a href='<?php echo $baseUrlAdmin; ?>/administradores'>
                                    <i class="fa fa-key"></i>&nbsp;&nbsp;Administradores
                                </a>
                                <a href='<?php echo $baseUrlAdmin; ?>/paginas'>
                                    <i class="fa fa-file-text"></i>&nbsp;&nbsp;Páginas
                                </a>
                                <a href=''>&nbsp;&nbsp;|&nbsp;&nbsp;</a>
                                <a href='<?php echo $baseUrlAdmin; ?>/sair'>
                                    <i class="fa fa-sign-out"></i>&nbsp;&nbsp;Sair do Painel
                                </a>
                            <?php } else { ?>
                                <a href='#' style="cursor: default;">
                                    <i class="fa fa-key"></i>&nbsp;&nbsp;Autenticação Obrigatória
                                </a>
                            <?php } ?>&nbsp;
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- header -->

        <div class="heading-opacity"></div>
        <header>
            <div class="overlay">
                <a href="#">
                    <i class="fa fa-times"></i>
                </a>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12 clearfix map_header">
                        <a href="#" class="menu_xs">
                            <i class="fa fa-bars"></i>
                        </a>
                        <a href="/" class="logo" style="width: 150px;">
                            <img src="<?php echo $baseUrlTheme; ?>/images/logorabbitRB.png" class="img-responsive" alt="Rabbitbet" 
                                 style="height: 40px; width: 54px; display:inline; margin-right: 5px; vertical-align: top;" />
                            ADM
                        </a>


                        <div class="menu-header-container">
                            <nav>
                                <?php if (Yii::app()->session["loginAdmin"] && $control != "site") { ?>
                                    <ul id="menu-header" class="navigate head_nav navigate">
                                        <li class="menu-item menu-item-type-post_type menu-item-object-page">
                                            <a href="<?php echo $baseUrlAdmin; ?>/partidas">
                                                <i class="fa fa-futbol-o"></i>&nbsp;&nbsp;Partidas
                                            </a>
                                        </li>
                                        <li  class="menu-item menu-item-type-post_type menu-item-object-page">
                                            <a href="<?php echo $baseUrlAdmin; ?>/desafios">
                                                <i class="fa fa-crosshairs"></i>&nbsp;&nbsp;Desafios
                                            </a>
                                        </li>
                                        <li class="menu-item menu-item-type-post_type menu-item-object-page">
                                            <a href="<?php echo $baseUrlAdmin; ?>/jogadores">
                                                <i class="fa fa-users"></i>&nbsp;&nbsp;Jogadores
                                            </a>
                                        </li>
                                        <li id="nav-menu-item-1823" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children">
                                            <a href="#">
                                                <i class="fa fa-money"></i>&nbsp;&nbsp;Financeiro
                                            </a>
                                            <ul class="sub-menu menu-odd  menu-depth-1">
                                                <li class="menu-item menu-item-type-post_type menu-item-object-page">
                                                    <a href="<?php echo $baseUrlAdmin; ?>/saques">
                                                        <i class="fa fa-download"></i>&nbsp;&nbsp;Saques
                                                    </a>
                                                </li>
                                                <li class="menu-item menu-item-type-post_type menu-item-object-page">
                                                    <a href="<?php echo $baseUrlAdmin; ?>/creditos">
                                                        <i class="fa fa-credit-card"></i>&nbsp;&nbsp;Créditos
                                                    </a>
                                                </li>
                                                <li class="menu-item menu-item-type-post_type menu-item-object-page">
                                                    <a href="<?php echo $baseUrlAdmin; ?>/comissoes">
                                                        <i class="fa fa-percent"></i>&nbsp;&nbsp;Comissões
                                                    </a>
                                                </li>
                                                <li class="menu-item menu-item-type-post_type menu-item-object-page">
                                                    <a href="<?php echo $baseUrlAdmin; ?>/movimentacoes">
                                                        <i class="fa fa-list-ol"></i><small>&nbsp;&nbsp;Movimentações</small>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li id="nav-menu-item-1823" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children">
                                            <a href="#">
                                                <i class="fa fa-cogs"></i>&nbsp;&nbsp;Administrar
                                            </a>
                                            <ul class="sub-menu menu-odd  menu-depth-1">
                                                <li class="menu-item menu-item-type-post_type menu-item-object-page">
                                                    <a href="<?php echo $baseUrlAdmin; ?>/consoles">
                                                        <i class="fa fa-shield"></i>&nbsp;&nbsp;Consoles
                                                    </a>
                                                </li>
                                                <li class="menu-item menu-item-type-post_type menu-item-object-page">
                                                    <a href="<?php echo $baseUrlAdmin; ?>/games">
                                                        <i class="fa fa-puzzle-piece"></i>&nbsp;&nbsp;Games
                                                    </a>
                                                </li>
                                                <li class="menu-item menu-item-type-post_type menu-item-object-page">
                                                    <a href="<?php echo $baseUrlAdmin; ?>/torneios">
                                                        <i class="fa fa-sitemap"></i>&nbsp;&nbsp;Torneios
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                <?php } ?>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </header>



        <div class="middle_content">
            <div class="container">
                <?php echo $content; ?>
            </div>
        </div>



        <!-- footer -->
        <footer class="fmr_footer">
            <div class="container">
                <div class="row" style="text-align: right;">

                </div>
            </div>
        </footer>

        <script type='text/javascript' src='<?php echo $baseUrlTheme; ?>/js/jquery/jquery.js'></script>
        <script type='text/javascript' src='<?php echo $baseUrlTheme; ?>/js/jquery/jquery.maskMoney.min.js'></script>
        <script type='text/javascript' src='<?php echo $baseUrlTheme; ?>/js/ion.rangeSlider.js'></script>
        <script type='text/javascript' src='<?php echo $baseUrlTheme; ?>/js/bootstrap.min.js'></script>
        <script type='text/javascript' src='<?php echo $baseUrlTheme; ?>/js/bootstrap-tagsinput.min.js'></script>
        <script type='text/javascript' src='<?php echo $baseUrlTheme; ?>/js/jquery.masonry.js'></script>
        <script type='text/javascript' src='<?php echo $baseUrlTheme; ?>/js/ladda.min.js'></script>
        <script type='text/javascript' src='<?php echo $baseUrlTheme; ?>/js/owl.carousel.min.js'></script>
        <script type='text/javascript' src='<?php echo $baseUrlTheme; ?>/js/bootstrap-select.js'></script>
        <script type='text/javascript' src='<?php echo $baseUrlTheme; ?>/js/bootstrap-tokenfield.min.js'></script>
        <script type='text/javascript' src='<?php echo $baseUrlTheme; ?>/js/common.js'></script>

        <script>
            // Todos campos de formulário com "form-control"
            jQuery(document).ready(function() {
                jQuery('input:not([type="submit"]), select, textarea:not([class~="note-codable"])').addClass('form-control');
            });
        </script>
    </body>
</html>