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
                    <h3><i class="fa fa-crosshairs"></i>&nbsp;&nbsp;Desafiar Jogadores</h3>

                    <?php
                    if($retornoDesafiar > 0){
                        echo '<div class="row retornoDesafio">'
                                . '<div class="alert alert-success">'
                                    . 'Desafio enviado com sucesso! Aguarde um adversário...'
                                . '</div>'
                            . '</div>';
                    }
                    ?>
                    
                    <?php
                    $form = $this->beginWidget('CActiveForm', array(
                        'id' => 'desafiarPublico',
                        'enableAjaxValidation' => false,
                    ));
                    ?>

                    <div class="row">
                        <div class="col-md-4 col-sm-6">
                            <?php echo $form->labelEx($desafiarModel, 'idconsole'); ?>
                            <br />
                            <?php
                            $consoles = $this->listaConsoles();
                            $numC = count($consoles);
                            if ($numC <= 0) {
                                $consoles = array(0 => 'Cadastre um console ativo');
                            } else {
                                $consoles = array('' => 'Selecione ...') + $consoles;
                            }
                            echo $form->dropDownList($desafiarModel, 'idconsole', $consoles, array('style' => 'width:100%;', 'class' => 'form-control',
                                'onchange' => "$('#" . CHtml::activeId($desafiarModel, 'idgame') . "').html('<option value=\'0\'>Aguarde ...</option>')",
                                'ajax' => array(
                                    'type' => 'POST',
                                    'url' => CController::createUrl('jogar/listaGamesConsole'),
                                    'update' => '#' . CHtml::activeId($desafiarModel, 'idgame')
                                )
                            ));
                            ?>
                            <?php echo $form->error($desafiarModel, 'idconsole'); ?>
                        </div>

                        <div class="col-md-4 col-sm-6">
                            <?php echo $form->labelEx($desafiarModel, 'idgame'); ?>
                            <br />
                            <?php
                            $games = array('' => 'Selecione um console');
                            if (isset($desafiarModel->idconsole) && $desafiarModel->idconsole > 0) {
                                $games = $this->listaGamesConsole($desafiarModel->idconsole, true);
                            }
                            echo $form->dropDownList($desafiarModel, 'idgame', $games, array('style' => 'width:100%;', 'class' => 'form-control'));
                            ?>
                            <?php echo $form->error($desafiarModel, 'idgame'); ?>
                        </div>

                        <div class="col-md-2 col-sm-6">
                            <?php echo $form->labelEx($desafiarModel, 'valor'); ?>
                            <br />
                            <?php 
                            $this->widget('application.extensions.moneymask.MMask',array(
                                'element'=>'#Desafio_valor',
                                'currency'=>'PHP',
                                'config'=>array(
                                    'showSymbol'=>true,
                                    'symbolStay'=>true,
                                )
                            ));
                            echo $form->textField($desafiarModel, 'valor', array('style' => 'width:100%;', 'class' => 'form-control')); ?>
                            <?php echo $form->error($desafiarModel, 'valor'); ?>
                        </div>

                        <div class="col-md-2 col-sm-6">
                            <?php echo CHtml::submitButton('Desafiar', array('style' => 'margin-top:24px;', 'class' => 'btn btn-success btn-large')); ?>
                        </div>
                    </div>

                    <?php $this->endWidget(); ?>
                </div>
                
                <div class="listasDesafios">
                    
                    <div class="row bloco_conteudo">

                        <h5 style="margin-bottom: 10px;">
                            <i class="fa fa-users"></i>&nbsp;&nbsp;
                            Desafios Públicos
                        </h5>
                        
                        <ul class="listaHorizontal liLink">
                            <?php                                                        
                            if(count($listaDesafios) == 0){
                                echo '<div class="alert alert-info">Nenhum Desafio Global</div>';
                            }
                            else {
                                foreach($listaDesafios as $desafio){
                                    $iddesafio = $desafio->iddesafio;
                                    $classAvatar = ($desafio->desafiante == $idjogador) ? " meuAvatar " : "";
                            ?>
                            <li class="row">
                                <div class="col-md-2 col-sm-2">
                                    <img src="<?php echo $baseUrl.'/uploads/imagens/jogadores/'.$desafio->Desafiante->avatar; ?>" 
                                         class="imgJog <?php echo $classAvatar; ?>" width="60" height="60" alt="<?php echo 'Avatar de '.$desafio->Desafiante->usuario; ?>" />
                                </div>
                                <div class="col-md-3 col-sm-3">
                                    <?php echo $desafio->Desafiante->usuario; ?>
                                </div>
                                <div class="col-md-3 col-sm-3">
                                    <?php echo $desafio->Console->nome." - ".$desafio->Game->nome; ?>
                                </div>
                                <div class="col-md-2 col-sm-2">
                                    <small>R$</small> <?php echo $desafio->valor; ?>
                                </div>
                                <div class="col-md-2 col-sm-2">
                                    <?php
                                    if($desafio->desafiante != $this->jogadorLogado->idjogador){
                                        
                                        $linkAceitar = $baseUrl.'/global/aceitar/'.$iddesafio;                                        
                                        echo '<a href="'.$linkAceitar.'" class="btn btn-success btnDesafio" data-toggle="tooltip" data-placement="top" title="Aceitar">'
                                                . '<i class="fa fa-thumbs-up"></i>'
                                            . '</a>   ';
                                    }
                                    else {
                                        $linkCancelar = $baseUrl.'/global/cancelar/'.$iddesafio;
                                        echo '<a href="'.$linkCancelar.'" class="btn btn-default btnDesafio">Cancelar</a>';
                                    }
                                    ?>
                                </div>
                            </li>
                            <?php
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