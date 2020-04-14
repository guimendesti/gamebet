<?php
/* @var $this BannersController */
/* @var $model Banner */

$baseUrlAdmin = Yii::app()->controller->module->baseUrl;
?>

<h1>Banners</h1>

<a href="<?php echo $baseUrlAdmin . "/banners/criar"; ?>" class="btn btn-success" style="float:right;">Novo Banner</a>

<br />
<br />

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'banner-grid',
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
            "style" => "vertical-align:middle;"
        ),
    ),
    'columns' => array(
        array(
            'name' => 'loja.nomeFantasia',
            'header' => 'Loja',
        ),
        array(
            'name' => 'categoria',
            'value' => 'ucfirst($data->categoria)',
            'htmlOptions' => array("style" => "text-align:center;"),
        ),
        array(
            'name' => 'posicao',
            'htmlOptions' => array("style" => "text-align:center;"),
        ),
        array(
            'name' => 'imagem',
            'value' => '(is_file("images/banners/".$data->imagem)) ? "<img src=\'' . Yii::app()->baseUrl . '/images/banners/".$data->imagem."\' class=\'img-thumbnail\' style=\'cursor:sw-resize;max-height:60px;\'  data-toggle=\"modal\" data-target=\"#img".$data->idbanner."\" /><div class=\"modal fade modalImage\" id=\"img".$data->idbanner."\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"".$data->imagem."\" aria-hidden=\"true\"><div class=\"modal-dialog\" style=\"width:700px;\"><div class=\"modal-content\"><div class=\"modal-header\"><button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button></div><div class=\"modal-body\"><img src=\'' . Yii::app()->baseUrl . '/images/banners/".$data->imagem."\' style=\"width:100%;\" /></div></div></div></div>" : "<span style=\'color:#999;\'>Sem Imagem</span>"',
            'htmlOptions' => array("style" => "text-align:center;"),
            'type' => 'raw',
        ),
        array(
            'name' => 'status',
            'header' => 'Status',
            'htmlOptions' => array("style" => "text-align:center;"),
            'value' => '($data->status)?"<span class=\'badge badge-success\'>Ativo</span>":"<span class=\'badge badge-danger\'>Inativo</span>"',
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
                    'imageUrl' => Yii::app()->baseUrl . '/images/icone/icon_edit.png',
                    'url' => 'Yii::app()->createUrl("' . $baseUrlAdmin . '/banners/editar",array("id" => $data->idbanner))',
                    'options' => array("style" => "margin-right:10px;"),
                ),
                'delete' => array
                    (
                    'label' => 'Deletar',
                    'imageUrl' => Yii::app()->baseUrl . '/images/icone/icon_delete.png',
                    'url' => 'Yii::app()->createUrl("' . $baseUrlAdmin . '/banners/deletar",array("id" => $data->idbanner))',
                ),
            ),
            'deleteConfirmation' => 'Tem certeza que deseja deletar esse registro?',
            'htmlOptions' => array("style" => "text-align:center;width:140px;"),
        ),
    ),
));
?>
