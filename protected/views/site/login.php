<!DOCTYPE html><!--[if lt IE 7]>
<html class="ie6 oldie" lang="zh"><![endif]--><!--[if IE 7]>
<html class="ie7 oldie" lang="zh"><![endif]--><!--[if IE 8]>
<html class="ie8 oldie" lang="zh"><![endif]--><!--[if gt IE 8]><!-->
<html lang="zh"> <!--<![endif]-->
<head>
	<meta http-equiv="X-UA-Compatible" content="edge"/>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<meta name="viewport" content="width=1024">
	<!--[if lt IE 7]>
	<meta http-equiv="refresh" content="0; url=http://miwifi.com/blockie6.html"/><![endif]--><title>登录 - 小米路由器</title>
	<link rel="stylesheet" href="<?php echo Util::getCssUrl(); ?>original/page.login.css?v=0.0.3">
	<script>
		if (window.self != window.top) {
			window.top.location.reload(true);
		}
	</script>
</head>
<body id="page-login">
<div id="doc">
	<div id="hd">
		<div class="inner clearfix">
			<h1 id="logo"><a href="/" title="小米路由器">小米路由器</a></h1>

			<div class="mod-user-nav">
				<ul>
					<li><a id="downloadclient" href="#downloadclient">下载客户端</a></li>
					<li class="div-line">|</li>
					<li><b><a target="_blank" href="http://www1.miwifi.com">访问官网</a></b></li>
				</ul>
			</div>
		</div>
	</div>
	<div id="bd">
		<div class="mod-login clearfix">
			<div class="login-form">
				<div class="hd tab-router">
					<ul class="tab-nav">
						<li class="disabled" data-target="tab-xiaomi">小米账号登录</li>
						<li data-target="tab-router">管理密码登录</li>
					</ul>
				</div>
				<div class="bd">
					<div class="tab-content">
						<div class="tab-panel">
							<div class="userface" style="">
								<img class="face img-circle">

								<p class="name">未知</p>
							</div>
							<form id="xmloginform" name="xmloginform" method="post" action="/cgi-bin/luci/api/xqpassport/login" class="form-login">
								<div class="item">
									<span class="v"><input autocomplete="off" class="text input-large" type="text" name="uuid" id="xmuuid"/></span>

									<div class="t"><span class="text"></span><i class="dur"></i></div>
								</div>
								<div class="item">
									<span class="v"><input autocomplete="off" placeholder="小米账号密码" class="text input-large" type="password" name="password" id="xmpassword" value="" autocomplete="off"/></span>

									<div class="t"><span class="text"></span><i class="dur"></i></div>
								</div>
								<div class="item item-control">
									<label class="l js-checkbox"><span class="input-checkbox"><input name="remember" id="remember" type="checkbox"></span>
										两周内自动登录</label>
									<span class="r"><a class="forgetrtpwd" target="_blank" href="#">忘记密码？</a></span>
								</div>
								<div class="item item-control">
									<button type="submit" id="btnXmSubmit" class="btn btn-primary btn-block" disabled="disabled">
										<span>登录</span></button>
								</div>
							</form>
						</div>
						<div class="tab-panel tab-panel-active">
							<div class="userface">
								<img src="<?php echo Util::getImgUrl(); ?>tmp/face_rt.png" alt="" class="face img-circle">

								<p class="name" id="routername"></p>
							</div>
							<form id="rtloginform" name="rtloginform" method="post" action="/cgi-bin/luci/api/xqsystem/login" class="form-login">
								<input type="hidden" name="username" value="admin"/>
								<input type="hidden" name="logtype" value="2">

								<div class="item">
									<span class="v"><input placeholder="请输入管理密码" class="text input-large" type="password" name="password" id="rtpassword" value=""/></span>

									<div class="t"><span class="text"></span><i class="dur"></i></div>
								</div>
								<div class="item item-control">
									<button type="submit" id="btnRtSubmit" class="btn btn-primary btn-block" disabled="disabled">
										<span>登录</span></button>
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="ft"></div>
			</div>
		</div>
	</div>
	<div id="ft">
		<p>&copy; 2015 小米路由器<span>|</span>服务热线 400-100-5678</p>
	</div>

</div>

<!--[if lt IE 7]>
<script>
	try {
		document.execCommand("BackgroundImageCache", false, true);
	} catch (e) {
	}
