<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle=Yii::app()->name . ' - Erro';

?>

<h2>Erro <?php echo $code; ?></h2>

<div class="error">
<?php echo CHtml::encode($message); ?>
</div>