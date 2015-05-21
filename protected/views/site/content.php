
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
<link rel="stylesheet" href="<?php echo Util::getCssPath();?>page.set.qos.css?v=0.0.3"/>
</head>
<body>
<!-- upgread -->
<div class="mod-setting-panel">
    <div class="hd">
        <h3>QoS状态</h3>
        <a href="#" data-order="1" class="btn-offon btn-on" id="btnqos"></a>
    </div>
    <div class="bd">
        <div class="mod-qos-off" id="qosoff" style="display: none;">
            <p>QoS是一种智能带宽分配功能，可以帮助你自动为各设备设置限速，<br>让在线视频与网络游戏同时享有畅快体验！</p>
        </div>
        <div class="mod-qos" id="qosset" style="display: block;">
            <div class="section" id="speedtest" style="display: none;">
                <div class="ico ico-speedtest"></div>
                <div class="speedtest">
                    <div class="content" id="speedteststep"><p>你的网络上传带宽为1.24 Mbps</p><p>你的网络下载带宽为12.05 Mbps</p></div>
                    <div class="progress" style="display: none;"><span id="progressval"></span></div>
                    <div class="btns" style="display: block;">
                        <a href="#" id="btnsetbw" class="btn btn-small" data-upload="1.24" data-download="12.05"><span>确认</span></a>
                        <a href="#" id="btncancelsptest" class="btn btn-small" style="display: none;"><span>手动设置</span></a>
                        <a href="#" id="btnretest" class="btn btn-small"><span>重新检测</span></a>
                    </div>
                </div>
            </div>
            <!--  -->
            <div class="section" id="sectsetbandwidth" style="display: block;">
                <h4>外网带宽</h4>
                <div class="speedset clearfix" id="autoget" style="">
                    <div>
                        上传：<span id="upload" class="upband">1.24</span>Mbps 下载：<span id="download" class="downband">12.05</span>Mbps
                    </div>
                    <div class="btns">
                        <a href="#" class="btn btn-small" id="speedget"><span>重新测速</span></a>
                        <a href="#" class="btn btn-small" id="speedset"><span>手工修改</span></a>
                    </div>
                </div>
                <div class="speedset" id="customset" style="display:none;">
                    <form action="/cgi-bin/luci/;stok=cdd7e9533c86d482abe91e09388d8759/api/xqnetwork/set_band" class="form form-small form-qos" name="bandwidth" id="bandwidth" method="post">
                        <div class="item">
                            <label class="k">上传：</label>
                            <span class="v"><input type="text" name="upload" class="text upband"> Mbps</span>
                            <em class="t"></em>
                        </div>
                        <div class="item">
                            <label class="k">下载：</label>
                            <span class="v"><input type="text" name="download" class="text downband"> Mbps</span>
                            <em class="t"></em>
                        </div>
                        <div class="item item-control">
                            <button type="submit" id="submitbandwirdh" class="btn btn-primary btn-small"><span>保存</span></button>
                            <a id="cancelsetbandwidth" href="#" class="btn btn-small"><span>取消</span></a>
                        </div>
                    </form>
                </div>
            </div>
            <!--  -->
            <div class="section" style="display: block;">
                <h4>QoS模式</h4>
                <div class="models">
                    <label for="model1"><input type="radio" value="0" name="model" id="model1" class="model"> <span>自动（系统自动进行智能限速）</span></label>
                    <label for="model2"><input type="radio" value="1" name="model" id="model2" class="model"> <span>手工（用户设置限速规则与优先级）</span></label>
                </div>
            </div>
            <!--  -->
            <div class="section" style="display: block;">
                <h4>设备列表 <i class="ico ico-refresh" id="refresh" title="刷新当前设备列表"></i></h4>
                <div id="devloading" style="display: none;">加载中...</div>
                <table class="table table-devices" id="tableauto" style="">
                    <thead>
                    <tr>
                        <th>名称</th>
                        <th>IP和MAC</th>
                        <th>当前网速</th>
                        <th>智能限速</th>
                        <th class="center">限速模式</th>
                    </tr>
                    </thead>
                    <tbody id="devlistauto">
                    <tr>
                        <td>我的iPhone6</td>
                        <td class="con">192.168.31.190 <br> F0:DB:E2:8E:7A:86</td>
                        <td class="con"><i class="ico ico-upspeed"></i> 0KB/S <br><i class="ico ico-downspeed"></i> 0KB/S</td>
                        <td class="con"><i class="ico ico-upspeed"></i> 171KB/S <br><i class="ico ico-downspeed"></i> 1660.75KB/S</td>
                        <td class="con center">系统自动</td>
                    </tr>

                    <tr>
                        <td>徐晶-iPhone</td>
                        <td class="con">192.168.31.195 <br> 18:F6:43:8E:81:23</td>
                        <td class="con"><i class="ico ico-upspeed"></i> 0KB/S <br><i class="ico ico-downspeed"></i> 0KB/S</td>
                        <td class="con"><i class="ico ico-upspeed"></i> 171KB/S <br><i class="ico ico-downspeed"></i> 1660.75KB/S</td>
                        <td class="con center">系统自动</td>
                    </tr>

                    <tr>
                        <td>我的Pro</td>
                        <td class="con">192.168.31.122 <br> 6C:40:08:8E:50:B0</td>
                        <td class="con"><i class="ico ico-upspeed"></i> 0KB/S <br><i class="ico ico-downspeed"></i> 0KB/S</td>
                        <td class="con"><i class="ico ico-upspeed"></i> 171KB/S <br><i class="ico ico-downspeed"></i> 1660.75KB/S</td>
                        <td class="con center">系统自动</td>
                    </tr>

                    <tr>
                        <td>徐晶的Pro</td>
                        <td class="con">192.168.31.107 <br> D0:A6:37:EA:C9:D3</td>
                        <td class="con"><i class="ico ico-upspeed"></i> 0KB/S <br><i class="ico ico-downspeed"></i> 0KB/S</td>
                        <td class="con"><i class="ico ico-upspeed"></i> 171KB/S <br><i class="ico ico-downspeed"></i> 1660.75KB/S</td>
                        <td class="con center">系统自动</td>
                    </tr>

                    <tr>
                        <td>xujingde-iPad</td>
                        <td class="con">192.168.31.209 <br> C8:F6:50:1A:03:C3</td>
                        <td class="con"><i class="ico ico-upspeed"></i> 0KB/S <br><i class="ico ico-downspeed"></i> 0KB/S</td>
                        <td class="con"><i class="ico ico-upspeed"></i> 171KB/S <br><i class="ico ico-downspeed"></i> 1660.75KB/S</td>
                        <td class="con center">系统自动</td>
                    </tr>
                    </tbody>
                </table>
                <table class="table table-devices" id="tablecustom" style="display: none;">
                    <thead>
                    <tr>
                        <th>名称</th>
                        <th width="130">IP和MAC</th>
                        <th>当前网速</th>
                        <th width="80" class="center">优先级</th>
                        <th width="130">最大带宽</th>
                        <th width="60" class="center">操作</th>
                    </tr>
                    </thead>
                    <tbody id="devlistcustom"></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script type="tmpl/html" id="tpldevlist1">
