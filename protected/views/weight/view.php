<?php
/* @var $this WeightController */
/* @var $model Weight */

$this->breadcrumbs=array(
	'Weights'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Weight', 'url'=>array('index')),
	array('label'=>'Create Weight', 'url'=>array('create')),
	array('label'=>'Update Weight', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Weight', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Weight', 'url'=>array('admin')),
);
?>

<h1>View Weight #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'weight',
		'date',
	),
)); ?>
