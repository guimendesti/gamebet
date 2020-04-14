<?php
/* @var $this PartidasController */
/* @var $model Partida */

$baseUrlTheme = Yii::app()->theme->baseUrl;
$baseUrlAdmin = Yii::app()->controller->module->baseUrl;
?>

<h1>Partidas</h1>

<a href="<?php echo $baseUrlAdmin . "/partidas/criar"; ?>" class="btn btn-success" style="float:right;">Nova Partida</a>

<br />
<br />

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'partida-grid',
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
            'name' => 'idconsole',
            'header' => 'Plataforma',
            'value' => '"<b>Console:</b> ".$data->Console->nome."<br />'
                        . '<b>Game:</b> ".$data->Game->nome'
                        . '.( ($data->idtorneio > 0) ? "<br /><b>Torneio:</b> ".$data->Torneio->nome : "" )',
            'type' => 'raw',
        ),
        array(
            'name' => 'valor',
            'htmlOptions' => array("style" => "text-align:center;"),
            'value' => '"R$ ".number_format($data->valor, 2, \',\', \'.\')',
        ),
        array(
            'name' => 'dataCriacao',
            'header' => 'Calendário',
            'value' => '$data->getCalendario()',
            'type' => 'raw',
        ),
        array(
            'name' => 'resultado',
            'value' => '$data->getResultados()',
            'type' => 'raw',
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
                    'url' => '"' . $baseUrlAdmin . '/partidas/ver/id/".$data->idpartida',
                    'options' => array("style" => "margin-right:5px;"),
                ),
                'update' => array
                    (
                    'label' => 'Editar',
                    'imageUrl' => $baseUrlTheme . '/assets/admin/layout/img/icons/icon_edit.png',
                    'url' => '"' . $baseUrlAdmin . '/partidas/editar/id/".$data->idpartida',
                    'options' => array("style" => "margin-right:10px;"),
                ),
                'delete' => array
                    (
                    'label' => 'Deletar',
                    'imageUrl' => $baseUrlTheme . '/assets/admin/layout/img/icons/icon_delete.png',
                    'url' => '"' . $baseUrlAdmin . '/partidas/deletar/id/".$data->idpartida',
                ),
            ),
            'deleteConfirmation' => 'Tem certeza que deseja deletar esse registro?',
            'htmlOptions' => array("style" => "text-align:center;width:140px;"),
        ),
    ),
));
?>
