<div class="form">
	<form>
		<div class="item">
			<label class="k" for="Mainmenu_title">菜单名称</label>
		<span class="v">
			<input size="20" maxlength="20" class="text input-large" name="Mainmenu[title]" id="Mainmenu_title" type="text" value="">
		</span>
		</div>
		<div class="item">
			<label class="k" for="Mainmenu_url">链接</label>
		<span class="v">
			<input size="20" maxlength="20" class="text input-large" name="Mainmenu[url]" id="Mainmenu_url" type="text" value="">
		</span>
		</div>
		<div class="item">
			<label class="k" for="Mainmenu_enable">启用</label>
		<span class="v">
			<?php echo CHtml::dropDownList('Mainmenu[enable]', 1, array(0 => '禁用', 1 => '启用'), array('class' => 'beautify')) ?>
		</div>

		<div class="item item-control">
			<button type="submit" id="addBtn" class="btn btn-primary btn-large"><span>新建</span></button>
		</div>
	</form>

</div>