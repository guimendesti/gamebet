<?php
/* @var $this PartidasController */
/* @var $model Partida */

?>

<h1>Editar Partida<small> de <?php echo $model->getData('dataCriacao', true); ?></small></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>