</script><![endif]-->
<link rel="stylesheet" href="<?php echo Util::getCssUrl(); ?>dialog.css?v=0.0.3">
<?php
$this->beginContent('xiaomibind');
$this->endContent();
?>
<script>
	$(function () {
		$('#btnRtSubmit, #btnXmSubmit').prop('disabled', false);
		$('#routername').html('zouliming');
		var ModelLogin = (function () {
			var root = $('.login-form'),
				tab = $('.tab-nav li', root),
				hd = $('.hd', root),
				tabPanel = $('.tab-panel', root),
				active = 'tab-panel-active',
				tabActiveClass = ['tab-xiaomi', 'tab-router'],
				index,
				tabActive,
				isBinded = true,
				logtype = 1,
				tabEvent = function () {
					tab.removeClass('disabled');
					tab.on('click', function (e) {
						index = $(this).index();
						tabActive = $(this).attr('data-target');
						tabPanel.removeClass(active);
						tabPanel.eq(index).addClass(active);
						hd[0].className = 'hd ' + tabActive;
					});
				},
				switchTo = function (index) {
					tabActive = tabActiveClass[index];
					tabPanel.removeClass(active);
					tabPanel.eq(index).addClass(active);
					hd[0].className = 'hd ' + tabActive;
				},
				//渲染小米账号登录模块
				randerXiaomi = function (info) {
					var face = '/img/tmp/face.png',
						uuid = info.userId,
						iconUrl = info.miliaoIcon == '' ? face : info.miliaoIconOrig,
						nickname = info.aliasNick == '' ? uuid : StringH.encode4Html(info.aliasNick),
						elFace = $('.userface img', tabPanel[0]),
						elName = $('.userface .name', tabPanel[0]),
						formUuid = $('#xmuuid'),
						formPwd = $('#xmpassword');
					elFace.attr('src', iconUrl);
					elName.html(nickname);
					formUuid.val(uuid).prop('readOnly', true);
					$('.userface', tabPanel[0]).css({visibility: 'visible'});
				},
				//判断小米账号是否绑定过
				hasXiaomi = function () {
					if (isBinded) {
						tabEvent();
						$.getJSON('/api/passportBinded', {"force": 1}, function (rsp) {
							if (rsp.code == 0) {
								randerXiaomi(rsp.info);
							}
						});
						switchTo(parseInt(logtype, 10) - 1);
					}
				},
				formEvent = function () {
					//路由器登录
					$('#rtloginform').on('submit', function (e) {
						e.preventDefault();
						var frm = this.name,
							that = this;
						var validator = FormValidator.checkAll(frm, [{
							name: 'password',
							display: '密码',
							rules: 'required'
						}]);
						if (validator) {
							$('#btnRtSubmit').prop('disabled', true).find('span').html('登录中...');
							var param = $(this).serializeArray();
							var pwd = $('#rtpassword').val();
							global_event.crypto.init();
							var oldPwd = global_event.crypto.oldPwd(pwd);
							var nonce = global_event.crypto.nonce;
							var _param = $.map(param, function (val) {
									var tmp = val;
									if (val.name == 'password') {
										tmp.value = oldPwd
									}
									return tmp;
								}
							);
							_param.push({name: 'nonce', value: nonce});
							$.post('/api/login', _param, function (rsp) {
								var rsp = $.parseJSON(rsp);
								if (rsp.code == 0) {
									window.location.href = rsp.url;
								} else if (rsp.code == 403) {
									window.location.reload();
								} else {
									$('.item', that).addClass('item-err');
									$('.item .t', that).html('密码错误<i class="dur"></i>').show();
									setTimeout(function () {
										$('#btnRtSubmit').prop('disabled', false).find('span').html('登录');
									}, 200);
								}
							});
						}
						return false;
					});
					//小米登录
					$('#xmloginform').on('submit', function (e) {
						var frm = this.name;
						var url = this.action;
						var remember = $('#remember', this).prop('checked');
						var validator = FormValidator.checkAll(frm, [{
							name: 'uuid',
							display: '账号',
							rules: 'required'
						}, {
							name: 'password',
							display: '密码',
							rules: 'required'
						}]);
						if (validator) {
							$('#btnXmSubmit').prop('disabled', true).find('span').html('登录中...');
							var pwd = $.trim($('#xmpassword').val());
							var data = {
								'uuid': $.trim($('#xmuuid').val()),
								'password': hex_md5(pwd),
								'encrypt': Base64.encode(pwd)
							};
							$.ajax({
								type: 'post',
								url: url,
								data: data,
								dataType: 'json',
								success: function (rsp) {
									if (rsp.code == 0) {
										if (remember) {
											var expires = 7;
											$.cookie('autologin_v2', rsp.uuid + '|||' + rsp.token, {
												expires: expires,
												path: '/'
											});
										}
										var requestData = {
											uuid: rsp.uuid,
											token: rsp.token,
											logtype: 1
										};
										$.post('/cgi-bin/luci/api/xqsystem/login', requestData, function (rsp) {
											var rsp = $.parseJSON(rsp);
											if (rsp.code == 0) {
												window.location.href = rsp.url;
											} else {
												alert(rsp.msg);
											}
										});
									} else {
										var errMsg = rsp.msg;
										if (rsp.code == 403) {
											errMsg = '系统正在升级请稍等'
										}
										var itempwd = $('#xmpassword').parents('.item');
										itempwd.find('.t').html(errMsg + '<i class="dur"></i>').show();
										itempwd.addClass('item-err');
										$('#btnXmSubmit').prop('disabled', false).find('span').html('登录');
									}
								}
							});
						}
						e.preventDefault();
						return false;
					});
				},
				forgetrtpwd = function () {
					$('.forgetrtpwd').on('click', function (e) {
						e.preventDefault();
						var el = this;
						$.lightalert({follow: el, width: 320}).setContent('你忘记了密码问我？我怎么会知道？').show();
					});
				};
			return {
				domReady: function () {
//					hasXiaomi();
					formEvent();
					forgetrtpwd();
				}
			};
		}());
		ModelLogin.domReady();
	});
</script>
</body>
</html>