<?php
$baseUrl = Yii::app()->baseUrl;
$baseUrlTheme = Yii::app()->theme->baseUrl;
$baseUrlJogador = $baseUrl . "/jogador";

$control = Yii::app()->getController()->getId();
$action = Yii::app()->getController()->getAction()->getId();


$bgCabecalho = $baseUrl . '/uploads/imagens/bgCabecalhoPagina.jpg';
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
        <title>Rabbitbet</title>
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

    <body id="myid" class="blog page-id-7 page-template page-template-template-members page-template-template-members-php logged-in admin-bar no-customize-support  single-post st_classic menustyle_classic headstyle_classic transparentmenu_no head_stickyonscroll_no footerstyle_light subheaderbg_undermenu has_topline page-members">

        <div class="top_mnu top_line">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 clearfix">
                        <div class="menu-top-right pull-right">                            
                            <?php if (Yii::app()->session["loginJogador"]) { ?>
                                <a href='<?php echo $baseUrlJogador; ?>/partidas' title='Agenda de Partidas'>
                                    <i class="fa fa-futbol-o"></i>&nbsp;&nbsp;Minhas Partidas
                                </a>
                                <a href='<?php echo $baseUrlJogador; ?>/desafios' title='Desafios Pendentes'>
                                    <i class="fa fa-crosshairs"></i>&nbsp;&nbsp;Meus Desafios
                                </a>
                                <a href=''>|</a>

                                <ul class="pull-right menuJogadorConta">
                                    <li class="dropdown user">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                            <span class="username">
                                                <i class="fa fa-user"></i>&nbsp;&nbsp;<?php echo $this->jogadorLogado->usuario; ?>
                                            </span>
                                            &nbsp;&nbsp;<i class="fa fa-angle-down"></i>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <?php //print_r(Yii::app()->session["loginJogador"]); ?>
                                            <li>
                                                <a href='<?php echo $baseUrlJogador; ?>' title='Perfil, Avaliações e Históricos'>
                                                    <i class="fa fa-cogs"></i>&nbsp;&nbsp;Minha Conta
                                                </a>
                                            </li>
                                            <li>
                                                <a href='<?php echo $baseUrlJogador; ?>/financeiro' title='Balanço Financeiro'>
                                                    <i class="fa fa-money"></i>&nbsp;&nbsp;Financeiro
                                                </a>
                                            </li>
                                            <li>
                                                <a style="border-top:1px solid #222;margin-top:10px;" href='<?php echo $baseUrlJogador; ?>/sair' title='Sair da Conta'>
                                                    <i class="fa fa-sign-out"></i>&nbsp;&nbsp;Sair
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            <?php } else { ?>
                                <a href='<?php echo $baseUrlJogador; ?>'>
                                    <i class="fa fa-key"></i>&nbsp;&nbsp;Acessar Minha Conta
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
                        <a href="<?php echo $baseUrl; ?>" class="logoRabbitbet">
                            <img src="<?php echo $baseUrlTheme; ?>/images/logorabbit.png" class="img-responsive" alt="Rabbitbet" style="height: 40px; width: 214px;" />
                        </a>

                        <div class="menu-header-container">
                            <nav>
                                <ul id="menu-header" class="navigate head_nav navigate">
                                    <li  class="menu-item menu-item-type-post_type menu-item-object-page">
                                        <a   href="<?php echo $baseUrl; ?>/global">Global</a>
                                    </li>
                                    <li  class="menu-item menu-item-type-post_type menu-item-object-page">
                                        <a   href="<?php echo $baseUrl; ?>/privado">Privado</a>
                                    </li>
                                    <li  class="menu-item menu-item-type-post_type menu-item-object-page">
                                        <a   href="<?php echo $baseUrl; ?>/torneios">Torneios</a>
                                    </li>
                                    <li id="nav-menu-item-1826" class="menu-item menu-item-type-post_type menu-item-object-page">
                                        <a   href="<?php echo $baseUrl; ?>/regras">Regras</a>
                                    </li>
                                    <li id="nav-menu-item-1807" class="menu-item menu-item-type-post_type menu-item-object-page">
                                        <a   href="<?php echo $baseUrl; ?>/comofunciona">Como Funciona</a>
                                    </li>
                                    <li id="nav-menu-item-1855" class="menu-item menu-item-type-post_type menu-item-object-page">
                                        <a   href="<?php echo $baseUrl; ?>/contato">Contato</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>

                        <a href="#" class="menu_xs">
                            <i class="fa fa-bars"></i>
                        </a>
                    </div>
                </div>
            </div>
        </header>

        <?php if ($control != 'site' || $action != 'index') { ?>
            <div data-h="555" class="heading_blog parallax-window" data-image="<?php echo $bgCabecalho; ?>" style="background-image: url(<?php echo $bgCabecalho; ?>);">
                <div class="bg_fon ">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 clearfix">

                                <?php
                                if (count($this->breadcrumbs)) {
                                    $this->widget('zii.widgets.CBreadcrumbs', array(
                                        'links' => $this->breadcrumbs,
                                        'homeLink' => (isset($this->homeUrl) ? $this->homeUrl : ''),
                                        'tagName' => 'div',
                                        'htmlOptions' => array('class' => 'nav_a_l'),
                                        'activeLinkTemplate' => '<a href="{url}">{label}</a><i class="fa fa-angle-right"></i>',
                                        'inactiveLinkTemplate' => '<a class="active">{label}</a>',
                                        'separator' => '',
                                        'actionPrefix' => '',
                                    ));
                                }
                                ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--  bg_fon -->
        <?php } ?>


        <?php echo $content; ?>


        <!-- footer -->
        <footer class="fmr_footer hidden-xs">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <h2>Disponíveis</h2>
                        <ul class="megamenu_descr megamenu_descr_one clearfix people_Wigdet">

                            <li class="clearfix">
                                <a href="#" class="clearfix">
                                    <div>
                                        <img  src="<?php echo $baseUrlTheme; ?>/images/foot-image1.png" width="60" height="60" alt="" />
                                        <p>Name</p>
                                        <p class='descr'>
                                            <span class='edited'>PS4</span> - FIFA 2015<br />
                                            <span class='edited'>Aposta: </span><b>R$20,00</b>
                                        </p>
                                    </div>
                                </a>
                            </li>

                            <li class="clearfix">
                                <a href="#" class="clearfix">
                                    <div>
                                        <img  src="<?php echo $baseUrlTheme; ?>/images/foot-image2.png" width="60" height="60" alt="" />
                                        <p>Name2</p>
                                        <p class='descr'>
                                            <span class='edited'>Xbox</span> - FIFA 2016<br />
                                            <span class='edited'>Aposta: </span><b>R$10,00</b>
                                        </p>
                                    </div>
                                </a>
                            </li>

                            <li class="clearfix">
                                <a href="#" class="clearfix">
                                    <div>
                                        <img  src="<?php echo $baseUrlTheme; ?>/images/foot-image3.jpg" width="60" height="60" alt="" />
                                        <p>SubAdmin</p>
                                        <p class='descr'>
                                            <span class='edited'>PS3</span> - FIFA 2015<br />
                                            <span class='edited'>Aposta: </span><b>R$50,00</b>
                                        </p>
                                    </div>
                                </a>
                            </li>
                        </ul>

                    </div>

                    <div class="col-md-4 col-sm-4">
                        <h2>Ranking</h2>
                        <ul class="megamenu_descr megamenu_descr_one clearfix people_Wigdet">

                            <li class="clearfix">
                                <a href="#" class="clearfix">
                                    <div>
                                        <img  src="<?php echo $baseUrlTheme; ?>/images/foot-image2.png" width="60" height="60" alt="" />
                                        <p>Name</p>
                                        <p class='descr'>
                                            <span class='edited' >Lucro: </span> <b>R$150,00</b><br />
                                            <span class='edited' >Avaliação: </span>
                                            <span class='avaliacaoStar'>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-half-empty"></i>
                                                <i class="fa fa-star-o"></i>
                                            </span>
                                        </p>
                                    </div>
                                </a>
                            </li>

                            <li class="clearfix">
                                <a href="#" class="clearfix">
                                    <div>
                                        <img  src="<?php echo $baseUrlTheme; ?>/images/foot-image3.jpg" width="60" height="60" alt="" />
                                        <p>Name2</p>
                                        <p class='descr'>
                                            <span class='edited' >Lucro: </span> <b>R$150,00</b><br />
                                            <span class='edited' >Avaliação: </span>
                                            <span class='avaliacaoStar'>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-half-empty"></i>
                                                <i class="fa fa-star-o"></i>
                                            </span>
                                        </p>
                                    </div>
                                </a>
                            </li>

                            <li class="clearfix">
                                <a href="#" class="clearfix">
                                    <div>
                                        <img src="<?php echo $baseUrlTheme; ?>/images/foot-image1.png" width="60" height="60" alt="" />
                                        <p>SubAdmin</p>
                                        <p class='descr'>
                                            <span class='edited' >Lucro: </span> <b>R$150,00</b><br />
                                            <span class='edited' >Avaliação: </span>
                                            <span class='avaliacaoStar'>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-half-empty"></i>
                                                <i class="fa fa-star-o"></i>
                                            </span>
                                        </p>
                                    </div>
                                </a>
                            </li>
                        </ul>

                    </div>
                    <div class="col-md-4 col-sm-4">
                        <h2>Atendimento</h2>
                        <div class="textwidget">
                            <b>Tel:</b>
                            1234 - 5678 - 9010
                            <br> <b>Email:</b>
                            i448539@gmail.com
                            <br>
                            <b>Working Hours:</b>
                            8:00 a.m - 17:00 a.m
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </footer>


        <div id="areaChat">
            <div class="chat_box">
                <div class="chat_head"> Chat Box</div>
                <div class="chat_body"> 
                    <div class="user">
                        <a href="javascript:register_popup('narayan-prusty', 'Narayan Prusty');">
                            Krishna Teja
                        </a>
                    </div>
                    <div class="user">
                        <a href="javascript:register_popup('teste-2', 'Teste 2');">
                            Teste 2
                        </a>
                    </div>
                </div>
            </div>

        </div>


        <script type='text/javascript' src='<?php echo $baseUrlTheme; ?>/js/jquery/jquery.js'></script>
        <script type='text/javascript' src='<?php echo $baseUrlTheme; ?>/js/jquery/jquery.maskMoney.min.js'></script>
        <script type='text/javascript' src='<?php echo $baseUrlTheme; ?>/js/ion.rangeSlider.js'></script>
        <script type='text/javascript' src='<?php echo $baseUrlTheme; ?>/js/bootstrap.min.js'></script>
        <script type='text/javascript' src='<?php echo $baseUrlTheme; ?>/js/jquery.masonry.js'></script>
        <script type='text/javascript' src='<?php echo $baseUrlTheme; ?>/js/ladda.min.js'></script>
        <script type='text/javascript' src='<?php echo $baseUrlTheme; ?>/js/owl.carousel.min.js'></script>
        <script type='text/javascript' src='<?php echo $baseUrlTheme; ?>/js/common.js'></script>
        <script>
            jQuery(document).ready(function() {
                jQuery('[data-toggle="tooltip"]').tooltip();
                jQuery('input:not([type="submit"]), select, textarea:not([class~="note-codable"])').addClass('form-control');
            });
        </script>
        
        
        <script>
            //this function can remove a array element.
            Array.remove = function(array, from, to) {
                var rest = array.slice((to || from) + 1 || array.length);
                array.length = from < 0 ? array.length + from : from;
                return array.push.apply(array, rest);
            };
        
            //this variable represents the total number of popups can be displayed according to the viewport width
            var total_popups = 0;
            
            //arrays of popups ids
            var popups = [];
        
            //this is used to close a popup
            function close_popup(id)
            {
                for(var iii = 0; iii < popups.length; iii++)
                {
                    if(id == popups[iii])
                    {
                        Array.remove(popups, iii);
                        
                        document.getElementById(id).style.display = "none";
                        
                        calculate_popups();
                        
                        return;
                    }
                }   
            }
        
            //displays the popups. Displays based on the maximum number of popups that can be displayed on the current viewport width
            function display_popups()
            {
                var right = 280;
                
                var iii = 0;
                for(iii; iii < total_popups; iii++)
                {
                    if(popups[iii] != undefined)
                    {
                        var element = document.getElementById(popups[iii]);
                        element.style.right = right + "px";
                        right = right + 270;
                        element.style.display = "block";
                    }
                }
                
                for(var jjj = iii; jjj < popups.length; jjj++)
                {
                    var element = document.getElementById(popups[jjj]);
                    element.style.display = "none";
                }
            }
            
            //creates markup for a new popup. Adds the id to popups array.
            function register_popup(id, name)
            {
                
                for(var iii = 0; iii < popups.length; iii++)
                {   
                    //already registered. Bring it to front.
                    if(id == popups[iii])
                    {
                        Array.remove(popups, iii);
                    
                        popups.unshift(id);
                        
                        calculate_popups();
                        
                        
                        return;
                    }
                }               
                
                var element = '<div class="popup-box chat-popup" id="'+ id +'">';
                element = element + '<div class="popup-head">';
                element = element + '<div class="popup-head-left">'+ name +'</div>';
                element = element + '<div class="popup-head-right"><a href="javascript:close_popup(\''+ id +'\');">&#10005;</a></div>';
                element = element + '<div style="clear: both"></div></div><div class="popup-messages"></div>';
                element = element + '<div class="msg_footer"><textarea class="msg_input" rows="4"></textarea></div></div>';
               
                document.getElementsByTagName("body")[0].innerHTML = document.getElementsByTagName("body")[0].innerHTML + element;  
        
                popups.unshift(id);
                        
                calculate_popups();
                
            }
            
            //calculate the total number of popups suitable and then populate the toatal_popups variable.
            function calculate_popups()
            {
                var width = window.innerWidth;
                if(width < 540)
                {
                    total_popups = 0;
                }
                else
                {
                    width = width - 200;
                    //320 is width of a single popup box
                    total_popups = parseInt(width/270);
                }
                
                display_popups();
                
            }
            
            //recalculate when window is loaded and also when window is resized.
            window.addEventListener("resize", calculate_popups);
            window.addEventListener("load", calculate_popups);
            
        </script>
    </body>
</html>