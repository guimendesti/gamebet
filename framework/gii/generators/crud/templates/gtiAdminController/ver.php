<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<?php echo "<?php\n"; ?>
/* @var $this <?php echo $this->getControllerClass(); ?> */
/* @var $model <?php echo $this->getModelClass(); ?> */

$baseUrlAdmin = Yii::app()->controller->module->baseUrl;
?>

<h1><?php echo $this->modelClass . ": <small><?php echo \$model->{$this->tableSchema->primaryKey}; ?></small>"; ?></h1>

<a href="<?php echo "<?php echo "; ?>$baseUrlAdmin<?php echo " . '/" . strtolower($this->pluralize($this->modelClass)) . "'; ?>"; ?>" class="btn btn-info btn-mini">Voltar</a>
<br />
<br />

<?php echo "<?php"; ?> $this->widget('zii.widgets.CDetailView', array(
'data'=>$model,
'nullDisplay' => '',
'attributes'=>array(
<?php
foreach ($this->tableSchema->columns as $column) {

    if ($column->name != "id" . strtolower($this->class2name($this->modelClass))) {
        echo "\t\t'" . $column->name . "',\n";
    }
}
?>
),
)); ?>
