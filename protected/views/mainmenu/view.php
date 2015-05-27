<?php
/* @var $this MainmenuController */
/* @var $model Mainmenu */

?>

<h1>View Mainmenu #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'url',
		'enable',
	),
)); ?>
