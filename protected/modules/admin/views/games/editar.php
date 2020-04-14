<?php
/* @var $this GamesController */
/* @var $model Game */

?>

<h1>Editar Game: <small><?php echo $model->idgame; ?></small></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>