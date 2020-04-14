<?php
/* @var $this PartidasController */
/* @var $model Partida */
/* @var $form CActiveForm */

$baseUrlAdmin = Yii::app()->controller->module->baseUrl;
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'partida-form',
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
                'url' => CController::createUrl('partidas/listaGamesConsole'),
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
        echo $form->dropDownList($model, 'idgame', $games, array('style' => 'width:250px;',
            'onchange' => "$('#" . CHtml::activeId($model, 'idtorneio') . "').html('<option value=\'\'>Aguarde ...</option>')",
            'ajax' => array(
                'type' => 'POST',
                'url' => CController::createUrl('partidas/listaTorneiosGame'),
                'update' => '#' . CHtml::activeId($model, 'idtorneio')
            )
        ));
        ?>
        <?php echo $form->error($model, 'idgame'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'idtorneio'); ?>
        <?php
        $torneios = array('' => 'Selecione um game');
        if (isset($model->idconsole) && $model->idconsole > 0 && isset($model->idgame) && $model->idgame > 0) {
            $torneios = $this->listaTorneiosGame($model->idconsole, $model->idgame, true);
        }
        echo $form->dropDownList($model, 'idtorneio', $torneios, array('style' => 'width:250px;'));
        ?>
        <?php echo $form->error($model, 'idtorneio'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'valor', array('style' => 'vertical-align:top;padding-top:6px;')); ?>
        <?php echo $form->textField($model, 'valor', array('style' => 'width:100px;')); ?>
        <?php echo $form->error($model, 'valor'); ?>
    </div>

    <hr />

    <div class="row">
        <?php echo $form->labelEx($model, 'dataAgendada'); ?>
        <?php echo $form->dateField($model, 'dataAgendada', array('style' => 'width:160px;')); ?>
        <?php echo $form->error($model, 'dataAgendada'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'dataPartida'); ?>
        <?php echo $form->dateField($model, 'dataPartida', array('style' => 'width:160px;')); ?>
        <?php echo $form->error($model, 'dataPartida'); ?>
    </div>

    <hr />

    <div class="row">
        <?php echo $form->labelEx($model, 'resultadoA'); ?>
        <?php echo $form->textField($model, 'resultadoA', array('style' => 'width:160px;', 'maxlength' => 30)); ?>
        <?php echo $form->error($model, 'resultadoA'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'resultadoB'); ?>
        <?php echo $form->textField($model, 'resultadoB', array('style' => 'width:160px;', 'maxlength' => 30)); ?>
        <?php echo $form->error($model, 'resultadoB'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'resultado'); ?>
        <?php echo $form->textField($model, 'resultado', array('style' => 'width:160px;', 'maxlength' => 30)); ?>
        <?php echo $form->error($model, 'resultado'); ?>
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
        <a href="<?php echo $baseUrlAdmin . '/partidas'; ?>" class="btn btn-info btn-xs">Cancelar</a>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->