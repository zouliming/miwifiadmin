<?php
Yii::app()->clientScript
	->registerCssFile(Util::getCssUrl() . 'jquery-ui.css')
	->registerCssFile(Util::getCssUrl() . 'page.default.css')
	->registerCssFile(Util::getCssUrl() . 'page.weight.css')
	->registerCssFile(Util::getCssUrl() . 'dialog.css');
?>
<style type="text/css">
.ui-datepicker{font-size: 10px;}
.ui-timepicker-div .ui-widget-header { margin-bottom: 8px; }
.ui-timepicker-div dl { text-align: left; }
.ui-timepicker-div dl dt { float: left; clear:left; padding: 0 0 0 5px; }
.ui-timepicker-div dl dd { margin: 0 10px 10px 45%; }
.ui-timepicker-div td { font-size: 90%; }
.ui-tpicker-grid-label { background: none; border: none; margin: 0; padding: 0; }

.ui-timepicker-rtl{ direction: rtl; }
.ui-timepicker-rtl dl { text-align: right; padding: 0 5px 0 0; }
.ui-timepicker-rtl dl dt{ float: right; clear: right; }
.ui-timepicker-rtl dl dd { margin: 0 45% 10px 10px; }
</style>
<div class="mod-weight-panel">
	<div class="section">
		<h4>记录您的体重</h4>
		<form id="addForm" class="form form-horizontal">
			<div class="item">
				<label class="k" for="Mainmenu_title">体重</label>
				<span class="v">
					<input size="20" maxlength="20" class="text input-large" name="Weight[weight]" id="Mainmenu_title" type="text" value="">
				</span>
				<em class="t"></em>
			</div>

			<div class="item item-control">
				<button type="submit" id="addBtn" class="btn btn-primary btn-large"><span>新建</span></button>
			</div>
		</form>
	</div>
	<div class="section" style="display: block;">
		<h4>体重 <i class="ico ico-refresh" id="refresh" title="刷新当前表格数据"></i></h4>

		<div id="devloading" style="display: none;">加载中...</div>
		<table width="100%" id="tableWeight" style="">
			<thead>
			<tr>
				<th>ID</th>
				<th>体重</th>
				<th>日期</th>
				<th>操作</th>
			</tr>
			</thead>
			<tbody></tbody>
		</table>
	</div>
</div>

<script type="tmpl/html" id="tpllist1">
    <tr data-id="{$id}">
    <form id="form{$id}" name="form{$id}">
        <td>{$id}</td>
        <td>
            <div class="read-mod">{$weight}</div>
            <div class="edit-mod"><input name="weight" type="text" value="{$weight}"></div>
        </td>
        <td>
            <div class="read-mod">{$date}</div>
            <div class="edit-mod"><input name="date" type="text" value="{$date}" class="datetime"></div>
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
        </form>
    </tr>
</script>
<?php
$jsUrl = Util::getJsUrl();
Yii::app()->clientScript
	->registerCoreScript('jquery')
	->registerScriptFile($jsUrl . 'jquery-ui-1.10.4.custom.min.js')
	->registerScriptFile($jsUrl . 'jquery.ui.datepicker-zh-CN.js')
	->registerScriptFile($jsUrl . 'jquery-ui-timepicker-addon.js')
	->registerScriptFile($jsUrl . 'jquery-ui-timepicker-zh-CN.js')
	->registerScriptFile($jsUrl . 'selectbeautify.js')
	->registerScriptFile($jsUrl . 'qwrap.js')
	->registerScriptFile($jsUrl . 'jquery.dialog.js')
	->registerScriptFile($jsUrl . 'validate.js')
	->registerScriptFile($jsUrl . 'pageTable.js')
	->registerScriptFile($jsUrl . 'util.js');
