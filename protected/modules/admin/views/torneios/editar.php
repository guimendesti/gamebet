<?php
/* @var $this TorneiosController */
/* @var $model Torneio */

?>

<h1>Editar Torneio: <small><?php echo $model->nome; ?></small></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>