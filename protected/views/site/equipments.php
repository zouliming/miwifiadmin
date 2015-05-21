<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html lang="zh" xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh">
    <!--<![endif]-->

    <head>
        <meta content="edge" http-equiv="X-UA-Compatible" />
        <meta content="text/html; charset=UTF-8" http-equiv="Content-Type" />
        <meta content="width=1024" name="viewport" /><!--[if lt IE 7]>
      <meta http-equiv="refresh" content="0; url=http://miwifi.com/blockie6.html" />
      <![endif]-->

        <title>小米路由器</title>
        <link type="text/css" href="<?php echo Util::getCssPath();?>page.set.st.css?v=0.0.3" rel="stylesheet" />
        <link href="<?php echo Util::getCssPath();?>dialog.css?v=0.0.3" rel="stylesheet" type="text/css" />
    </head>

    <body>
        <div class="mod-setting-panel">
            <div class="hd">
                <h3>系统状态</h3>
            </div>

            <div class="bd">
                <div class="mod-set-status">
                    <div class="group">
                        <h3>版本信息</h3>

                        <div class="cont">
                            <ul class="list">
                                <li><span class="k">当前软件版本：</span><span class="v sys-version">1.0.13</span></li>

                                <li><span class="k">当前硬件版本：</span><span class="v">Ver.B</span></li>
                            </ul>
                        </div>
                    </div>

                    <div class="group">
                        <h3>LAN口状态</h3>

                        <div class="cont">
                            <ul class="list">
                                <li><span class="k">MAC地址：</span><span class="vl lan-mac">8C:BE:BE:28:EE:CF</span></li>

                                <li><span class="k">IP地址：</span><span class="v lan-ip">192.168.31.1</span></li>

                                <li><span class="k">子网掩码：</span><span class="v lan-mask">255.255.255.0</span></li>
                            </ul>
                        </div>
                    </div>

                    <div class="group">
                        <h3>无线状态</h3>

                        <div class="cont">
                            <ul class="list">
                                <li><span class="k">WiFi 2.4G：</span><span class="v wifi1-st">开启</span></li>

                                <li><span class="k">SSID：</span><span class="v wifi1-ssid">CMCC-China</span></li>

                                <li><span class="k">信道：</span><span class="v wifi1-channel">3(20M)</span></li>

                                <li><span class="k">模式：</span><span class="v wifi1-mode">Master</span></li><!-- <li><span class="k">频段带宽：</span><span class="v"></span></li>
                                          <li><span class="k">MAC地址：</span><span class="v"></span></li>
                                          <li><span class="k">WDS状态：</span><span class="v"></span></li> -->
                            </ul>

                            <ul class="list">
                                <li><span class="k">WiFi 5G：</span><span class="v wifi2-st">开启</span></li>

                                <li><span class="k">SSID：</span><span class="v wifi2-ssid">CMCC-China_5G</span></li>

                                <li><span class="k">信道：</span><span class="v wifi2-channel">149(80M)</span></li>

                                <li><span class="k">模式：</span><span class="v wifi2-mode">Master</span></li><!-- <li><span class="k">频段带宽：</span><span class="v"></span></li>
                                          <li><span class="k">MAC地址：</span><span class="v"></span></li>
                                          <li><span class="k">WDS状态：</span><span class="v"></span></li> -->
                            </ul>
                        </div>
                    </div>

                    <div class="group">
                        <h3>WAN口状态</h3>

                        <div class="cont">
                            <ul class="list">
                                <li><span class="k">MAC地址：</span><span class="v wan-mac">8C:BE:BE:28:EE:CF</span></li>

                                <li><span class="k">IP地址：</span><span class="v wan-ip">183.195.37.96</span></li>

                                <li><span class="k">连接类型：</span><span class="v wan-type">PPPOE</span></li>

                                <li><span class="k">子网掩码：</span><span class="v wan-mask">255.255.255.255</span></li>

                                <li><span class="k">网关：</span><span class="v wan-gateway">183.195.39.254</span></li>

                                <li><span class="k">DNS服务器：</span><span class="v wan-peerdns">211.136.150.66</span></li>

                                <li><span class="k">备选DNS：</span><span class="v wan-dns">211.136.112.50</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--[if lt IE 7]>
      <script>
      try{ document.execCommand("BackgroundImageCache",false,true);} catch(e){}
      </script>
      <![endif]-->

        <?php 
        $this->beginContent('xiaomibind');
        $this->endContent();
        ?>
        <script src="<?php echo Util::getJsPath(); ?>jquery-1.8.3.js" type="text/javascript">
        </script><script src="<?php echo Util::getJsPath(); ?>qwrap.js" type="text/javascript">
        </script><script src="<?php echo Util::getJsPath(); ?>jquery.form.js" type="text/javascript">
        </script><script src="<?php echo Util::getJsPath(); ?>utf8.js" type="text/javascript">
        </script><script src="<?php echo Util::getJsPath(); ?>validate.js" type="text/javascript">
        </script><script src="<?php echo Util::getJsPath(); ?>jquery.dialog.js" type="text/javascript">
        </script><script src="<?php echo Util::getJsPath(); ?>jquery.cookie.js" type="text/javascript">
        </script><script src="<?php echo Util::getJsPath(); ?>selectbeautify.js" type="text/javascript">
        </script><script src="<?php echo Util::getJsPath(); ?>util.js" type="text/javascript">
        </script>
    </body>
</html>