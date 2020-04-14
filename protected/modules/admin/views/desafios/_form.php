<?php
/* @var $this DesafiosController */
/* @var $model Desafio */
/* @var $form CActiveForm */

$baseUrlAdmin = Yii::app()->controller->module->baseUrl;
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'desafio-form',
        'enableAjaxValidation' => false,
    ));

    echo ($form->errorSummary($model)) ? "<div class='errorAlert alert alert-danger'>"
            . "Por favor, corrija os problemas abaixo!"
            . "</div>" : '';
    ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'idconsole', array('style' => 'vertical-align:top; padding-top:6px;')); ?>
        <?php
        $consoles = $this->listaConsoles();
        $numC = count($consoles);
        if ($numC <= 0) {
            $consoles = array(0 => 'Cadastre um console ativo');
        } else {
            $consoles = array('' => 'Selecione ...') + $consoles;
        }
        echo $form->dropDownList($model, 'idconsole', $consoles, array('style' => 'width:150px;',
            'onchange' => "$('#" . CHtml::activeId($model, 'idgame') . "').html('<option value=\'0\'>Aguarde ...</option>')",
            'ajax' => array(
                'type' => 'POST',
                'url' => CController::createUrl('desafios/listaGamesConsole'),
                'update' => '#' . CHtml::activeId($model, 'idgame')
            )
        ));
        ?>
        <?php echo $form->error($model, 'idconsole'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'idgame'); ?>
        <?php
        $games = array('' => 'Selecione um console');
        if (isset($model->idconsole) && $model->idconsole > 0) {
            $games = $this->listaGamesConsole($model->idconsole, true);
        }
        echo $form->dropDownList($model, 'idgame', $games, array('style' => 'width:250px;'));
        ?>
        <?php echo $form->error($model, 'idgame'); ?>
    </div>
    
    <div class="row">
        <?php echo $form->labelEx($model, 'tipo'); ?>
        <?php echo $form->dropDownList($model, 'tipo', array('privado' => 'Privado', 'global' => 'Global'), array('style' => 'width:160px;')); ?>
        <?php echo $form->error($model, 'tipo'); ?>
    </div>
    
    <hr />

    <div class="row">
        <?php echo $form->labelEx($model, 'desafiante'); ?>
        <?php echo $form->textField($model, 'desafiante'); ?>
        <?php echo $form->error($model, 'desafiante'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'mensagemDesafio', array('style' => 'vertical-align:top;padding-top:6px;')); ?>
        <?php echo $form->textArea($model, 'mensagemDesafio', array('style' => 'height:70px;', 'maxlength' => 45)); ?>
        <?php echo $form->error($model, 'mensagemDesafio'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'valor'); ?>
        <?php echo $form->textField($model, 'valor', array('style' => 'width:100px;')); ?>
        <?php echo $form->error($model, 'valor'); ?>
    </div>
    
    <hr />
    
    <div class="row">
        <?php echo $form->labelEx($model, 'desafiado'); ?>
        <?php echo $form->textField($model, 'desafiado'); ?>
        <?php echo $form->error($model, 'desafiado'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'resposta'); ?>
        <?php echo $form->dropDownList($model, 'resposta', array('' => '...', '1' => 'Sim', '0' => 'Não'), array('style' => 'width:100px;')); ?>
        <?php echo $form->error($model, 'resposta'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'mensagemResposta', array('style' => 'vertical-align:top;padding-top:6px;')); ?>
        <?php echo $form->textArea($model, 'mensagemResposta', array('style' => 'height:70px;', 'maxlength' => 45)); ?>
        <?php echo $form->error($model, 'mensagemResposta'); ?>
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
        <a href="<?php echo $baseUrlAdmin . '/desafios'; ?>" class="btn btn-info btn-xs">Cancelar</a>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->