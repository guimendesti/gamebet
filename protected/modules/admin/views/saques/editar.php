<?php
/* @var $this SaquesController */
/* @var $model Jogsaque */

?>

<h1>Editar Saque #<small><?php echo $model->idjogsaque; ?></small></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>