<?php
//除了主菜单，还有二级菜单，二级菜单不可以展开
?>
<?php $this->beginContent('//layouts/main'); ?>
    <div id="bd" class="dft">
        <div class="set-bd">
            <div class="grid-2 clearfix">
                <div class="article">
                    <iframe name="setting" id="setting" style="width:100%;border:0;background:none;" src="/site/blank" frameborder="0" scrolling="no" height="1011"></iframe>
                </div>
                <div class="aside">
                    <div class="mod-setting-nav" style="height: 1011px;">
                        <ul class="nav-list clearfix">
                            <?php foreach($this->menu as $k=>$v){ ?>
                            <li class="nav-item">
                                <h3 class="nav-hd">
                                    <a target="setting" href="#!<?php echo $k;?>"><span><?php echo $v['label'];?></span></a>
                                </h3>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script type="text/javascript">
<?php
$urlMap = array();
foreach($this->menu as $k=>$v){
        $urlMap[$k] = $v['href'];
}
?>
var urlMap = <?php echo json_encode($urlMap);?>;
</script>
<?php
Yii::app()->clientScript->registerScript('asideMenu', "
$(function () {
        $(global_event).trigger('set:map');
});",CClientScript::POS_END);
?>
<?php $this->endContent(); ?>