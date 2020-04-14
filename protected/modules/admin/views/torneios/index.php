<?php
/* @var $this TorneiosController */
/* @var $model Torneio */

$baseUrlTheme = Yii::app()->theme->baseUrl;
$baseUrlAdmin = Yii::app()->controller->module->baseUrl;
?>

<h1>Torneios</h1>

<a href="<?php echo $baseUrlAdmin . "/torneios/criar"; ?>" class="btn btn-success" style="float:right;">Novo Torneio</a>

<br />
<br />

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'torneio-grid',
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
            'value' => '(is_file("uploads/imagens/torneios/".$data->imagem)) ? "<img src=\'' . Yii::app()->baseUrl . '/uploads/imagens/torneios/".$data->imagem."\' class=\'img-thumbnail\' style=\'cursor:sw-resize;max-height:60px;\'  data-toggle=\"modal\" data-target=\"#img".$data->idtorneio."\" /><div class=\"modal fade modalImage\" id=\"img".$data->idtorneio."\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"".$data->imagem."\" aria-hidden=\"true\"><div class=\"modal-dialog\" style=\"width:700px;\"><div class=\"modal-content\"><div class=\"modal-header\"><button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button></div><div class=\"modal-body\"><img src=\'' . Yii::app()->baseUrl . '/uploads/imagens/torneios/".$data->imagem."\' style=\"width:100%;\" /></div></div></div></div>" : "<span style=\'color:#999;\'>Sem Imagem</span>"',
            'htmlOptions' => array("style" => "text-align:center;"),
            'type' => 'raw',
        ),
        array(
            'name' => 'Console.nome',
            'header' => 'Console',
            'htmlOptions' => array("style" => "text-align:center;"),
        ),
        array(
            'name' => 'Game.nome',
            'header' => 'Game',
            'htmlOptions' => array("style" => "text-align:center;"),
        ),
        'nome',
        //'descricao',
        array(
            'name' => 'jogadores',
            'htmlOptions' => array("style" => "text-align:center;"),
        ),
        array(
            'name' => 'valor',
            'htmlOptions' => array("style" => "text-align:center;"),
            'value' => '"R$ ".number_format($data->valor, 2, \',\', \'.\')',
        ),
        array(
            'name' => 'status',
            'htmlOptions' => array("style" => "text-align:center;"),
            'value' => '$data->getStatus()',
            'type' => 'raw',
        ),
        array(
            'class' => 'CButtonColumn',
            'template' => '{view}{update}{delete}',
            'buttons' => array
                (
                'view' => array
                    (
                    'label' => 'Ver',
                    'imageUrl' => $baseUrlTheme . '/assets/admin/layout/img/icons/icon_lupa.png',
                    'url' => '"' . $baseUrlAdmin . '/torneios/ver/id/".$data->idtorneio',
                    'options' => array("style" => "margin-right:5px;"),
                ),
                'update' => array
                    (
                    'label' => 'Editar',
                    'imageUrl' => $baseUrlTheme . '/assets/admin/layout/img/icons/icon_edit.png',
                    'url' => '"' . $baseUrlAdmin . '/torneios/editar/id/".$data->idtorneio',
                    'options' => array("style" => "margin-right:10px;"),
                ),
                'delete' => array
                    (
                    'label' => 'Deletar',
                    'imageUrl' => $baseUrlTheme . '/assets/admin/layout/img/icons/icon_delete.png',
                    'url' => '"' . $baseUrlAdmin . '/torneios/deletar/id/".$data->idtorneio',
                ),
            ),
            'deleteConfirmation' => 'Tem certeza que deseja deletar esse registro?',
            'htmlOptions' => array("style" => "text-align:center;width:140px;"),
        ),
    ),
));
?>
