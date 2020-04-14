<?php
/* @var $this ComissoesController */
/* @var $model Comissao */
/* @var $form CActiveForm */

$baseUrlAdmin = Yii::app()->controller->module->baseUrl;
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'comissao-form',
        'enableAjaxValidation' => false,
    ));
    ?>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'idjogmovimentacao'); ?>
        <?php echo $form->textField($model, 'idjogmovimentacao'); ?>
        <?php echo $form->error($model, 'idjogmovimentacao'); ?>
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


    <br />
    <br />
    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Criar' : 'Salvar', array('class' => 'btn btn-success btn-large')); ?>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="<?php echo $baseUrlAdmin . '/comissoes'; ?>" class="btn btn-info btn-xs">Cancelar</a>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->