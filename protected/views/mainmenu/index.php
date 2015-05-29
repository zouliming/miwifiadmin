<?php
/* @var $this MainmenuController */
/* @var $dataProvider CActiveDataProvider */
$datas = $dataProvider->getData();
Yii::app()->clientScript->registerCssFile(Util::getCssUrl() . 'page.set.mainmenu.css');
?>
<div class="mod-manimenu">
    <div class="section" style="display: block;">
        <h4>设备列表 <i class="ico ico-refresh" id="refresh" title="刷新当前设备列表"></i></h4>

        <div id="devloading" style="display: none;">加载中...</div>
        <table width="100%" id="tableMenu" style="display: none">
            <thead>
            <tr>
                <th>ID</th>
                <th>标题</th>
                <th>链接</th>
                <th>状态</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody id="menulist"></tbody>
        </table>
    </div>
</div>
<?php
$jsUrl = Util::getJsUrl();
Yii::app()->clientScript
    ->registerCoreScript('jquery')
    ->registerScriptFile($jsUrl . 'selectbeautify.js')
    ->registerScriptFile($jsUrl . 'qwrap.js')
    ->registerScriptFile($jsUrl . 'util.js');
?>
<script type="tmpl/html" id="tplmenulist1">
    <tr>
        <td>{$id}</td>
        <td>
            <div class="read-mod">{$title}</div>
            <div class="edit-mod"><input name="title" type="text" value="{$title}"></div>
        </td>
        <td>
            <div class="read-mod">{$url}</div>
            <div class="edit-mod"><input name="url" type="text" value="{$url}"></div>
        </td>
        <td>
            <div class="read-mod">{if($enable==1)}启用{else}禁用{/if}</div>
            <div class="edit-mod"><input name="enable" type="text" value="{$enable}"></div>
        </td>
        <td>
        <div class="read-mod">
			<button type="button" class="btn btn-small btn-editqos"><span>编辑</span></button>
			{if($level != 0)}
				<button type="button" class="btn btn-small btn-del-qoslimit"><span>删除</span></button>
			{/if}
		</div>
		<div class="edit-mod">
			<button type="button" class="btn btn-small btn-set-qoslimit"><span>确认</span></button>
			<button type="button" class="btn btn-small btn-cancel-qoslimit"><span>取消</span></button>
		</div>
        </td>
    </tr>

</script>
<script type="text/javascript">
    var modelQos = (function () {
        // get menu list
        function menuStatus() {
            $.getJSON('/mainmenu/menuinfo', {}, function (rsp) {
                $('#devloading').hide();
                if (rsp.code == 0) {
                    randerDevlist(rsp);
                }
            });
        }

        // rander menus list DOM
        function randerDevlist(rsp) {
            var tpl,
                menulist = rsp.list,
                arrdevlist = [],
                htmlmenulist,
                tbody,
                colspan,
                table;
            $('.table-devices').hide();

            tpl = $('#tplmenulist1').html();
            tbody = $('#menulist');
            colspan = 5;
            table = $('#tableMenu');
            if (menulist.length == 0) {
                tbody.html('<tr><td colspan="' + colspan + '">无数据</td></tr>');
                return;
            }
            for (var i = 0; i < menulist.length; i++) {
                var index = i,
                    title = menulist[i].title,
                    url = menulist[i].url,
                    enable = menulist[i].enable,
                    tpldata = {
                        index: index,
                        title: title,
                        url: url,
                        enable: ['禁用', '启用'][enable]
                    };
                arrdevlist.push(tpl.tmpl(tpldata));
            }
            htmlmenulist = arrdevlist.join('');
            tbody.html(htmlmenulist);
            table.show();
        }

        function addEvent() {
            $('body').delegate('.btn-editqos', 'click', function (e) {
                e.preventDefault();
                var root = $(e.target).parents('tr');
                root.find('td').each(function () {
                    $(this).addClass('toedit');
                });
            });

            $('body').delegate('.btn-cancel-qoslimit', 'click', function (e) {
                e.preventDefault();
                var root = $(e.target).parents('tr');
                var formName = root.find('form')[0].name;
                root.find('td').each(function () {
                    $(this).removeClass('toedit');
                });
                console.log(formName);
                FormValidator.checkAll(formName, []);
            });

            $('body').delegate('.btn-del-qoslimit', 'click', function (e) {
                e.preventDefault();

                var delqos = (function (evt) {
                    var e = evt;
                    return function () {
                        var root = $(e.target).parents('tr'),
                            mac = root.attr('data-mac');
                        $.getJSON('api/xqnetwork/qos_offlimit', {mac: mac}, function (rsp) {
                            if (rsp.code == 0) {
                                qosStatus();
                            } else {
                                alert(rsp.msg);
                            }
                        });
                    }
                })(e);

                window.top.$.dialog({
                    title: '删除QoS设置',
                    content: '你确定要清除这个设备的QoS配置？',
                    ok: function () {
                        delqos();
                    },
                    cancel: function () {
                    }
                }).lock();

            });

            $('body').delegate('.btn-set-qoslimit', 'click', function (e) {
                e.preventDefault();
                var root = $(this).parents('tr'),
                    formName = root.find('form').attr('name'),
                    mac = root.attr('data-mac'),
                    upload = root.find('input[name=upload]').val(),
                    download = root.find('input[name=download]').val(),
                    level = root.find('select[name=level]').val(),
                    requestData = {
                        mac: mac,
                        upload: upload,
                        download: download,
                        level: level
                    },
                    requestURL = 'api/xqnetwork/qos_limit',
                    validRules = [{
                        name: 'upload',
                        display: '上传',
                        rules: 'required|numeric|greater_than[0]|less_than[101]'
                    }, {
                        name: 'download',
                        display: '下载',
                        rules: 'required|numeric|greater_than[0]|less_than[101]'
                    }],
                    validate = FormValidator.checkAll(formName, validRules);
                if (validate) {
                    $.post(requestURL, requestData, function (rsp) {
                        if (rsp.code === 0) {
                            qosStatus();
                        } else {
                            alert(rsp.msg);
                        }
                    }, 'json');
                }
            });
        }

        return {
            init: function () {
                menuStatus();
                addEvent();
            }
        }
    }());
    $(function () {
        modelQos.init();
    });
</script>
