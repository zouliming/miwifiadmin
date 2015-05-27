<?php
/* @var $this MainmenuController */
/* @var $model Mainmenu */

$this->breadcrumbs=array(
	'Mainmenus'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Mainmenu', 'url'=>array('index')),
	array('label'=>'Create Mainmenu', 'url'=>array('create')),
	array('label'=>'View Mainmenu', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Mainmenu', 'url'=>array('admin')),
);
?>

<h1>Update Mainmenu <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>