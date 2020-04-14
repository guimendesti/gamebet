<?php
/* @var $this ComissoesController */
/* @var $model Comissao */

?>

<h1>Editar Comissão #<small><?php echo $model->idcomissao; ?></small></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>