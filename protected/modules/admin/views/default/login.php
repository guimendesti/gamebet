<?php
$baseUrlTheme = Yii::app()->theme->baseUrl;
$baseUrlAdmin = Yii::app()->controller->module->baseUrl;
?>

<div class="middle_content">
    <div class="container">
        <div class="row">
            <div class="col-4" style="max-width: 300px;">
            <?php
            $htmlFields = array(
                'errorOptions' => array
                    (
                    'errorCssClass' => '',
                    'successCssClass' => '',
                    'validatingCssClass' => '',
                    'style' => 'display: none',
                    'hideErrorMessage' => TRUE,
                    'afterValidateAttribute' => 'js:afterValidateAttribute',
                )
            );

            $form = $this->beginWidget('CActiveForm', array(
                'htmlOptions' => array('class' => 'login-form'),
                'enableClientValidation' => true,
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                    'errorMessage' => "{attribute} vazio",
                ),
            ));
            ?>
            <h3 class="form-title">Administração - Login</h3>
            <?php
            if ($this->getPageState('erroLogin')) {
                ?>
                <div class="alert alert-danger">
                    <button class="close" data-close="alert"></button>
                    <span>E-mail ou senha inválido</span>
                </div>
                <?php
            }
            ?>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'usuario', array('label' => 'Usuário', 'class' => 'control-label')); ?>
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">
                        <i class="fa fa-user"></i>
                    </span>
                    <?php echo $form->textField($model, 'usuario', array('class' => 'form-control', "autocomplete" => "off", "placeholder" => "Usuário")); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($model, 'senha', array('label' => 'Senha', 'class' => 'control-label visible-ie8 visible-ie9')); ?>
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">
                        <i class="fa fa-lock"></i>
                    </span>
                    <?php echo $form->passwordField($model, 'senha', array('class' => 'form-control placeholder-no-fix', "autocomplete" => "off", "placeholder" => "Senha")); ?>
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn blue pull-right">
                    Entrar <i class="m-icon-swapright m-icon-white"></i>
                </button>
            </div>

            <br />
            <br />
            <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
</div>
