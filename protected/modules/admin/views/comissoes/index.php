<?php
/* @var $this ComissoesController */
/* @var $model Comissao */

$baseUrlTheme = Yii::app()->theme->baseUrl;
$baseUrlAdmin = Yii::app()->controller->module->baseUrl;
?>

<h1>Comissões</h1>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'comissao-grid',
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
            'name' => 'idjogmovimentacao',
            'htmlOptions' => array("style" => "text-align:center;"),
            'value' => '"#".$data->idjogmovimentacao',
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
                    'url' => '"' . $baseUrlAdmin . '/comissoes/editar/id/".$data->idcomissao',
                    'options' => array("style" => "margin-right:10px;"),
                ),
                'delete' => array
                    (
                    'label' => 'Deletar',
                    'imageUrl' => $baseUrlTheme . '/assets/admin/layout/img/icons/icon_delete.png',
                    'url' => '"' . $baseUrlAdmin . '/comissoes/deletar/id/".$data->idcomissao',
                ),
            ),
            'deleteConfirmation' => 'Tem certeza que deseja deletar esse registro?',
            'htmlOptions' => array("style" => "text-align:center;width:140px;"),
        ),*/
    ),
));
?>
