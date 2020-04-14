<?php
/* @var $this JogadoresController */
/* @var $model Jogador */
/* @var $form CActiveForm */

$baseUrlAdmin = Yii::app()->controller->module->baseUrl;
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'jogador-form',
        'enableAjaxValidation' => false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
    ));

    echo ($form->errorSummary($model)) 
            ? "<div class='errorAlert alert alert-danger'>"
                . "Por favor, corrija os problemas abaixo!"
             . "</div>" 
            : '';
    ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'avatar'); ?>
        <?php echo $form->fileField($model, 'avatar', array('style' => 'display:inline-block;')); ?>
        <?php
        if (!$model->isNewRecord) {
            echo "<br />";
            echo (is_file("uploads/imagens/jogadores/" . $model->avatar)) 
                    ? "<img src='" . Yii::app()->baseUrl . "/uploads/imagens/jogadores/" . $model->avatar . "' class='img-thumbnail' "
                        . "style='cursor:sw-resize;max-height:100px;margin-left:142px;' data-toggle='modal' data-target='#img" . $model->idjogador . "' />"
                        . "<div class='modal fade modalImage' id='img" . $model->idjogador . "' tabindex='-1' role='dialog' aria-labelledby='" . $model->avatar . "' aria-hidden='true'>"
                        . " <div class='modal-dialog' style='width:700px;'>"
                        . "     <div class='modal-content'>"
                        . "         <div class='modal-header'>"
                        . "             <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>"
                        . "         </div>"
                        . "         <div class='modal-body'>"
                        . "             <img src='" . Yii::app()->baseUrl . "/uploads/imagens/jogadores/" . $model->avatar . "' style='width:100%;' />"
                        . "         </div>"
                        . "     </div>"
                        . " </div>"
                        . "</div>" 
                    : "<span style='color:#999;margin-left:142px;'>Sem Imagem</span>";
        }
        ?>
        <?php echo $form->error($model, 'avatar'); ?>
    </div>
    
    <hr />

    <div class="row">
        <?php echo $form->labelEx($model, 'nome'); ?>
        <?php echo $form->textField($model, 'nome', array('size' => 60, 'maxlength' => 150)); ?>
        <?php echo $form->error($model, 'nome'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'cpf'); ?>
        <?php echo $form->textField($model, 'cpf', array('style' => 'width:150px;', 'maxlength' => 11)); ?>
        <?php echo $form->error($model, 'cpf'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'genero'); ?>
        <?php echo $form->dropDownList($model, 'genero', array('0' => 'Selecione ...', 'f' => 'Feminino', 'm' => 'Masculino'), array('style' => 'width:150px;')); ?>
        <?php echo $form->error($model, 'genero'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'nascimento'); ?>
        <?php echo $form->textField($model, 'nascimento', array('style' => 'width:150px;')); ?>
        <?php echo $form->error($model, 'nascimento'); ?>
    </div>

    <hr />

    <div class="row">
        <?php echo $form->labelEx($model, 'usuario'); ?>
        <?php echo $form->textField($model, 'usuario', array('size' => 30, 'maxlength' => 30)); ?>
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
            echo '<a onclick="jQuery(this).hide();jQuery(\'#cpSenha\').show();jQuery(\'#cpSenha\').focus();" class="linkAlterarSenha">Alterar senha</a>';
            echo '<span id="cpSenha" style="display:none;">';
            echo $form->passwordField($model, 'senha', array('style' => 'width:200px;', 'name' => 'novaSenha'));
            echo '&nbsp;&nbsp;<a onclick="jQuery(\'.linkAlterarSenha\').show();jQuery(\'#cpSenha\').hide();jQuery(\'input[name=novaSenha]\').val(\'\')"  class="linkAlterarSenha">Cancelar</a>';
            echo '</span>';
        }
        ?>

        <?php echo $form->error($model, 'senha'); ?>
    </div>

    <hr />

    <div class="row">
        <?php echo $form->labelEx($model, 'email'); ?>
        <?php echo $form->textField($model, 'email', array('size' => 60, 'maxlength' => 150)); ?>
        <?php echo $form->error($model, 'email'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'tel1', array('label' => 'Telefone(s)')); ?>
        <?php echo $form->textField($model, 'tel1', array('style' => 'width:150px;', 'maxlength' => 25)); ?>
        &nbsp;e/ou&nbsp;
        <?php echo $form->textField($model, 'tel2', array('style' => 'width:150px;', 'maxlength' => 25)); ?>
        <?php echo $form->error($model, 'tel1'); ?>
        <?php echo $form->error($model, 'tel2'); ?>
    </div>

    <hr />

    <div class="row">
        <?php echo $form->labelEx($model, 'cep'); ?>
        <?php echo $form->textField($model, 'cep', array('style' => 'width:120px;', 'maxlength' => 10)); ?>
        <?php echo $form->error($model, 'cep'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'endereco'); ?>
        <?php echo $form->textField($model, 'endereco', array('size' => 60, 'maxlength' => 150)); ?>
        <?php echo $form->error($model, 'endereco'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'bairro'); ?>
        <?php echo $form->textField($model, 'bairro', array('maxlength' => 50)); ?>
        <?php echo $form->error($model, 'bairro'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'cidade', array('label' => 'Cidade/UF')); ?>
        <?php echo $form->textField($model, 'cidade', array('style' => 'width:320px;', 'maxlength' => 50)); ?>
        &nbsp;/&nbsp;
        <?php echo $form->textField($model, 'uf', array('style' => 'width:60px;', 'maxlength' => 2)); ?>
        <?php echo $form->error($model, 'cidade'); ?>
        <?php echo $form->error($model, 'uf'); ?>
    </div>

    <hr />

    <div class="row">
        <?php echo $form->labelEx($model, 'idPsn'); ?>
        <?php echo $form->textField($model, 'idPsn', array('style' => 'width:150px;', 'maxlength' => 50)); ?>
        <?php echo $form->error($model, 'idPsn'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'idXbox'); ?>
        <?php echo $form->textField($model, 'idXbox', array('style' => 'width:150px;', 'maxlength' => 50)); ?>
        <?php echo $form->error($model, 'idXbox'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'idOrigin'); ?>
        <?php echo $form->textField($model, 'idOrigin', array('style' => 'width:150px;', 'maxlength' => 50)); ?>
        <?php echo $form->error($model, 'idOrigin'); ?>
    </div>

    <hr />

    <div class="row">
        <?php echo $form->labelEx($model, 'status'); ?>
        <?php echo $form->dropDownList($model, 'status', array('1' => 'Ativo', '0' => 'Inativo'), array('style' => 'width:100px;')); ?>
        <?php echo $form->error($model, 'status'); ?>
    </div>


    <br />
    <br />
    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Criar' : 'Salvar', array('class' => 'btn btn-success btn-large')); ?>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="<?php echo $baseUrlAdmin . '/jogadores'; ?>" class="btn btn-info btn-xs">Cancelar</a>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->