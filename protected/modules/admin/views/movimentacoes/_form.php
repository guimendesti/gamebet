<?php
/* @var $this MovimentacoesController */
/* @var $model Jogmovimentacao */
/* @var $form CActiveForm */

$baseUrlAdmin = Yii::app()->controller->module->baseUrl;
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'movimentacao-form',
        'enableAjaxValidation' => false,
    ));
    ?>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'idjogador'); ?>
        <?php echo $form->textField($model, 'idjogador'); ?>
        <?php echo $form->error($model, 'idjogador'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'idpartida'); ?>
        <?php echo $form->textField($model, 'idpartida'); ?>
        <?php echo $form->error($model, 'idpartida'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'idtorneio'); ?>
        <?php echo $form->textField($model, 'idtorneio'); ?>
        <?php echo $form->error($model, 'idtorneio'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'transacao'); ?>
        <?php echo $form->textField($model, 'transacao', array('size' => 7, 'maxlength' => 7)); ?>
        <?php echo $form->error($model, 'transacao'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'descricao'); ?>
        <?php echo $form->textField($model, 'descricao', array('size' => 60, 'maxlength' => 250)); ?>
        <?php echo $form->error($model, 'descricao'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'valor'); ?>
        <?php echo $form->textField($model, 'valor'); ?>
        <?php echo $form->error($model, 'valor'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'saldoAntes'); ?>
        <?php echo $form->textField($model, 'saldoAntes'); ?>
        <?php echo $form->error($model, 'saldoAntes'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'saldoDepois'); ?>
        <?php echo $form->textField($model, 'saldoDepois'); ?>
        <?php echo $form->error($model, 'saldoDepois'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'data'); ?>
        <?php echo $form->textField($model, 'data'); ?>
        <?php echo $form->error($model, 'data'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'status'); ?>
        <?php echo $form->textField($model, 'status'); ?>
        <?php echo $form->error($model, 'status'); ?>
    </div>


    <br />
    <br />
    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Criar' : 'Salvar', array('class' => 'btn btn-success btn-large')); ?>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="<?php echo $baseUrlAdmin . '/movimentacoes'; ?>" class="btn btn-info btn-xs">Cancelar</a>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->