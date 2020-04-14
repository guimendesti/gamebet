<?php
/* @var $this MovimentacoesController */
/* @var $model Jogmovimentacao */

$baseUrlTheme = Yii::app()->theme->baseUrl;
$baseUrlAdmin = Yii::app()->controller->module->baseUrl;
?>

<h1>Movimentações</h1>

<br />
<br />

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'movimentacao-grid',
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
            'name' => 'data',
            'htmlOptions' => array("style" => "text-align:center;padding:10px 0;"),
            'value' => '$data->getData(true)'
        ),
        array(
            'name' => 'Jogador.usuario',
            'header' => 'Jogador'
        ),
        array(
            'name' => 'idtorneio',
            'header' => 'Torneio',
            'value' => '($data->idtorneio > 0)?$data->Torneio->nome:""'
        ),
        array(
            'name' => 'idpartida',
            'value' => '($data->idpartida > 0)?$data->Partida->getDataStatus(true):""'
        ),
        array(
            'name' => 'transacao',
            'htmlOptions' => array("style" => "text-align:center;"),
            'value' => '$data->getTransacao()'
        ),
        array(
            'name' => 'valor',
            'htmlOptions' => array("style" => "text-align:center;"),
            'value' => '"R$ ".number_format($data->valor, 2, \',\', \'.\')',
        ),
        array(
            'name' => 'saldoDepois',
            'header' => 'Saldo',
            'htmlOptions' => array("style" => "text-align:center;"),
            'value' => '"R$ ".number_format($data->saldoDepois, 2, \',\', \'.\')',
        ),
        /*
        array(
            'class' => 'CButtonColumn',
            'template' => '{update}',
            'buttons' => array
                (
                'update' => array
                    (
                    'label' => 'Editar',
                    'imageUrl' => $baseUrlTheme . '/assets/admin/layout/img/icons/icon_edit.png',
                    'url' => '"' . $baseUrlAdmin . '/movimentacoes/editar/id/".$data->idjogmovimentacao',
                    'options' => array("style" => "margin-right:10px;"),
                ),
                'delete' => array
                    (
                    'label' => 'Deletar',
                    'imageUrl' => $baseUrlTheme . '/assets/admin/layout/img/icons/icon_delete.png',
                    'url' => '"' . $baseUrlAdmin . '/movimentacoes/deletar/id/".$data->idjogmovimentacao',
                ),
            ),
            'deleteConfirmation' => 'Tem certeza que deseja deletar esse registro?',
            'htmlOptions' => array("style" => "text-align:center;width:140px;"),
        ),*/
    ),
));
?>
