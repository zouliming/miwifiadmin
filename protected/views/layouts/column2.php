<?php $this->beginContent('//layouts/main'); ?>
<div id="bd" class="dft">
    <div class="set-bd">
        <div class="grid-2 clearfix">
                <?php echo $content;?>
            <!-- 二级菜单 -->
            <?php
            $this->widget('application.components.widgets.asideMenuWidget', array(
                    'asideMenu'=>$this->asideMenu
            ));
            ?>
        </div>
    </div>
</div>
<?php
Yii::app()->clientScript->registerScript('asideMenu', "
$(function () {
        $(global_event).trigger('set:map');
        $(global_event).trigger('set:navAnimate');
});",CClientScript::POS_END);
?>
<?php $this->endContent(); ?>