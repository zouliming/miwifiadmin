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
                            <li class="nav-item">
                                <h3 class="nav-hd">
                                    <a target="setting" href="#"><span>WiFi设置</span></a>
                                </h3>
                            </li>
                            <li class="nav-item">
                                <h3 class="nav-hd">
                                    <a target="setting" href="#"><span>外网设置</span></a>
                                </h3>
                            </li>
                            <li class="nav-item">
                                <h3 class="nav-hd">
                                    <a target="setting" href="#"><span>内网设置</span></a>
                                </h3>
                            </li>
                            <li class="nav-item">
                                <h3 class="nav-hd">
                                    <a target="setting" href="#"><span>WAN口速率</span></a>
                                </h3>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $this->endContent(); ?>