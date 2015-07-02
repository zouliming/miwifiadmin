<?php
Yii::app()->clientScript->registerCssFile(Util::getCssUrl().'original/page.index.css');
?>
<div id="netdetecte" class="mod-sect mod-net-check net-check-warn" style="display:none;">
	<p class="msg">
		<i class="ico ico-check-tips"></i>
		<span class="con">不正常，请检测。</span>
	</p>
	<a href="#" class="action" target="_blank">立即检测</a>
</div>
<div class="mod-sect mod-router-info">
	<table>
		<tbody>
		<tr>
			<td width="273">
				<div class="pic">
					<img src="<?php echo Util::getImgUrl();?>v2/pic_rt.png" alt="">
				</div>
			</td>
			<td>
				<div class="main">
					<h2>CMCC-China的小米路由器</h2>
					<ul class="list">
						<li>型号：R1D</li>
						<li>版本：1.0.13</li>
						<li>CPU：双核 1GHz</li>
						<li>存储：930.71 GB</li>
						<!-- <li>内存：8GB</li> -->
						<li>运行时长：
							<span id="upTime">20小时50分28秒</span>
						</li>
						<li>连接终端：
							<span id="devicesNum">5</span>台</li>
						<li class="last">MAC地址：8C:BE:BE:28:EE:CF</li>
					</ul>
					<div class="disk" style="">
						<p>
							<!-- 总空间：<span class="disk-total">1TB</span> &nbsp;&nbsp;&nbsp;&nbsp; -->可用空间：
							<span class="disk-available">910.42GB</span>
						</p>
						<div class="used-bar">
							<div class="s0" style="width: 2.17945269047533%;"></div>
							<!-- <div class="s1"></div>
														<div class="s2"></div>
														<div class="s3"></div> --></div>
						<!-- <ul class="used-type">
														<li><i class="type type-1"></i>视频：12.3G</li>
														<li><i class="type type-2"></i>图片：12.3G</li>
														<li><i class="type type-3"></i>音乐：12.3G</li>
														<li><i class="type type-4"></i>其他：12.3G</li>
												</ul> -->
					</div>
				</div>
			</td>
		</tr>
		</tbody>
	</table>
</div>
<div class="mod-sect mod-net-status">
	<div class="hd">
		<h2>当前网络状态</h2>
	</div>
	<div class="bd">
		<table>
			<tbody>
			<tr>
				<td>
					<div class="traffic" id="trafficChart" style="width: 570px; height: 370px;">
						<p class="currval" style="right: 9.5px;">当前下载速度:
							<b id="downSpeed">566.28KB/S</b>
						</p>
						<div class="grid">
							<div class="label-y">
								<label style="top: 10px; width: 60px; left: -60px;">10MB/S</label>
								<label style="top: 80px; width: 60px; left: -60px;">8MB/S</label>
								<label style="top: 150px; width: 60px; left: -60px;">6MB/S</label>
								<label style="top: 220px; width: 60px; left: -60px;">4MB/S</label>
								<label style="top: 290px; width: 60px; left: -60px;">2MB/S</label>
								<label style="top: 360px; width: 60px; left: -60px;">0MB/S</label>
							</div>
						</div>
						<div class="line canvas" style="left: 60px; top: 40px;">
							<svg height="370" version="1.1" width="570" xmlns="http://www.w3.org/2000/svg" style="overflow: hidden; position: relative;">
								<desc style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Created with Raphaël 2.1.2</desc>
								<defs style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></defs>
							</svg>
						</div>
					</div>
				</td>
				<td width="220">
					<div class="status">
						<ul>
							<li>
								<div>
									<i class="ico ico-st-1"></i>
									<p>
										<b id="averageSpeed">402.31KB/S</b>
									</p>
									<p class="muted">平均下载</p>
								</div>
							</li>
							<li>
								<div>
									<i class="ico ico-st-2"></i>
									<p>
										<b id="maxSpeed">2.03MB/S</b>
									</p>
									<p class="muted">最快下载</p>
								</div>
							</li>
							<li>
								<div>
									<i class="ico ico-st-3"></i>
									<p>
										<b id="totalDownload">2.72GB</b>
									</p>
									<p class="muted">总下载量</p>
								</div>
							</li>
							<li class="last">
								<div>
									<i class="ico ico-st-4"></i>
									<p>
										<b id="totalUpload">374.77MB</b>
									</p>
									<p class="muted">总上传量</p>
								</div>
							</li>
						</ul>
					</div>
				</td>
			</tr>
			</tbody>
		</table>
	</div>
