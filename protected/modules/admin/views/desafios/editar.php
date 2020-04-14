<?php
/* @var $this DesafiosController */
/* @var $model Desafio */

?>

<h1>Editar Desafio: <small><?php echo $model->iddesafio; ?></small></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>