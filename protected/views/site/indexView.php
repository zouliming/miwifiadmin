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
        <link rel="stylesheet" href="<?php echo Util::getCssPath(); ?>page.setting.css?v=0.0.3" type="text/css" />
        <link rel="stylesheet" href="<?php echo Util::getCssPath(); ?>dialog.css?v=0.0.3" type="text/css" />
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
                    <h1 id="logo"><a href="web/home" title="小米路由器">小米路由器</a></h1>

                    <div class="mod-user-nav">
                        <ul>
                            <li><img alt="CMCC-China" src="<?php echo Util::getImgPath();?>tmp/face_rt_m.png" class="img-circle" /><span id="router_name">CMCC-China</span>&nbsp;&nbsp;</li>

                            <li><a href="login.html" class="logout">退出</a></li>

                            <li class="div-line">|</li>

                            <li><a href="#downloadclient" id="downloadclient" name="downloadclient">下载客户端</a></li>

                            <li class="div-line">|</li>

                            <li><b><a href="http://www1.miwifi.com" target="_blank">访问官网</a></b></li>
                        </ul>
                    </div>
                </div>
            </div><!--  -->

            <div id="nav">
                <script type="text/javascript">
                    var navCurrent = '.setting';
                </script>

                <div class="list">
                    <ul>
                        <li class="home active">
                            <a href="web/home">
                                <i class="ico ico-nav-1"></i>
                                <span>路由状态</span>
                            </a>
                        </li>

                        <li class="manager">
                            <a href="web/manager">
                                <i class="ico ico-nav-2"></i><span>设备管理</span></a>
                        </li>

                        <li class="plugin"><a href="web/netset">
                                <i class="ico ico-nav-3"></i><span>网络设置</span></a></li>

                        <li class="setting"><a href="web/sysset">
                                <i class="ico ico-nav-4"></i><span>系统设置</span></a></li>
                    </ul>
                </div>
            </div>

            <div id="bd" class="dft">
                <!-- <div id="bd-hd">在这里，你可以对小强路由器进行重新设置。</div> -->

                <div class="set-bd">
                    <div class="grid-2 clearfix">
                        <div class="article">
                            <iframe name="setting" id="setting" style="width:100%; border:0;background:none;" src="/site/status" frameborder="0" scrolling="no"></iframe>
                        </div>

                        <div class="aside">
                            <div class="mod-setting-nav">
                                <ul class="nav-list clearfix">
                                    <li class="nav-item">
                                        <h3 class="nav-hd"><span>路由器权限</span><a href="#" class="bt-onoff bt-on"></a></h3>

                                        <ul class="isopen">
                                            <li><a target="setting" href="#!passport">修改管理密码</a></li>
                                        </ul>
                                    </li>

                                    <li class="nav-item">
                                        <h3 class="nav-hd"><span>高级功能</span><a href="#" class="bt-onoff bt-off"></a></h3>

                                        <ul style="display:none;">
                                            <li><a target="setting" href="#!sys_status">系统状态</a></li>

                                            <li><a target="setting" href="#!pro/upgrade">路由器手动升级</a></li>

                                            <li><a target="setting" href="#!pro/qos">应用限速</a></li>

                                            <li><a target="setting" href="#!pro/qos_pro">QoS智能限速</a></li>

                                            <li><a target="setting" href="#!pro/upnp">UPnP</a></li>

                                            <li><a target="setting" href="#!pro/vpn">PPTP/L2TP</a></li>

                                            <li><a target="setting" href="#!pro/nat">端口转发</a></li>

                                            <li><a target="setting" href="#!pro/dmz">DMZ</a></li>

                                            <li><a target="setting" href="#!pro/ddns">DDNS</a></li>

                                            <li><a target="setting" href="#!pro/developer">开发者选项</a></li>

                                            <li><a target="setting" href="#!pro/noflushd">硬盘自动休眠</a></li>
                                        </ul>
                                    </li>

                                    <li class="nav-item">
                                        <h3 class="nav-hd"><span>系统功能</span><a href="#" class="bt-onoff bt-on"></a></h3>

                                        <ul class="isopen">
                                            <li class="active"><a target="setting" href="#!upgrade"><span>系统升级</span></a></li>

                                            <li><a target="setting" href="#!log">上传日志</a></li>

                                            <li><a target="setting" href="#!reboot">关机 & 重启</a></li>
                                        </ul>
                                    </li>

                                    <li class="nav-item">
                                        <h3 class="nav-hd"><span>重置与恢复</span><a href="#" class="bt-onoff bt-on"></a></h3>

                                        <ul class="isopen">
                                            <li><a href="#!diskformat" target="setting">格式化硬盘</a></li>

                                            <li><a target="setting" href="#!reset"><span>恢复出厂设置</span></a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div><!--  -->
                </div><!--  -->
            </div>

            <div id="ft">
                <p>系统版本: MiWiFi Rom 1.0.13 稳定版&nbsp;&nbsp;&nbsp;&nbsp;MAC地址: 8C:BE:BE:28:EE:CF</p>

                <p>&copy; 2015 小米路由器<span>|</span><a href="http://www1.miwifi.com" target="_blank">官方网站</a><span>|</span><a href="http://weibo.com/xiaomiluyouqi" target="_blank">官方微博</a><span>|</span><a href="https://land.xiaomi.net/res/e1fdbc3/land/miwifi/wf_2dcode.jpg" target="_blank">官方微信</a><span>|</span><a href="http://bbs.xiaomi.cn/forum-692-1.html" target="_blank">用户社区</a><span>|</span>服务热线 400-100-5678</p>
            </div>
        </div><!--[if lt IE 7]>
      <script>
      try{ document.execCommand("BackgroundImageCache",false,true);} catch(e){}
      </script>
      <![endif]-->
        <script type="tmpl/html" id="tmplLogin">
            <ul>
            <li>
            <img class="img-circle" src="{$icon}" alt="{$nickname}"><span id="router_name">{$nickname}</span>&nbsp;&nbsp;
            </li>
            <li><a class="logout" href="web/logout">退出</a></li>
            <li class="div-line">|</li>
            <li><a id="downloadclient" href="#downloadclient">下载客户端</a></li>
            <li class="div-line">|</li>
            <li><b><a target="_blank" href="http://www1.miwifi.com">访问官网</a></b></li>
            </ul>
        </script>
        <?php 
        $this->beginContent('xiaomibind');
        $this->endContent();
        ?>
        <script type="text/javascript">
            //是否绑定全局变量
            global_event.isBinded = true;
            $(global_event).on('getLogininfo', function (evt, data) {
                    var psp = global_event.pspGet();
                    var uuid = psp.uuid;
                    var token = psp.token;
                    var logtype = psp.logtype;
                    var tplDb;
                    var router_name = 'CMCC-China';
                    var showLoginbar = function (tplDb) {
                            var tpl = $('#tmplLogin').html();
                            var randerRes = StringH.tmpl(tpl, tplDb);
                            $('.mod-user-nav').html(randerRes);
                    };
                    if (logtype == 1 && global_event.isBinded) {
                            $.getJSON('api/xqpassport/binded', {}, function (rsp) {
                                    if (rsp.code == 0 && rsp.bind == 1) {
                                            var face = '/xiaoqiang/web/img/tmp/face.png';
                                            tplDb = {
                                                    'icon': rsp.info.miliaoIcon == '' ? face : rsp.info.miliaoIcon,
                                                    'nickname': rsp.info.aliasNick == '' ? rsp.info.userId : StringH.encode4Html(rsp.info.aliasNick),
                                                    'logouttype': "1"
                                            };
                                            showLoginbar(tplDb);
                                    }
                            });
                    } else {
                            tplDb = {
                                    'icon': '/img/tmp/face_rt_m.png',
                                    'nickname': router_name,
                                    'logouttype': "2"
                            };
                            showLoginbar(tplDb);
                    }
            });

            $(global_event).on('init:bindxiaomi', function (evt, data) {
                    var mustbind = data.mustbind,
                        dlgContent = $('#xiaomibind').html();
                    art.dialog({
                            title: '绑定小米账号',
                            content: dlgContent,
                            beforeunload: function () {
                                    var dialog = this;
                                    if (mustbind) {
                                            window.location.href = 'web/home';
                                    }
                            }
                    }).lock();

                    $('body').delegate('#xiaomipsp', 'submit', function (e) {
                            e.preventDefault();
                            var frm = this.name;
                            var url = 'api/xqpassport/login';
                            var btnText = $('#btnBindXiaomi span').html();
                            var validator = FormValidator.checkAll(frm, [{
                                            name: 'uuid',
                                            display: '小米账号',
                                            rules: 'required'
                                    }, {
                                            name: 'password',
                                            display: '密码',
                                            rules: 'required'
                                    }]);
                            if (validator) {

                                    var pwd = $.trim($('#xmpassword').val()),
                                        data = {
                                                'uuid': $.trim($('#xmuuid').val()),
                                                'password': hex_md5(pwd),
                                                'encrypt': Base64.encode(pwd)
                                        };
                                    $('#btnBindXiaomi').prop('disabled', true).find('span').html('登录中...');
                                    $.ajax({
                                            type: 'post',
                                            url: url,
                                            data: data,
                                            dataType: 'json',
                                            success: function (rsp) {
                                                    if (rsp.code == 0) {
                                                            $('#btnBindXiaomi').find('span').html('绑定中...');
                                                            $.getJSON('api/xqpassport/rigister', {uuid: rsp.uuid}, function (rsp) {
                                                                    if (rsp.code == 0) {
                                                                            $('#btnBindXiaomi').find('span').html('绑定成功');
                                                                            window.location.reload();
                                                                    } else {
                                                                            $('#btnBindXiaomi').prop('disabled', false).find('span').html(btnText);
                                                                            window.top.art.dialog({
                                                                                    'title': '绑定小米账号',
                                                                                    'content': '绑定失败，系统繁忙，请重试。'
                                                                            }).lock().time(1.5 * 1000);
                                                                    }
                                                            });
                                                    } else {
                                                            $('#btnBindXiaomi').prop('disabled', false).find('span').html(btnText);
                                                            window.top.art.dialog({
                                                                    'title': '绑定小米账号',
                                                                    'content': '账号绑定失败，请检查用户名和密码是否正确。'
                                                            }).lock().time(1.5 * 1000);
                                                    }
                                            }
                                    });
                            }
                    });
            });
            $(global_event).on('init:needbind', function (evt, data) {
                    var mustbind = global_event.mustBind || false;
                    if (global_event.isBinded === false) {
                            if (mustbind) {
                                    $(global_event).trigger('init:bindxiaomi', {mustbind: mustbind});
                            }
                    }
            });

            $(function () {
                    //检测绑定状态
                    // $(global_event).trigger('init:needbind');
                    //延迟显示用户信息
                    window.setTimeout(function () {
                            $(global_event).trigger('getLogininfo');
                    }, 800);

                    $('body').delegate('#feedback', 'mousedown', function (e) {
                            console.log('feedback');
                            setTimeout(function () {
                                    var request_date = {};
                                    $.getJSON('api/xqsystem/upload_log', request_date, function (rsp)
                                    {
                                            console.log('upload_log', rsp);
                                    });
                            }, 40);
                    });
                    //nav
                    if (typeof (navCurrent) !== "undefined") {
                            $('#nav li').removeClass('active');
                            $('#nav').find(navCurrent).addClass('active');
                    }
            });
        </script><script type="text/javascript">
            // reboot
            var global_api_reboot = {
                    url: 'api/xqsystem/reboot',
                    param: {"client": "web"}
            };
            function reboot_window() {
                    art.dialog({
                            title: '重启路由',
                            content: '是否确定重启路由器，重启将断开和小米路由器的连接。',
                            okValue: '重启',
                            ok: function () {
                                    var dlg = this;
                                    $.getJSON(global_api_reboot.url, global_api_reboot.param, function (rsp) {
                                            if (rsp.code != 0) {
                                                    art.dialog({title: false, content: "重启失败"}).time(1.5 * 1000);
                                            } else {
                                                    var ip = rsp.lanIp[0].ip;
                                                    // global_dorestart('正在重启', ip, true);
                                                    $(global_event).trigger('reboot:wait', {
                                                            lanIp: ip,
                                                            action: '重启路由器',
                                                            refresh: true
                                                    });
                                            }
                                    });
                                    dlg.close();
                                    return false;
                            },
                            cancelValue: '取消',
                            cancel: function () {
                                    this.close();
                                    return false;
                            }
                    }).lock();
            }
            // shutdown
            function shutdown_window() {
                    art.dialog({
                            title: '关闭路由器',
                            content: '是否确定关闭路由器，操作将断开和小米路由器的连接。',
                            okValue: '关闭',
                            ok: function () {
                                    $.getJSON('api/xqsystem/shutdown', {}, function (rsp) {
                                            if (rsp.code != 0) {
                                                    art.dialog({title: false, content: "关闭路由器失败"}).time(1.5 * 1000);
                                            } else {
                                                    art.dialog({
                                                            title: '关闭路由器',
                                                            content: '关机中，请等待路由器指示灯熄灭后再断开电源',
                                                            cancel: false
                                                    }).lock();
                                            }
                                    });
                            },
                            cancelValue: '取消',
                            cancel: function () {
                                    this.close();
                            }
                    }).lock();
            }
            //reset
            function reset_window(format) {

                    var reset = (function (format) {
                            var request_data = {
                                    format: format ? 1 : 0
                            };
                            function wait() {
                                    $(global_event).trigger('reboot:wait', {
                                            action: '恢复出厂设置',
                                            refresh: true,
                                            lanIp: '192.168.31.1'
                                    });
                            }
                            function clearCookies() {
                                    var keys = document.cookie.match(/[^ =;]+(?=\=)/g);
                                    if (keys) {
                                            for (var i = keys.length; i--; ) {
                                                    document.cookie = keys[i] + '=0;path=/;expires=' + new Date(0).toUTCString();
                                            }
                                    }
                            }

                            return function () {
                                    console.log(request_data);
                                    $.getJSON('api/xqsystem/reset', request_data, function (rsp) {
                                            if (rsp.code != 0) {
                                                    window.parent.art.dialog({
                                                            title: false,
                                                            content: rsp.msg
                                                    }).time(3 * 1000);
                                            } else {
                                                    // clear cookies
                                                    clearCookies();
                                                    //block wait
                                                    wait();
                                            }
                                    });
                            }
                    })(format);

                    window.top.art.dialog({
                            title: '恢复出厂设置',
                            content: '是否确定恢复出厂设置，并让小米路由器回到初始状态？',
                            okValue: '确认',
                            ok: function () {
                                    reset();
                            },
                            cancelValue: '取消',
                            cancel: function () {
                                    this.close();
                            }
                    }).lock();
            }
        </script>
        <script type="text/javascript">
            $(global_event).on('set:map', function (evt, data) {
                    var urlMap = {
                            'upgrade': 'web/sysset/upgrade',
                            'passport': 'web/sysset/passport',
                            'reboot': 'web/sysset/reboot',
                            'reset': 'web/sysset/reset',
                            'pro/upgrade': 'web/sysset/upgrade_manual',
                            'upload_config': 'web/sysset/upload_config',
                            'log': 'web/sysset/log',
                            'sys_psp': 'web/sysset/sys_psp',
                            'sys_status': 'web/sysset/sys_status',
                            'diskformat': 'web/sysset/diskformat',
                            // 'pro/nginx' : 'web/sysset/nginx',
                            'pro/lamp': 'web/sysset/lamp',
                            'pro/upnp': 'web/sysset/upnp',
                            'pro/nat': 'web/sysset/nat',
                            'pro/vpn': 'web/sysset/vpn',
                            'pro/developer': 'web/sysset/developer',
                            'pro/noflushd': 'web/sysset/noflushd',
                            'pro/qos_pro': 'web/sysset/qos_pro',
                            'pro/qos': 'web/sysset/qos',
                            'pro/dmz': 'web/sysset/dmz',
                            'pro/ddns': 'web/sysset/ddns'
                    };
                    global_event.set = {
                            'urlMap': urlMap
                    };
                    $('.nav-item a[target="setting"]').on('click', function (e) {
                            e.preventDefault();
                            var hash = $(this).attr('href');
                            var key = hash.replace('#!', '');
                            window.location.hash = hash;
                            if (typeof (urlMap[key]) !== 'undefined') {
                                    console.log('here');
                                    $(global_event).trigger('set:loadIframe', {url: urlMap[key]});
                            } else {
                                    return;
                            }
                    });
                    $('.nav-item li a').on('click', function (e) {
                            $('.nav-item li').removeClass('active');
                            $(this.parentNode).addClass('active');
                    });
            });

            $(global_event).on('set:loadIframe', function (evt, data) {
                    var url = data.url,
                        iframe = document.getElementById('setting');
                    //iframe.src = url;
                    iframe.src = "/site/content";
                    function reinitIframe() {
                            var iframe = document.getElementById('setting');
                            try {
                                    var bHeight = iframe.contentWindow.document.body.scrollHeight;
                                    var dHeight = iframe.contentWindow.document.documentElement.scrollHeight;
                                    var height = Math.max(bHeight, dHeight);
                                    height = Math.max(height, 1000);
                                    iframe.height = height;
                                    $('.mod-setting-nav').height(height);
                            } catch (ex) {
                            }
                    }
                    window.reinitIframe = reinitIframe;
                    $('#setting').load(function () {
                            window.setInterval(function () {
                                    window.reinitIframe();
                            }, 200);
                    });
            });


            $(global_event).on('set:pageLoad', function (evt, data) {
                    var key = window.location.hash.replace('#!', '');
                    var map = global_event.set.urlMap;
                    if (typeof (map[key]) !== 'undefined') {
                            $(global_event).trigger('set:loadIframe', {url: map[key]});
                            $('.nav-item li').removeClass('active');
                            $('.nav-item li a').each(function () {
                                    if ($(this).attr('href') == '#!' + key) {
                                            $(this.parentNode).addClass('active');
                                            var $ul = $(this).parents('ul');
                                            var $item = $(this).parents('.nav-item');
                                            if ($ul[0].style.display == 'none') {
                                                    $ul.show();
                                                    $item.find('.bt-onoff').removeClass('bt-off').addClass('bt-on');
                                            }
                                    }
                            });
                    } else {
                            $(global_event).trigger('set:loadIframe', {url: map['upgrade']});
                    }
            });

            $(global_event).on('set:navAnimate', function (evt, data) {
                    var timer;
                    $('.nav-item .nav-hd').on('click', function (e) {
                            e.preventDefault();
                            var list = $('ul', this.parentNode);
                            var status = $('.bt-onoff', this.parentNode);
                            var isopen = list.hasClass('isopen');
                            if (isopen) {
                                    list.hide();
                                    list.removeClass('isopen');
                                    status[0].className = 'bt-onoff bt-off';
                            } else {
                                    list.show();
                                    list.addClass('isopen');
                                    status[0].className = 'bt-onoff bt-on';
                            }
                    });
                    /*
                     $('.nav-item')
                     .on('mouseenter', function(e){
                     var root = $('.nav-list');
                     var listIsOpen = $('ul.isopen', root);
                     var list = $('ul', this);
                     var listHieght = list.find('li').length * 40;
                     var statusAll = $('.bt-onoff', root);
                     var status = $('.bt-onoff', this);
                     if($('ul',this).hasClass('isopen')){
                     console.log('is open');
                     return;
                     }
                     window.clearTimeout(timer);
                     timer = window.setTimeout(function(){
                     if (list.length > 0) {
                     listIsOpen.stop(1,1).animate({
                     'height' : 0,
                     'padding-top' : 0,
                     'padding-bottom' : 0,
                     'overflow' : 'hidden'
                     },400).removeClass('isopen');
                     list.stop(1,1).animate({
                     'height' : listHieght,
                     'padding-top' : 4,
                     'padding-bottom' : 4,
                     'overflow' : 'hidden'
                     },400);
                     list.addClass('isopen');
                     
                     statusAll.each(function(){
                     this.className = 'bt-onoff bt-on';
                     });
                     status[0].className = 'bt-onoff bt-off';
                     }
                     }, 400);
                     });
                     */
            });

            $(global_event).on('set:uploadLog', function (evt, data) {
                    var request_date = {};
                    $.getJSON('api/xqsystem/upload_log', request_date, function (rsp)
                    {
                            if (rsp.code == 0) {
                                    $.lightalert().setContent('日志上传成功').show();
                            } else {
                                    $.lightalert().setContent(rsp.msg).show();
                            }
                            global_event.isRequestUplog = false;
                    })
            });

            $(global_event).on('set:downloadConfig', function (evt, data) {
                    var request_date = {};
                    $.getJSON('api/xqsystem/config_recovery', request_date, function (rsp)
                    {
                            if (rsp.code == 0) {
                                    $.lightalert().setContent('成功重启后生效').show();
                            } else {
                                    $.lightalert().setContent(rsp.msg).show();
                            }
                    })
            });


            $(function () {
                    $(global_event).trigger('set:map');
                    $(global_event).trigger('set:pageLoad');
                    $(global_event).trigger('set:navAnimate');
                    $(global_event).trigger('psp:initEvent');

                    global_event.isRequestUplog = false;
                    $('.upload_log').on('click', function (e) {
                            e.preventDefault();
                            if (global_event.isRequestUplog) {
                                    return;
                            }
                            global_event.isRequestUplog = true;
                            $(global_event).trigger('set:uploadLog');
                    });
                    $('.download_config').on('click', function (e) {
                            e.preventDefault();
                            art.dialog({
                                    title: '确认恢复配置信息',
                                    content: '恢复配置会造成你当前的配置被覆盖不可用，你真的需要恢复配置吗？',
                                    width: 400,
                                    ok: function () {
                                            $(global_event).trigger('set:downloadConfig');
                                    },
                                    cancel: function () {
                                            this.close();
                                    }
                            }).lock();

                    });
            });

        </script>
    </body>
</html>
