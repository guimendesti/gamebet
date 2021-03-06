<?php
/* @var $this CreditosController */
/* @var $model Jogcredito */
/* @var $form CActiveForm */

$baseUrlAdmin = Yii::app()->controller->module->baseUrl;
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'jogcredito-form',
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
        <?php echo $form->labelEx($model, 'data'); ?>
        <?php echo $form->textField($model, 'data'); ?>
        <?php echo $form->error($model, 'data'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'valor'); ?>
        <?php echo $form->textField($model, 'valor'); ?>
        <?php echo $form->error($model, 'valor'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'forma'); ?>
        <?php echo $form->textField($model, 'forma', array('size' => 9, 'maxlength' => 9)); ?>
        <?php echo $form->error($model, 'forma'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'situacao'); ?>
        <?php echo $form->textField($model, 'situacao'); ?>
        <?php echo $form->error($model, 'situacao'); ?>
    </div>


    <br />
    <br />
    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Criar' : 'Salvar', array('class' => 'btn btn-success btn-large')); ?>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="<?php echo $baseUrlAdmin . '/creditos'; ?>" class="btn btn-info btn-xs">Cancelar</a>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->