<tr>
	<td>{$devname}</td>
	<td class="con">{$ip} <br> {$mac}</td>
	<td class="con"><i class="ico ico-upspeed"></i> {$upspeed}/S <br><i class="ico ico-downspeed"></i> {$downspeed}/S</td>
	<td class="con"><i class="ico ico-upspeed"></i> {$upmax}KB/S <br><i class="ico ico-downspeed"></i> {$downmax}KB/S</td>
	<td class="con center">系统自动</td>
</tr>
</script>
<script type="tmpl/html" id="tpldevlist2">
<tr data-mac="{$mac}">
	<td>{$devname}</td>
	<td class="con">{$ip} <br> {$mac}</td>
	<td class="con"><i class="ico ico-upspeed"></i> {$upspeed}/S <br><i class="ico ico-downspeed"></i> {$downspeed}/S</td>
	<td class="center">
		<div class="read-mod">
			{$levelvalue}
		</div>
		<div class="edit-mod">
			<select name="level">
				<option value="1" {if($level == 1)}selected="selected"{/if}>低</option>
				<option value="2" {if($level == 2 || $level == 0)}selected="selected"{/if}>中</option>
				<option value="3" {if($level == 3)}selected="selected"{/if}>高</option>
			</select>
		</div>
	</td>
	<td>
		<div class="form form-qos read-mod">
			<div class="item">
				<i class="ico ico-upspeed"></i> {if($level == 0)}未设置{else}{$upmaxper} %{/if}
			</div>
			<div class="item">
				<i class="ico ico-downspeed"></i> {if($level == 0)}未设置{else}{$downmaxper} %{/if}
			</div>
		</div>
		<form class="form form-small form-qos edit-mod" id="qoslimit{$index}" name="qoslimit{$index}">
			<div class="item">
				<label class="k"><i class="ico ico-upspeed"></i></label>
				<span class="v"><input name="upload" class="text" type="text" value="{$upmaxper}"> %</span>
				<em class="t"></em>
			</div>
			<div class="item">
				<label class="k"><i class="ico ico-downspeed"></i></label>
				<span class="v"><input name="download" class="text" type="text" value="{$downmaxper}"> %</span>
				<em class="t"></em>
			</div>
		</form>
	</td>
	<td class="center action">
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

