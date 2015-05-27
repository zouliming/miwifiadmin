<?php
/* @var $this AsidemenuController */
/* @var $model Asidemenu */

$this->breadcrumbs=array(
	'Asidemenus'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Asidemenu', 'url'=>array('index')),
	array('label'=>'Create Asidemenu', 'url'=>array('create')),
	array('label'=>'View Asidemenu', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Asidemenu', 'url'=>array('admin')),
);
?>

<h1>Update Asidemenu <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>