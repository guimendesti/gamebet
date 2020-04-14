<?php
$baseUrl = Yii::app()->baseUrl;
$baseUrlTheme = Yii::app()->theme->baseUrl;

$idjogador = $this->jogadorLogado->idjogador;
?>

<div class="middle_content">
    <div class="container">
        <div class="row">
            <?php $this->renderPartial('application.modules.jogador.views.default.colunaConta'); ?>
            
            <div class='col-md-9 col-sm-8 col-xs-7'>

                <div class="blocoDesafiar">
                    <h3><i class="fa fa-sitemap"></i>&nbsp;&nbsp;Filtrar Torneios</h3>
                    
                    <?php
                    $form = $this->beginWidget('CActiveForm', array(
                        'id' => 'torneioFiltro',
                        'enableAjaxValidation' => false,
                    ));
                    ?>

                    <div class="row">
                        <div class="col-md-5 col-sm-5">
                            <?php echo $form->labelEx($torneioFiltro, 'idconsole'); ?>
                            <br />
                            <?php
                            $consoles = $this->listaConsoles();
                            $numC = count($consoles);
                            if ($numC <= 0) {
                                $consoles = array(0 => 'Cadastre um console ativo');
                            } else {
                                $consoles = array('' => 'Selecione ...') + $consoles;
                            }
                            echo $form->dropDownList($torneioFiltro, 'idconsole', $consoles, array('style' => 'width:100%;', 'class' => 'form-control',
                                'onchange' => "$('#" . CHtml::activeId($torneioFiltro, 'idgame') . "').html('<option value=\'0\'>Aguarde ...</option>')",
                                'ajax' => array(
                                    'type' => 'POST',
                                    'url'=>CController::createUrl('torneios/listaGamesConsole'),
                                    'update' => '#' . CHtml::activeId($torneioFiltro, 'idgame')
                                )
                            ));
                            ?>
                            <?php echo $form->error($torneioFiltro, 'idconsole'); ?>
                        </div>

                        <div class="col-md-5 col-sm-5">
                            <?php echo $form->labelEx($torneioFiltro, 'idgame'); ?>
                            <br />
                            <?php
                            $games = array('' => 'Selecione um console');
                            if (isset($torneioFiltro->idconsole) && $torneioFiltro->idconsole > 0) {
                                $games = $this->listaGamesConsole($torneioFiltro->idconsole, true);
                            }
                            echo $form->dropDownList($torneioFiltro, 'idgame', $games, array('style' => 'width:100%;', 'class' => 'form-control'));
                            ?>
                            <?php echo $form->error($torneioFiltro, 'idgame'); ?>
                        </div>

                        <div class="col-md-2 col-sm-2">
                            <?php echo CHtml::submitButton('Filtrar', array('style' => 'margin-top:24px;', 'class' => 'btn btn-success btn-large')); ?>
                            <a href="<?php echo $baseUrl . '/torneios'; ?>" class="btn btn-xs btnLimparFiltro">Limpar</a>
                        </div>
                    </div>

                    <?php $this->endWidget(); ?>
                </div>
                
                <div class="listasDesafios">
                    
                    <div class="row bloco_conteudo">
                        <?php
                        if(count($torneios) == 0){
                            $nenhumFitro = "";
                            if($torneioFiltro->idconsole > 0){
                                $console = Console::model()->find('idconsole='.$torneioFiltro->idconsole);
                                $nenhumFitro .= " em ".$console->nome;
                            }
                            if($torneioFiltro->idgame > 0){
                                $game = Game::model()->find('idgame='.$torneioFiltro->idgame);
                                $nenhumFitro .= " - ".$game->nome;
                            }
                            echo '<div class="alert alert-info">Nenhum torneio aberto'.$nenhumFitro.'</div>';
                        }
                        else {
                        ?>
                        <h5 style="margin-bottom: 10px;">
                            <i class="fa fa-trophy"></i>&nbsp;&nbsp;Torneios Abertos
                        </h5>
                        
                        <ul class="listaHorizontal liLink">
                            <?php
                                foreach($torneios as $torneio){
                                    $idtorneio = $torneio->idtorneio;
                            ?>
                            <li class="row">
                                <div class="col-md-2 col-sm-2">
                                    <img src="<?php echo $baseUrl.'/uploads/imagens/torneios/'.$torneio->imagem; ?>" class="imgTorneio" 
                                         width="80" height="80" alt="<?php echo 'Torneio '.$torneio->nome; ?>" />
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <h4><?php echo $torneio->nome; ?></h4>
                                    <?php echo $torneio->Console->nome." - ".$torneio->Game->nome; ?>
                                </div>
                                <div class="col-md-2 col-sm-2">
                                    <small style="color:#888;">Jogadores:</small><br/>
                                    <span style="font-size:16px;"><?php echo Torneioinscricao::model()->count('idtorneio='.$idtorneio); ?></span>
                                    <small>(<?php echo $torneio->jogadores; ?>)</small>
                                </div>
                                <div class="col-md-2 col-sm-2">
                                    <small style="color:#888;">Entrada:</small><br/>
                                    <small>R$</small> <?php echo $torneio->getValor(); ?>
                                </div>
                                <div class="col-md-2 col-sm-2 acaoTorneio">
                                    <?php
                                    $contaInscricao = Torneioinscricao::model()->count('idtorneio='.$idtorneio
                                                                                    .' AND idjogador='.$idjogador);
                                    $linkTorneio = $baseUrl.'/torneios/'.$torneio->getNomeUrl();
                                    
                                    if($torneio->status == "aberto"){
                                        if($contaInscricao){

                                            $linkSair = $baseUrl.'/torneios/cancelar/'.$torneio->getNomeUrl();

                                            echo '<a href="'.$linkTorneio.'" class="btn btn-primary btnAcessar">Acessar</a>';
                                            echo '<a href="'.$linkSair.'" class="btn btn-default btn-xs btnCancelar">Cancelar Inscrição</a>';
                                        }
                                        else {
                                            echo '<a href="'.$linkTorneio.'" class="btn btn-default btn-xs btnAcessar" style="margin:-8px auto 5px;">Acessar</a>';
                                            $linkInscrever = $baseUrl.'/torneios/inscrever/'.$torneio->getNomeUrl();
                                            echo '<a href="'.$linkInscrever.'" class="btn btn-success btnInscrever">Inscrever</a>';
                                        }
                                    }
                                    else{
                                        echo $torneio->getStatus();
                                        echo '<a class="entrar" href="'.$linkTorneio.'">';
                                        echo ($contaInscricao)?'Entrar':'Assistir';
                                        echo '</a>';
                                    }
                                    ?>
                                </div>
                            </li>
                            <?php
                            }
                            ?>
                        </ul>
                        
                        <?php
                        }
                        ?>
                    </div>
                    
                </div>
                
            </div>
        </div>
    </div>
</div>