?>
<script type="text/javascript">
        var modelWeight = (function(){
                function randerDevlist(template,table,columnCount,data) {
                        var tpl,
				datalist = data,
				arrdevlist = [],
				htmlmenulist,
				tbody,
				colspan,
				table;
			tpl = $(template).html();
			table = $(table);
			tbody = table.find('tbody');
			colspan = columnCount;
			if (datalist.length === 0) {
				tbody.html('<tr><td colspan="' + colspan + '">无数据</td></tr>');
				return;
			}
			for (var i = 0; i < datalist.length; i++) {
				var index = i,
					id = datalist[i].id,
					weight = datalist[i].weight,
					date = datalist[i].date,
					tpldata = {
						index: index,
						id: id,
						weight: weight,
						date: date
					};
				arrdevlist.push(tpl.tmpl(tpldata));
			}
			htmlmenulist = arrdevlist.join('');
			tbody.html(htmlmenulist);
			table.show();
                }
                function addEvent(){
                        //编辑
			$('body').delegate('.btn-editqos', 'click', function (e) {
				e.preventDefault();
				var root = $(e.target).parents('tr');
                                $('.datetime').datetimepicker();
                                console.log($('.datetime'));
				root.find('td').each(function () {
					$(this).addClass('toedit');
				});
			});
			//取消
			$('body').delegate('.btn-cancel-qoslimit', 'click', function (e) {
				e.preventDefault();
				var root = $(e.target).parents('tr');
				root.find('td').each(function () {
					$(this).removeClass('toedit');
				});
			});
			//删除
			$('body').delegate('.btn-del-qoslimit', 'click', function (e) {
				e.preventDefault();
				var delData = (function (evt) {
					var e = evt;
					return function () {
						var root = $(e.target).parents('tr'),
							id = root.attr('data-id');
						$.post('delete/' + id, {}, function (rsp) {
							if (rsp.code == 0) {
								modelWeight.updateData();
							} else {
								alert(rsp.msg);
							}
						}, 'json');
					}
				})(e);
				window.top.$.dialog({
					title: '删除数据',
					content: '你确定要这条数据吗？',
					ok: function () {
						delData();
					},
					cancel: function () {
					}
				}).lock();
			});
			//提交修改form
			$('body').delegate('.btn-set-qoslimit', 'click', function (e) {
				e.preventDefault();
				var root = $(this).parents('tr'),
					formName = root.find('form').attr('name'),
					id = root.attr('data-id'),
					weight = root.find('input[name=weight]').val(),
					date = root.find('input[name=date]').val(),
					requestData = {
						Weight: {
							weight: weight,
							date: date
						}
					},
					requestURL = 'update/' + id,
					validRules = [{
						name: 'Weight[weight]',
						display: '体重',
						rules: 'required|numeric'
					}],
					validate = FormValidator.checkAll(formName, validRules);
				if (validate) {
					$.post(requestURL, requestData, function (rsp) {
						if (rsp.code === 0) {
							modelWeight.updateData();
						} else {
							alert(rsp.msg);
						}
					}, 'json');
				}
			});
			//刷新菜单信息
			$('#refresh').on('click', function (e) {
				e.preventDefault();
				$('#devloading').show();
				modelWeight.updateData();
				$('#devloading').hide();
			});
                        $("#addBtn").on('click',function(e){
				e.preventDefault();
				var data = $('#addForm').serialize();
				var validator = FormValidator.checkAll('addForm',[
					{
						name: 'Weight[weight]',
						display: '体重',
						rules: 'required|numeric'
					}
				]);
				if(validator){
					modelWeight.addMenu(data);
				}
			});
                }
                return {
                        init: function (a) {
				this.pageTableObject = a;
				addEvent();
				$.selectBeautify();
			},
                        model:function(){
                                return {
                                        'name':'Weight',
                                        'model':[
                                                'id',
                                                'weight',
                                                'date',
                                        ]
                                };
                        },
			updateData:function(){
				this.pageTableObject.jump(1);
			},
                        //获取最新的菜单信息
			menuStatus:function(data) {
				randerDevlist('#tpllist1','#tableWeight',4,data);
			},
                        addMenu:function(data){
				$.post('add', data, function (rsp) {
					if (rsp.code === 0) {
						modelWeight.updateData();
						modelWeight.resetForm();
					} else {
						console.log('提示错误');
					}
				}, 'json');
			},
			resetForm:function(){
				$('#addForm').find('input:not(".dummy")').val('');
			}
                };
        }());
        
	$(function () {
		var a = $('#tableWeight').pager({
			infoUrl:'/weight/alldata',
			renderData:function(data){//指怎么处理当前数据
                                modelWeight.menuStatus(data);
			}
		});
		modelWeight.init(a);
	});
</script>
