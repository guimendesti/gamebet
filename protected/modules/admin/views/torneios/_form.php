<?php
/* @var $this TorneiosController */
/* @var $model Torneio */
/* @var $form CActiveForm */

$baseUrlAdmin = Yii::app()->controller->module->baseUrl;
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'torneio-form',
        'enableAjaxValidation' => false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
    ));
    
    echo ($form->errorSummary($model)) 
            ? "<div class='errorAlert alert alert-danger'>"
                   ."Por favor, corrija os problemas abaixo!"
              ."</div>" 
            : ''; 
    ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'imagem'); ?>
        <?php echo $form->fileField($model, 'imagem', array('style' => 'display:inline-block;')); ?>
        <?php
        if (!$model->isNewRecord) {
            echo "<br />";
            echo (is_file("uploads/imagens/torneios/" . $model->imagem)) 
                    ? "<img src='" . Yii::app()->baseUrl . "/uploads/imagens/torneios/" . $model->imagem . "' class='img-thumbnail' "
                        . "style='cursor:sw-resize;max-height:100px;margin-left:142px;' data-toggle='modal' data-target='#img" . $model->idtorneio . "' />"
                        . "<div class='modal fade modalImage' id='img" . $model->idtorneio . "' tabindex='-1' role='dialog' aria-labelledby='" . $model->imagem . "' aria-hidden='true'>"
                        . " <div class='modal-dialog' style='width:700px;'>"
                        . "     <div class='modal-content'>"
                        . "         <div class='modal-header'>"
                        . "             <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>"
                        . "         </div>"
                        . "         <div class='modal-body'>"
                        . "             <img src='" . Yii::app()->baseUrl . "/uploads/imagens/torneios/" . $model->imagem . "' style='width:100%;' />"
                        . "         </div>"
                        . "     </div>"
                        . " </div>"
                        . "</div>" 
                    : "<span style='color:#999;margin-left:142px;'>Sem Imagem</span>";
        }
        ?>
        <?php echo $form->error($model, 'imagem'); ?>
    </div>
    
    <hr />

    <div class="row">
        <?php echo $form->labelEx($model, 'idconsole', array('style' => 'vertical-align:top; padding-top:6px;')); ?>
        <?php 
        $consoles = $this->listaConsoles();
        $numC = count($consoles);
        if($numC <= 0){
            $consoles = array(0 => 'Cadastre um console ativo');
        }
        else{
            $consoles = array('0' => 'Selecione ...') + $consoles;
        }
        echo $form->dropDownList($model, 'idconsole', $consoles, array('style' => 'width:150px;',
                                    'onchange' => "$('#".CHtml::activeId($model,'idgame')."').html('<option value=\'0\'>Aguarde ...</option>')",
                                    'ajax' => array(
                                        'type'=>'POST',
                                        'url'=>CController::createUrl('torneios/listaGamesConsole'),
                                        'update'=>'#'.CHtml::activeId($model,'idgame')
                                     )
            )); 
        ?>
        <?php echo $form->error($model, 'idconsole'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'idgame'); ?>
        <?php 
        $games = array(0 => 'Selecione um console');
        if(isset($model->idconsole) && $model->idconsole > 0){
            $games = $this->listaGamesConsole($model->idconsole, true);
        }
        echo $form->dropDownList($model, 'idgame', $games, array('style' => 'width:250px;')); 
        ?>
        <?php echo $form->error($model, 'idgame'); ?>
    </div>
    
    <hr />

    <div class="row">
        <?php echo $form->labelEx($model, 'nome'); ?>
        <?php echo $form->textField($model, 'nome', array('size' => 60, 'maxlength' => 100)); ?>
        <?php echo $form->error($model, 'nome'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'descricao', array('style' => 'vertical-align:top; padding-top:6px;')); ?>
        <?php echo $form->textArea($model, 'descricao', array('rows' => 6, 'cols' => 50)); ?>
        <?php echo $form->error($model, 'descricao'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'jogadores'); ?>
        <?php echo $form->dropDownList($model, 'jogadores', array('0' => 'Nº Máx.', '4' => '4', '8' => '8', '16' => '16', '32' => '32'), array('style' => 'width:100px;')); ?>
        <?php echo $form->error($model, 'jogadores'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'valor'); ?>
        <?php echo $form->textField($model, 'valor', array('style' => 'width:100px;')); ?>
        <?php echo $form->error($model, 'valor'); ?>
    </div>
    
    <hr />

    <div class="row">
        <?php echo $form->labelEx($model, 'status'); ?>
        <?php echo $form->dropDownList($model, 'status', $model->listaStatus(), array('style' => 'width:160px;')); ?>
        <?php echo $form->error($model, 'status'); ?>
    </div>


    <br />
    <br />
    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Criar' : 'Salvar', array('class' => 'btn btn-success btn-large')); ?>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="<?php echo $baseUrlAdmin . '/torneios'; ?>" class="btn btn-info btn-xs">Cancelar</a>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->