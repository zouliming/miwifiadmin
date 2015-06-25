<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle=Yii::app()->name . ' - Error';
$this->breadcrumbs=array(
	'Error',
);
?>

<h2>错误： <?php echo $code; ?></h2>

<div class="alert alert-danger">
<?php echo CHtml::encode($message); ?>
</div>