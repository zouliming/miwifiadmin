<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--[if lt IE 7]><html class="ie6 oldie" lang="zh"><![endif]-->
<!--[if IE 7]><html class="ie7 oldie" lang="zh"><![endif]-->
<!--[if IE 8]><html class="ie8 oldie" lang="zh"><![endif]-->
<!--[if gt IE 8]><!-->

<html lang="zh" xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh">
    <!--<![endif]-->

    <head>
        <meta http-equiv="X-UA-Compatible" content="edge" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=1024" /><!--[if lt IE 7]>
        <meta http-equiv="refresh" content="0; url=http://miwifi.com/blockie6.html" />
        <![endif]-->

        <title>路由设置 - 小米路由器</title>
        <link rel="stylesheet" href="<?php echo Util::getCssUrl(); ?>page.setting.css?v=0.0.3" type="text/css" />
        <?php
        //因为弹出框会用到这个样式，在iframe里写无效，必须写在顶层
        Yii::app()->clientScript->registerCssFile(Util::getCssUrl() . 'dialog.css');
        ?>
    </head>

    <body>
        <div id="doc" class="hidden">
            <noscript>
                <div class="noscript">
                    你的浏览器禁止了Javascript功能，会造成无法使用系统进行路由器管理，请开启。
                </div>
            </noscript>

            <div id="hd">
                <div class="inner clearfix">
                    <h1 id="logo"><a href="#" title="小米路由器">小米路由器</a></h1>

                    <div class="mod-user-nav">
                        <ul>
                            <?php
                            if(!Yii::app()->user->isGuest){
                            ?>
                            <li><img alt="CMCC-China" src="<?php echo Util::getImgUrl(); ?>tmp/face_rt_m.png" class="img-circle" /><span id="router_name">牛逼的管理后台</span>&nbsp;&nbsp;</li>

                            <li><a href="/site/logout" class="logout">退出</a></li>

                            <li class="div-line">|</li>
                            <?php } ?>

                            <li><a href="#downloadclient" id="downloadclient" name="downloadclient">下载客户端</a></li>

                            <li class="div-line">|</li>

                            <li><b><a id="fullScreen" href="#">全屏</a></b></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- 一级菜单 -->
            <?php $this->widget('application.components.widgets.menuWidget',array(
                    
            ));?>
            <?php echo $content; ?>
            <div id="ft">
                <p>系统版本: MiWiFi Rom 1.0.13 稳定版&nbsp;&nbsp;&nbsp;&nbsp;MAC地址: 8C:BE:BE:28:EE:CF</p>

                <p>&copy; 2015 小米路由器<span>|</span><a href="#" target="_blank">官方网站</a><span>|</span><a href="#" target="_blank">官方微博</a><span>|</span><a href="#" target="_blank">官方微信</a><span>|</span><a href="#" target="_blank">用户社区</a><span>|</span>服务热线 400-100-5678</p>
            </div>
        </div>
        <!--[if lt IE 7]>
        <script>
        try{ document.execCommand("BackgroundImageCache",false,true);} catch(e){}
        </script>
        <![endif]-->
        <?php 
        $this->beginContent('//site/xiaomibind');
        $this->endContent();
        ?>
    </body>
</html>
