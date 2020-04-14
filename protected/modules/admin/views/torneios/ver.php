<?php
/* @var $this TorneiosController */
/* @var $model Torneio */

$baseUrlAdmin = Yii::app()->controller->module->baseUrl;
?>

<h1>Torneio: <small><?php echo $model->nome; ?></small></h1>

<a href="<?php echo $baseUrlAdmin . '/torneios'; ?>" class="btn btn-info btn-mini">Voltar</a>
<br />
<br />

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'nullDisplay' => '',
    'attributes' => array(
        array(
            'name' => 'Console.nome',
            'label' => 'Console',
        ),
        array(
            'name' => 'Game.nome',
            'label' => 'Game',
        ),
        'nome',
        'descricao',
        'jogadores',
        array(
            'name' => 'status',
            'value' => ($model->status)?"<span class='label label-success'>Ativo</span>":"<span class='label label-danger'>Inativo</span>",
            'type' => 'raw',
        ),
    ),
));
?>
