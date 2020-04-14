<?php
/* @var $this JogadoresController */
/* @var $model Jogador */

$baseUrlTheme = Yii::app()->theme->baseUrl;
$baseUrlAdmin = Yii::app()->controller->module->baseUrl;
?>

<h1>Jogadores</h1>

<a href="<?php echo $baseUrlAdmin . "/jogadores/criar"; ?>" class="btn btn-success" style="float:right;">Novo Jogador</a>

<br />
<br />

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'jogador-grid',
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
            'name' => 'avatar',
            'value' => '(is_file("uploads/imagens/jogadores/".$data->avatar)) ? "<img src=\'' . Yii::app()->baseUrl . '/uploads/imagens/jogadores/".$data->avatar."\' class=\'img-thumbnail\' style=\'cursor:sw-resize;max-height:60px;\'  data-toggle=\"modal\" data-target=\"#img".$data->idjogador."\" /><div class=\"modal fade modalImage\" id=\"img".$data->idjogador."\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"".$data->avatar."\" aria-hidden=\"true\"><div class=\"modal-dialog\" style=\"width:700px;\"><div class=\"modal-content\"><div class=\"modal-header\"><button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button></div><div class=\"modal-body\"><img src=\'' . Yii::app()->baseUrl . '/uploads/imagens/jogadores/".$data->avatar."\' style=\"width:100%;\" /></div></div></div></div>" : "<span style=\'color:#999;\'>Sem Imagem</span>"',
            'htmlOptions' => array("style" => "text-align:center;"),
            'type' => 'raw',
        ),
        array(
            'name' => 'nome',
            'header' => 'Dados Pessoais',
            'value' => '"<b>Nome:</b> ".$data->nome."<br />'
                        . '<b>CPF:</b> ".$data->cpf."<br />'
                        . '<b>Usuário:</b> ".$data->usuario."<br />'
                        . '<b>Gênero:</b> ".$data->getGenero()."<br />'
                        . '<b>Nascimento:</b> ".$data->getNascimento()',
            'type' => 'raw',
        ),
        array(
            'name' => 'email',
            'header' => 'Contatos',
            'value' => '"<b>E-mail:</b> ".$data->email."<br />'
                        . '<b>Telefone 1:</b> ".$data->tel1."<br />'
                        . '<b>Telefone 2:</b> ".$data->tel2',
            'type' => 'raw',
        ),
        array(
            'name' => 'idPsn',
            'header' => 'IDs',
            'value' => '"<b>PSN:</b> ".$data->idPsn."<br />'
                        . '<b>Xbox:</b> ".$data->idXbox."<br />'
                        . '<b>Origin:</b> ".$data->idOrigin',
            'type' => 'raw',
        ),
        array(
            'name' => 'endereco',
            'value' => '$data->endereco." - ".$data->bairro."<br />".$data->cidade."/".$data->uf." - Cep: ".$data->cep',
            'type' => 'raw',
        ),
        array(
            'name' => 'status',
            'htmlOptions' => array("style" => "text-align:center;"),
            'value' => '($data->status)?"<span class=\'label label-success\'>Ativo</span>":"<span class=\'label label-danger\'>Inativo</span>"',
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
                    'url' => '"' . $baseUrlAdmin . '/jogadores/ver/id/".$data->idjogador',
                    'options' => array("style" => "margin-right:5px;"),
                ),
                'update' => array
                    (
                    'label' => 'Editar',
                    'imageUrl' => $baseUrlTheme . '/assets/admin/layout/img/icons/icon_edit.png',
                    'url' => '"' . $baseUrlAdmin . '/jogadores/editar/id/".$data->idjogador',
                    'options' => array("style" => "margin-right:10px;"),
                ),
                'delete' => array
                    (
                    'label' => 'Deletar',
                    'imageUrl' => $baseUrlTheme . '/assets/admin/layout/img/icons/icon_delete.png',
                    'url' => '"' . $baseUrlAdmin . '/jogadores/deletar/id/".$data->idjogador',
                ),
            ),
            'deleteConfirmation' => 'Tem certeza que deseja deletar esse registro?',
            'htmlOptions' => array("style" => "text-align:center;width:140px;"),
        ),
    ),
));
?>
