<?php
/* @var $this JogadoresController */
/* @var $model Jogador */
/* @var $form CActiveForm */

$baseUrl = Yii::app()->baseUrl;
?>

<div class="row form formEditarConta">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'jogador-form',
        'enableAjaxValidation' => false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
    ));

    echo ($form->errorSummary($model)) ? "<div class='errorAlert alert alert-danger'>"
            . "Por favor, corrija os problemas abaixo!"
            . "</div>" : '';
    ?>
    
    <div class="row buttons">
        <a href="<?php echo $baseUrl . '/jogador'; ?>" class="btn btn-default btn-xs">Cancelar Alterações</a>
        <button type="submit" class='btn btn-success btn-large btnSalvar'>
            <i class="fa fa-floppy-o"></i>&nbsp;&nbsp;Salvar
        </button>
        
    </div>

    <div class="col-md-6 col-sm-6">
        <div class="row">
            <?php echo $form->labelEx($model, 'nome'); ?>
            <?php echo $form->textField($model, 'nome', array('size' => 60, 'maxlength' => 150)); ?>
            <?php echo $form->error($model, 'nome'); ?>
        </div>

        <div class="row">
            <div class="col-md-6 col-sm-6">
                <?php echo $form->labelEx($model, 'cpf'); ?>
                <?php echo $form->textField($model, 'cpf', array('style' => '', 'maxlength' => 11)); ?>
                <?php echo $form->error($model, 'cpf'); ?>
            </div>
            <div class="col-md-6 col-sm-6">
                <?php echo $form->labelEx($model, 'nascimento'); ?>
                <?php echo $form->textField($model, 'nascimento', array('style' => '')); ?>
                <?php echo $form->error($model, 'nascimento'); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 col-sm-6">
                <?php echo $form->labelEx($model, 'usuario'); ?>
                <?php echo $form->textField($model, 'usuario', array('size' => 30, 'maxlength' => 30)); ?>
                <?php echo $form->error($model, 'usuario'); ?>
            </div>
            <div class="col-md-6 col-sm-6">
                <?php echo $form->labelEx($model, 'genero'); ?>
                <?php echo $form->dropDownList($model, 'genero', array('0' => 'Selecione ...', 'f' => 'Feminino', 'm' => 'Masculino'), array('style' => 'width:150px;')); ?>
                <?php echo $form->error($model, 'genero'); ?>
            </div>
        </div>

        <hr />

        <div class="row">
            <div class="col-md-8 col-sm-7">
                <?php echo $form->labelEx($model, 'email'); ?>
                <?php echo $form->textField($model, 'email', array('size' => 60, 'maxlength' => 150)); ?>
                <?php echo $form->error($model, 'email'); ?>
            </div>
            <div class="col-md-4 col-sm-5">
                <?php echo $form->labelEx($model, 'senha'); ?>
                <?php
                    echo $form->hiddenField($model, 'senha');
                    unset($model->senha);
                    echo '<a onclick="jQuery(this).hide();jQuery(\'#cpSenha\').show();jQuery(\'#cpSenha\').focus();" class="linkAlterarSenha">Alterar senha</a>';
                    echo '<span id="cpSenha" style="display:none;">';
                    echo $form->passwordField($model, 'senha', array('name' => 'novaSenha'));
                    echo '&nbsp;&nbsp;<a onclick="jQuery(\'.linkAlterarSenha\').show();jQuery(\'#cpSenha\').hide();jQuery(\'input[name=novaSenha]\').val(\'\')"  class="linkAlterarSenha">Cancelar</a>';
                    echo '</span>';
                ?>
                <?php echo $form->error($model, 'senha'); ?>
            </div>
        </div>

        <hr />

        <div class="row">
            <div class="col-md-4 col-sm-4">
                <?php echo $form->labelEx($model, 'idPsn'); ?>
                <?php echo $form->textField($model, 'idPsn', array('style' => '', 'maxlength' => 50)); ?>
                <?php echo $form->error($model, 'idPsn'); ?>
            </div>
            <div class="col-md-4 col-sm-4">
                <?php echo $form->labelEx($model, 'idXbox'); ?>
                <?php echo $form->textField($model, 'idXbox', array('style' => '', 'maxlength' => 50)); ?>
                <?php echo $form->error($model, 'idXbox'); ?>
            </div>

            <div class="col-md-4 col-sm-4">
                <?php echo $form->labelEx($model, 'idOrigin'); ?>
                <?php echo $form->textField($model, 'idOrigin', array('style' => '', 'maxlength' => 50)); ?>
                <?php echo $form->error($model, 'idOrigin'); ?>
            </div>
        </div>
        
        <hr />
    </div>

    <div class="col-md-6 col-sm-6">
        <div class="row">
            <?php echo $form->labelEx($model, 'avatar'); ?>
            <?php
            if (!$model->isNewRecord) {
                echo (is_file("uploads/imagens/jogadores/" . $model->avatar)) ? "<img src='" . Yii::app()->baseUrl . "/uploads/imagens/jogadores/" . $model->avatar . "' class='img-thumbnail' "
                        . "style='cursor:sw-resize;max-height:100px;' data-toggle='modal' data-target='#img" . $model->idjogador . "' />"
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
                        . "</div>" : "<span style='color:#999;margin-left:142px;'>Sem Imagem</span>";
            }
            ?>
            <?php echo $form->fileField($model, 'avatar', array('style' => '')); ?>
            <?php echo $form->error($model, 'avatar'); ?>
        </div>

        <hr />

        <div class="row">
            <div class="col-md-5 col-sm-5">
                <?php echo $form->labelEx($model, 'cep'); ?>
                <?php echo $form->textField($model, 'cep', array('style' => '', 'maxlength' => 10)); ?>
                <?php echo $form->error($model, 'cep'); ?>
            </div>
            <div class="col-md-7 col-sm-7">
                <?php echo $form->labelEx($model, 'cidade', array('label' => 'Cidade/UF')); ?>
                <div class="">
                    <div class="col-md-8 col-sm-8" style="padding-right:0px;">
                        <?php echo $form->textField($model, 'cidade', array('style' => '', 'maxlength' => 50)); ?>
                    </div>
                    <div class="col-md-4 col-sm-4" style="padding-right:0px;">
                        <?php echo $form->textField($model, 'uf', array('style' => 'max-width:40px;', 'maxlength' => 2)); ?>
                    </div>
                </div>
                <?php echo $form->error($model, 'cidade'); ?>
                <?php echo $form->error($model, 'uf'); ?>
            </div>
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
            <?php echo $form->labelEx($model, 'tel1', array('label' => 'Telefone(s)')); ?>
            <?php echo $form->textField($model, 'tel1', array('style' => 'width:140px;', 'maxlength' => 25)); ?>
            &nbsp;e&nbsp;
            <?php echo $form->textField($model, 'tel2', array('style' => 'width:140px;', 'maxlength' => 25)); ?>
            <?php echo $form->error($model, 'tel1'); ?>
            <?php echo $form->error($model, 'tel2'); ?>
        </div>

    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->