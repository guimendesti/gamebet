<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<?php echo "<?php\n"; ?>
/* @var $this <?php echo $this->getControllerClass(); ?> */
/* @var $model <?php echo $this->getModelClass(); ?> */
/* @var $form CActiveForm */

$baseUrlAdmin = Yii::app()->controller->module->baseUrl;
?>

<div class="form">

    <?php echo "<?php \$form=\$this->beginWidget('CActiveForm', array(
	'id'=>'" . $this->class2id($this->modelClass) . "-form',
	'enableAjaxValidation'=>false,
)); ?>\n"; ?>

    <?php echo "<?php echo \$form->errorSummary(\$model); ?>\n"; ?>

    <?php
    foreach ($this->tableSchema->columns as $column) {
        if ($column->autoIncrement)
            continue;
        ?>
        <div class="row">
            <?php echo "<?php echo " . $this->generateActiveLabel($this->modelClass, $column) . "; ?>\n"; ?>
            <?php echo "<?php echo " . $this->generateActiveField($this->modelClass, $column) . "; ?>\n"; ?>
            <?php echo "<?php echo \$form->error(\$model,'{$column->name}'); ?>\n"; ?>
        </div>

        <?php
    }
    ?>

    <br />
    <br />
    <div class="row buttons">
        <?php echo "<?php echo CHtml::submitButton(" ?>$model->isNewRecord<?php echo " ? 'Criar' : 'Salvar', array('class'=>'btn btn-success btn-large')); ?>" ?>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="<?php echo "<?php echo "; ?>$baseUrlAdmin<?php echo ".'/" . $this->class2id($this->modelClass) . "s'; ?>"; ?>" class="btn btn-info btn-xs">Cancelar</a>
    </div>

    <?php echo "<?php \$this->endWidget(); ?>\n"; ?>

</div><!-- form -->