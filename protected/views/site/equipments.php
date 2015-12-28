<?php
Yii::app()->clientScript->registerCssFile(Util::getCssUrl().'original/page.manage.css');
?>
<div id="bd-hd">在这里查看目前接入路由器的设备，并对设备进行管理
    <a href="#" class="btn btn-small refresh"
       id="btnRefresh"><span>刷新</span></a>
</div>
<div class="mod-device">
    <div class="bd">
        <table class="table">
            <thead>
                <tr>
                    <th class="s0">当前连接终端</th>
                    <th class="s1">互联网访问</th>
                    <th class="s2">全盘访问</th>
                </tr>
            </thead>
            <tbody id="device_list">
                <tr class="list-item">
                    <td class="s0">
                        <table>
                            <tbody>
                                <tr>
                                    <td class="s00">
                                        <i class="ico ico-devices ico-devices-4"></i>
                                    </td>
                                    <td class="s01">
                                        <div class="name">
                                            <span class="name-show">我的Pro</span>
                                            <a href="#" class="ico-rename act-edit"
                                               data-name="我的Pro" data-mac="6C:40:08:8E:50:B0"></a>
                                            <div class="name-edit"></div>
                                        </div>
                                        <p class="muted">已连接：59分30秒&nbsp;&nbsp;|&nbsp;&nbsp;当前网速：0KB/秒&nbsp;&nbsp;|&nbsp;&nbsp;总流量：1.79GB
                                            <br>IP地址：192.168.31.122&nbsp;&nbsp;|&nbsp;&nbsp;连接类型：WiFi 5G&nbsp;&nbsp;|&nbsp;&nbsp;</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                    <td class="s1">
                        <b>本机</b>
                    </td>
                    <td class="s2">
                        <a data-mac="6C:40:08:8E:50:B0" href="#"
                           class="btn-offon btn-on act-data-disable"></a>
                    </td>
                </tr>
                <tr class="list-item">2015/12/28
                    <td class="s0">
                        <table>
                            <tbody>
                                <tr>
                                    <td class="s00">
                                        <img class="company-icon" src="<?php echo Util::getImgUrl();?>device_list_apple.png">
                                    </td>
                                    <td class="s01">
                                        <div class="name">
                                            <span class="name-show">张三-iPhone</span>
                                            <a href="#" class="ico-rename act-edit"
                                               data-name="张三-iPhone" data-mac="18:F6:43:8E:81:23"></a>
                                            <div class="name-edit"></div>
                                        </div>
                                        <p class="muted">已连接：34分50秒&nbsp;&nbsp;|&nbsp;&nbsp;当前网速：0KB/秒&nbsp;&nbsp;|&nbsp;&nbsp;总流量：3.15MB
                                            <br>IP地址：192.168.31.195&nbsp;&nbsp;|&nbsp;&nbsp;连接类型：WiFi 5G&nbsp;&nbsp;|&nbsp;&nbsp;</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                    <td class="s1">
                        <a data-mac="18:F6:43:8E:81:23" href="#"
                           class="btn-offon btn-on act-kick-out"></a>
                    </td>
                    <td class="s2">
                        <a data-mac="18:F6:43:8E:81:23" href="#"
                           class="btn-offon btn-off act-data-enable"></a>
                    </td>
                </tr>
                <tr class="list-item">
                    <td class="s0">
                        <table>
                            <tbody>
                                <tr>
                                    <td class="s00">
                                        <img class="company-icon" src="<?php echo Util::getImgUrl();?>device_list_apple.png">
                                    </td>
                                    <td class="s01">
                                        <div class="name">
                                            <span class="name-show">我的iPhone6</span>
                                            <a href="#" class="ico-rename act-edit"
                                               data-name="我的iPhone6" data-mac="F0:DB:E2:8E:7A:86"></a>
                                            <div class="name-edit"></div>
                                        </div>
                                        <p class="muted">已连接：1小时15分30秒&nbsp;&nbsp;|&nbsp;&nbsp;当前网速：0KB/秒&nbsp;&nbsp;|&nbsp;&nbsp;总流量：161.88MB
                                            <br>IP地址：192.168.31.190&nbsp;&nbsp;|&nbsp;&nbsp;连接类型：WiFi 5G&nbsp;&nbsp;|&nbsp;&nbsp;</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                    <td class="s1">
                        <a data-mac="F0:DB:E2:8E:7A:86" href="#"
                           class="btn-offon btn-on act-kick-out"></a>
                    </td>
                    <td class="s2">
                        <a data-mac="F0:DB:E2:8E:7A:86" href="#"
                           class="btn-offon btn-on act-data-disable"></a>
                    </td>
                </tr>
                <tr class="list-item">
                    <td class="s0">
                        <table>
                            <tbody>
                                <tr>
                                    <td class="s00">
                                        <img class="company-icon" src="<?php echo Util::getImgUrl();?>device_list_apple.png">
                                    </td>
                                    <td class="s01">
                                        <div class="name">
                                            <span class="name-show">张三的Pro</span>
                                            <a href="#" class="ico-rename act-edit"
                                               data-name="张三的Pro" data-mac="D0:A6:37:EA:C9:D3"></a>
                                            <div class="name-edit"></div>
                                        </div>
                                        <p class="muted">已连接：39分54秒&nbsp;&nbsp;|&nbsp;&nbsp;当前网速：1.29MB/秒&nbsp;&nbsp;|&nbsp;&nbsp;总流量：413.16MB
                                            <br>IP地址：192.168.31.107&nbsp;&nbsp;|&nbsp;&nbsp;连接类型：WiFi 2.4G&nbsp;&nbsp;|&nbsp;&nbsp;</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                    <td class="s1">
                        <a data-mac="D0:A6:37:EA:C9:D3" href="#"
                           class="btn-offon btn-on act-kick-out"></a>
                    </td>
                    <td class="s2">
                        <a data-mac="D0:A6:37:EA:C9:D3" href="#"
                           class="btn-offon btn-off act-data-enable"></a>
                    </td>
                </tr>
                <tr class="list-item">
                    <td class="s0">
                        <table>
                            <tbody>
                                <tr>
                                    <td class="s00">
                                        <img class="company-icon" src="<?php echo Util::getImgUrl();?>device_list_apple.png">
                                    </td>
                                    <td class="s01">
                                        <div class="name">
                                            <span class="name-show">xujingde-iPad</span>
                                            <a href="#" class="ico-rename act-edit"
                                               data-name="xujingde-iPad" data-mac="C8:F6:50:1A:03:C3"></a>
                                            <div class="name-edit"></div>
                                        </div>
                                        <p class="muted">已连接：21小时8分41秒&nbsp;&nbsp;|&nbsp;&nbsp;当前网速：0KB/秒&nbsp;&nbsp;|&nbsp;&nbsp;总流量：7.7MB
                                            <br>IP地址：192.168.31.209&nbsp;&nbsp;|&nbsp;&nbsp;连接类型：WiFi 5G&nbsp;&nbsp;|&nbsp;&nbsp;</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                    <td class="s1">
                        <a data-mac="C8:F6:50:1A:03:C3" href="#"
                           class="btn-offon btn-on act-kick-out"></a>
                    </td>
                    <td class="s2">
                        <a data-mac="C8:F6:50:1A:03:C3" href="#"
                           class="btn-offon btn-on act-data-disable"></a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<script type="text/javascript">
        var navCurrent = '.equipments';
</script>