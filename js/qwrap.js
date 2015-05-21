/*!
	Copyright (c) Baidu Youa Wed QWrap
	version: 1.1.5 2013-02-28 released
	author: QWrap 月影、JK、屈屈
*/

/**
 * @singleton
 * @class QW QW是QWrap的默认域，所有的核心Class都应定义在QW的域下
 */
(function() {
	var QW = {
		/**
		 * @property {string} VERSION 脚本库的版本号
		 * @default 1.1.5
		 */
		VERSION: "1.1.5",
		/**
		 * @property {string} RELEASE 脚本库的发布号（小版本）
		 * @default 2013-02-28
		 */
		RELEASE: "2013-02-28",
		/**
		 * @property {string} PATH 脚本库的运行路径
		 * @type string
		 */
		PATH: (function() {
			var sTags = document.getElementsByTagName("script");
			return sTags[sTags.length - 1].src.replace(/(^|\/)[^\/]+\/[^\/]+$/, "$1");
		}()),

		/**
		 * 获得一个命名空间
		 * @method namespace
		 * @static
		 * @param { String } sSpace 命名空间符符串。如果命名空间不存在，则自动创建。
		 * @param { Object } root (Optional) 命名空间的起点。当没传root时：如果sSpace以“.”打头，则是默认为QW为根，否则默认为window。
		 * @return {any} 返回命名空间对应的对象
		 */
		namespace: function(sSpace, root) {
			var arr = sSpace.split('.'),
				i = 0,
				nameI;
			if (sSpace.indexOf('.') == 0) {
				i = 1;
				root = root || QW;
			}
			root = root || window;
			for (; nameI = arr[i++];) {
				if (!root[nameI]) {
					root[nameI] = {};
				}
				root = root[nameI];
			}
			return root;
		},

		/**
		 * QW无冲突化，还原可能被抢用的window.QW变量
		 * @method noConflict
		 * @static
		 * @return {json} 返回QW的命名空间
		 */
		noConflict: (function() {
			var _previousQW = window.QW;
			return function() {
				window.QW = _previousQW;
				return QW;
			}
		}()),

		/**
		 * 异步加载脚本
		 * @method loadJs
		 * @static
		 * @param { String } url Javascript文件路径
		 * @param { Function } callback (Optional) Javascript加载后的回调函数
		 * @param { Option } options (Optional) 配置选项，例如charset
		 */
		loadJs: function(url, callback, options) {
			options = options || {};
			var head = document.getElementsByTagName('head')[0] || document.documentElement,
				script = document.createElement('script'),
				done = false;
			script.src = url;
			if (options.charset) {
				script.charset = options.charset;
			}
			if ( "async" in options ){
				script.async = options["async"] || "";
			}
			script.onerror = script.onload = script.onreadystatechange = function() {
				if (!done && (!this.readyState || this.readyState == "loaded" || this.readyState == "complete")) {
					done = true;
					if (callback) {
						callback();
					}
					script.onerror = script.onload = script.onreadystatechange = null;
					head.removeChild(script);
				}
			};
			head.insertBefore(script, head.firstChild);
		},

		/**
		 * 加载jsonp脚本
		 * @method loadJsonp
		 * @static
		 * @param { String } url Javascript文件路径
		 * @param { Function } callback (Optional) jsonp的回调函数
		 * @param { Option } options (Optional) 配置选项，目前除支持loadJs对应的参数外，还支持：
				{RegExp} callbackReplacer (Optional) 回调函数的匹配正则。默认是：/%callbackfun%/ig；如果url里没找到匹配，则会添加“callback=%callbackfun%”在url后面
				{Function} oncomplete (Optional) Javascript加载后的回调函数
		 */
		loadJsonp : (function(){
			var seq = new Date() * 1;
			return function (url , callback , options){
				options = options || {};
				var funName = "QWJsonp" + seq++,
					callbackReplacer = options .callbackReplacer || /%callbackfun%/ig;
				window[funName] = function (data){
					if (callback) {
						callback(data);
					}
					window[funName] = null;
				};
				if (callbackReplacer.test(url)) url = url.replace(callbackReplacer,funName);
				else {
					url += (/\?/.test( url ) ? "&" : "?") + "callback=" + funName;
				}
				QW.loadJs(url , options.oncomplete , options);
			};
		}()),

		/**
		 * 加载css样式表
		 * @method loadCss
		 * @static
		 * @param { String } url Css文件路径
		 */
		loadCss: function(url) {
			var head = document.getElementsByTagName('head')[0] || document.documentElement,
			css = document.createElement('link');
			css.rel = 'stylesheet';
			css.type = 'text/css';
			css.href = url;
			head.insertBefore(css, head.firstChild);
		},

		/**
		 * 抛出异常
		 * @method error
		 * @static
		 * @param { obj } 异常对象
		 * @param { type } Error (Optional) 错误类型，默认为Error
		 */
		error: function(obj, type) {
			type = type || Error;
			throw new type(obj);
		}
	};

	/*
	 * @class Wrap Wrap包装器。在对象的外面加一个外皮
	 * @namespace QW
	 * @param {any} core 被包装对象
	 * @return {Wrap}
	 */
	/*
	QW.Wrap=function(core) {
		this.core=core;
	};
	*/

	window.QW = QW;
}());

/**
 * @class StringH 核心对象String的扩展
 * @singleton
 * @namespace QW
 * @helper
 */

