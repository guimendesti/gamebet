<?php
$baseUrl = Yii::app()->baseUrl;
$baseUrlTheme = Yii::app()->theme->baseUrl;

$idjogador = $this->jogadorLogado->idjogador;
?>

<div class="middle_content">
    <div class="container">
        <div class="row">
            <?php $this->renderPartial('application.modules.jogador.views.default.colunaConta'); ?>
            
            <div class='col-md-9 col-sm-8'>
                <div class="blocoDesafiar">
                    <h3><i class="fa fa-crosshairs"></i>&nbsp;&nbsp;Localizar Jogadores</h3>
                    
                    <?php
                    $form = $this->beginWidget('CActiveForm', array(
                        'id' => 'filtroJogadores',
                        'enableAjaxValidation' => false,
                    ));
                    ?>

                    <div class="row">
                        <div class="col-md-5 col-sm-5">
                            <?php echo $form->labelEx($filtroModel, 'idconsole'); ?>
                            <br />
                            <?php
                            $consoles = $this->listaConsoles();
                            $numC = count($consoles);
                            if ($numC <= 0) {
                                $consoles = array(0 => 'Cadastre um console ativo');
                            } else {
                                $consoles = array('' => 'Selecione ...') + $consoles;
                            }
                            echo $form->dropDownList($filtroModel, 'idconsole', $consoles, array('style' => 'width:100%;', 'class' => 'form-control',
                                'onchange' => "$('#" . CHtml::activeId($filtroModel, 'idgame') . "').html('<option value=\'0\'>Aguarde ...</option>')",
                                'ajax' => array(
                                    'type' => 'POST',
                                    'url' => CController::createUrl('jogar/listaGamesConsole'),
                                    'update' => '#' . CHtml::activeId($filtroModel, 'idgame')
                                )
                            ));
                            ?>
                            <?php echo $form->error($filtroModel, 'idconsole'); ?>
                        </div>

                        <div class="col-md-5 col-sm-5">
                            <?php echo $form->labelEx($filtroModel, 'idgame'); ?>
                            <br />
                            <?php
                            $games = array('' => 'Selecione um console');
                            if (isset($filtroModel->idconsole) && $filtroModel->idconsole > 0) {
                                $games = $this->listaGamesConsole($filtroModel->idconsole, true);
                            }
                            echo $form->dropDownList($filtroModel, 'idgame', $games, array('style' => 'width:100%;', 'class' => 'form-control'));
                            ?>
                            <?php echo $form->error($filtroModel, 'idgame'); ?>
                        </div>

                        <div class="col-md-2 col-sm-2">
                            <?php echo CHtml::submitButton('Procurar', array('style' => 'margin-top:24px;', 'class' => 'btn btn-primary btn-large')); ?>
                        </div>
                    </div>

                    <?php $this->endWidget(); ?>
                </div>
                
                <div class="listasDesafios ">
                    
                    <div class="row bloco_conteudo">

                        <h5 style="margin-bottom: 10px;">
                            <i class="fa fa-users"></i>&nbsp;&nbsp;
                            Jogadores Disponíveis
                        </h5>
                        
                        <?php
                        if($retornoDesafiar > 0){
                            echo '<div class="row retornoDesafio">'
                                    . '<div class="alert alert-success">'
                                        . 'Desafio enviado com sucesso! Aguarde a resposta.'
                                    . '</div>'
                                . '</div>';
                        }
                        ?>
                        
                        <ul class="listaHorizontal liLink">
                            <?php
                            if(count($listaJogadores) == 0){
                                echo '<div class="alert alert-info">Nenhum Jogador para Desafio Privado<br /><small>(Escolha outro Console ou Game)</small></div>';
                            }
                            else {
                                foreach($listaJogadores as $jogador){
                                    $idjogador = $jogador->idjogador;
                                    
                                    if(count($jogador->Disponiveis)>0){
                                        
                                        $d = 0;
                                        foreach($jogador->Disponiveis as $disponivel){
                                            $d++;
                            ?>

                            <?php
                            $formDesafio = $this->beginWidget('CActiveForm', array(
                                'id' => 'desafiarPrivado'.$d,
                                'enableAjaxValidation' => false,
                            ));
                            echo $formDesafio->hiddenField($desafiarModel, 'desafiado', array('value' => $jogador->idjogador));
                            echo $formDesafio->hiddenField($desafiarModel, 'idconsole', array('value' => $disponivel->Console->idconsole));
                            echo $formDesafio->hiddenField($desafiarModel, 'idgame', array('value' => $disponivel->Game->idgame));
                            ?>
                            <li class="row">
                                <div class="col-md-3 col-sm-3">
                                    <img src="<?php echo $baseUrl.'/uploads/imagens/jogadores/'.$jogador->avatar; ?>" class="imgJog notFloat" width="60" height="60" alt="<?php echo 'Avatar de '.$jogador->usuario; ?>" />
                                    <?php echo $jogador->usuario; ?>
                                </div>
                                <div class="col-md-5 col-sm-5">
                                    <?php echo $disponivel->Console->nome." - ".$disponivel->Game->nome; ?>
                                </div>
                                <div class="col-md-2 col-sm-2">
                                    <?php 
                                    $this->widget('application.extensions.moneymask.MMask',array(
                                        'element'=>'#Desafio_valor',
                                        'currency'=>'PHP',
                                        'config'=>array(
                                            'showSymbol'=>true,
                                            'symbolStay'=>true,
                                        )
                                    ));

                                    echo $formDesafio->textField($desafiarModel, 'valor', array('style' => 'width:100%;', 'class' => 'form-control', 'placeholder' => '0,00')); ?>
                                    <?php echo $formDesafio->error($desafiarModel, 'valor'); ?>
                                </div>
                                <div class="col-md-2 col-sm-2">
                                    <?php
                                    $dOnclick = "$('.error').removeClass('error');"
                                            . "var cValor=$('#desafiarPrivado".$d." #Desafio_valor');"
                                            .   "if(cValor.val()>0){ return true; } else { cValor.addClass('error'); return false;}";
                                    echo '<button type="submit" onclick="'.$dOnclick.'" class="btn btn-success btnDesafio" data-toggle="tooltip" data-placement="top" title="Desafiar">'
                                            . 'Desafiar'
                                        . '</button>   ';

                                    ?>
                                </div>
                            </li>
                    <?php $this->endWidget(); ?>
                            <?php
                                        }
                                    }
                                }
                            }
                            ?>
                        </ul>
                    </div>
                    
                </div>
            </div>
            
        </div>
    </div>
</div>