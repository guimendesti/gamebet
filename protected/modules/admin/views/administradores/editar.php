<?php
/* @var $this AdminAdministradoresController */
/* @var $model Admin */

?>

<h1>Editar Administrador: <small><?php echo $model->nome; ?></small></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>