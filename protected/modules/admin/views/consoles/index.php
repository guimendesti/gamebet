<?php
/* @var $this ConsolesController */
/* @var $model Console */

$baseUrlTheme = Yii::app()->theme->baseUrl;
$baseUrlAdmin = Yii::app()->controller->module->baseUrl;
?>

<h1>Consoles</h1>

<a href="<?php echo $baseUrlAdmin . "/consoles/criar"; ?>" class="btn btn-success" style="float:right;">Novo Console</a>

<br />
<br />

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'console-grid',
    'dataProvider' => $model->search(),
    'emptyText' => 'Nenhum registro foi encontrado',
    'summaryText' => '',
    'enableSorting' => false,
    'htmlOptions' => array("style" => "font-size:13px;"),
    'pager' => array(
        'header' => '<br /><br />Páginas:&nbsp;&nbsp;',
        'firstPageLabel' => '&lt;&lt;',
        'prevPageLabel' => '&lt; Anterior',
        'nextPageLabel' => 'Próxima &gt;',
        'lastPageLabel' => '&gt;&gt;',
        'htmlOptions' => array(
            "style" => "vertical-align:middle;",
            "class" => "pagination"
        ),
        'selectedPageCssClass' => 'disabled'
    ),
    'columns' => array(
        array(
            'name' => 'imagem',
            'value' => '(is_file("uploads/imagens/consoles/".$data->imagem)) ? "<img src=\'' . Yii::app()->baseUrl . '/uploads/imagens/consoles/".$data->imagem."\' class=\'img-thumbnail\' style=\'cursor:sw-resize;max-height:60px;\'  data-toggle=\"modal\" data-target=\"#img".$data->idconsole."\" /><div class=\"modal fade modalImage\" id=\"img".$data->idconsole."\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"".$data->imagem."\" aria-hidden=\"true\"><div class=\"modal-dialog\" style=\"width:700px;\"><div class=\"modal-content\"><div class=\"modal-header\"><button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button></div><div class=\"modal-body\"><img src=\'' . Yii::app()->baseUrl . '/uploads/imagens/consoles/".$data->imagem."\' style=\"width:100%;\" /></div></div></div></div>" : "<span style=\'color:#999;\'>Sem Imagem</span>"',
            'htmlOptions' => array("style" => "text-align:center;"),
            'type' => 'raw',
        ),
        'nome',
        'descricao',
        array(
            'name' => 'status',
            'htmlOptions' => array("style" => "text-align:center;"),
            'value' => '($data->status)?"<span class=\'label label-success\'>Ativo</span>":"<span class=\'label label-danger\'>Inativo</span>"',
            'type' => 'raw',
        ),
        array(
            'class' => 'CButtonColumn',
            'template' => '{update}{delete}',
            'buttons' => array
                (
                'update' => array
                    (
                    'label' => 'Editar',
                    'imageUrl' => $baseUrlTheme . '/assets/admin/layout/img/icons/icon_edit.png',
                    'url' => '"' . $baseUrlAdmin . '/consoles/editar/id/".$data->idconsole',
                    'options' => array("style" => "margin-right:10px;"),
                ),
                'delete' => array
                    (
                    'label' => 'Deletar',
                    'imageUrl' => $baseUrlTheme . '/assets/admin/layout/img/icons/icon_delete.png',
                    'url' => '"' . $baseUrlAdmin . '/consoles/deletar/id/".$data->idconsole',
                ),
            ),
            'deleteConfirmation' => 'Tem certeza que deseja deletar esse registro?',
            'htmlOptions' => array("style" => "text-align:center;width:140px;"),
        ),
    ),
));
?>
