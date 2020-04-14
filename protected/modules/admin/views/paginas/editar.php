<?php
/* @var $this PaginasController */
/* @var $model Pagina */

?>

<h1>Editar Página: <small><?php echo $model->nome; ?></small></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>