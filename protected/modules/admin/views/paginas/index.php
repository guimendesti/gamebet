<?php
/* @var $this PaginasController */
/* @var $model Pagina */

$baseUrlTheme = Yii::app()->theme->baseUrl;
$baseUrlAdmin = Yii::app()->controller->module->baseUrl;
?>

<h1>Páginas</h1>

<?php /*
<a href="<?php echo $baseUrlAdmin . "/paginas/criar"; ?>" class="btn btn-success" style="float:right;">Nova Página</a>
*/?>
<br />
<br />

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'pagina-grid',
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
        'nome',
        'apelido',
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
                    'url' => '"' . $baseUrlAdmin . '/paginas/editar/id/".$data->idpagina',
                    'options' => array("style" => "margin-right:10px;"),
                ),
                'delete' => array
                    (
                    'label' => 'Deletar',
                    'imageUrl' => $baseUrlTheme . '/assets/admin/layout/img/icons/icon_delete.png',
                    'url' => '"' . $baseUrlAdmin . '/paginas/deletar/id/".$data->idpagina',
                ),
            ),
            'deleteConfirmation' => 'Tem certeza que deseja deletar esse registro?',
            'htmlOptions' => array("style" => "text-align:center;width:140px;"),
        ),
    ),
));
?>
