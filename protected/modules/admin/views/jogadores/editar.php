<?php
/* @var $this JogadoresController */
/* @var $model Jogador */

?>

<h1>Editar Jogador: <small><?php echo $model->nome; ?></small></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>