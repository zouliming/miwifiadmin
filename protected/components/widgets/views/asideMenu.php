<div class="aside">
    <div class="mod-setting-nav">
        <ul class="nav-list clearfix">
                <?php foreach ($menus as $k => $item) { ?>
                    <li class="nav-item">
                        <h3 class="nav-hd"><span><?php echo $item['sub']; ?></span><a href="#" class="bt-onoff bt-off"></a></h3>
                        <?php
                        //如果子菜单在这里，就是class="isopen"，如果不在，就是style="display:none"
                        ?>
                        <ul style="display: none">
                                <?php
                                foreach ($item['children'] as $menu) {
                                        ?>
                                    <li><a target="setting" href="#!<?php echo $menu['href']; ?>"><?php echo $menu['title']; ?></a></li>
                            <?php } ?>
                        </ul>
                    </li>
            <?php } ?>
        <!--template demo
            <li class="nav-item">
                <h3 class="nav-hd"><span>高级功能</span><a href="#" class="bt-onoff bt-off"></a></h3>

                <ul style="display:none;">
                    <li><a target="setting" href="#!sys_status">系统状态</a></li>

                    <li><a target="setting" href="#!pro/upgrade">路由器手动升级</a></li>

                    <li><a target="setting" href="#!pro/developer">开发者选项</a></li>
                </ul>
            </li>
        -->
        </ul>
    </div>
</div>