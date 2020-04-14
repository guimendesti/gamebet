<?php
/* @var $this MensagensController */
/* @var $model Chatmensagem */

?>

<h1>Editar Chatmensagem: <small><?php echo $model->idchatmensagem; ?></small></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>