<!--[if lt IE 7]>
<script>
try{ document.execCommand("BackgroundImageCache",false,true);} catch(e){}
</script>
<![endif]-->
<link rel="stylesheet" href="<?php echo Util::getCssPath();?>dialog.css?v=0.0.3">
<?php 
        $this->beginContent('xiaomibind');
        $this->endContent();
        ?>
<script>
var modelQos = (function(){
	// get Qos status
	function qosStatus(){
		$('#qosset').hide();
		$.getJSON('/api/qos_info', {}, function(rsp){
			$( '#devloading' ).hide();
			$('#qosset').show();
			if (rsp.code == 0) {
				var btnqos = $('#btnqos')[0],
					listqos = $('#qosset'),
					listqosoff = $('#qosoff');
				if (rsp.status.on === 0) {
					btnqos.className = 'btn-offon btn-off';
					listqos.hide();
					listqosoff.show();
				}else{
					btnqos.className = 'btn-offon btn-on';
					listqos.show();
					listqosoff.hide();
				}
				if ( rsp.status.on === 1 ) {
					var upband = rsp.band.upload,
						downband = rsp.band.download,
						model = rsp.status.mode;

					if ( downband == 0 ) {
						getBandwidth();
						return;
					}
					if ( model == 0 ) {
						$('#model1').prop( 'checked', true );
					} else {
						$('#model2').prop( 'checked', true );
					}
					$('span.upband').text( upband );
					$('span.downband').text( downband );
					$('input.upband').val( upband );
					$('input.downband').val( downband );

					$('#autoget').show();
					$('.section').show();
					$('#speedtest').hide();
					randerDevlist( rsp, model );
				}
			}
		});
	}

	// set bandwidth form callback
	function setBandWidth( e ){
		e.preventDefault();
		var tar = e.target,
			formName = tar.name,
			requestURL = tar.action,
			validRules = [{
				name: 'upload',
				display :'上传',
				rules: 'required|numeric|greater_than[0]|less_than[100000]'
			},{
				name: 'download',
				display :'下载',
				rules: 'required|numeric|greater_than[0]|less_than[100000]'
			}],
			requestData = $(tar).serialize(),
			validate = FormValidator.checkAll(formName, validRules);
		console.log( tar, formName , validate );
		if ( validate ) {
			$.post( requestURL, requestData, function( rsp ){
				if ( rsp.code === 0 ) {
					$('.speedset').hide();
					$('#autoget').show();
					qosStatus();
				} else {
					alert( rsp.msg );
				}
			}, 'json' );
		}
	}

	// when firset set Qos get network bandwidth info
	function getBandwidth( type ){
		var upband,
			upbandRet,
			downband,
			downbandRet,
			type = type | 1,
			getError = function( rsp ){
				if ( rsp.code !== 0 ) {
					alert( rsp.msg );
					location.reload( true );
				}
			},
			ajaxError = function(){
				alert( '系统错误，请重试。' );
				location.reload( true );
			},
			showprogress = function( e ) {
				console.log( e );
				if (e.lengthComputable) {
					var total = e.total,
						loaded = e.loaded,
						per = ( Math.floor( ( loaded / total ) * 10000 ) / 100 ) + '%';
					$('#progressval').html( per );
				}
			},
			getupspeed = function(){
				return $.ajax({
					type: 'GET',
					url: 'api/xqnetdetect/uploadspeed',
					dataType: 'json',
					xhrFields: {
						onprogress: function (event) {
							showprogress( event );
						}
					}
				});
			},
			getdownspeed = function(){
				return $.ajax({
					type: 'GET',
					url: 'api/xqnetdetect/netspeed',
					dataType: 'json',
					xhrFields: {
						onprogress: function (event) {
							showprogress( event );
						}
					}
				});
			},
			setband = function( upband, downband ){
				return $.ajax({
					type: 'POST',
					url: 'api/xqnetwork/set_band',
					data: {upload: upband, download: downband},
					dataType: 'json'
				});
			},
			wait = function(){
				$( '.section' ).hide();
				$( '#speedteststep' ).html('正在检测上传速度，请稍等...');
				$( '#speedtest' ).show();
				$( '#speedtest .progress' ).show();
				$( '#speedtest .btns' ).hide();
			},
			done = function(){
				$( '#speedtest .btns' ).show();
				$( '#speedtest .progress' ).hide();
			};

		wait();

		// get upload speed and bandwidth
		getupspeed()
		.done(function( rsp ){
			if ( rsp.code == 0 ) {
				upband = parseFloat( rsp.bandwidth );
				upbandRet = '<p>你的网络上传带宽为'+upband+' Mbps</p>';
			} else {
				upbandRet = '<p>上传测速失败</p>';
			}
			$( '#speedteststep' ).html( upbandRet + '<p>正在检测下载速度，请稍等...</p>');
			// get download speed and bandwidth
			getdownspeed()
			.done(function( rsp ){
				if ( rsp.code == 0 ) {
					downband = parseFloat( rsp.bandwidth );
					downbandRet = '<p>你的网络下载带宽为'+downband+' Mbps</p>';
				} else {
					downbandRet = '<p>下载测速失败</p>';
				}

				$( '#speedteststep' ).html( upbandRet + downbandRet );
				if ( typeof(upband) == 'undefined' || typeof(downband) == 'undefined' ) {
					$('#btnsetbw').hide();
					$('#btncancelsptest').show();
				} else {
					$('#btnsetbw').show()
						.attr('data-upload', upband)
						.attr('data-download', downband);
					$('#btncancelsptest').hide();
				}
				done();
			})
			.fail(ajaxError);
		})
		.fail(ajaxError);
	}

	// rander devices list DOM
	function randerDevlist( rsp, type ){
		var tpl,
			devlist = rsp.list,
			arrdevlist = [],
			htmldevlist,
			tbody,
			colspan,
			table;
		$('.table-devices').hide();
		if ( type == 0 ) {
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
		if ( devlist.length == 0 ) {
			tbody.html( '<tr><td colspan="'+ colspan +'">无数据</td></tr>' );
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
					levelvalue: ['未设置','低','中','高'][level]
				};
			arrdevlist.push( tpl.tmpl(tpldata) );
		}
		htmldevlist = arrdevlist.join('');
		tbody.html( htmldevlist );
		table.show();
	}

	// switch QoS status
	function qosSwitch(){
		var btnqos = $('#btnqos');
		btnqos.on('click', function(e){
			e.preventDefault();
			var st = $(this).hasClass('btn-on') ? 0 : 1,
				btn = this;
			$.getJSON('api/xqnetwork/qos_switch', {'on': st}, function(rsp){
				if (rsp.code == 0) {
					location.reload(1);
				}
			});
		});
	}

	// add Event
	function addEvent(){
		$( '#bandwidth' ).on( 'submit', setBandWidth );

		$( '#cancelsetbandwidth' ).on( 'click', function( e ){
			e.preventDefault();
			$( '.speedset' ).show();
			$( '#customset' ).hide();
			FormValidator.checkAll('bandwidth', []);
		} );

		$( '#speedset' ).on( 'click', function( e ){
			e.preventDefault();
			$( '.speedset' ).hide();
			$( '#customset' ).show();
		} );

		$( '#speedget' ).on( 'click', function( e ){
			e.preventDefault();
			getBandwidth( 2 );
		} );

		$( '.model' ).on( 'click', function( e ){
			var checked = $( e.target ).prop( 'checked' ),
				val = $( '.model:checked' ).val();
			if ( checked ) {
				$.getJSON( 'api/xqnetwork/qos_mode', { mode: val }, function( rsp ){
					if ( rsp.code === 0 ) {
						qosStatus();
					} else {
						alert( rsp.msg );
					}
				} );
			}
		} );

		$('body').delegate( '.btn-editqos', 'click', function( e ){
			e.preventDefault();
			var root = $( e.target ).parents( 'tr' );
			root.find('td').each(function(){
				$(this).addClass('toedit');
			});
		} );

		$('body').delegate( '.btn-cancel-qoslimit', 'click', function( e ){
			e.preventDefault();
			var root = $( e.target ).parents( 'tr' );
			var formName = root.find('form')[0].name;
			root.find('td').each(function(){
				$(this).removeClass('toedit');
			});
			console.log(formName);
			FormValidator.checkAll( formName, []);
		} );

		$('body').delegate( '.btn-del-qoslimit', 'click', function( e) {
			e.preventDefault();

			var delqos = (function ( evt ){
				var e = evt;
				return function() {
					var root = $( e.target ).parents( 'tr' ),
						mac = root.attr('data-mac');
					$.getJSON(  'api/xqnetwork/qos_offlimit', {mac: mac}, function( rsp ){
						if ( rsp.code == 0 ) {
							qosStatus();
						} else {
							alert( rsp.msg );
						}
					});
				}
			})( e );

			window.top.$.dialog({
				title: '删除QoS设置',
				content: '你确定要清除这个设备的QoS配置？',
				ok: function(){
					delqos();
				},
				cancel: function(){}
			}).lock();

		} );

		$('body').delegate( '.btn-set-qoslimit', 'click', function( e ){
			e.preventDefault();
			var root = $( this ).parents( 'tr' ),
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
					display :'上传',
					rules: 'required|numeric|greater_than[0]|less_than[101]'
				},{
					name: 'download',
					display :'下载',
					rules: 'required|numeric|greater_than[0]|less_than[101]'
				}],
				validate = FormValidator.checkAll( formName, validRules );
				if ( validate ) {
					$.post( requestURL, requestData, function( rsp ){
						if ( rsp.code === 0 ) {
							qosStatus();
						} else {
							alert( rsp.msg );
						}
					}, 'json' );
				}
		} );

		$( '#refresh' ).on( 'click', function( e ){
			e.preventDefault();
			$( '#devloading' ).show();
			qosStatus();
		} );

		$('#btnsetbw').on('click', function( e ){
			e.preventDefault();
			var upband = $(this).attr('data-upload'),
				downband = $(this).attr('data-download');
			$.ajax({
				type: 'POST',
				url: 'api/xqnetwork/set_band',
				data: {upload: upband, download: downband},
				dataType: 'json'
			}).done(function( rsp ){
				if ( rsp.code === 0 ) {
					$('.section').show();
					$('#speedtest').hide();
					qosStatus();
				} else {
					alert( rsp.msg );
					location.reload( true );
				}
			});
		});

		$('#btnretest').on('click', function( e ){
			e.preventDefault();
			getBandwidth();
		});

		$('#btncancelsptest').on('click', function( e ){
			e.preventDefault();
			$('#sectsetbandwidth').show();
			$( '.speedset' ).hide();
			$( '#customset' ).show();
			$( '#speedtest' ).hide();
		});
	}

	return {
		init : function(){
			qosStatus();
			qosSwitch();
			addEvent();
		}
	}
}());
//$(function(){
//	modelQos.init();
//});
</script>