</div>
<div class="mod-sect mod-devices-status">
	<div class="hd">
		<h2>终端流量统计</h2>
	</div>
	<div class="bd">
		<table>
			<tbody>
			<tr>
				<td>
					<div class="chart" id="piechart" style="width:334px; height:334px; margin:0 70px 0 26px">
						<svg height="334" version="1.1" width="334" xmlns="http://www.w3.org/2000/svg" style="overflow: hidden; position: relative;">
							<desc style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Created with Raphaël 2.1.2</desc>
							<defs style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></defs>
							<path fill="#099ede" stroke="#ffffff" d="M167,167L325,167A158,158,0,1,0,210.91908511843013,318.7732320350334Z" stroke-width="3.00003704893671"
							      style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);" transform="matrix(1,0,0,1,0,0)"></path>
							<text x="71.0761967459939" y="94.89851617832869" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none"
							      fill="#ffffff" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 18px; line-height: normal; font-family: &#39;Microsoft Yahei&#39;; opacity: 1;"
							      opacity="1" font-size="18px" font-family="Microsoft Yahei">
								<tspan dy="7.250078678328691" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">79.4%</tspan>
							</text>
							<path fill="#10c7be" stroke="#ffffff" d="M167,167L210.91908511843013,318.7732320350334A158,158,0,0,0,291.3935706854941,264.41786064225073Z"
							      stroke-width="3" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path>
							<text x="234.16653087786779" y="266.44172730716434" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none"
							      fill="#ffffff" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 18px; line-height: normal; font-family: &#39;Microsoft Yahei&#39;; opacity: 1;"
							      opacity="1" font-size="18px" font-family="Microsoft Yahei">
								<tspan dy="7.246414807164342" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">9.9%</tspan>
							</text>
							<path fill="#4ec213" stroke="#ffffff" d="M167,167L291.3935706854941,264.41786064225073A158,158,0,0,0,316.9376337390253,216.82675976563095Z"
							      stroke-width="3" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path>
							<text x="272.7324051873224" y="223.75084574967917" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none"
							      fill="#ffffff" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 18px; line-height: normal; font-family: &#39;Microsoft Yahei&#39;; opacity: 0;"
							      opacity="0" font-size="18px" font-family="Microsoft Yahei">
								<tspan dy="7.243033249679172" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">5.4%</tspan>
							</text>
							<path fill="#ffcc00" stroke="#ffffff" d="M167,167L316.9376337390253,216.82675976563095A158,158,0,0,0,324.8717468201639,173.364868887108Z"
							      stroke-width="3" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path>
							<text x="285.04908533385935" y="188.5502541014995" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none"
							      fill="#ffffff" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 18px; line-height: normal; font-family: &#39;Microsoft Yahei&#39;; opacity: 0;"
							      opacity="0" font-size="18px" font-family="Microsoft Yahei">
								<tspan dy="7.24556660149949" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">4.4%</tspan>
							</text>
							<path fill="#ff7700" stroke="#ffffff" d="M167,167L324.8717468201639,173.364868887108A158,158,0,0,0,324.99116984962086,168.67040400749764Z"
							      stroke-width="3" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path>
							<text x="286.961189923191" y="170.051706442647" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none"
							      fill="#ffffff" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 18px; line-height: normal; font-family: &#39;Microsoft Yahei&#39;; opacity: 0;"
							      opacity="0" font-size="18px" font-family="Microsoft Yahei">
								<tspan dy="7.247018942647003" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">0.4%</tspan>
							</text>
							<path fill="#d24747" stroke="#ffffff" d="M167,167L324.99116984962086,168.67040400749764A158,158,0,0,0,325,167.00000000000003Z"
							      stroke-width="3" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path>
							<text x="286.99832337745573" y="167.63433949865788" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none"
							      fill="#ffffff" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 18px; line-height: normal; font-family: &#39;Microsoft Yahei&#39;; opacity: 0;"
							      opacity="0" font-size="18px" font-family="Microsoft Yahei">
								<tspan dy="7.25152699865788" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">0.1%</tspan>
							</text>
							<path fill="none" stroke="#999999" d="M167,167M167,74C238.5914333795136,74,283.33607924170957,151.5,247.5403625519528,213.5C230.92751262122317,242.27430013854078,200.22569986145922,260,167,260C95.4085666204864,260,50.663920758290416,182.50000000000003,86.45963744804719,120.50000000000003C103.07248737877678,91.72569986145925,133.77430013854078,74,167,74C167,74,167,74,167,74"
							      stroke-linejoin="round" stroke-linecap="round" stroke-width="2" opacity="0.067" transform="matrix(1,0,0,1,1,2)" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); stroke-linejoin: round; stroke-linecap: round; opacity: 0.067;"></path>
							<path fill="none" stroke="#999999" d="M167,167M167,74C238.5914333795136,74,283.33607924170957,151.5,247.5403625519528,213.5C230.92751262122317,242.27430013854078,200.22569986145922,260,167,260C95.4085666204864,260,50.663920758290416,182.50000000000003,86.45963744804719,120.50000000000003C103.07248737877678,91.72569986145925,133.77430013854078,74,167,74C167,74,167,74,167,74"
							      stroke-linejoin="round" stroke-linecap="round" stroke-width="4" opacity="0.067" transform="matrix(1,0,0,1,1,2)" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); stroke-linejoin: round; stroke-linecap: round; opacity: 0.067;"></path>
							<path fill="none" stroke="#999999" d="M167,167M167,74C238.5914333795136,74,283.33607924170957,151.5,247.5403625519528,213.5C230.92751262122317,242.27430013854078,200.22569986145922,260,167,260C95.4085666204864,260,50.663920758290416,182.50000000000003,86.45963744804719,120.50000000000003C103.07248737877678,91.72569986145925,133.77430013854078,74,167,74C167,74,167,74,167,74"
							      stroke-linejoin="round" stroke-linecap="round" stroke-width="6" opacity="0.067" transform="matrix(1,0,0,1,1,2)" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); stroke-linejoin: round; stroke-linecap: round; opacity: 0.067;"></path>
							<path fill="none" stroke="#999999" d="M167,167M167,74C238.5914333795136,74,283.33607924170957,151.5,247.5403625519528,213.5C230.92751262122317,242.27430013854078,200.22569986145922,260,167,260C95.4085666204864,260,50.663920758290416,182.50000000000003,86.45963744804719,120.50000000000003C103.07248737877678,91.72569986145925,133.77430013854078,74,167,74C167,74,167,74,167,74"
							      stroke-linejoin="round" stroke-linecap="round" stroke-width="8" opacity="0.067" transform="matrix(1,0,0,1,1,2)" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); stroke-linejoin: round; stroke-linecap: round; opacity: 0.067;"></path>
							<path fill="none" stroke="#999999" d="M167,167M167,74C238.5914333795136,74,283.33607924170957,151.5,247.5403625519528,213.5C230.92751262122317,242.27430013854078,200.22569986145922,260,167,260C95.4085666204864,260,50.663920758290416,182.50000000000003,86.45963744804719,120.50000000000003C103.07248737877678,91.72569986145925,133.77430013854078,74,167,74C167,74,167,74,167,74"
							      stroke-linejoin="round" stroke-linecap="round" stroke-width="10" opacity="0.067" transform="matrix(1,0,0,1,1,2)" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); stroke-linejoin: round; stroke-linecap: round; opacity: 0.067;"></path>
							<circle cx="167" cy="167" r="93" fill="#ffffff" stroke="#ffffff" stroke-width="0" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
							<text x="167" y="159" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#444444" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 55px; line-height: normal; font-family: &#39;Microsoft Yahei&#39;; fill-opacity: 1;"
							      font-size="55px" font-weight="normal" font-family="Microsoft Yahei" fill-opacity="1">
								<tspan dy="21.75" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">1.5</tspan>
							</text>
							<text x="167" y="197" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#999999" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 16px; line-height: normal; font-family: &#39;Microsoft Yahei&#39;; fill-opacity: 1;"
							      font-size="16px" font-weight="normal" font-family="Microsoft Yahei" fill-opacity="1">
								<tspan dy="6.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">GB/总下载量</tspan>
							</text>
						</svg>
					</div>
				</td>
				<td>
					<div id="piecharttable" class="charttable">
						<ul class="list">
							<li class="item">
								<i class="ico color" style="background:#099ede;"></i>
								<span class="name">我的Pro</span>
								<span class="value">1.26GB</span>
								<span class="value">519.73KB/S</span>
							</li>
							<li class="item">
								<i class="ico color" style="background:#10c7be;"></i>
								<span class="name">我的iPhone6</span>
								<span class="value">161.86MB</span>
								<span class="value">0KB/S</span>
							</li>
							<li class="item">
								<i class="ico color" style="background:#4ec213;"></i>
								<span class="name">徐晶的Pro</span>
								<span class="value">89.01MB</span>
								<span class="value">15.08KB/S</span>
							</li>
							<li class="item">
								<i class="ico color" style="background:#ffcc00;"></i>
								<span class="name">zoulimingdeiPad</span>
								<span class="value">72.68MB</span>
								<span class="value">0KB/S</span>
							</li>
							<li class="item">
								<i class="ico color" style="background:#ff7700;"></i>
								<span class="name">xujingde-iPad</span>
								<span class="value">7.7MB</span>
								<span class="value">0KB/S</span>
							</li>
							<li class="item">
								<i class="ico color" style="background:#d24747;"></i>
								<span class="name">徐晶-iPhone</span>
								<span class="value">2.73MB</span>
								<span class="value">0.53KB/S</span>
							</li>
						</ul>
					</div>
				</td>
			</tr>
			</tbody>
		</table>
	</div>
</div>