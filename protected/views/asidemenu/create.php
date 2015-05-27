<?php
/* @var $this AsidemenuController */
/* @var $model Asidemenu */

$this->breadcrumbs=array(
	'Asidemenus'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Asidemenu', 'url'=>array('index')),
	array('label'=>'Manage Asidemenu', 'url'=>array('admin')),
);
?>

<h1>Create Asidemenu</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>