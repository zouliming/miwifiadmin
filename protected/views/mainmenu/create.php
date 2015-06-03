<?php
Yii::app()->clientScript
	->registerCoreScript('jquery')
	->registerCssFile(Util::getCssUrl() . 'page.default.css')
	->registerCssFile(Util::getCssUrl() . 'page.mainmenu.css')
	->registerCssFile(Util::getCssUrl() . 'dialog.css')
	->registerScriptFile(Util::getJsUrl() . 'selectbeautify.js');
?>
<div class="mod-mainmenu-panel">
	<h4>新建菜单</h4>

	<?php $this->renderPartial('_form', array()); ?>
</div>