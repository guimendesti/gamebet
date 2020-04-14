<?php
/* @var $this ConsolesController */
/* @var $model Console */
/* @var $form CActiveForm */

$baseUrlAdmin = Yii::app()->controller->module->baseUrl;
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'console-form',
        'enableAjaxValidation' => false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
    ));
    
    echo ($form->errorSummary($model)) 
            ? "<div class='errorAlert alert alert-danger'>"
                   ."Por favor, corrija os problemas abaixo!"
              ."</div>" 
            : ''; 
    ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'imagem'); ?>
        <?php echo $form->fileField($model, 'imagem', array('style' => 'display:inline-block;')); ?>
        <?php
        if (!$model->isNewRecord) {
            echo "<br />";
            echo (is_file("uploads/imagens/consoles/" . $model->imagem)) 
                    ? "<img src='" . Yii::app()->baseUrl . "/uploads/imagens/consoles/" . $model->imagem . "' class='img-thumbnail' "
                        . "style='cursor:sw-resize;max-height:100px;margin-left:142px;' data-toggle='modal' data-target='#img" . $model->idconsole . "' />"
                        . "<div class='modal fade modalImage' id='img" . $model->idconsole . "' tabindex='-1' role='dialog' aria-labelledby='" . $model->imagem . "' aria-hidden='true'>"
                        . " <div class='modal-dialog' style='width:700px;'>"
                        . "     <div class='modal-content'>"
                        . "         <div class='modal-header'>"
                        . "             <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>"
                        . "         </div>"
                        . "         <div class='modal-body'>"
                        . "             <img src='" . Yii::app()->baseUrl . "/uploads/imagens/consoles/" . $model->imagem . "' style='width:100%;' />"
                        . "         </div>"
                        . "     </div>"
                        . " </div>"
                        . "</div>" 
                    : "<span style='color:#999;margin-left:142px;'>Sem Imagem</span>";
        }
        ?>
        <?php echo $form->error($model, 'imagem'); ?>
    </div>
    
    <hr />

    <div class="row">
        <?php echo $form->labelEx($model, 'nome'); ?>
        <?php echo $form->textField($model, 'nome', array('size' => 50, 'maxlength' => 50)); ?>
        <?php echo $form->error($model, 'nome'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'descricao'); ?>
        <?php echo $form->textField($model, 'descricao', array('size' => 60, 'maxlength' => 250)); ?>
        <?php echo $form->error($model, 'descricao'); ?>
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
        <a href="<?php echo $baseUrlAdmin . '/consoles'; ?>" class="btn btn-info btn-xs">Cancelar</a>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->