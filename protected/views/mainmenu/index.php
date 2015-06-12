<?php
Yii::app()->clientScript
	->registerCssFile(Util::getCssUrl() . 'page.default.css')
	->registerCssFile(Util::getCssUrl() . 'page.mainmenu.css')
	->registerCssFile(Util::getCssUrl() . 'dialog.css');
?>
<div class="mod-mainmenu-panel">
	<div class="section">
		<h4>新建菜单</h4>
		<form id="addForm" class="form form-horizontal">
			<div class="item">
				<label class="k" for="Mainmenu_title">菜单名称</label>
				<span class="v">
					<input size="20" maxlength="20" class="text input-large" name="Mainmenu[title]" id="Mainmenu_title" type="text" value="">
				</span>
				<em class="t"></em>
			</div>
			<div class="item">
				<label class="k" for="Mainmenu_url">链接</label>
				<span class="v">
					<input size="20" maxlength="20" class="text input-large" name="Mainmenu[url]" id="Mainmenu_url" type="text" value="">
				</span>
				<em class="t"></em>
			</div>
			<div class="item">
				<label class="k" for="Mainmenu_enable">启用</label>
				<span class="v">
				<?php echo CHtml::dropDownList('Mainmenu[enable]', 1, array(0 => '禁用', 1 => '启用'), array('class' => 'beautify')) ?>
				</span>
				<em class="t"></em>
			</div>

			<div class="item item-control">
				<button type="submit" id="addBtn" class="btn btn-primary btn-large"><span>新建</span></button>
			</div>
		</form>
	</div>
	<div class="section" style="display: block;">
		<h4>菜单列表 <i class="ico ico-refresh" id="refresh" title="刷新当前设备列表"></i></h4>

		<div id="devloading" style="display: none;">加载中...</div>
		<table width="100%" id="tableMenu" style="">
			<thead>
			<tr>
				<th>ID</th>
				<th>标题</th>
				<th>链接</th>
				<th>状态</th>
				<th>操作</th>
			</tr>
			</thead>
			<tbody id="menulist">
			</tbody>
		</table>
		<div id="pager" class="pager"></div>
	</div>
</div>
<script type="tmpl/html" id="tplmenulist1">
    <tr data-id="{$id}">
    <form id="form{$id}" name="form{$id}">
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
            <div class="read-mod">{$enableLabel}</div>
            <div class="edit-mod">
            <select name="enable">
				<option value="0" {if($enable == 0)}selected="selected"{/if}>禁用</option>
				<option value="1" {if($enable == 1)}selected="selected"{/if}>启用</option>
			</select>
            </div>
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
	->registerScriptFile($jsUrl . 'selectbeautify.js')
	->registerScriptFile($jsUrl . 'qwrap.js')
	->registerScriptFile($jsUrl . 'jquery.dialog.js')
	->registerScriptFile($jsUrl . 'validate.js')
	->registerScriptFile($jsUrl . 'util.js');
