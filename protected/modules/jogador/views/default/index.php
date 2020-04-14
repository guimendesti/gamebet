<?php
$baseUrl = Yii::app()->baseUrl;
$baseUrlTheme = Yii::app()->theme->baseUrl;
?>

<div class="middle_content">
    <div class="container">
        <div class="row minhaConta">
            <?php $this->renderPartial('application.modules.jogador.views.default.colunaConta'); ?>

            <div class="col-md-9 col-sm-8 col-xs-7">

                <div class="row bloco_conteudo">
                    <h5>Dados Pessoais</h5>

                    <?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
                </div>

                <div class="row bloco_conteudo blocoEstatistica">
                    <h5>Estatísticas</h5>
                    
                    <div class="row">
                        <div class="col-md-3 col-sm-3 col-xs-6">
                            <div class="btn btn-lg btn-info">28</div>
                            <br />Partidas
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-6">
                            <div class="btn btn-lg btn-success">22</div>
                            <br />Vitórias
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-6">
                            <div class="btn btn-lg btn-primary">8</div>
                            <br />Torneios
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-6">
                            <div class="btn btn-lg btn-warning">2</div>
                            <br />1º Lugar
                        </div>
                    </div>
                    
                </div>
                
                <br />
                <br />
                <div class="row">
                    <div class="col-md-4 col-sm-4 bloco_conteudo">

                        <h5 style="margin-bottom: 10px;">Últimos Desafios</h5>
                        <ul class="side_bar_list liLink">
                            <li>
                                <a href="#">
                                    <img src="<?php echo $baseUrlTheme; ?>/images/foot-image2.png" class="imgJog" width="60" height="60" alt="" />
                                    Jogador X<br />
                                    <small>PS4 - FIFA 2016<br />R$</small>
                                    15,00 <small>(10/05/2016)</small>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="<?php echo $baseUrlTheme; ?>/images/foot-image1.png" class="imgJog" width="60" height="60" alt="" />
                                    Jogador X<br />
                                    <small>PS4 - FIFA 2015<br />R$</small>
                                    40,00 <small>(10/05/2016)</small>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="<?php echo $baseUrlTheme; ?>/images/foot-image1.png" class="imgJog" width="60" height="60" alt="" />
                                    Jogador X<br />
                                    <small>PS4 - FIFA 2015<br />R$</small>
                                    40,00 <small>(10/05/2016)</small>
                                </a>
                            </li>
                            <li class="verMais">
                                <a href="#">
                                    Ver Todos Desafios&nbsp;
                                    <i class="fa fa-angle-double-right"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-4 col-sm-4 bloco_conteudo">
                        <h5 style="margin-bottom: 10px;">Últimas Partidas</h5>
                        <ul class="side_bar_list liLink">
                            <!--
                            <li>
                                <a href="#">
                                    <img src="<?php echo $baseUrlTheme; ?>/images/foot-image1.png" class="imgJog" width="60" height="60" alt="" />
                                    Jogador X<br />
                                    <small>PS4 - FIFA 2016</small><br />
                                    <span class='label label-primary placar'>Aguardando</span>
                                </a>
                            </li>
                            -->
                            <li>
                                <a href="#">
                                    <img src="<?php echo $baseUrlTheme; ?>/images/foot-image2.png" class="imgJog" width="60" height="60" alt="" />
                                    Jogador X<br />
                                    <small>PS4 - FIFA 2016</small><br />
                                    <span class='label label-success placar'>3 x 0</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="<?php echo $baseUrlTheme; ?>/images/foot-image1.png" class="imgJog" width="60" height="60" alt="" />
                                    Jogador X<br />
                                    <small>PS4 - FIFA 2016</small><br />
                                    <span class='label label-default placar'>1 x 1</span>
                                </a>
                            </li>
                            <!--
                            <li>
                                <a href="#">
                                    <img src="<?php echo $baseUrlTheme; ?>/images/foot-image3.jpg" class="imgJog" width="60" height="60" alt="" />
                                    Jogador X<br />
                                    <small>PS4 - FIFA 2016</small><br />
                                    <span class='label label-warning placar'>Moderação</span>
                                </a>
                            </li>
                            -->
                            <li>
                                <a href="#">
                                    <img src="<?php echo $baseUrlTheme; ?>/images/foot-image2.png" class="imgJog" width="60" height="60" alt="" />
                                    Jogador X<br />
                                    <small>PS4 - FIFA 2016</small><br />
                                    <span class='label label-danger placar'>2 x 1</span>
                                </a>
                            </li>
                            <li class="verMais">
                                <a href="#">
                                    Ver Todas Partidas&nbsp;
                                    <i class="fa fa-angle-double-right"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-4 col-sm-4 bloco_conteudo">

                        <h5 style="margin-bottom: 10px;">Últimas Avaliações</h5>
                        <ul class="side_bar_list liLink">
                            <li>
                                <a href="#">
                                    <img src="<?php echo $baseUrlTheme; ?>/images/foot-image1.png" class="imgJog" width="60" height="60" alt="" />
                                    Jogador X<br />
                                    <small>PS4 - FIFA 2016</small>
                                    <br />
                                    <span style="color:#DDA309;padding-left: 5px;">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-half-empty"></i>
                                        <i class="fa fa-star-o"></i>
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="<?php echo $baseUrlTheme; ?>/images/foot-image2.png" class="imgJog" width="60" height="60" alt="" />
                                    Jogador X<br />
                                    <small>PS4 - FIFA 2016</small>
                                    <br />
                                    <span style="color:#DDA309;padding-left: 5px;">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-half-empty"></i>
                                        <i class="fa fa-star-o"></i>
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="<?php echo $baseUrlTheme; ?>/images/foot-image1.png" class="imgJog" width="60" height="60" alt="" />
                                    Jogador X<br />
                                    <small>PS4 - FIFA 2016</small>
                                    <br />
                                    <span style="color:#DDA309;padding-left: 5px;">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-half-empty"></i>
                                        <i class="fa fa-star-o"></i>
                                    </span>
                                </a>
                            </li>
                            <li class="verMais">
                                <a href="#">
                                    Ver Todas Avaliações&nbsp;
                                    <i class="fa fa-angle-double-right"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>