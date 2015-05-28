<?php
/* @var $this MainmenuController */
/* @var $dataProvider CActiveDataProvider */
$datas = $dataProvider->getData();
Yii::app()->clientScript->registerCssFile(Util::getCssUrl() . 'page.set.menu.css');
?>
<div class="mod-manimenu">
    <table width="100%">
        <tr>
            <th>ID</th>
            <th>标题</th>
            <th>链接</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
        <?php
        foreach ($datas as $row) {
            ?>
            <tr>
                <td><?php echo $row->id; ?></td>
                <td><?php echo $row->title; ?></td>
                <td><?php echo $row->url; ?></td>
                <td><?php echo $row->enable == 1 ? "启用" : "禁用"; ?></td>
                <td>
                    <div class="read-mod">
                        <button type="button" class="btn btn-small btn-editqos"><span>编辑</span></button>
                        <button type="button" class="btn btn-small btn-del-qoslimit"><span>删除</span></button>
                    </div>
                    <div class="edit-mod" style="display: none">
                        <button type="button" class="btn btn-small btn-set-qoslimit"><span>确认</span></button>
                        <button type="button" class="btn btn-small btn-cancel-qoslimit"><span>取消</span></button>
                    </div>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>
<?php Util::loadJquery(); ?>
<script type="tmpl/html" id="tpldevlist1">
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
        // rander devices list DOM
        function randerDevlist(rsp, type) {
            var tpl,
                devlist = rsp.list,
                arrdevlist = [],
                htmldevlist,
                tbody,
                colspan,
                table;
            $('.table-devices').hide();
            if (type == 0) {
                tpl = $('#tpldevlist1').html();
                tbody = $('#devlistauto');
                colspan = 5;
                table = $('#tableauto');
            } else {
                tpl = $('#tpldevlist2').html();
                tbody = $('#devlistcustom');
                colspan = 6;
                table = $('#tablecustom');
            }
            if (devlist.length == 0) {
                tbody.html('<tr><td colspan="' + colspan + '">无数据</td></tr>');
                return;
            }
            for (var i = 0; i < devlist.length; i++) {
                var index = i,
                    upspeed = byteFormat(devlist[i].statistics.upspeed, 100),
                    downspeed = byteFormat(devlist[i].statistics.downspeed, 100),
                    upmax = devlist[i].qos.upmax,
                    downmax = devlist[i].qos.downmax,
                    upmaxper = devlist[i].qos.upmaxper,
                    maxdownper = devlist[i].qos.maxdownper,
                    level = devlist[i].qos.level,
                    ip = devlist[i].ip,
                    mac = devlist[i].mac,
                    dname = devlist[i]['name'],
                    tpldata = {
                        index: index,
                        devname: dname,
                        ip: ip,
                        mac: mac,
                        upspeed: upspeed,
                        downspeed: downspeed,
                        upmax: upmax,
                        downmax: downmax,
                        upmaxper: upmaxper,
                        downmaxper: maxdownper,
                        level: level,
                        levelvalue: ['未设置', '低', '中', '高'][level]
                    };
                arrdevlist.push(tpl.tmpl(tpldata));
            }
            htmldevlist = arrdevlist.join('');
            tbody.html(htmldevlist);
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
                addEvent();
            }
        }
    }());
    $(function () {
        modelQos.init();
    });
</script>
