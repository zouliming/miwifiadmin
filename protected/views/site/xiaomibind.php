<div id="panelClientdld" class="panel-client-dld" style="display:none; z-index:101;">
	<ul class="clearfix">
		<li class="first"><a href="#"><img src="/img/pic_client_pc.png" alt=""/> <span>PC版</span></a></li>

		<li><a href="#"><img src="/img/pic_client_mac.png" alt=""/> <span>Mac版</span></a></li>

		<li><a href="#"><img src="/img/pic_client_ad.png" alt=""/> <span>Android</span></a></li>
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
	var global_static_url = '<?php echo Yii::app()->getBaseUrl(); ?>';
</script>
<script src="<?php echo Util::getJsUrl(); ?>common.js?v=0.0.3"></script>
<script src="<?php echo Util::getJsUrl(); ?>md5.js?v=0.0.3"></script>
<script src="<?php echo Util::getJsUrl(); ?>base64.js?v=0.0.3"></script>
<script src="<?php echo Util::getJsUrl(); ?>crypto-js/rollups/sha1.js?v=0.0.3"></script>
<script src="<?php echo Util::getJsUrl(); ?>crypto-js/rollups/aes.js?v=0.0.3"></script>
<script>
	//检测ajax登录是否失效
	$(global_event).trigger('needLogin');
	global_event.crypto = {
		key: 'a2ffa5c9be07488bbb04a3a47d3c5f6a',
		iv: '64175472480004614961023454661220',
		nonce: null,
		init: function () {
			var nonce = this.nonceCreat();
			this.nonce = nonce;
		},
		nonceCreat: function () {
			var type = 0;
			var deviceId = '6c:40:08:8e:50:b0';
			var time = Math.floor(new Date().getTime() / 1000);
			var random = Math.floor(Math.random() * 10000);
			return [type, deviceId, time, random].join('_');
		},
		oldPwd: function (pwd) {
			return CryptoJS.SHA1(this.nonce + CryptoJS.SHA1(pwd + this.key).toString()).toString();
		},
		//不知道做什么用的
		newPwd: function (pwd, newpwd) {
			var key = CryptoJS.SHA1(pwd + this.key).toString();
			key = CryptoJS.enc.Hex.parse(key).toString();
			key = key.substr(0, 32);
			key = CryptoJS.enc.Hex.parse(key);
			var password = CryptoJS.SHA1(newpwd + this.key).toString();
			var iv = CryptoJS.enc.Hex.parse(this.iv);
			var aes = CryptoJS.AES.encrypt(
				password,
				key,
				{iv: iv, mode: CryptoJS.mode.CBC, padding: CryptoJS.pad.Pkcs7}
			).toString();
			return aes;
		}
	};
	//下载客户端
	$(global_event).on('downloadclient', function (evt, data) {
		var ModelClientDownload = (function () {
			var base,
				baseWidth,
				basePos,
				target = $('#panelClientdld'),
				targetDur = target.find('.dur'),
				targetWidth,
				targetDurWidth,
				docWidth,
				targetLeft,
				targetDurLeft,
				timer;
			if (target.length == 0) {
				return;
			}
			var position = function () {
					baseWidth = base.outerWidth();
					basePos = base.offset();
					targetWidth = target.outerWidth();
					targetDurWidth = targetDur.outerWidth();
					docWidth = $(window).width();
					targetLeft = basePos.left + baseWidth / 2 - targetWidth / 2;
					if (targetLeft + targetWidth > docWidth) {
						targetLeft = docWidth - targetWidth - 10;
					}
					target.css({left: targetLeft});
					targetDurLeft = basePos.left + baseWidth / 2 - targetDurWidth / 2 - targetLeft;
					targetDur.css({left: targetDurLeft});
				},
				init = function (el) {
					base = el || $('#downloadclient');
					position();
					$(window).resize(function () {
						window.clearTimeout(timer);
						timer = window.setTimeout(function () {
							position();
						}, 400);
					});
					$('#downloadMask').on('click', function (e) {
						e.preventDefault();
						$(this).hide();
						target.hide();
					});
				},
				show = function () {
					maskShow();
					target.show();
				},
				maskShow = function () {
					$('#downloadMask').css({
						width: '100%',
						height: $(window).height()
					}).show();
				},
				hide = function () {
					target.hide();
					window.clearTimeout(timer);
				},
				isopen = function () {
					return target[0].style.display != 'none';
				};
			return {
				init: init,
				update: position,
				show: show,
				hide: hide,
				isopen: isopen
			}
		})();
		$('body').delegate('#downloadclient', 'click', function (e) {
			e.preventDefault();
			if (navigator.userAgent.match(/Android/i)) {
				location.href = '#';
				return;
			}
			var $this = $(this),
				panel = ModelClientDownload;
			panel.init($this);
			if (panel.isopen()) {
				panel.hide();
			} else {
				panel.show();
			}
		});
	});
	$(global_event).trigger('downloadclient');
</script>

<script type="text/javascript">
	//二级菜单链接
	$(global_event).on('set:map', function (evt, data) {
		global_event.set = {
			'urlMap': urlMap
		};
		$('.nav-item a[target="setting"]').on('click', function (e) {
			e.preventDefault();
			var hash = $(this).attr('href');
			var key = hash.replace('#!', '');
			window.location.hash = hash;
			if (typeof (urlMap[key]) !== 'undefined') {
				$(global_event).trigger('set:loadIframe', {url: urlMap[key]});
			} else {
				console.log('这个菜单名找不到对应的链接啊，大哥');
				return;
			}
		});
                //二级不展开菜单，active样式效果
		$('.nav-item h3 a').on('click', function (e) {
			$('.nav-item').removeClass('active');
			$(this.parentNode.parentNode).addClass('active');
		});
                //二级展开菜单，active样式效果
		$('.nav-item li a').on('click', function (e) {
			$('.nav-item li').removeClass('active');
			$(this.parentNode).addClass('active');
		});
	});
	//加载iframe
	$(global_event).on('set:loadIframe', function (evt, data) {
		var url = data.url,
			iframe = document.getElementById('setting');
		iframe.src = url;
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
	//二级菜单添加颜色效果
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
	//二级菜单展开效果
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
	});
	$(function () {
		//nav,一级菜单设置active状态
		if (typeof (navCurrent) !== "undefined") {
			$('#nav li').removeClass('active');
			$('#nav').find(navCurrent).addClass('active');
		}
	});
</script>