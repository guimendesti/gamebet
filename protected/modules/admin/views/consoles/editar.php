<?php
/* @var $this ConsolesController */
/* @var $model Console */

?>

<h1>Editar Console: <small><?php echo $model->idconsole; ?></small></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>