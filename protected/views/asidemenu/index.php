<?php
/* @var $this AsidemenuController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Asidemenus',
);

$this->menu=array(
	array('label'=>'Create Asidemenu', 'url'=>array('create')),
	array('label'=>'Manage Asidemenu', 'url'=>array('admin')),
);
?>

<h1>Asidemenus</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
