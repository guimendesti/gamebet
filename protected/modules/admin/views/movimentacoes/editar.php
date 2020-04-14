<?php
/* @var $this MovimentacoesController */
/* @var $model Jogmovimentacao */

?>

<h1>Editar Movimentação #<small><?php echo $model->idjogmovimentacao; ?></small></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>