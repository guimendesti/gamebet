<?php
/* @var $this PartidasController */
/* @var $model Partida */

$baseUrlAdmin = Yii::app()->controller->module->baseUrl;
?>

<h1>Partida<small> de <?php echo $model->getData('dataCriacao', true); ?></small></h1>

<a href="<?php echo $baseUrlAdmin . '/partidas'; ?>" class="btn btn-info btn-mini">Voltar</a>
<br />
<br />

<?php $this->widget('zii.widgets.CDetailView', array(
'data'=>$model,
'nullDisplay' => '',
'attributes'=>array(
		'idconsole',
		'idgame',
		'idtorneio',
		'valor',
		'dataCriacao',
		'dataAgendada',
		'dataPartida',
		'resultadoA',
		'dataResultadoA',
		'resultadoB',
		'dataResultadoB',
		'resultado',
		'dataResultado',
		'status',
),
)); ?>
