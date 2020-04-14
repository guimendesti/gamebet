<?php
/* @var $this CreditosController */
/* @var $model Jogcredito */

?>

<h1>Editar Crédito #<small><?php echo $model->idjogcredito; ?></small></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>