<?php
/* @var $this DesafiosController */
/* @var $model Desafio */

$baseUrlTheme = Yii::app()->theme->baseUrl;
$baseUrlAdmin = Yii::app()->controller->module->baseUrl;
?>

<h1>Desafios</h1>

<a href="<?php echo $baseUrlAdmin . "/desafios/criar"; ?>" class="btn btn-success" style="float:right;">Novo Desafio</a>

<br />
<br />

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'desafio-grid',
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
                        . '<b>Game:</b> ".$data->Game->nome',
            'type' => 'raw',
        ),
        array(
            'name' => 'tipo',
            'value' => 'ucwords($data->tipo)',
        ),
        'desafiante',
        array(
            'name' => 'mensagemDesafio',
            'value' => '"<b>".$data->getData(\'dataDesafio\')."</b>: ".$data->mensagemDesafio',
            'type' => 'raw',
        ),
        array(
            'name' => 'valor',
            'htmlOptions' => array("style" => "text-align:center;"),
            'value' => '"R$ ".number_format($data->valor, 2, \',\', \'.\')',
        ),
        'desafiado',
        array(
            'name' => 'mensagemResposta',
            'value' => '( ($data->resposta)?"<span class=\'label label-success\'><i class=\'fa fa-check\'></i></span>"'
                        . ':"<span class=\'label label-danger\'><i class=\'fa fa-times\'></i></span>" )." '
                            . '<b>".$data->getData(\'dataResposta\')."</b>: ".$data->mensagemResposta',
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
            'template' => '{update}{delete}',
            'buttons' => array
                (
                'update' => array
                    (
                    'label' => 'Editar',
                    'imageUrl' => $baseUrlTheme . '/assets/admin/layout/img/icons/icon_edit.png',
                    'url' => '"' . $baseUrlAdmin . '/desafios/editar/id/".$data->iddesafio',
                    'options' => array("style" => "margin-right:10px;"),
                ),
                'delete' => array
                    (
                    'label' => 'Deletar',
                    'imageUrl' => $baseUrlTheme . '/assets/admin/layout/img/icons/icon_delete.png',
                    'url' => '"' . $baseUrlAdmin . '/desafios/deletar/id/".$data->iddesafio',
                ),
            ),
            'deleteConfirmation' => 'Tem certeza que deseja deletar esse registro?',
            'htmlOptions' => array("style" => "text-align:center;width:140px;"),
        ),
    ),
));
?>