(function() {

	var StringH = {
		/**
		 * 除去字符串两边的空白字符
		 * @method trim
		 * @static
		 * @param {String} s 需要处理的字符串
		 * @return {String}  除去两端空白字符后的字符串
		 * @remark 如果字符串中间有很多连续tab,会有有严重效率问题,相应问题可以用下一句话来解决.
		 return s.replace(/^[\s\xa0\u3000]+/g,"").replace(/([^\u3000\xa0\s])[\u3000\xa0\s]+$/g,"$1");
		 */
		trim: function(s) {
			return s.replace(/^[\s\xa0\u3000]+|[\u3000\xa0\s]+$/g, "");
		},

		/**
		 * 对一个字符串进行多次replace
		 * @method mulReplace
		 * @static
		 * @param {String} s  需要处理的字符串
		 * @param {array} arr  数组，每一个元素都是由replace两个参数组成的数组
		 * @return {String} 返回处理后的字符串
		 * @example alert(mulReplace("I like aa and bb. JK likes aa.",[[/aa/g,"山"],[/bb/g,"水"]]));
		 */
		mulReplace: function(s, arr) {
			for (var i = 0; i < arr.length; i++) {
				s = s.replace(arr[i][0], arr[i][1]);
			}
			return s;
		},

		/**
		 * 字符串简易模板
		 * @method format
		 * @static
		 * @param {String} s 字符串模板，其中变量以{0} {1}表示
		 * @param {String} arg0 (Optional) 替换的参数
		 * @return {String}  模板变量被替换后的字符串
		 * @example alert(format("{0} love {1}.",'I','You'))
		 */
		format: function(s, arg0) {
			var args = arguments;
			return s.replace(/\{(\d+)\}/ig, function(a, b) {
				var ret = args[(b | 0) + 1];
				return ret == null ? '' : ret;
			});
		},

		/*
		* 字符串简易模板
		* @method tmpl
		* @static
		* @param {String} sTmpl 字符串模板，其中变量以｛$aaa｝表示
		* @param {Object} opts 模板参数
		* @return {String}  模板变量被替换后的字符串
		* @example alert(tmpl("{$a} love {$b}.",{a:"I",b:"you"}))
		tmpl:function(sTmpl,opts){
			return sTmpl.replace(/\{\$(\w+)\}/g,function(a,b){return opts[b]});
		},
		*/

		/**
		 * 字符串模板
		 * @method tmpl
		 * @static
		 * @param {String} sTmpl 字符串模板，其中变量以{$aaa}表示。模板语法：
		 分隔符为{xxx}，"}"之前没有空格字符。
		 js表达式/js语句里的'}', 需使用' }'，即前面有空格字符
		 模板里的字符{用##7b表示
		 模板里的实体}用##7d表示
		 模板里的实体#可以用##23表示。例如（模板真的需要输出"##7d"，则需要这么写“##23#7d”）
		 {strip}...{/strip}里的所有\r\n打头的空白都会被清除掉
		 {}里只能使用表达式，不能使用语句，除非使用以下标签
		 {js ...}		－－任意js语句, 里面如果需要输出到模板，用print("aaa");
		 {if(...)}		－－if语句，写法为{if($a>1)},需要自带括号
		 {elseif(...)}	－－elseif语句，写法为{elseif($a>1)},需要自带括号
		 {else}			－－else语句，写法为{else}
		 {/if}			－－endif语句，写法为{/if}
		 {for(...)}		－－for语句，写法为{for(var i=0;i<1;i++)}，需要自带括号
		 {/for}			－－endfor语句，写法为{/for}
		 {while(...)}	－－while语句,写法为{while(i-->0)},需要自带括号
		 {/while}		－－endwhile语句, 写法为{/while}
		 * @param {Object} opts (Optional) 模板参数
		 * @return {String|Function}  如果调用时传了opts参数，则返回字符串；如果没传，则返回一个function（相当于把sTmpl转化成一个函数）

		 * @example alert(tmpl("{$a} love {$b}.",{a:"I",b:"you"}));
		 * @example alert(tmpl("{js print('I')} love {$b}.",{b:"you"}));
		 */
		tmpl: (function() {
			/*
			sArrName 拼接字符串的变量名。
			*/
			var sArrName = "sArrCMX",
				sLeft = sArrName + '.push("';
			/*
				tag:模板标签,各属性含义：
				tagG: tag系列
				isBgn: 是开始类型的标签
				isEnd: 是结束类型的标签
				cond: 标签条件
				rlt: 标签结果
				sBgn: 开始字符串
				sEnd: 结束字符串
			*/
			var tags = {
				'js': {
					tagG: 'js',
					isBgn: 1,
					isEnd: 1,
					sBgn: '");',
					sEnd: ';' + sLeft
				},
				//任意js语句, 里面如果需要输出到模板，用print("aaa");
				'if': {
					tagG: 'if',
					isBgn: 1,
					rlt: 1,
					sBgn: '");if',
					sEnd: '{' + sLeft
				},
				//if语句，写法为{if($a>1)},需要自带括号
				'elseif': {
					tagG: 'if',
					cond: 1,
					rlt: 1,
					sBgn: '");} else if',
					sEnd: '{' + sLeft
				},
				//if语句，写法为{elseif($a>1)},需要自带括号
				'else': {
					tagG: 'if',
					cond: 1,
					rlt: 2,
					sEnd: '");}else{' + sLeft
				},
				//else语句，写法为{else}
				'/if': {
					tagG: 'if',
					isEnd: 1,
					sEnd: '");}' + sLeft
				},
				//endif语句，写法为{/if}
				'for': {
					tagG: 'for',
					isBgn: 1,
					rlt: 1,
					sBgn: '");for',
					sEnd: '{' + sLeft
				},
				//for语句，写法为{for(var i=0;i<1;i++)},需要自带括号
				'/for': {
					tagG: 'for',
					isEnd: 1,
					sEnd: '");}' + sLeft
				},
				//endfor语句，写法为{/for}
				'while': {
					tagG: 'while',
					isBgn: 1,
					rlt: 1,
					sBgn: '");while',
					sEnd: '{' + sLeft
				},
				//while语句,写法为{while(i-->0)},需要自带括号
				'/while': {
					tagG: 'while',
					isEnd: 1,
					sEnd: '");}' + sLeft
				} //endwhile语句, 写法为{/while}
			};

			return function(sTmpl, opts) {
				var N = -1,
					NStat = []; //语句堆栈;
				var ss = [
					[/\{strip\}([\s\S]*?)\{\/strip\}/g, function(a, b) {
						return b.replace(/[\r\n]\s*\}/g, " }").replace(/[\r\n]\s*/g, "");
					}],
					[/\\/g, '\\\\'],
					[/"/g, '\\"'],
					[/\r/g, '\\r'],
					[/\n/g, '\\n'], //为js作转码.
					[
						/\{[\s\S]*?\S\}/g, //js里使用}时，前面要加空格。
						function(a) {
							a = a.substr(1, a.length - 2);
							for (var i = 0; i < ss2.length; i++) {a = a.replace(ss2[i][0], ss2[i][1]); }
							var tagName = a;
							if (/^(.\w+)\W/.test(tagName)) {tagName = RegExp.$1; }
							var tag = tags[tagName];
							if (tag) {
								if (tag.isBgn) {
									var stat = NStat[++N] = {
										tagG: tag.tagG,
										rlt: tag.rlt
									};
								}
								if (tag.isEnd) {
									if (N < 0) {throw new Error("Unexpected Tag: " + a); }
									stat = NStat[N--];
									if (stat.tagG != tag.tagG) {throw new Error("Unmatch Tags: " + stat.tagG + "--" + tagName); }
								} else if (!tag.isBgn) {
									if (N < 0) {throw new Error("Unexpected Tag:" + a); }
									stat = NStat[N];
									if (stat.tagG != tag.tagG) {throw new Error("Unmatch Tags: " + stat.tagG + "--" + tagName); }
									if (tag.cond && !(tag.cond & stat.rlt)) {throw new Error("Unexpected Tag: " + tagName); }
									stat.rlt = tag.rlt;
								}
								return (tag.sBgn || '') + a.substr(tagName.length) + (tag.sEnd || '');
							} else {
								return '",(' + a + '),"';
							}
						}
					]
				];
				var ss2 = [
					[/\\n/g, '\n'],
					[/\\r/g, '\r'],
					[/\\"/g, '"'],
					[/\\\\/g, '\\'],
					[/\$(\w+)/g, 'opts["$1"]'],
					[/print\(/g, sArrName + '.push(']
				];
				for (var i = 0; i < ss.length; i++) {
					sTmpl = sTmpl.replace(ss[i][0], ss[i][1]);
				}
				if (N >= 0) {throw new Error("Lose end Tag: " + NStat[N].tagG); }

				sTmpl = sTmpl.replace(/##7b/g,'{').replace(/##7d/g,'}').replace(/##23/g,'#'); //替换特殊符号{}#
				sTmpl = 'var ' + sArrName + '=[];' + sLeft + sTmpl + '");return ' + sArrName + '.join("");';

				//alert('转化结果\n'+sTmpl);
				var fun = new Function('opts', sTmpl);
				if (arguments.length > 1) {return fun(opts); }
				return fun;
			};
		}()),

		/**
		 * 判断一个字符串是否包含另一个字符串
		 * @method contains
		 * @static
		 * @param {String} s 字符串
		 * @param {String} opts 子字符串
		 * @return {String} 模板变量被替换后的字符串
		 * @example alert(contains("aaabbbccc","ab"))
		 */
		contains: function(s, subStr) {
			return s.indexOf(subStr) > -1;
		},

		/**
		 * 全角字符转半角字符
		 全角空格为12288，转化成" "；
		 全角句号为12290，转化成"."；
		 其他字符半角(33-126)与全角(65281-65374)的对应关系是：均相差65248
		 * @method dbc2sbc
		 * @static
		 * @param {String} s 需要处理的字符串
		 * @return {String}  返回转化后的字符串
		 * @example
		 var s="发票号是ＢＢＣ１２３４５６，发票金额是１２.３５元";
		 alert(dbc2sbc(s));
		 */
		dbc2sbc: function(s) {
			return StringH.mulReplace(s, [
				[/[\uff01-\uff5e]/g, function(a) {
					return String.fromCharCode(a.charCodeAt(0) - 65248);
				}],
				[/\u3000/g, ' '],
				[/\u3002/g, '.']
			]);
		},

		/**
		 * 得到字节长度
		 * @method byteLen
		 * @static
		 * @param {String} s 字符串
		 * @return {number}  返回字节长度
		 */
		byteLen: function(s) {
			return s.replace(/[^\x00-\xff]/g, "--").length;
		},
		/**
		 * 得到指定字节长度的子字符串
		 * @method subByte
		 * @static
		 * @param {String} s 字符串
		 * @param {number} len 字节长度
		 * @param {string} tail (Optional) 结尾字符串
		 * @return {string}  返回指定字节长度的子字符串
		 */
		subByte: function(s, len, tail) {
			if (StringH.byteLen(s) <= len) {return s; }
			tail = tail || '';
			len -= StringH.byteLen(tail);
			return s.substr(0, len).replace(/([^\x00-\xff])/g, "$1 ") //双字节字符替换成两个
				.substr(0, len) //截取长度
				.replace(/[^\x00-\xff]$/, "") //去掉临界双字节字符
				.replace(/([^\x00-\xff]) /g, "$1") + tail; //还原
		},

		/**
		 * 将字符串首字母大写
		 */
		capitalize: function(s){
			return s.slice(0,1).toUpperCase() + s.slice(1);
		},

		/**
		 * 驼峰化字符串。将“ab-cd”转化为“abCd”
		 * @method camelize
		 * @static
		 * @param {String} s 字符串
		 * @return {String}  返回转化后的字符串
		 */
		camelize: function(s) {
			return s.replace(/\-(\w)/ig, function(a, b) {
				return b.toUpperCase();
			});
		},

		/**
		 * 反驼峰化字符串。将“abCd”转化为“ab-cd”。
		 * @method decamelize
		 * @static
		 * @param {String} s 字符串
		 * @return {String} 返回转化后的字符串
		 */
		decamelize: function(s) {
			return s.replace(/[A-Z]/g, function(a) {
				return "-" + a.toLowerCase();
			});
		},

		/**
		 * 字符串为javascript转码
		 * @method encode4Js
		 * @static
		 * @param {String} s 字符串
		 * @return {String} 返回转化后的字符串
		 * @example
		 var s="my name is \"JK\",\nnot 'Jack'.";
		 window.setTimeout("alert('"+encode4Js(s)+"')",10);
		 */
		encode4Js: function(s) {
			return StringH.mulReplace(s, [
				[/\\/g, "\\u005C"],
				[/"/g, "\\u0022"],
				[/'/g, "\\u0027"],
				[/\//g, "\\u002F"],
				[/\r/g, "\\u000A"],
				[/\n/g, "\\u000D"],
				[/\t/g, "\\u0009"]
			]);
		},

		/**
		 * 转义转义字符，用于Object.Stringify
		 * 直接用encode4JS会有问题，有时候php等后端脚本不能直接解开
		 * 用这个和JSON.Stringify保持一致
		 * @static
		 * @param {String} s 字符串
		 * @return {String} 返回转化后的字符串
		 */
		escapeChars: function(s){
			return StringH.mulReplace(s, [
				[/\\/g, "\\\\"],
				[/"/g, "\\\""],
				//[/'/g, "\\\'"],//标准json里不支持\后跟单引号
				[/\r/g, "\\r"],
				[/\n/g, "\\n"],
				[/\t/g, "\\t"]
			]);
		},

		/**
		 * 为http的不可见字符、不安全字符、保留字符作转码
		 * @method encode4Http
		 * @static
		 * @param {String} s 字符串
		 * @return {String} 返回处理后的字符串
		 */
		encode4Http: function(s) {
			return s.replace(/[\u0000-\u0020\u0080-\u00ff\s"'#\/\|\\%<>\[\]\{\}\^~;\?\:@=&]/g, function(a) {
				return encodeURIComponent(a);
			});
		},

		/**
		 * 字符串为Html转码
		 * @method encode4Html
		 * @static
		 * @param {String} s 字符串
		 * @return {String} 返回处理后的字符串
		 * @example
		 var s="<div>dd";
		 alert(encode4Html(s));
		 */
		encode4Html: function(s) {
			var el = document.createElement('pre'); //这里要用pre，用div有时会丢失换行，例如：'a\r\n\r\nb'
			var text = document.createTextNode(s);
			el.appendChild(text);
			return el.innerHTML;
		},

		/**
		 * 字符串为Html的value值转码
		 * @method encode4HtmlValue
		 * @static
		 * @param {String} s 字符串
		 * @return {String} 返回处理后的字符串
		 * @example:
		 var s="<div>\"\'ddd";
		 alert("<input value='"+encode4HtmlValue(s)+"'>");
		 */
		encode4HtmlValue: function(s) {
			return StringH.encode4Html(s).replace(/"/g, "&quot;").replace(/'/g, "&#039;");
		},

		/**
		 * 与encode4Html方法相反，进行反编译
		 * @method decode4Html
		 * @static
		 * @param {String} s 字符串
		 * @return {String} 返回处理后的字符串
		 */
		decode4Html: function(s) {
			var div = document.createElement('div');
			div.innerHTML = StringH.stripTags(s);
			return div.childNodes[0] ? div.childNodes[0].nodeValue || '' : '';
		},

		/**
		 * 将所有tag标签消除，即去除<tag>，以及</tag>
		 * @method stripTags
		 * @static
		 * @param {String} s 字符串
		 * @return {String} 返回处理后的字符串
		 */
		stripTags: function(s) {
			return s.replace(/<[^>]*>/gi, '');
		},

		/**
		 * eval某字符串。如果叫"eval"，在这里需要加引号，才能不影响YUI压缩。不过其它地方用了也会有问题，所以改名evalJs，
		 * @method evalJs
		 * @static
		 * @param {String} s 字符串
		 * @param {any} opts 运行时需要的参数。
		 * @return {any} 根据字符结果进行返回。
		 */
		evalJs: function(s, opts) { //如果用eval，在这里需要加引号，才能不影响YUI压缩。不过其它地方用了也会有问题，所以改成evalJs，
			return new Function("opts", s)(opts);
		},

		/**
		 * eval某字符串，这个字符串是一个js表达式，并返回表达式运行的结果
		 * @method evalExp
		 * @static
		 * @param {String} s 字符串
		 * @param {any} opts eval时需要的参数。
		 * @return {any} 根据字符结果进行返回。
		 */
		evalExp: function(s, opts) {
			return new Function("opts", "return (" + s + ");")(opts);
		},

		/**
		 * 解析url或search字符串。
		 * @method queryUrl
		 * @static
		 * @param {String} s url或search字符串
		 * @param {String} key (Optional) 参数名。
		 * @return {Json|String|Array|undefined} 如果key为空，则返回解析整个字符串得到的Json对象；否则返回参数值。有多个参数，或参数名带[]的，参数值为Array。
		 */
		queryUrl: function(url, key) {
			url = url.replace(/^[^?=]*\?/ig, '').split('#')[0];	//去除网址与hash信息
			var json = {};
			//考虑到key中可能有特殊符号如“[].”等，而[]却有是否被编码的可能，所以，牺牲效率以求严谨，就算传了key参数，也是全部解析url。
			url.replace(/(^|&)([^&=]+)=([^&]*)/g, function (a, b, key , value){
				//对url这样不可信的内容进行decode，可能会抛异常，try一下；另外为了得到最合适的结果，这里要分别try
				try {
				key = decodeURIComponent(key);
				} catch(e) {}

				try {
				value = decodeURIComponent(value);
				} catch(e) {}

				if (!(key in json)) {
					json[key] = /\[\]$/.test(key) ? [value] : value; //如果参数名以[]结尾，则当作数组
				}
				else if (json[key] instanceof Array) {
					json[key].push(value);
				}
				else {
					json[key] = [json[key], value];
				}
			});
			return key ? json[key] : json;
		},

		/**
		 * 为了和ObjectH的encodeURIJson配对，加上这个
		 */
		decodeURIJson: function(url){
			return StringH.queryUrl(url);
		}
	};

	QW.StringH = StringH;

}());

/**
 * @class ObjectH 核心对象Object的静态扩展
 * @singleton
 * @namespace QW
 * @helper
 */

(function() {
	var escapeChars = QW.StringH.escapeChars;

	function getConstructorName(o) {
		//加o.constructor是因为IE下的window和document
		if(o != null && o.constructor != null){
			return  Object.prototype.toString.call(o).slice(8, -1);
		}else{
			return '';
		}
	}
	//注意类型判断如果用.constructor比较相等和用instanceof都会有跨iframe的问题，因此尽量避免
	//用typeof和Object.prototype.toString不会有这些问题
	var ObjectH = {
		/**
		 * 判断一个变量是否是string值或String对象
		 * @method isString
		 * @static
		 * @param {any} obj 目标变量
		 * @returns {boolean}
		 */
		isString: function(obj) {
			return getConstructorName(obj) == 'String';
		},

		/**
		 * 判断一个变量是否是function对象
		 * @method isFunction
		 * @static
		 * @param {any} obj 目标变量
		 * @returns {boolean}
		 */
		isFunction: function(obj) {
			return getConstructorName(obj) == 'Function';
		},

		/**
		 * 判断一个变量是否是Array对象
		 * @method isArray
		 * @static
		 * @param {any} obj 目标变量
		 * @returns {boolean}
		 */
		isArray: function(obj) {
			return getConstructorName(obj) == 'Array';
		},

		/**
		 * 判断一个变量是否是Array泛型（Array或类Array类型），即:有length属性并且该属性是数值的对象
		 * @method isArrayLike
		 * @static
		 * @param {any} obj 目标变量
		 * @returns {boolean}
		 */
		isArrayLike: function(obj) {
			return !!obj && typeof obj == 'object' && obj.nodeType != 1 && typeof obj.length == 'number';
		},

		/**
		 * 判断一个变量是否是typeof 'object'
		 * @method isObject
		 * @static
		 * @param {any} obj 目标变量
		 * @returns {boolean}
		 */
		isObject: function(obj) {
			return obj !== null && typeof obj == 'object';
		},

		/**
		 * 判断一个变量的constructor是否是Object。---如果一个对象是由{}或new Object()产生的，那么isPlainObject返回true。
		 * @method isPlainObject
		 * @static
		 * @param {any} obj 目标变量
		 * @returns {boolean}
		 */
		isPlainObject: function(obj) {
			return getConstructorName(obj) == 'Object';
		},

		/**
		 * 判断一个变量是否是Wrap对象
		 * @method isWrap
		 * @static
		 * @param {any} obj 目标变量
		 * @param {string} coreName (Optional) core的属性名，默认为'core'
		 * @returns {boolean}
		 */
		isWrap: function(obj, coreName) {
			return !!(obj && obj[coreName || 'core']);
		},

		/**
		 * 判断一个变量是否是Html的Element元素
		 * @method isElement
		 * @static
		 * @param {any} obj 目标变量
		 * @returns {boolean}
		 */
		isElement: function(obj) {
			return !!obj && obj.nodeType == 1;
		},

		/**
		 * 为一个对象设置属性，支持以下三种调用方式:
		 set(obj, prop, value)
		 set(obj, propJson)
		 set(obj, props, values)
		 ---特别说明propName里带的点，会被当作属性的层次
		 * @method set
		 * @static
		 * @param {Object} obj 目标对象
		 * @param {string|Json|Array|setter} prop 如果是string,则当属性名(属性名可以是属性链字符串,如"style.display")；如果是function，则当setter函数；如果是Json，则当prop/value对；如果是数组，则当prop数组，第二个参数对应的也是value数组
		 * @param {any | Array} value 属性值
		 * @returns {Object} obj
		 * @example
		 var el={style:{},firstChild:{}};
		 set(el,"id","aaaa");
		 set(el,{className:"cn1",
		 "style.display":"block",
		 "style.width":"8px"
		 });
		 */
		set: function(obj, prop, value) {
			if (ObjectH.isArray(prop)) {
				//set(obj, props, values)
				for (var i = 0; i < prop.length; i++) {
					ObjectH.set(obj, prop[i], value[i]);
				}
			} else if (ObjectH.isPlainObject(prop)) {
				//set(obj, propJson)
				for (i in prop) {
					ObjectH.set(obj, i, prop[i]);
				}
			} else if (ObjectH.isFunction(prop)) { //getter
				var args = [].slice.call(arguments, 1);
				args[0] = obj;
				prop.apply(null, args);
			} else {
				//set(obj, prop, value);
				var keys = prop.split(".");
				i = 0;
				for (var obj2 = obj, len = keys.length - 1; i < len; i++) {
					obj2 = obj2[keys[i]];
				}
				obj2[keys[i]] = value;
			}
			return obj;
		},

		/**
		 * 得到一个对象的相关属性，支持以下三种调用方式:
		 get(obj, prop) -> obj[prop]
		 get(obj, props) -> propValues
		 get(obj, propJson) -> propJson
		 * @method get
		 * @static
		 * @param {Object} obj 目标对象
		 * @param {string|Array|getter} prop 如果是string,则当属性名(属性名可以是属性链字符串,如"style.display")；如果是function，则当getter函数；如果是array，则当获取的属性名序列；
		 如果是Array，则当props看待
		 * @param {boolean} nullSensitive 是否对属性链异常敏感。即，如果属性链中间为空，是否抛出异常
		 * @returns {any|Array} 返回属性值
		 * @example
		 get(obj,"style"); //返回obj["style"];
		 get(obj,"style.color"); //返回 obj.style.color;
		 get(obj,"styleee.color"); //返回 undefined;
		 get(obj,"styleee.color",true); //抛空指针异常，因为obj.styleee.color链条中的obj.styleee为空;
		 get(obj,["id","style.color"]); //返回 [obj.id, obj.style.color];
		 */
		get: function(obj, prop, nullSensitive) {
			if (ObjectH.isArray(prop)) { //get(obj, props)
				var ret = [],
					i;
				for (i = 0; i < prop.length; i++) {
					ret[i] = ObjectH.get(obj, prop[i], nullSensitive);
				}
			} else if (ObjectH.isFunction(prop)) { //getter
				var args = [].slice.call(arguments, 1);
				args[0] = obj;
				return prop.apply(null, args);
			} else { //get(obj, prop)
				var keys = prop.split(".");
				ret = obj;
				for (i = 0; i < keys.length; i++) {
					if (!nullSensitive && ret == null) {return; }
					ret = ret[keys[i]];
				}
			}
			return ret;
		},

		/**
		 * 将源对象的属性并入到目标对象
		 * @method mix
		 * @static
		 * @param {Object} des 目标对象
		 * @param {Object|Array} src 源对象，如果是数组，则依次并入
		 * @param {boolean} override (Optional) 是否覆盖已有属性。如果为function则初为混合器，为src的每一个key执行 des[key] = override(des[key], src[key], key);
		 * @returns {Object} des
		 */
		mix: function(des, src, override) {
			if (ObjectH.isArray(src)) {
				for (var i = 0, len = src.length; i < len; i++) {
					ObjectH.mix(des, src[i], override);
				}
				return des;
			}
			if (typeof override == 'function') {
				for (i in src) {
					des[i] = override(des[i], src[i], i);
				}
			}
			else {
			for (i in src) {
				//这里要加一个des[i]，是因为要照顾一些不可枚举的属性
				if (override || !(des[i] || (i in des))) {
					des[i] = src[i];
				}
			}
			}
			return des;
		},

		/**
		 * <p>输出一个对象里面的内容</p>
		 * <p><strong>如果属性被"."分隔，会取出深层次的属性</strong>，例如:</p>
		 * <p>ObjectH.dump(o, "aa"); //得到 {"aa": o.aa}</p>
		 * @method dump
		 * @static
		 * @param {Object} obj 被操作的对象
		 * @param {Array} props 包含要被复制的属性名称的数组
		 * @return {Object} 包含被dump出的属性的对象
		 */
		dump: function(obj, props) {
			var ret = {};
			for (var i = 0, len = props.length; i < len; i++) {
				if (i in props) {
					var key = props[i];
					if(key in obj)
						ret[key] = obj[key];
				}
			}
			return ret;
		},

		/**
		 * 在对象中的每个属性项上运行一个函数，并将函数返回值作为属性的值。
		 * @method map
		 * @static
		 * @param {Object} obj 被操作的对象
		 * @param {function} fn 迭代计算每个属性的算子，该算子迭代中有三个参数value-属性值，key-属性名，obj，当前对象
		 * @param {Object} thisObj (Optional)迭代计算时的this
		 * @return {Object} 返回包含这个对象中所有属性计算结果的对象
		 */
		map: function(obj, fn, thisObj) {
			var ret = {};
			for (var key in obj) {
				ret[key] = fn.call(thisObj, obj[key], key, obj);
			}
			return ret;
		},

		/**
		 * 得到一个对象中所有可以被枚举出的属性的列表
		 * @method keys
		 * @static
		 * @param {Object} obj 被操作的对象
		 * @return {Array} 返回包含这个对象中所有属性的数组
		 */
		keys: function(obj) {
			var ret = [];
			for (var key in obj) {
				if (obj.hasOwnProperty(key)) {
					ret.push(key);
				}
			}
			return ret;
		},

		/**
		 * 得到一个对象中所有可以被枚举出的属性值的列表
		 * @method values
		 * @static
		 * @param {Object} obj 被操作的对象
		 * @return {Array} 返回包含这个对象中所有属性值的数组
		 */
		values: function(obj) {
			var ret = [];
			for (var key in obj) {
				if (obj.hasOwnProperty(key)) {
					ret.push(obj[key]);
				}
			}
			return ret;
		},

		/**
		 * 以某对象为原型创建一个新的对象 （by Ben Newman）
		 * @method create
		 * @static
		 * @param {Object} proto 作为原型的对象
		 * @param {Object} props (Optional) 附加属性
		 */
		create: function(proto, props) {
			var ctor = function(ps) {
				if (ps) {
					ObjectH.mix(this, ps, true);
				}
			};
			ctor.prototype = proto;
			return new ctor(props);
		},

		/**
		 * 序列化一个对象(只序列化String,Number,Boolean,Date,Array,Json对象和有toJSON方法的对象,其它的对象都会被序列化成null)
		 * @method stringify
		 * @static
		 * @param {Object} obj 需要序列化的Json、Array对象或其它对象
		 * @returns {String} : 返回序列化结果
		 * @example
		 var card={cardNo:"bbbb1234",history:[{date:"2008-09-16",count:120.0,isOut:true},1]};
		 alert(stringify(card));
		 */
		stringify: function(obj) {
			if (obj == null) {return 'null'; }
			if (typeof obj !='string' && obj.toJSON) {//JK: IE8的字符串的toJSON有问题，丢了引号
				return obj.toJSON();
			}
			var type = getConstructorName(obj).toLowerCase();
			switch (type) {
				case 'string':
					return '"' + escapeChars(obj) + '"';
				case 'number':
					var ret = obj.toString();
					return /N/.test(ret) ? 'null' : ret;
				case 'boolean':
					return obj.toString();
				case 'date' :
					return 'new Date(' + obj.getTime() + ')';
				case 'array' :
					var ar = [];
					for (var i = 0; i < obj.length; i++) {ar[i] = ObjectH.stringify(obj[i]); }
					return '[' + ar.join(',') + ']';
				case 'object':
					if (ObjectH.isPlainObject(obj)) {
						ar = [];
						for (i in obj) {
							ar.push('"' + escapeChars(i) + '":' + ObjectH.stringify(obj[i]));
						}
						return '{' + ar.join(',') + '}';
					}
			}
			return 'null'; //无法序列化的，返回null;
		},

		/**
		 * encodeURI一个Json对象
		 * @method encodeURIJson
		 * @static
		 * @param {Json} json  Json数据，只有一层json，每一键对应的值可以是字符串或字符串数组
		 * @returns {string} : 返回被encodeURI结果。
		 */
		encodeURIJson: function(json){
			var s = [];
			for( var p in json ){
				if(json[p]==null) continue;
				if(json[p] instanceof Array)
				{
					for (var i=0;i<json[p].length;i++) s.push( encodeURIComponent(p) + '=' + encodeURIComponent(json[p][i]));
				}
				else
					s.push( encodeURIComponent(p) + '=' + encodeURIComponent(json[p]));
			}
			return s.join('&');
		}

	};

	QW.ObjectH = ObjectH;
}());

/**
 * @class ArrayH 核心对象Array的扩展
 * @singleton
 * @namespace QW
 * @helper
 */
(function() {
	var isArray = QW.ObjectH.isArray;

	var ArrayH = {
		/**
		 * 在数组中的每个项上运行一个函数，并将全部结果作为数组返回。
		 * @method map
		 * @static
		 * @param {Array} arr 待处理的数组.
		 * @param {Function} callback 需要执行的函数.
		 * @param {Object} pThis (Optional) 指定callback的this对象.
		 * @return {Array} 返回满足过滤条件的元素组成的新数组
		 * @example
		 var arr=["aa","ab","bc"];
		 var arr2=map(arr,function(a,b){return a.substr(0,1)=="a"});
		 alert(arr2);
		 */
		map: function(arr, callback, pThis) {
			var len = arr.length;
			var rlt = new Array(len);
			for (var i = 0; i < len; i++) {
				if (i in arr) {
					rlt[i] = callback.call(pThis, arr[i], i, arr);
				}
			}
			return rlt;
		},

		/**
		 * 对Array的每一个元素运行一个函数。
		 * @method forEach
		 * @static
		 * @param {Array} arr 待处理的数组.
		 * @param {Function} callback 需要执行的函数.
		 * @param {Object} pThis (Optional) 指定callback的this对象.
		 * @return {void}
		 * @example
		 var arr=["a","b","c"];
		 var dblArr=[];
		 forEach(arr,function(a,b){dblArr.push(b+":"+a+a);});
		 alert(dblArr);
		 */
		forEach: function(arr, callback, pThis) {
			for (var i = 0, len = arr.length; i < len; i++) {
				if (i in arr) {
					callback.call(pThis, arr[i], i, arr);
				}
			}
		},

		/**
		 * 在数组中的每个项上运行一个函数，并将函数返回真值的项作为数组返回。
		 * @method filter
		 * @static
		 * @param {Array} arr 待处理的数组.
		 * @param {Function} callback 需要执行的函数.
		 * @param {Object} pThis (Optional) 指定callback的this对象.
		 * @return {Array} 返回满足过滤条件的元素组成的新数组
		 * @example
		 var arr=["aa","ab","bc"];
		 var arr2=filter(arr,function(a,b){return a.substr(0,1)=="a"});
		 alert(arr2);
		 */
		filter: function(arr, callback, pThis) {
			var rlt = [];
			for (var i = 0, len = arr.length; i < len; i++) {
				if ((i in arr) && callback.call(pThis, arr[i], i, arr)) {
					rlt.push(arr[i]);
				}
			}
			return rlt;
		},

		/**
		 * 判断数组中是否有元素满足条件。
		 * @method some
		 * @static
		 * @param {Array} arr 待处理的数组.
		 * @param {Function} callback 需要执行的函数.
		 * @param {Object} pThis (Optional) 指定callback的this对象.
		 * @return {boolean} 如果存在元素满足条件，则返回true.
		 * @example
		 var arr=["aa","ab","bc"];
		 var arr2=filter(arr,function(a,b){return a.substr(0,1)=="a"});
		 alert(arr2);
		 */
		some: function(arr, callback, pThis) {
			for (var i = 0, len = arr.length; i < len; i++) {
				if (i in arr && callback.call(pThis, arr[i], i, arr)) {
					return true;
				}
			}
			return false;
		},

		/**
		 * 判断数组中所有元素都满足条件。
		 * @method every
		 * @static
		 * @param {Array} arr 待处理的数组.
		 * @param {Function} callback 需要执行的函数.
		 * @param {Object} pThis (Optional) 指定callback的this对象.
		 * @return {boolean} 所有元素满足条件，则返回true.
		 * @example
		 var arr=["aa","ab","bc"];
		 var arr2=filter(arr,function(a,b){return a.substr(0,1)=="a"});
		 alert(arr2);
		 */
		every: function(arr, callback, pThis) {
			for (var i = 0, len = arr.length; i < len; i++) {
				if (i in arr && !callback.call(pThis, arr[i], i, arr)) {
					return false;
				}
			}
			return true;
		},

		/**
		 * 返回一个元素在数组中的位置（从前往后找）。如果数组里没有该元素，则返回-1
		 * @method indexOf
		 * @static
		 * @param {Array} arr 待处理的数组.
		 * @param {Object} obj 元素，可以是任何类型
		 * @param {int} fromIdx (Optional) 从哪个位置开始找起，如果为负，则表示从length+startIdx开始找
		 * @return {int} 则返回该元素在数组中的位置.
		 * @example
		 var arr=["a","b","c"];
		 alert(indexOf(arr,"c"));
		 */
		indexOf: function(arr, obj, fromIdx) {
			var len = arr.length;
			fromIdx |= 0; //取整
			if (fromIdx < 0) {
				fromIdx += len;
			}
			if (fromIdx < 0) {
				fromIdx = 0;
			}
			for (; fromIdx < len; fromIdx++) {
				if (fromIdx in arr && arr[fromIdx] === obj) {
					return fromIdx;
				}
			}
			return -1;
		},

		/**
		 * 返回一个元素在数组中的位置（从后往前找）。如果数组里没有该元素，则返回-1
		 * @method lastIndexOf
		 * @static
		 * @param {Array} arr 待处理的数组.
		 * @param {Object} obj 元素，可以是任何类型
		 * @param {int} fromIdx (Optional) 从哪个位置开始找起，如果为负，则表示从length+startIdx开始找
		 * @return {int} 则返回该元素在数组中的位置.
		 * @example
		 var arr=["a","b","a"];
		 alert(lastIndexOf(arr,"a"));
		 */
		lastIndexOf: function(arr, obj, fromIdx) {
			var len = arr.length;
			fromIdx |= 0; //取整
			if (!fromIdx || fromIdx >= len) {
				fromIdx = len - 1;
			}
			if (fromIdx < 0) {
				fromIdx += len;
			}
			for (; fromIdx > -1; fromIdx--) {
				if (fromIdx in arr && arr[fromIdx] === obj) {
					return fromIdx;
				}
			}
			return -1;
		},

		/**
		 * 判断数组是否包含某元素
		 * @method contains
		 * @static
		 * @param {Array} arr 待处理的数组.
		 * @param {Object} obj 元素，可以是任何类型
		 * @return {boolean} 如果元素存在于数组，则返回true，否则返回false
		 * @example
		 var arr=["a","b","c"];
		 alert(contains(arr,"c"));
		 */
		contains: function(arr, obj) {
			return (ArrayH.indexOf(arr, obj) >= 0);
		},

		/**
		 * 清空一个数组
		 * @method clear
		 * @static
		 * @param {Array} arr 待处理的数组.
		 * @return {void}
		 */
		clear: function(arr) {
			arr.length = 0;
		},

		/**
		 * 将数组里的某(些)元素移除。
		 * @method remove
		 * @static
		 * @param {Array} arr 待处理的数组.
		 * @param {Object} obj0 待移除元素
		 * @param {Object} obj1 … 待移除元素
		 * @return {number} 返回第一次被移除的位置。如果没有任何元素被移除，则返回-1.
		 * @example
		 var arr=["a","b","c"];
		 remove(arr,"a","c");
		 alert(arr);
		 */
		remove: function(arr, obj) {
			var idx = -1;
			for (var i = 1; i < arguments.length; i++) {
				var oI = arguments[i];
				for (var j = 0; j < arr.length; j++) {
					if (oI === arr[j]) {
						if (idx < 0) {
							idx = j;
						}
						arr.splice(j--, 1);
					}
				}
			}
			return idx;
		},

		/**
		 * 数组元素除重，得到新数据
		 * @method unique
		 * @static
		 * @param {Array} arr 待处理的数组.
		 * @return {void} 数组元素除重，得到新数据
		 * @example
		 var arr=["a","b","a"];
		 alert(unique(arr));
		 */
		unique: function(arr) {
			var rlt = [],
				oI = null,
				indexOf = Array.indexOf || ArrayH.indexOf;
			for (var i = 0, len = arr.length; i < len; i++) {
				if (indexOf(rlt, oI = arr[i]) < 0) {
					rlt.push(oI);
				}
			}
			return rlt;
		},

		/**
		 * 为数组元素进行递推操作。
		 * @method reduce
		 * @static
		 * @param {Array} arr 待处理的数组.
		 * @param {Function} callback 需要执行的函数。
		 * @param {any} initial (Optional) 初始值，如果没有这初始，则从第一个有效元素开始。没有初始值，并且没有有效元素，会抛异常
		 * @return {any} 返回递推结果.
		 * @example
		 var arr=[1,2,3];
		 alert(reduce(arr,function(a,b){return Math.max(a,b);}));
		 */
		reduce: function(arr, callback, initial) {
			var len = arr.length;
			var i = 0;
			if (arguments.length < 3) { //找到第一个有效元素当作初始值
				var hasV = 0;
				for (; i < len; i++) {
					if (i in arr) {
						initial = arr[i++];
						hasV = 1;
						break;
					}
				}
				if (!hasV) {throw new Error("No component to reduce"); }
			}
			for (; i < len; i++) {
				if (i in arr) {
					initial = callback(initial, arr[i], i, arr);
				}
			}
			return initial;
		},

		/**
		 * 为数组元素进行逆向递推操作。
		 * @method reduceRight
		 * @static
		 * @param {Array} arr 待处理的数组.
		 * @param {Function} callback 需要执行的函数。
		 * @param {any} initial (Optional) 初始值，如果没有这初始，则从第一个有效元素开始。没有初始值，并且没有有效元素，会抛异常
		 * @return {any} 返回递推结果.
		 * @example
		 var arr=[1,2,3];
		 alert(reduceRight(arr,function(a,b){return Math.max(a,b);}));
		 */
		reduceRight: function(arr, callback, initial) {
			var len = arr.length;
			var i = len - 1;
			if (arguments.length < 3) { //逆向找到第一个有效元素当作初始值
				var hasV = 0;
				for (; i > -1; i--) {
					if (i in arr) {
						initial = arr[i--];
						hasV = 1;
						break;
					}
				}
				if (!hasV) {
					throw new Error("No component to reduceRight");
				}
			}
			for (; i > -1; i--) {
				if (i in arr) {
					initial = callback(initial, arr[i], i, arr);
				}
			}
			return initial;
		},

		/**
		 * 将一个数组扁平化
		 * @method expand
		 * @static
		 * @param arr {Array} 要扁平化的数组
		 * @return {Array} 扁平化后的数组
		 */
		expand: function(arr, shallow) {
			var ret = [],
				i = 0,
				len = arr.length;
			for (; i<len; i++) {
				if (isArray(arr[i])) {
					ret = ret.concat(shallow ? arr[i] : ArrayH.expand(arr[i]));
				}
				else {
					ret.push(arr[i]);
				}
			}
			return ret;
		},

		/**
		 * 将一个泛Array转化成一个Array对象。
		 * @method toArray
		 * @static
		 * @param {Array} arr 待处理的Array的泛型对象.
		 * @return {Array}
		 */
		toArray: function(arr) {
			var ret = [];
			for (var i = 0; i < arr.length; i++) {
				ret[i] = arr[i];
			}
			return ret;
		},


		/**
		 * 对数组进行包装。
		 * @method wrap
		 * @static
		 * @param {Array} arr 待处理的数组.
		 * @param {Class} constructor 构造器
		 * @returns {Object}: 返回new constructor(arr)
		 */
		wrap: function(arr, constructor) {
			return new constructor(arr);
		}
	};

	QW.ArrayH = ArrayH;

}());

/**
 * @class HashsetH HashsetH是对不含有重复元素的数组进行操作的Helper
 * @singleton
 * @namespace QW
 * @helper
 */

(function() {
	var contains = QW.ArrayH.contains;

	var HashsetH = {
		/**
		 * 合并两个已经uniquelize过的数组，相当于两个数组concat起来，再uniquelize，不过效率更高
		 * @method union
		 * @static
		 * @param {Array} arr 待处理的数组.
		 * @param {Array} arr2 待处理的数组.
		 * @return {Array} 返回一个新数组
		 * @example
		 var arr=["a","b"];
		 var arr2=["b","c"];
		 alert(union(arr,arr2));
		 */
		union: function(arr, arr2) {
			var ra = [];
			for (var i = 0, len = arr2.length; i < len; i++) {
				if (!contains(arr, arr2[i])) {
					ra.push(arr2[i]);
				}
			}
			return arr.concat(ra);
		},
		/**
		 * 求两个已经uniquelize过的数组的交集
		 * @method intersect
		 * @static
		 * @param {Array} arr 待处理的数组.
		 * @param {Array} arr2 待处理的数组.
		 * @return {Array} 返回一个新数组
		 * @example
		 var arr=["a","b"];
		 var arr2=["b","c"];
		 alert(intersect(arr,arr2));
		 */
		intersect: function(arr, arr2) {
			var ra = [];
			for (var i = 0, len = arr2.length; i < len; i++) {
				if (contains(arr, arr2[i])) {
					ra.push(arr2[i]);
				}
			}
			return ra;
		},
		/**
		 * 求两个已经uniquelize过的数组的差集
		 * @method minus
		 * @static
		 * @param {Array} arr 待处理的数组.
		 * @param {Array} arr2 待处理的数组.
		 * @return {Array} 返回一个新数组
		 * @example
		 var arr=["a","b"];
		 var arr2=["b","c"];
		 alert(minus(arr,arr2));
		 */
		minus: function(arr, arr2) {
			var ra = [];
			for (var i = 0, len = arr.length; i < len; i++) {
				if (!contains(arr, arr2[i])) {
					ra.push(arr[i]);
				}
			}
			return ra;
		},
		/**
		 * 求两个已经uniquelize过的数组的补集
		 * @method complement
		 * @static
		 * @param {Array} arr 待处理的数组.
		 * @param {Array} arr2 待处理的数组.
		 * @return {Array} 返回一个新数组
		 * @example
		 var arr=["a","b"];
		 var arr2=["b","c"];
		 alert(complement(arr,arr2));
		 */
		complement: function(arr, arr2) {
			return HashsetH.minus(arr, arr2).concat(HashsetH.minus(arr2, arr));
		}
	};

	QW.HashsetH = HashsetH;

}());

/**
 * @class DateH 核心对象Date的扩展
 * @singleton
 * @namespace QW
 * @helper
 */

(function() {

	var DateH = {
		/**
		 * 格式化日期
		 * @method format
		 * @static
		 * @param {Date} d 日期对象
		 * @param {string} pattern 日期格式(y年M月d天h时m分s秒)，默认为"yyyy-MM-dd"
		 * @return {string}  返回format后的字符串
		 * @example
		 var d=new Date();
		 alert(format(d," yyyy年M月d日\n yyyy-MM-dd\n MM-dd-yy\n yyyy-MM-dd hh:mm:ss"));
		 */
		format: function(d, pattern) {
			pattern = pattern || 'yyyy-MM-dd';
			var y = d.getFullYear().toString(),
				o = {
					M: d.getMonth() + 1, //month
					d: d.getDate(), //day
					h: d.getHours(), //hour
					m: d.getMinutes(), //minute
					s: d.getSeconds() //second
				};
			pattern = pattern.replace(/(y+)/ig, function(a, b) {
				return y.substr(4 - Math.min(4, b.length));
			});
			for (var i in o) {
				pattern = pattern.replace(new RegExp('(' + i + '+)', 'g'), function(a, b) {
					return (o[i] < 10 && b.length > 1) ? '0' + o[i] : o[i];
				});
			}
			return pattern;
		}
	};

	QW.DateH = DateH;

}());

/**
 * @class FunctionH 核心对象Function的扩展
 * @singleton
 * @namespace QW
 * @helper
 */
(function() {

	var FunctionH = {
		/**
		 * 函数包装器 methodize，对函数进行methodize化，使其的第一个参数为this，或this[attr]。
		 * @method methodize
		 * @static
		 * @param {function} func要方法化的函数
		 * @param {string} attr (Optional) 属性
		 * @return {function} 已方法化的函数
		 */
		methodize: function(func, attr) {
			if (attr) {
				return function() {
					return func.apply(null, [this[attr]].concat([].slice.call(arguments)));
				};
			}
			return function() {
				return func.apply(null, [this].concat([].slice.call(arguments)));
			};
		},
		/** 对函数进行集化，使其第一个参数可以是数组
		 * @method mul
		 * @static
		 * @param {function} func
		 * @param {bite} opt 操作配置项，缺省 0 表示默认，
		 1 表示getFirst  将只操作第一个元素，
		 2 表示joinLists 如果第一个参数是数组，将操作的结果扁平化返回
		 3 表示getFirstDefined 将操作到返回一个非undefined的结果为止
		 hint: getFirstDefined 配合wrap的 keepReturnValue 可以实现gsetter
			   还可以考虑通过增加getAllValued功能来实现gsetter_all，暂时没有需求，所以不予实现
		 * @return {Object} 已集化的函数
		 */
		mul: function(func, opt) {
			var getFirst = opt == 1,
				joinLists = opt == 2,
				getFirstDefined = opt == 3;

			if (getFirst) {
				return function() {
					var list = arguments[0];
					if (!(list instanceof Array)) {
						return func.apply(this, arguments);
					}
					if (list.length) {
						var args = [].slice.call(arguments);
						args[0] = list[0];
						return func.apply(this, args);
					}
				};
			}

			return function() {
				var list = arguments[0];
				if (list instanceof Array) {
					var moreArgs = [].slice.call(arguments),
						ret = [],
						i = 0,
						len = list.length,
						r;
					for (; i < len; i++) {
						moreArgs[0] = list[i];
						r = func.apply(this, moreArgs);
						if (joinLists) {
							if (r != null) {
								ret = ret.concat(r);
							}
						}
						else if(getFirstDefined) {
							if (r !== undefined){
								return r;
							}
						}
						else {
							ret.push(r);
						}
					}
					return getFirstDefined?undefined:ret;
				} else {
					return func.apply(this, arguments);
				}
			};
		},
		/**
		 * 函数包装变换
		 * @method rwrap
		 * @static
		 * @param {func}
		 * @param {Wrap} wrapper 包装对象
		 * @param {number|string} opt 包装选项 0~n 表示包装arguments，this|context 表示包装this，缺省表示包装ret
		 * @param {boolean} keepReturnValue 可选的，true表示尊重returnValue，只有returnValue === undefined时才包装
		 * @return {Function}
		 */
		rwrap: function(func, wrapper, opt, keepReturnValue) {
			if(opt == null) opt = 0;
			return function() {
				var ret = func.apply(this, arguments);
				if(keepReturnValue && ret !== undefined) return ret;
				if (opt >= 0) {
					ret = arguments[opt];
				} else if(opt == "this" || opt == "context"){
					ret = this;
				}
				return wrapper ? new wrapper(ret) : ret;
			};
		},
		/**
		 * 针对Function做拦截器
		 * @method hook
		 * @static
		 * @param {Function} 要拦截的函数
		 * @param {String} where，before和after
		 * @param {Function} 拦截器： function(args|returnValue , callee , where)
		 */
		hook: function(func, where, handler){
			//如果是before拦截器
			if(where == "before"){
				return function(){
					var args = [].slice.call(arguments);
					if(false !== handler.call(this, args, func, where)){
						//如果return false，阻止后续的执行，否则执行
						return func.apply(this, args);
					}
				}
			}else if(where == "after"){
				return function(){
					var args = [].slice.call(arguments);
					var ret = func.apply(this, args);
					//返回after的返回值
					return handler.call(this, ret, func, where);
				}
			}else{
				throw new Error("unknow hooker:" + where);
			}
		},
		/**
		 * 绑定
		 * @method bind
		 * @via https://developer.mozilla.org/en/JavaScript/Reference/Global_Objects/Function/bind
		 * @compatibile ECMA-262, 5th (JavaScript 1.8.5)
		 * @static
		 * @param {func} 要绑定的函数
		 * @obj {object} this_obj
		 * @param {any} arg1 (Optional) 预先确定的参数
		 * @param {any} arg2 (Optional) 预先确定的参数
		 * @return {Function}
		 */
		bind: function(func, obj) {
			var slice = [].slice,
				args = slice.call(arguments, 2),
				nop = function() {},
				bound = function() {
					return func.apply(this instanceof nop ? this : (obj || {}), args.concat(slice.call(arguments)));
				};

			nop.prototype = func.prototype;

			bound.prototype = new nop();

			return bound;
		},
		/**
		 * 懒惰执行某函数：一直到不得不执行的时候才执行。
		 * @method lazyApply
		 * @static
		 * @param {Function} fun  调用函数
		 * @param {Object} thisObj  相当于apply方法的thisObj参数
		 * @param {Array} argArray  相当于apply方法的argArray参数
		 * @param {int} ims  interval毫秒数，即window.setInterval的第二个参数.
		 * @param {Function} checker  定期运行的判断函数。<br/>
			对于不同的返回值，得到不同的结果：<br/>
				返回true或1，表示需要立即执行<br/>
				返回-1，表示成功偷懒，不用再执行<br/>
				返回其它值，表示暂时不执行<br/>
		 * @return {int}  返回interval的timerId
		 */
		lazyApply: function(fun, thisObj, argArray, ims, checker) {
			checker = checker || function() {return true; };
			var timer = function() {
					var verdict = checker();
					if (verdict == 1) {
						fun.apply(thisObj, argArray || []);
					}
					if (verdict == 1 || verdict == -1) {
						clearInterval(timerId);
					}
				},
				timerId = setInterval(timer, ims);
			return timerId;
		}
	};


	QW.FunctionH = FunctionH;

}());

/**
 * @class ClassH 为function提供强化的原型继承能力
 * @singleton
 * @namespace QW
 * @helper
 */
(function() {
	var mix = QW.ObjectH.mix,
		create = QW.ObjectH.create;

	var ClassH = {
		/**
		 * <p>为类型动态创建一个实例，它和直接new的区别在于instanceof的值</p>
		 * <p><strong>第二范式：new T <=> T.apply(T.getPrototypeObject())</strong></p>
		 * @method createInstance
		 * @static
		 * @prarm {function} cls 要构造对象的类型（构造器）
		 * @return {object} 这个类型的一个实例
		 */
		createInstance: function(cls) {
			var p = create(cls.prototype);
			cls.apply(p, [].slice.call(arguments, 1));
			return p;
		},

		/**
		 * 函数包装器 extend
		 * <p>改进的对象原型继承，延迟执行参数构造，并在子类的实例中添加了$super引用</p>
		 * @method extend
		 * @static
		 * @param {function} cls 产生子类的原始类型
		 * @param {function} p 父类型
		 * @return {function} 返回以自身为构造器继承了p的类型
		 * @throw {Error} 不能对继承返回的类型再使用extend
		 */
		extend: function(cls, p /*,p1,p2... 多继承父类型*/) {

			function comboParents(parents){
				var T = function(){};
				T.prototype = parents[0].prototype;

				for(var i = 1; i < parents.length; i++){
					var P = parents[i];
					mix(T.prototype, P.prototype);
				}
				return new T();
			}

			var cp = cls.prototype;

			cls.prototype = comboParents([].slice.call(arguments, 1));

			//$super指向第一个父类，在构造器内可以通过arguments.callee.$super执行父类构造
			//多继承时，instance和$super只对第一个父类有效
			cls.$super = p;

			//如果原始类型的prototype上有方法，先copy
			mix(cls.prototype, cp, true);

			return cls;
		}
	};

	QW.ClassH = ClassH;

}());

/**
 * Helper管理器，核心模块中用来管理Helper的子模块
 * @module core
 * @beta
 * @submodule core_HelperH
 */

/**
 * @class HelperH
 * <p>一个Helper是指同时满足如下条件的一个对象：</p>
 * <ol><li>Helper是一个不带有可枚举proto属性的简单对象（这意味着你可以用for...in...枚举一个Helper中的所有属性和方法）</li>
 * <li>Helper可以拥有属性和方法，但Helper对方法的定义必须满足如下条件：</li>
 * <div> 1). Helper的方法必须是静态方法，即内部不能使用this。</div>
 * <div> 2). 同一个Helper中的方法的第一个参数必须是相同类型或相同泛型。</div>
 * <li> Helper类型的名字必须以Helper或大写字母H结尾。 </li>
 * <li> 对于只满足第一条的JSON，也算是泛Helper，通常以“U”（util）结尾。 </li>
 * <li> 本来Util和Helper应该是继承关系，但是JavaScript里我们把继承关系简化了。</li>
 * </ol>
 * @singleton
 * @namespace QW
 * @helper
 */

(function() {

	var FunctionH = QW.FunctionH,
		create = QW.ObjectH.create,
		isPlainObject = QW.ObjectH.isPlainObject,
		Methodized = function() {};

	var HelperH = {
		/**
		 * 对于需要返回wrap对象的helper方法，进行结果包装
		 * @method rwrap
		 * @static
		 * @param {Helper} helper Helper对象
		 * @param {Class} wrapper 将返回值进行包装时的包装器(WrapClass)
		 * @param {Object} wrapConfig 需要返回Wrap对象的方法的配置
		 * @return {Object} 方法已rwrap化的<strong>新的</strong>Helper
		 */
		rwrap: function(helper, wrapper, wrapConfig) {
			//create以helper为原型生成了一个新的对象，相当于复制了helper的所有属性，不过新对象属性方法的改变不会对helper产生影响
			var ret = create(helper);
			wrapConfig = wrapConfig || 'operator';

			for (var i in helper) {
				var wrapType = wrapConfig,
					fn = helper[i];
				if(fn instanceof Function){
					if (typeof wrapType != 'string') {
						wrapType = wrapConfig[i] || '';
					}
					if ('queryer' == wrapType) { //如果方法返回查询结果，对返回值进行包装
						ret[i] = FunctionH.rwrap(fn, wrapper, "returnValue");
					} else if ('operator' == wrapType) { //如果方法只是执行一个操作
						if (helper instanceof Methodized) { //如果是methodized后的,对this直接返回
							ret[i] = FunctionH.rwrap(fn, wrapper, "this");
						} else {
							ret[i] = FunctionH.rwrap(fn, wrapper, 0); //否则对第一个参数进行包装，针对getter系列
						}
					} else if('gsetter' == wrapType){
						if (helper instanceof Methodized){
							ret[i] = FunctionH.rwrap(fn, wrapper, "this", true);
						}else{
							ret[i] = FunctionH.rwrap(fn, wrapper, 0, true);
						}
					}
				}
			}
			return ret;
		},
		/**
		 * 根据配置，产生gsetter新方法，它根椐参数的长短来决定调用getter还是setter
		 * @method gsetter
		 * @static
		 * @param {Helper} helper Helper对象
		 * @param {Object} gsetterConfig 需要返回Wrap对象的方法的配置
		 * @return {Object} 方法已gsetter化的<strong>新的</strong>helper
		 */
		gsetter: function(helper, gsetterConfig) {
			//create以helper为原型生成了一个新的对象，相当于复制了helper的所有属性，不过新对象属性方法的改变不会对helper产生影响
			var ret = create(helper);
			gsetterConfig = gsetterConfig || {};

			for (var i in gsetterConfig) {
				ret[i] = (function(config, extra) {
					return function() {
						var offset = arguments.length;

						//如果没有methodize过，那么多出来的第一个参数要扣减回去
						offset -= extra;
						if (isPlainObject(arguments[extra])) {
							offset++; //如果第一个参数是json，则当作setter，所以offset+1
						}
						return ret[config[Math.min(offset, config.length - 1)]].apply(this, arguments);
					};
				}(gsetterConfig[i], helper instanceof Methodized ? 0 : 1 ));
			}
			return ret;
		},

		/**
		 * 对helper的方法，进行mul化，使其可以处理第一个参数是数组的情况
		 * @method mul
		 * @static
		 * @param {Helper} helper Helper对象
		 * @param {json|string} mulConfig 如果某个方法的mulConfig类型和含义如下：
		 getter 或getter_first_all //同时生成get--(返回fist)、getAll--(返回all)
		 getter_first	//生成get--(返回first)
		 getter_all		//生成get--(返回all)
		 queryer		//生成get--(返回concat all结果)
		 gsetter 		//生成gsetter--(如果是getter返回first，如果是setter，作为operator)
		 * @return {Object} 方法已mul化的<strong>新的</strong>Helper
		 */
		mul: function(helper, mulConfig) {
			//create以helper为原型生成了一个新的对象，相当于复制了helper的所有属性，不过新对象属性方法的改变不会对helper产生影响
			var ret = create(helper);
			mulConfig = mulConfig || {};


			var getAll = 0,
				getFirst = 1,
				joinLists = 2,
				getFirstDefined = 3;

			for (var i in helper) {
				var fn = helper[i];
				if (fn instanceof Function) {
					var mulType = mulConfig;
					if (typeof mulType != 'string') {
						mulType = mulConfig[i] || '';
					}

					if ("getter" == mulType || "getter_first" == mulType || "getter_first_all" == mulType) {
						//如果是配置成gettter||getter_first||getter_first_all，那么需要用第一个参数
						ret[i] = FunctionH.mul(fn, getFirst);
					} else if ("getter_all" == mulType) {
						ret[i] = FunctionH.mul(fn, getAll);
					} else if ("gsetter" == mulType) {
						ret[i] = FunctionH.mul(fn, getFirstDefined);
					} else {
						//queryer的话需要join返回值，把返回值join起来的说
						//例如W(els).query('div') 每一个el返回一个array，如果不join的话就会变成 [array1, array2, array3...]
						ret[i] = FunctionH.mul(fn, joinLists);
					}
					//... operator分支这里不出现，因为operator的返回值被rwrap果断抛弃了。。

					if ("getter" == mulType || "getter_first_all" == mulType) {
						//如果配置成getter||getter_first_all，那么还会生成一个带All后缀的方法
						ret[i + "All"] = FunctionH.mul(fn, getAll);
					}
				}
			}
			return ret;
		},
		/**
		 * 对helper的方法，进行methodize化，使其的第一个参数为this，或this[attr]。
		 * @method methodize
		 * @static
		 * @param {Helper} helper Helper对象，如DateH
		 * @param {optional} attr (Optional)属性
		 * @param {boolean} preserveEveryProps (Optional) 是否保留Helper上的属性（非Function的成员），默认不保留
		 * @return {Object} 方法已methodize化的对象
		 */
		methodize: function(helper, attr, preserveEveryProps) {
			var ret = new Methodized(); //因为 methodize 之后gsetter和rwrap的行为不一样

			for (var i in helper) {
				var fn = helper[i];

				if (fn instanceof Function) {
					ret[i] = FunctionH.methodize(fn, attr);
				}else if(preserveEveryProps){
					//methodize默认不保留非Function类型的成员
					//如特殊情况需保留，可将preserveEveryProps设为true
					ret[i] = fn;
				}
			}
			return ret;
		}
	};

	QW.HelperH = HelperH;
}());

/**
 * @class JSON 对JSON序列化与反序列化方法的封装。
 * @singleton
 * @remarks
 * <a href='$baseurl$/core/_tests/json.test.html' target="_blank">单元测试</a>
 */

(function() {
	QW.JSON = {
		/**
		 * 将JSON字符串解析成对象或者数组。
		 * @static
		 * @method parse
		 * @param {String} text 有效的 JSON 文本
		 * @return {any} 返回值对象或数组
		 * @throw {SyntaxError} 如果text参数不是有效的JSON字符串则会抛异常。（注：本实现中，判断是否有效有意放宽了。例如：字符串可以用'括起来，json的key可以不带引号）
		 */
		parse: function(text) {
			/*检查JSON字符串的有效性*/
			if (/^[[\],:{}\s0]*$/.test(text.replace(/\\\\|\\"|\\'|\w+\s*\:|null|true|false|[+\-eE.]|new Date(\d*)/g, '0').replace(/"[^"]*"|'[^']*'|\d+/g, '0'))) {
				return new Function('return (' + text+');')();
			}
			/*无效的JSON格式*/
			throw 'Invalid JSON format in executing JSON.parse';
		},

		/**
		 * 将值对象或者数组进行字符串。
		 * @static
		 * @method stringify
		 * @param {any} value 需要进行字符串化的对象或者数组
		 * @return {String} 返回串化结果字符串
		 * @example
		 */
		stringify: function(value) {
			return QW.ObjectH.stringify(value);
		}
	};
}());

/**
 * core_retouch
*/

(function() {
	var methodize = QW.HelperH.methodize,
		mix = QW.ObjectH.mix;
	/**
	 * @class Object 扩展Object，用ObjectH来修饰Object，特别说明，未对Object.prototype作渲染，以保证Object.prototype的纯洁性
	 * @usehelper QW.ObjectH
	 */
	mix(Object, QW.ObjectH);

	/**
	 * @class Array 扩展Array，用ArrayH/HashsetH来修饰Array
	 * @usehelper QW.ArrayH,QW.HashsetH
	 */
	mix(QW.ArrayH, QW.HashsetH);
	mix(Array, QW.ArrayH);
	mix(Array.prototype, methodize(QW.ArrayH));

	/**
	 * @class Function 扩展Function，用FunctionH/ClassH来修饰Function
	 * @usehelper QW.FunctionH
	 */
	mix(QW.FunctionH, QW.ClassH);
	mix(Function, QW.FunctionH);
	//    mix(Function.prototype, methodize(QW.FunctionH));

	/**
	 * @class Date 扩展Date，用DateH来修饰Date
	 * @usehelper QW.DateH
	 */
	mix(Date, QW.DateH);
	mix(Date.prototype, methodize(QW.DateH));


	/**
	 * @class String 扩展String，用StringH来修饰String
	 * @usehelper QW.StringH
	 */
	mix(String, QW.StringH);
	mix(String.prototype, methodize(QW.StringH));
}());

/*
 * 将直属于QW的方法与命名空间上提一层到window
*/
QW.ObjectH.mix(window, QW);