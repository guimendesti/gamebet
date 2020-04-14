<?php
/* @var $this JogadoresController */
/* @var $model Jogador */

$baseUrlAdmin = Yii::app()->controller->module->baseUrl;
?>

<h1>Jogador: <small><?php echo $model->nome; ?></small></h1>

<a href="<?php echo $baseUrlAdmin . '/jogadores'; ?>" class="btn btn-info btn-mini">Voltar</a>
<br />
<br />

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'nullDisplay' => '',
    'attributes' => array(
        'idPsn',
        'idXbox',
        'idOrigin',
        'nome',
        'email',
        'usuario',
        'senha',
        'genero',
        'nascimento',
        'tel1',
        'tel2',
        'endereco',
        'cidade',
        'uf',
        'cep',
        'status',
    ),
));
?>
