<div id="bd" class="dft">
    <div class="set-bd">
        <div class="grid-2 clearfix">
            <div class="article">
                <iframe name="setting" id="setting" style="width:100%; border:0;background:none;" src="/site/blank" frameborder="0" scrolling="no"></iframe>
            </div>
            <!-- 二级菜单 -->
            <?php 
            if($this->showSecondMenu){
            $this->widget('application.components.widgets.asideMenuWidget', array(
                    'asideMenuItems'=>$asideMenuItems
            ));
            }
            ?>
        </div><!--  -->
    </div><!--  -->
</div>
<?php
Yii::app()->clientScript->registerScript('search', "
$(function () {
        $(global_event).trigger('set:map');
        $(global_event).trigger('set:navAnimate');
});",CClientScript::POS_END);
?>
