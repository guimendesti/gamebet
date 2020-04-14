<?php
/* @var $this PaginasController */
/* @var $model Pagina */

$baseUrlAdmin = Yii::app()->controller->module->baseUrl;
?>

<h1>Pagina: <small><?php echo $model->idpagina; ?></small></h1>

<a href="<?php echo $baseUrlAdmin . '/paginas'; ?>" class="btn btn-info btn-mini">Voltar</a>
<br />
<br />

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'nullDisplay' => '',
    'attributes' => array(
        'nome',
        'descricao',
        'conteudo',
        'status',
    ),
));
?>
