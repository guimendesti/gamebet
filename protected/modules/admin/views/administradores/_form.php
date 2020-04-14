<?php
/* @var $this AdminAdministradoresController */
/* @var $model Admin */
/* @var $form CActiveForm */

$baseUrlAdmin = Yii::app()->controller->module->baseUrl;
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'admin-form',
        'enableAjaxValidation' => false,
    ));
    ?>



    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'nome'); ?>
        <?php echo $form->textField($model, 'nome', array('style' => 'width:400px;', 'size' => 100, 'maxlength' => 150)); ?>
        <?php echo $form->error($model, 'nome'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'email'); ?>
        <?php echo $form->textField($model, 'email', array('style' => 'width:400px;', 'size' => 100, 'maxlength' => 150)); ?>
        <?php echo $form->error($model, 'email'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'usuario'); ?>
        <?php echo $form->textField($model, 'usuario', array('style' => 'width:200px;', 'size' => 50, 'maxlength' => 50)); ?>
        <?php echo $form->error($model, 'usuario'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'senha'); ?>

        <?php
        if ($model->isNewRecord) {
            echo $form->passwordField($model, 'senha', array('style' => 'width:200px;'));
        } else {
            echo $form->hiddenField($model, 'senha');
            unset($model->senha);
            echo '<a href="#" onclick="$(this).hide();$(\'#cpSenha\').show()" class="linkAlterarSenha">Alterar senha</a>';
            echo '<span id="cpSenha" style="display:none;">';
            echo $form->passwordField($model, 'senha', array('style' => 'width:200px;', 'name' => 'novaSenha'));
            echo '&nbsp;&nbsp;<a href="#" onclick="$(\'.linkAlterarSenha\').show();$(\'#cpSenha\').hide();$(\'input[name=novaSenha]\').val(\'\')">Cancelar</a>';
            echo '</span>';
        }
        ?>

        <?php echo $form->error($model, 'senha'); ?>
    </div>

    <br />
    <br />
    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Criar' : 'Salvar', array('class' => 'btn btn-success btn-large')); ?>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="<?php echo $baseUrlAdmin . '/administradores'; ?>" class="btn btn-info btn-xs">Cancelar</a>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->