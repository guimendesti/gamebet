<?php
/* @var $this MensagensController */
/* @var $model Chatmensagem */
/* @var $form CActiveForm */

$baseUrlAdmin = Yii::app()->controller->module->baseUrl;
?>

<div class="form">

    <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'chatmensagem-form',
	'enableAjaxValidation'=>false,
)); ?>

    <?php echo $form->errorSummary($model); ?>

            <div class="row">
            <?php echo $form->labelEx($model,'idjogador'); ?>
            <?php echo $form->textField($model,'idjogador'); ?>
            <?php echo $form->error($model,'idjogador'); ?>
        </div>

                <div class="row">
            <?php echo $form->labelEx($model,'destinatario'); ?>
            <?php echo $form->textField($model,'destinatario'); ?>
            <?php echo $form->error($model,'destinatario'); ?>
        </div>

                <div class="row">
            <?php echo $form->labelEx($model,'data'); ?>
            <?php echo $form->textField($model,'data'); ?>
            <?php echo $form->error($model,'data'); ?>
        </div>

                <div class="row">
            <?php echo $form->labelEx($model,'lida'); ?>
            <?php echo $form->textField($model,'lida'); ?>
            <?php echo $form->error($model,'lida'); ?>
        </div>

                <div class="row">
            <?php echo $form->labelEx($model,'mensagem'); ?>
            <?php echo $form->textArea($model,'mensagem',array('rows'=>6, 'cols'=>50)); ?>
            <?php echo $form->error($model,'mensagem'); ?>
        </div>

                <div class="row">
            <?php echo $form->labelEx($model,'status'); ?>
            <?php echo $form->textField($model,'status'); ?>
            <?php echo $form->error($model,'status'); ?>
        </div>

        
    <br />
    <br />
    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Criar' : 'Salvar', array('class'=>'btn btn-success btn-large')); ?>        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="<?php echo $baseUrlAdmin.'/chatmensagems'; ?>" class="btn btn-info btn-xs">Cancelar</a>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->