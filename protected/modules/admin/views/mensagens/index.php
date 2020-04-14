<?php
/* @var $this MensagensController */
/* @var $model Chatmensagem */

$baseUrlTheme = Yii::app()->theme->baseUrl;
$baseUrlAdmin = Yii::app()->controller->module->baseUrl;
?>

<h1>Chatmensagems</h1>

<a href="<?php echo $baseUrlAdmin."/chatmensagems/criar"; ?>" class="btn btn-success" style="float:right;">Novo Chatmensagem</a>

<br />
<br />

<?php $this->widget('zii.widgets.grid.CGridView', array(
'id'=>'chatmensagem-grid',
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
		'idjogador',
		'destinatario',
		'data',
		'lida',
		'mensagem',
		'status',

array(
'class'=>'CButtonColumn',
'template'=>'{view}{update}{delete}',
'buttons'=>array
(
'view' => array
(
'label'=>'Ver',
'imageUrl'=>$baseUrlTheme.'/assets/admin/layout/img/icons/icon_lupa.png',
'url'=>'"'.$baseUrlAdmin.'/chatmensagems/ver/id/".$data->idchatmensagem',
'options'=>array("style" => "margin-right:5px;"),
),
'update' => array
(
'label'=>'Editar',
'imageUrl'=>$baseUrlTheme.'/assets/admin/layout/img/icons/icon_edit.png',
'url'=>'"'.$baseUrlAdmin.'/chatmensagems/editar/id/".$data->idchatmensagem',
'options'=>array("style" => "margin-right:10px;"),
),
'delete' => array
(
'label'=>'Deletar',
'imageUrl'=>$baseUrlTheme.'/assets/admin/layout/img/icons/icon_delete.png',
'url'=>'"'.$baseUrlAdmin.'/chatmensagems/deletar/id/".$data->idchatmensagem',
),
),
'deleteConfirmation'=>'Tem certeza que deseja deletar esse registro?',
'htmlOptions'=>array("style"=>"text-align:center;width:140px;"),

),
),
)); ?>
