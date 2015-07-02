<?php
/* @var $this WeightController */
/* @var $model Weight */

$this->breadcrumbs=array(
	'Weights'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Weight', 'url'=>array('index')),
	array('label'=>'Create Weight', 'url'=>array('create')),
	array('label'=>'View Weight', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Weight', 'url'=>array('admin')),
);
?>

<h1>Update Weight <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>