?>
<script type="text/javascript">
	!function($){
		var Pager= function(element,options){
			var t = this;
			$.getJSON(options.infoUrl,function(rsp) {
				options.itemCount = rsp.itemCount;
				t.init(element, options);
			});
		}
		Pager.prototype = {
			constructor:Pager,
			init:function(element,options){
				this.$element = $(element);
				this.options = this.getOptions(options);
				this.itemCount = this.options.itemCount;

				this.currentPage = 1;
				var p = Math.ceil(this.options.itemCount / this.options.pageSize);
				this.totalPage = p;
				this.initTemplate();
				this.updateStatus();
				this.addEvent();
			},
			initTemplate:function(){
				var inHtml = "";
				inHtml += this.options.pageinfoTemplate;
				inHtml += this.options.paginationTemplate;
				this.$element.html(inHtml);
			},
			updateStatus:function(){
				var startIdx,endIdx,
				pageinfoEle = this.$element.find('.page_info'),
				ulEle = this.$element.find('ul');
				startIdx = this.options.pageSize*(this.currentPage-1)+1;
				endIdx = (this.options.pageSize*this.currentPage)>this.itemCount?this.itemCount:(this.options.pageSize*this.currentPage);

				pageinfoEle.find("span.show_label").html("第"+startIdx+"条到"+endIdx+"条数据");
				pageinfoEle.find("span.total_label").html("共"+this.itemCount+"条数据");
				ulEle.find('a').removeClass('disabled');
				if(this.currentPage==1){
					ulEle.find('.first').addClass('disabled');
					ulEle.find('.prev').addClass('disabled');
				}
				if(this.currentPage==this.totalPage){
					ulEle.find('.last').addClass('disabled');
					ulEle.find('.next').addClass('disabled');
				}
			},
			addEvent:function(){
				var that = this;
				var ulEle = this.$element.find('ul');
				ulEle.find('.paginate_button').on('click',function(e){
					e.preventDefault();
					var ele = $(this);
					//如果已经disabled了，就停止
					if(ele.hasClass('disabled')){
						return false;
					}
					if(ele.hasClass('first')){
						that.currentPage = 1;
					}else if(ele.hasClass('prev')){
						if(that.currentPage>1){
							that.currentPage = that.currentPage-1;
						}else{
							that.currentPage = 1;
						}
					}else if(ele.hasClass('next')){
						if(that.currentPage<that.totalPage-1){
							that.currentPage = that.currentPage+1;
						}else{
							that.currentPage = that.totalPage;
						}
					}else if(ele.hasClass('last')){
						that.currentPage = that.totalPage;
					}
					that.updateStatus();

					if(that.options.turnPageCallback){
						that.options.turnPageCallback(that.currentPage);
					}
				});
			},
			getOptions: function (options) {
				options = $.extend({}, $.fn.pager.defaults, options);
				return options;
			}
		};
		$.fn.pager = function (option) {
			return this.each(function () {
				var options = typeof option == 'object' && option;
				new Pager(this,options);
			})
		};
		$.fn.pager.Constructor = Pager;
		$.fn.pager.defaults = {
			pageSize: 5
			, amountUrl:false
			, pageinfoTemplate: '<div class="page_info"><span class="show_label"></span>，<span class="total_label"></span></div>'
			, paginationTemplate: '<ul>'+
			'<li><a href="#" class="paginate_button first">首页</a></li>'+
			'<li><a href="#" class="paginate_button prev">上一页</a></li>'+
			'<li><a href="#" class="paginate_button next">下一页</a></li>'+
			'<li><a href="#" class="paginate_button last">末页</a></li>'+
			'</ul>'
			, html: false
			, container: false
		};
	}(window.jQuery);

	var modelMenu = (function () {
		//渲染模板
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
					id = menulist[i].id,
					title = menulist[i].title,
					url = menulist[i].url,
					enable = menulist[i].enable,
					tpldata = {
						index: index,
						id: id,
						title: title,
						url: url,
						enable: enable,
						enableLabel: ['禁用', '启用'][enable]
					};
				arrdevlist.push(tpl.tmpl(tpldata));
			}
			htmlmenulist = arrdevlist.join('');
			tbody.html(htmlmenulist);
			table.show();
		}

		function addEvent() {
			//编辑
			$('body').delegate('.btn-editqos', 'click', function (e) {
				e.preventDefault();
				var root = $(e.target).parents('tr');
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
				var delqos = (function (evt) {
					var e = evt;
					return function () {
						var root = $(e.target).parents('tr'),
							id = root.attr('data-id');
						$.post('delete/' + id, {}, function (rsp) {
							if (rsp.code == 0) {
								modelMenu.menuStatus();
							} else {
								alert(rsp.msg);
							}
						}, 'json');
					}
				})(e);
				window.top.$.dialog({
					title: '删除菜单',
					content: '你确定要这个菜单项目吗？',
					ok: function () {
						delqos();
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
					title = root.find('input[name=title]').val(),
					url = root.find('input[name=url]').val(),
					enable = root.find('select[name=enable]').val(),
					requestData = {
						Mainmenu: {
							title: title,
							url: url,
							enable: enable
						}
					},
					requestURL = 'update/' + id,
					validRules = [{
						name: 'title',
						display: '标题',
						rules: 'required|max_length[20]|min_length[2]'
					}, {
						name: 'url',
						display: '链接',
						rules: 'required|max_length[20]|min_length[2]'
					}],
					validate = FormValidator.checkAll(formName, validRules);
				if (validate) {
					$.post(requestURL, requestData, function (rsp) {
						if (rsp.code === 0) {
							modelMenu.menuStatus();
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
				modelMenu.menuStatus();
			});
			$("#addBtn").on('click',function(e){
				e.preventDefault();
				var data = $('#addForm').serialize();
				var validator = FormValidator.checkAll('addForm',[
					{
						name: 'Mainmenu[title]',
						display: '标题',
						rules: 'required|max_length[20]|min_length[2]'
					}, {
						name: 'Mainmenu[url]',
						display: '链接',
						rules: 'required|max_length[20]|min_length[2]'
					}
				]);
				if(validator){
					modelMenu.addMenu(data);
				}
			});
		}

		return {
			init: function () {
				modelMenu.menuStatus();
				addEvent();
				$.selectBeautify();
			},
			//获取最新的菜单信息
			menuStatus:function(page) {
				if(page===undefined){
					page = 1;
				}
				$.getJSON('/mainmenu/menuinfo', {page:page}, function (rsp) {
					$('#devloading').hide();
					if (rsp.code == 0) {
						randerDevlist(rsp);
					}
				});
			},
			addMenu:function(data){
				$.post('create', data, function (rsp) {
					if (rsp.code === 0) {
						modelMenu.menuStatus();
						modelMenu.resetForm();
					} else {
						console.log('提示错误');
					}
				}, 'json');
			},
			resetForm:function(){
				$('#addForm').find('input:not(".dummy")').val('');
			},
			test: function () {
				console.log('回调函数被调用了');
			}
		}
	}());
	$(function () {
		modelMenu.init();
		$('#pager').pager({
			infoUrl:'/mainmenu/menucount',
			turnPageCallback:function(page){
				modelMenu.menuStatus(page);
			}
		});
	});
</script>
