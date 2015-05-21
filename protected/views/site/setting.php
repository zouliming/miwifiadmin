
<!DOCTYPE html>
<!--[if lt IE 7]><html class="ie6 oldie" lang="zh"><![endif]-->
<!--[if IE 7]><html class="ie7 oldie" lang="zh"><![endif]-->
<!--[if IE 8]><html class="ie8 oldie" lang="zh"><![endif]-->
<!--[if gt IE 8]><!--> <html lang="zh"> <!--<![endif]-->
    <head>
        <meta http-equiv="X-UA-Compatible" content="edge" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=1024">
        <!--[if lt IE 7]>
        <meta http-equiv="refresh" content="0; url=http://miwifi.com/blockie6.html" />
        <![endif]-->
        <title>小米路由器</title>
        <link rel="stylesheet" href="css/page.set.default.css?v=0.0.3"/>
    </head>
    <body>
        <!-- upgread -->
        <div class="mod-setting-panel">
            <div class="hd">
                <h3>端口转发</h3>
                <!-- 	<a href="#" data&#45;order="1" class="btn&#45;offon btn&#45;off" id="btnupnp"></a> -->
            </div>
            <div class="bd">

                <div class="mod-set-nat">
                    <h4>端口转发</h4>
                    <form id="portForm" name="portForm" class="form form-horizontal">
                        <div class="item">
                            <label for="name" class="k">名称：</label>
                            <span class="v"><input type="text" name="name" value="" class="text input-large" /></span>
                            <em class="t"></em>
                        </div>

                        <div class="item">
                            <label for="proto" class="k">协议：</label>
                            <span class="v">
                                <select  name="proto" class="beautify" style="width:185px;">
                                    <option value='1'>TCP</option>
                                    <option value='2'>UDP</option>
                                    <option value='3'>TCP和UDP</option>
                                </select>
                            </span>
                            <em class="t"></em>
                        </div>

                        <div class="item">
                            <label for="sport" class="k">外部端口：</label>
                            <span class="v"><input type="text" name="sport" value="" class="text input-large" /></span>
                            <em class="t"></em>
                        </div>

                        <div class="item">
                            <label for="ip" class="k">内部IP地址：</label>
                            <span class="v"><input type="text" name="ip" value="" class="text input-large" /></span>
                            <em class="t"></em>
                        </div>

                        <div class="item">
                            <label for="dport" class="k">内部端口：</label>
                            <span class="v"><input type="text" name="dport" value="" class="text input-large" /></span>
                            <em class="t"></em>
                        </div>

                        <div class="item item-control">
                            <button type="submit" id="addPort" class="btn btn-primary btn-large"><span>添加</span></button>
                        </div>
                    </form>
                </div>

                <div class="mod-set-nat">
                    <h4>规则列表</h4>
                    <form name="portFormEdit">


                        <table class="table">
                            <thead>
                                <tr>
                                    <th>名称</th>
                                    <th>协议</th>
                                    <th>外部端口</th>
                                    <th>内部IP地址</th>
                                    <th>内部端口</th>
                                    <th class="center" width="80">操作</th>
                                </tr>
                            </thead>
                            <tbody id="natlist_port">
                            </tbody>
                        </table>
                    </form>
                </div>

                <div class="mod-set-nat">
                    <h4>范围转发</h4>
                    <form id="rangeForm" name="rangeForm" class="form form-horizontal">

                        <div class="item">
                            <label for="name" class="k">名称：</label>
                            <span class="v"><input type="text" name="name" value="" class="text input-large" /></span>
                            <em class="t"></em>
                        </div>

                        <div class="item">
                            <label for="proto" class="k">协议：</label>
                            <span class="v">
                                <select  name="proto" class="beautify" style="width:185px;">
                                    <option value='1'>TCP</option>
                                    <option value='2'>UDP</option>
                                    <option value='3'>TCP和UDP</option>
                                </select>
                            </span>
                            <em class="t"></em>
                        </div>

                        <div class="item">
                            <label for="fport" class="k">起始端口：</label>
                            <span class="v"><input type="text" name="fport" value="" class="text input-large" /></span>
                            <em class="t"></em>
                        </div>

                        <div class="item">
                            <label for="tport" class="k">结束端口：</label>
                            <span class="v"><input type="text" name="tport" value="" class="text input-large" /></span>
                            <em class="t"></em>
                        </div>

                        <div class="item">
                            <label for="ip" class="k">目标IP：</label>
                            <span class="v"><input type="text" name="ip" value="" class="text input-large" /></span>
                            <em class="t"></em>
                        </div>

                        <div class="item item-control">
                            <button type="submit" id="addRange" class="btn btn-primary btn-large"><span>添加</span></button>
                        </div>
                    </form>
                </div>

                <div class="mod-set-nat">
                    <h4>规则列表</h4>
                    <form name="rangeFormEdit">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>名称</th>
                                    <th>协议</th>
                                    <th>起始端口</th>
                                    <th>结束端口</th>
                                    <th>目标IP</th>
                                    <th class="center" width="80">操作</th>
                                </tr>
                            </thead>
                            <tbody id="natlist_range">
                            </tbody>
                        </table>
                    </form>
                </div>
                <div class='mod-set-nat'>
                    <div class="item item-control">
                        <button type="submit" id="apply" class="btn btn-primary btn-large"><span>生效</span></button>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/template" id="tpl_tr_port">
            {for(var i=0;i<$arr.length;i++)}
            <tr>
            <td>{js print( StringH.encode4Html( $arr[i].name ) )}</td>
            <td>
            {if($arr[i].proto == 1)}TCP{/if}
            {if($arr[i].proto == 2)}UDP{/if}
            {if($arr[i].proto == 3)}TCP和UDP{/if}
            </td>
            <td>{$arr[i].srcport}</td>
            <td>{$arr[i].destip}</td>
            <td>{$arr[i].destport}</td>
            <td class="center">
            <a class="btn btn-danger btn-small delPort" href="javascript:;" data-port="{$arr[i].srcport}"><span>删除</span></a>
            </td>
            </tr>
            {/for}
        </script>

        <script type="text/template" id="tpl_tr_port_edit">
            <tr>
            <td class='item'>
            <span><input type="text" name="name" value="{{- item.name}}" class="text input-mini" /></span>
            <em class="t"></em>
            </td>
            <td>
            <select name="proto" class="">
            <option value='1' {{= item.proto=== 1?"selected" : ""}} >TCP</option>
            <option value='2' {{= item.proto=== 2?"selected" : ""}} >UDP</option>
            <option value='3' {{= item.proto=== 3?"selected" : ""}} >TCP和UDP</option>
            </select>
            </td>
            <td class='item'>
            <span><input type="text" name="sport" value="{{- item.srcport }}" class="text input-mini" /></span>
            <em class="t"></em>
            </td>
            <td class='item'>
            <span><input type="text" name="ip" value="{{- item.destip  }}" class="text input-mini" /></span>
            <em class="t"></em>
            </td>
            <td class='item'>
            <span><input type="text" name="dport" value="{{- item.destport }}" class="text input-mini" /></span>
            <em class="t"></em>
            </td>
            <td class='item'>
            <a class="btn btn-primary confirmEdit" href="javascript:;"><span>确定</span></a>
            <a class="btn cancelEdit" href="javascript:;"><span>取消</span></a>
            </td>
            </tr>
        </script>
        <script type="text/template" id="tpl_tr_range">
            {for(var i=0;i<$arr.length;i++)}
            <tr>
            <td>{js print( StringH.encode4Html( $arr[i].name ) )}</td>
            <td>
            {if($arr[i].proto == 1)}TCP{/if}
            {if($arr[i].proto == 2)}UDP{/if}
            {if($arr[i].proto == 3)}TCP和UDP{/if}
            </td>
            <td>{$arr[i].srcport.f}</td>
            <td>{$arr[i].srcport.t}</td>
            <td>{$arr[i].destip}</td>
            <td class="center">
            <a class="btn btn-danger btn-small delRange" href="javascript:;" data-port="{$arr[i].srcport.f}"><span>删除</span></a>
            </td>
            </tr>
            {/for}
        </script>
        <script type="text/template" id="tpl_tr_range_edit">
            <tr>
            <td class='item'>
            <span><input type="text" name="name" value="{{- item.name}}" class="text input-mini" /></span>
            <em class="t"></em>
            </td>
            <td>
            <select name="proto" class="">
            <option value='1' {{= item.proto=== 1?"selected" : ""}} >TCP</option>
            <option value='2' {{= item.proto=== 2?"selected" : ""}} >UDP</option>
            <option value='3' {{= item.proto=== 3?"selected" : ""}} >TCP和UDP</option>
            </select>
            </td>
            <td class='item'>
            <span><input type="text" name="fport" value="{{- item.srcport.f }}" class="text input-mini" /></span>
            <em class="t"></em>
            </td>
            <td class='item'>
            <span><input type="text" name="tport" value="{{- item.srcport.t  }}" class="text input-mini" /></span>
            <em class="t"></em>
            </td>
            <td class='item'>
            <span><input type="text" name="ip" value="{{- item.destip }}" class="text input-mini" /></span>
            <em class="t"></em>
            </td>
            <td class='item'>
            <a class="btn btn-primary confirmEditRange" href="javascript:;"><span>确定</span></a>
            <a class="btn  cancelEditRange" href="javascript:;"><span>取消</span></a>
            </td>
            </tr>
        </script>

        <!--[if lt IE 7]>
        <script>
        try{ document.execCommand("BackgroundImageCache",false,true);} catch(e){}
        </script>
        <![endif]-->
        <link rel="stylesheet" href="css/dialog.css?v=0.0.3">
        <div id="panelClientdld" class="panel-client-dld" style="display:none; z-index:101;">
            <ul class="clearfix">
                <li class="first">
                    <a href="http://bigota.miwifi.com/xiaoqiang/client/xqpc_client.exe">
                        <img src="img/pic_client_pc.png" alt="">
                        <span>PC版</span>
                    </a>
                </li>
                <li>
                    <a href="http://bigota.miwifi.com/xiaoqiang/client/xqmac_client.dmg">
                        <img src="img/pic_client_mac.png" alt="">
                        <span>Mac版</span>
                    </a>
                </li>
                <li>
                    <a href="http://bigota.miwifi.com/xiaoqiang/client/xqapp.apk">
                        <img src="img/pic_client_ad.png" alt="">
                        <span>Android</span>
                    </a>
                </li>
            </ul>
            <div class="dur"></div>
        </div>
        <div id="downloadMask" style="display:none; position:absolute; left:0; top:0; z-index:100;"></div>
        <script type="tmpl/html" id="xiaomibind">
    <div class="mod-panel-bind">
        <form action="/" class="form form-horizontal from-xiaomibind" method="post" name="xiaomipsp" id="xiaomipsp">
            <div class="item">
                <label class="k">小米账号：</label>
                <span class="v"><input type="text" name="uuid" id="xmuuid" class="text input-large" placeholder="请输入手机号码/邮箱/小米ID"></span>
                <em class="t"></em>
            </div>
            <div class="item">
                <label class="k">密&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;码：</label>
                <span class="v"><input type="password" name="password" id="xmpassword" class="text input-large" placeholder="请输入密码"></span>
                <em class="t"></em>
            </div>
            <div class="item item-control item-rsp-err" style="display:none;"><em class="t"></em></div>
            <div class="item item-control">
                <button type="submit" id="btnBindXiaomi" class="btn btn-primary l"><span>登录并绑定</span></button>
                <a target="_blank" href="https://account.xiaomi.com/pass/forgetPassword" class="r">忘记密码？</a>
            </div>
        </form>
        <div class="reg">
            <h3>为什么要绑定小米账号?</h3>
            <ul>
                <li>可以随时远程查看、管理路由器</li>
                <li>不开电脑也能下载电影</li>
                <li>支持更多插件的安装</li>
            </ul>
            <p>没有小米账号？<a href="https://account.xiaomi.com/pass/register" target="_blank">立即创建一个</a></p>
        </div>
    </div>
        </script>

        <script>
                var modelNat = (function () {
                        return {
                                init: function () {
                                        // addPort
                                        $('#addPort').on('click', function (e) {
                                                e.preventDefault();
                                                var data = $('#portForm').serialize();
                                                var validator = FormValidator.checkAll('portForm', [
                                                        {
                                                                name: 'ip',
                                                                display: '内部IP地址',
                                                                rules: 'required|valid_ip|callback_no_change'
                                                        },
                                                        {
                                                                name: 'name',
                                                                display: '名称',
                                                                rules: 'required'
                                                        },
                                                        {
                                                                name: 'sport',
                                                                display: '外部端口',
                                                                rules: 'required|is_natural|less_than[65536]'
                                                        },
                                                        {
                                                                name: 'dport',
                                                                display: '内部端口',
                                                                rules: 'required|is_natural|less_than[65536]'
                                                        }
                                                ]);
                                                if (validator) {
                                                        modelNat.addPort(data, 'new');
                                                }
                                        });

                                        // delPort
                                        $('#natlist_port').on('click', '.delPort', function (e) {
                                                e.preventDefault();
                                                var port = $(this).data('port');
                                                modelNat.delPort(port);
                                        });

                                        // editPort
                                        $('#natlist_port').on('click', '.editPort', function (e) {
                                                e.preventDefault();
                                                var item = $(e.currentTarget).data('item');
                                                modelNat.editPort(item, e);
                                        });

                                        // confirmEdit port
                                        $('#natlist_port').on('click', '.confirmEdit', function (e) {

                                                var data = $(e.target).parents('form').serialize();
                                                var validator = FormValidator.checkAll('portFormEdit', [
                                                        {
                                                                name: 'ip',
                                                                display: '内部IP地址',
                                                                rules: 'required|valid_ip|callback_no_change'
                                                        },
                                                        {
                                                                name: 'name',
                                                                display: '名称',
                                                                rules: 'required'
                                                        },
                                                        {
                                                                name: 'sport',
                                                                display: '外部端口',
                                                                rules: 'required|is_natural|less_than[65536]'
                                                        },
                                                        {
                                                                name: 'dport',
                                                                display: '内部端口',
                                                                rules: 'required|is_natural|less_than[65536]'
                                                        }
                                                ]);
                                                if (validator) {
                                                        modelNat.addPort(data, 'edit');
                                                }
                                                e.preventDefault();
                                        });

                                        // cancelEdit port
                                        $('#natlist_port').on('click', '.cancelEdit', function (e) {
                                                e.preventDefault();
                                                var $tr = $(e.currentTarget).parent().parent();
                                                $tr.html(modelNat.savedItem);
                                        });

                                        // addRange
                                        $('#addRange').on('click', function (e) {
                                                e.preventDefault();
                                                var data = $('#rangeForm').serialize();
                                                var validator = FormValidator.checkAll('rangeForm', [
                                                        {
                                                                name: 'ip',
                                                                display: '目标IP',
                                                                rules: 'required|valid_ip|callback_no_change'
                                                        },
                                                        {
                                                                name: 'name',
                                                                display: '名称',
                                                                rules: 'required'
                                                        },
                                                        {
                                                                name: 'fport',
                                                                display: '起始端口',
                                                                rules: 'required|is_natural|less_than[65536]'
                                                        },
                                                        {
                                                                name: 'tport',
                                                                display: '结束端口',
                                                                rules: 'required|is_natural|less_than[65536]'
                                                        }
                                                ]);
                                                if (validator) {
                                                        modelNat.addRange(data, 'new');
                                                }
                                        });

                                        // delRange
                                        $('#natlist_range').on('click', '.delRange', function (e) {
                                                e.preventDefault();
                                                var port = $(this).data('port');
                                                modelNat.delRange(port);
                                        });

                                        // editPort
                                        $('#natlist_range').on('click', '.editRange', function (e) {
                                                e.preventDefault();
                                                var item = $(e.currentTarget).data('item');
                                                modelNat.editRange(item, e);
                                        });

                                        // confirmEdit range
                                        $('#natlist_range').on('click', '.confirmEditRange', function (e) {
                                                e.preventDefault();

                                                var data = $(e.target).parents('form').serialize();
                                                var validator = FormValidator.checkAll('rangeFormEdit', [
                                                        {
                                                                name: 'ip',
                                                                display: '目标IP',
                                                                rules: 'required|valid_ip|callback_no_change'
                                                        },
                                                        {
                                                                name: 'name',
                                                                display: '名称',
                                                                rules: 'required'
                                                        },
                                                        {
                                                                name: 'fport',
                                                                display: '起始端口',
                                                                rules: 'required|is_natural|less_than[65536]'
                                                        },
                                                        {
                                                                name: 'tport',
                                                                display: '结束端口',
                                                                rules: 'required|is_natural|less_than[65536]'
                                                        }
                                                ]);
                                                if (validator) {
                                                        modelNat.addRange(data, 'edit');
                                                }
                                                e.preventDefault();
                                        });

                                        // cancelEdit range
                                        $('#natlist_range').on('click', '.cancelEditRange', function (e) {
                                                e.preventDefault();
                                                var $tr = $(e.currentTarget).parent().parent();
                                                $tr.html(modelNat.savedItemRange);
                                        });

                                        // apply
                                        $('#apply').on('click', function (e) {
                                                var $btn = $(e.currentTarget);
                                                var dlg = window.top.art.dialog({
                                                        title: '端口转发',
                                                        content: '规则正在生效中，请等待...',
                                                        lock: true,
                                                        cancel: false
                                                });
                                                $.getJSON(modelNat.url.applyRedirect, function (rsp) {
                                                        if (rsp.code === 0) {
                                                                dlg.close();
                                                        }
                                                });
                                        });

                                        // init
                                        // ftype: 0/1/2 全部/端口/范围
                                        modelNat.getRedirectPort();
                                        modelNat.getRedirectRange();
                                },
                                addPort: function (data, type) {
                                        $.post(modelNat.url.addPort, data, function (rsp) {
                                                if (rsp.code === 0) {
                                                        modelNat.getRedirectPort();
                                                        if (type === 'new') {
                                                                // 成功后清空form
                                                                $('#portForm').find('input:not(".dummy")').val('');
                                                        }
                                                } else {
                                                        window.top.art.dialog({
                                                                title: '端口转发',
                                                                content: rsp.msg,
                                                                lock: true,
                                                                time: 5 * 1000
                                                        });
                                                }
                                        }, 'json');
                                },
                                addRange: function (data, type) {
                                        $.post(modelNat.url.addRange, data, function (rsp) {
                                                if (rsp.code === 0) {
                                                        modelNat.getRedirectRange();
                                                        if (type === 'new') {
                                                                $('#rangeForm').find('input:not(".dummy")').val('');
                                                        }
                                                } else {
                                                        window.top.art.dialog({
                                                                title: '端口转发',
                                                                content: rsp.msg,
                                                                lock: true,
                                                                time: 5 * 1000
                                                        });

                                                }
                                        }, 'json');
                                },
                                delPort: function (port) {
                                        $.post(modelNat.url.delRedirect, 'port=' + port, function (rsp) {
                                                if (rsp.code === 0) {
                                                        modelNat.getRedirectPort();
                                                } else {
                                                        window.top.art.dialog({
                                                                title: '端口转发',
                                                                content: rsp.msg,
                                                                lock: true,
                                                                time: 5 * 1000
                                                        });
                                                }
                                        }, 'json');
                                },
                                delRange: function (port) {
                                        $.post(modelNat.url.delRedirect, 'port=' + port, function (rsp) {
                                                if (rsp.code === 0) {
                                                        modelNat.getRedirectRange();
                                                } else {
                                                        window.top.art.dialog({
                                                                title: '端口转发',
                                                                content: rsp.msg,
                                                                lock: true,
                                                                time: 5 * 1000
                                                        });
                                                }
                                        }, 'json');
                                },
                                savedItem: '',
                                savedItemRange: '',
                                editPort: function (item, e) {
                                        item = QW.JSON.parse(decodeURIComponent(item));
                                        var $tr = $(e.currentTarget).parent().parent();
                                        modelNat.savedItem = $tr.html();
                                        var html = tmpl($('#tpl_tr_port_edit').html(), {item: item});
                                        $tr.replaceWith(html);
                                        //$.selectBeautify();
                                },
                                editRange: function (item, e) {
                                        item = QW.JSON.parse(decodeURIComponent(item));
                                        var $tr = $(e.currentTarget).parent().parent();
                                        modelNat.savedItemRange = $tr.html();
                                        var html = tmpl($('#tpl_tr_range_edit').html(), {item: item});
                                        $tr.replaceWith(html);
                                        //$.selectBeautify();
                                },
                                getRedirectPort: function () {
                                        $.getJSON(modelNat.url.getRedirect, 'ftype=' + 1, function (rsp) {
                                                var html;
                                                if (rsp.code === 0) {
                                                        if (rsp.list.length !== 0) {
                                                                html = StringH.tmpl($('#tpl_tr_port').html(), {arr: rsp.list});
                                                                $('#natlist_port').html(html);
                                                        } else {
                                                                html = '<tr><td style="text-align:center;" colspan="6">暂无添加</td></tr>';
                                                                $('#natlist_port').html(html);
                                                        }
                                                } else {
                                                        window.top.art.dialog({
                                                                title: '端口转发',
                                                                content: rsp.msg,
                                                                lock: true,
                                                                time: 5 * 1000
                                                        });
                                                }
                                        });
                                },
                                getRedirectRange: function () {
                                        $.getJSON(modelNat.url.getRedirect, 'ftype=' + 2, function (rsp) {
                                                var html;
                                                if (rsp.code === 0) {
                                                        if (rsp.list.length　 !== 0) {
                                                                var html = StringH.tmpl($('#tpl_tr_range').html(), {arr: rsp.list});
                                                                $('#natlist_range').html(html);
                                                        } else {
                                                                html = '<tr><td style="text-align:center;" colspan="6">暂无添加</td></tr>';
                                                                $('#natlist_range').html(html);
                                                        }
                                                } else {
                                                        window.top.art.dialog({
                                                                title: '端口转发',
                                                                content: rsp.msg,
                                                                lock: true,
                                                                time: 5 * 1000
                                                        });
                                                }
                                        });
                                },
                                url: {
                                        'addPort': 'api/xqnetwork/add_redirect',
                                        'addRange': 'api/xqnetwork/add_range_redirect',
                                        'delRedirect': 'api/xqnetwork/delete_redirect',
                                        'applyRedirect': 'api/xqnetwork/redirect_apply',
                                        'getRedirect': 'api/xqnetwork/portforward'
                                }
                        }
                }());
                $(function () {
        //    $.selectBeautify();
                        modelNat.init();
                });
        </script>
