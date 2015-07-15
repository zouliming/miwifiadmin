<!DOCTYPE html>
<html>
    <head>
        <title>新版后台</title>
        <link rel="stylesheet" href="<?php echo Util::getCssUrl(); ?>newFrame.css" type="text/css" />
    </head>
    <body>
        <div class="header">这是头</div>
        <div class="container">
            <!-- 一级菜单 -->
            <?php $this->widget('application.components.widgets.menuWidget',array(
                    'version'=>'new'
            ));?>
            <div class="bd">
                <?php $this->widget('application.components.widgets.newAsideMenuWidget',array(
                ));?>
                <div class="main-content">
                    <?php echo $content;?>
                </div>
            </div>
        </div>
        <div class="footer">
            版权终身所有
        </div>
    </body>
</html>
