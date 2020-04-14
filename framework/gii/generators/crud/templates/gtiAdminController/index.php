<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<?php echo "<?php\n"; ?>
/* @var $this <?php echo $this->getControllerClass(); ?> */
/* @var $model <?php echo $this->getModelClass(); ?> */

$baseUrlTheme = Yii::app()->theme->baseUrl;
$baseUrlAdmin = Yii::app()->controller->module->baseUrl;
?>

<h1><?php echo ucwords($this->pluralize($this->class2name($this->modelClass))); ?></h1>

<a href="<?php echo '<?php echo $baseUrlAdmin."/' . strtolower($this->pluralize($this->class2name($this->modelClass))) . '/criar"; ?>'; ?>" class="btn btn-success" style="float:right;">Novo <?php echo ucwords($this->class2name($this->modelClass)); ?></a>

<br />
<br />

<?php echo "<?php"; ?> $this->widget('zii.widgets.grid.CGridView', array(
'id'=>'<?php echo $this->class2id($this->modelClass); ?>-grid',
'dataProvider'=>$model->search(),
'emptyText'=>'Nenhum registro foi encontrado',
'summaryText' => '',
'enableSorting'=>false,
'htmlOptions'=>array("style"=>"font-size:13px;"),
'pager'=>array(
'header' => '<br /><br />Páginas:&nbsp;&nbsp;',
'firstPageLabel' => '&lt;&lt;',
'prevPageLabel'  => '&lt; Anterior',
'nextPageLabel'  => 'Próxima &gt;',
'lastPageLabel'  => '&gt;&gt;',
'htmlOptions' => array(
"style" => "vertical-align:middle;",
"class" => "pagination"
),
'selectedPageCssClass' => 'disabled'
),
'columns'=>array(
<?php
$count = 0;
foreach ($this->tableSchema->columns as $column) {
    if ($column->autoIncrement)
        continue;

    if (++$count == 7) {
        echo "\t\t/*\n";
    }
    echo "\t\t'" . $column->name . "',\n";
}
if ($count >= 7)
    echo "\t\t*/\n";
?>

array(
'class'=>'CButtonColumn',
'template'=>'{view}{update}{delete}',
'buttons'=>array
(
'view' => array
(
'label'=>'Ver',
'imageUrl'=>$baseUrlTheme.'/assets/admin/layout/img/icons/icon_lupa.png',
'url'=>'"'.$baseUrlAdmin.'/<?php echo strtolower($this->pluralize($this->class2name($this->modelClass))); ?>/ver/id/".$data->id<?php echo $this->class2id($this->modelClass); ?>',
'options'=>array("style" => "margin-right:5px;"),
),
'update' => array
(
'label'=>'Editar',
'imageUrl'=>$baseUrlTheme.'/assets/admin/layout/img/icons/icon_edit.png',
'url'=>'"'.$baseUrlAdmin.'/<?php echo strtolower($this->pluralize($this->class2name($this->modelClass))); ?>/editar/id/".$data->id<?php echo $this->class2id($this->modelClass); ?>',
'options'=>array("style" => "margin-right:10px;"),
),
'delete' => array
(
'label'=>'Deletar',
'imageUrl'=>$baseUrlTheme.'/assets/admin/layout/img/icons/icon_delete.png',
'url'=>'"'.$baseUrlAdmin.'/<?php echo strtolower($this->pluralize($this->class2name($this->modelClass))); ?>/deletar/id/".$data->id<?php echo $this->class2id($this->modelClass); ?>',
),
),
'deleteConfirmation'=>'Tem certeza que deseja deletar esse registro?',
'htmlOptions'=>array("style"=>"text-align:center;width:140px;"),

),
),
)); ?>
