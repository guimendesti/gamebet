<?php
/* @var $this PaginasController */
/* @var $model Pagina */
/* @var $form CActiveForm */

$baseUrlAdmin = Yii::app()->controller->module->baseUrl;
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'pagina-form',
        'enableAjaxValidation' => false,
    ));
    ?>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'nome'); ?>
        <?php echo $form->textField($model, 'nome', array('size' => 50, 'maxlength' => 50)); ?>
        <?php echo $form->error($model, 'nome'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'apelido'); ?>
        <?php echo $form->textField($model, 'apelido', array('size' => 50, 'maxlength' => 50)); ?>
        <?php echo $form->error($model, 'apelido'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'descricao'); ?>
        <?php echo $form->textField($model, 'descricao', array('size' => 60, 'maxlength' => 250)); ?>
        <?php echo $form->error($model, 'descricao'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'status'); ?>
        <?php echo $form->dropDownList($model, 'status', array('1' => 'Ativo', '0' => 'Inativo'), array('style' => 'width:100px;')); ?>
        <?php echo $form->error($model, 'status'); ?>
    </div>

    <hr />

    <div class="row">
        <?php echo $form->labelEx($model, 'conteudo', array('style' => 'vertical-align:top; padding-top:6px;')); ?>
        <?php echo $form->textArea($model, 'conteudo', array('rows' => 6, 'cols' => 50)); ?>
        <?php echo $form->error($model, 'conteudo'); ?>
    </div>


    <br />
    <br />
    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Criar' : 'Salvar', array('class' => 'btn btn-success btn-large')); ?>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="<?php echo $baseUrlAdmin . '/paginas'; ?>" class="btn btn-info btn-xs">Cancelar</a>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->