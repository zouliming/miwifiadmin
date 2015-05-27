<?php
/* @var $this AsidemenuController */
/* @var $model Asidemenu */

$this->breadcrumbs=array(
	'Asidemenus'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Asidemenu', 'url'=>array('index')),
	array('label'=>'Create Asidemenu', 'url'=>array('create')),
	array('label'=>'Update Asidemenu', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Asidemenu', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Asidemenu', 'url'=>array('admin')),
);
?>

<h1>View Asidemenu #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'map',
		'url',
		'module_id',
		'enable',
	),
)); ?>
