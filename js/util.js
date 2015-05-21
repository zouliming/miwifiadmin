/*!
 * Util.js
 * zhangjianbin@xiaomi.com
 * for help method
 */
function secondToHour(time) {
        var pint = function (num) {
                return parseInt(num, 10);
        },
            hour = pint(time / 3600.0),
            minute = pint((parseFloat(time / 3600.0) - hour) * 60),
            second = pint(time) - hour * 3600 - minute * 60,
            format = hour + '小时' + minute + '分' + second + '秒';
        return format;
}

function secondToDate(second) {
        var time = parseFloat(second),
            pint = function (num) {
                    return parseInt(num, 10);
            },
            day;
        if (time !== null && time !== "") {
                if (time > 60 && time < 60 * 60) {
                        time = pint(time / 60.0) + '分' + pint((parseFloat(time / 60.0) - pint(time / 60.0, 10)) * 60) + '秒';
                }
                else if (time >= 60 * 60 && time < 60 * 60 * 24) {
                        time = secondToHour(time);
                } else if (time >= 24 * 60 * 60) {
                        day = pint(time / (3600.0 * 24));
                        time = time - (day * 3600 * 24);
                        time = day + '天 ' + secondToHour(time);
                }
                else {
                        time = pint(time) + '秒';
                }
        }
        return time;
}

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
function dateFormat(d, pattern) {
        pattern = pattern || 'yyyy-MM-dd';
        var y = d.getFullYear().toString(),
            o = {
                    M: d.getMonth() + 1, //month
                    d: d.getDate(), //day
                    h: d.getHours(), //hour
                    m: d.getMinutes(), //minute
                    s: d.getSeconds() //second
            },
        i;
        pattern = pattern.replace(/(y+)/ig, function (a, b) {
                return y.substr(4 - Math.min(4, b.length));
        });
        for (i in o) {
                pattern = pattern.replace(new RegExp('(' + i + '+)', 'g'), function (a, b) {
                        return (o[i] < 10 && b.length > 1) ? '0' + o[i] : o[i];
                });
        }
        return pattern;
}

/**
 * placeholder
 */
function placeholder() {
        var isInputSupported = 'placeholder' in document.createElement('input'),
            isTextareaSupported = 'placeholder' in document.createElement('textarea'),
            placeHolder_idx = 100000,
            g = function (id) {
                    return document.getElementById(id);
            };

        if (isInputSupported || isTextareaSupported) {
                return;
        }
        //模拟placeholder
        $('[placeholder]').each(function () {
                var el = this;
                var __placeholderTimer = null;
                var placeHolderElId = 'placeHolder-' + placeHolder_idx++;
                el.setAttribute('placeHolderEl', placeHolderElId);
                el.parentNode.style.position = 'relative';
                var position = $(el).position();
                var holderVal = $(el).attr('placeholder');
                var inputPaddingTop = $(el).css('padding-top');
                var inputPaddingLeft = $(el).css('padding-left');
                var inputFontSize = $(el).css('font-size');
                var elPlaceHolder = $('<span style="color:#999; font-size:16px; padding: 7px 4px; position:absolute; display:none;"></span>');
                elPlaceHolder.css({left: position.left + 1, top: position.top + 1, 'padding-top': inputPaddingTop, 'padding-left': inputPaddingLeft, 'font-size': inputFontSize});
                elPlaceHolder.html(holderVal);
                elPlaceHolder.attr('id', placeHolderElId);
                el.parentNode.insertBefore(elPlaceHolder[0], el);

                if (el.value == '') {
                        elPlaceHolder.show();
                }

                elPlaceHolder.on('click', function (e) {
                        try {
                                el.focus();
                        } catch (ex) {
                        }
                });

                $(el)
                    .on('keydown', function (e) {
                            var oldval = $(this).val();
                            oldval = $.trim(oldval);
                            var placeHolderEl = $(this).attr('placeHolderEl');
                            $(g(placeHolderEl)).hide();
                    })
                    .on('blur', function (e) {
                            var oldval, _oldval;
                            var that = $(this);
                            var placeHolderEl = $(this).attr('placeHolderEl');

                            clearTimeout(__placeholderTimer);
                            __placeholderTimer = setTimeout(function () { //在360浏览器下，autocomplete会先blur之后N百毫秒之后再change
                                    _oldval = that.val();
                                    oldval = $.trim(_oldval);
                                    if (_oldval === '' && oldval === '') {
                                            $(g(placeHolderEl)).show();
                                    }
                            }, 600);
                    });
        });

}
/**
 * checkbox beautify
 */
function checkboxBeautify() {
        $('.js-checkbox').each(function () {
                var $this = $(this),
                    $input = $('input', this);
                if ($input.prop('checked')) {
                        $this.addClass('input-checkbox-checked');
                } else {
                        $this.removeClass('input-checkbox-checked');
                }
        });
        $('body').delegate('.js-checkbox', 'click', function (e) {
                e.preventDefault();
                var $this = $('.input-checkbox', this),
                    $input = $('input', this);
                if ($input.prop('checked')) {
                        $input.prop('checked', false);
                        $this.removeClass('input-checkbox-checked');
                } else {
                        $input.prop('checked', true);
                        $this.addClass('input-checkbox-checked');
                }
                $input.trigger('ionchange');
                return false;
        });
}

/**
 * byte format
 */
function byteFormat(number, precision, isarray) {
        var val,
            label,
            ret;
        precision = precision || 100,
            isarray = isarray || false;
        if (number > 1024 * 1024 * 1024) {
                val = Math.floor(number / 1024 / 1024 / 1024 * precision) / precision;
                label = 'GB';
        } else if (number > 1024 * 1024 && number < 1024 * 1024 * 1024) {
                val = Math.floor(number / 1024 / 1024 * precision) / precision;
                label = 'MB';
        } else {
                val = Math.floor(number / 1024 * precision) / precision;
                label = 'KB';
        }

        if (isarray) {
                ret = [val, label];
        } else {
                ret = val + label;
        }

        return ret;
}

function fillHeight() {
        var resizeTimer = null,
            bdHeight = $('#bd').height(),
            autoHeight = function () {
                    $('#bd').css({height: 'auto'});
                    var bodyHeight = $('body').height(),
                        winHeight = $(window).height(),
                        hdHeight = $('#hd').outerHeight(),
                        ftHeight = $('#ft').outerHeight(true),
                        leftHeight = winHeight - hdHeight - ftHeight;
                    if (bodyHeight < winHeight) {
                            $('#bd').css({height: leftHeight});
                    }
                    $('#doc.hidden').css({visibility: 'visible'});
            }
        if ($('#bd').hasClass('dft')) {
                $(window).on('resize', function () {
                        if (resizeTimer) {
                                clearTimeout(resizeTimer)
                        }
                        resizeTimer = setTimeout(function () {
                                autoHeight();
                        }, 400);
                });
                autoHeight();
        }
}

// jQuery plugin Lightalert
(function ($) {
        function Lightalert(options) {
                options = options || {};
                this.width = options.width || '100%';
                this.follow = options.follow || false;
                this.timer = null;
                this.timeout = 5 * 1000;

                this.id = 'id' + (new Date().getTime());
                this.alert = $('<div class="lightalert" id="' + this.id + '"><span class="content"></span></div>');
                this.alert.appendTo('body');
                this.alert.css({width: this.width});
                this.content = this.alert.find('.content');
                this.setPosition();
        }
        Lightalert.prototype.time = function (time) {
                this.timeout = time * 1000;
                return this;
        };
        Lightalert.prototype.setContent = function (msg) {
                this.content.html(msg);
                return this;
        };
        Lightalert.prototype.setPosition = function () {
                var winW = $(window).width(),
                    winH = $(window).height(),
                    selfW = this.width,
                    selfH = $(this.alert).outerHeight(),
                    left = (winW - selfW) / 2,
                    follow = this.follow,
                    offset,
                    top;
                if (follow) {
                        offset = $(follow).offset();
                        left = offset.left;
                        top = offset.top + $(follow).height() + 10;
                        if (left + selfW > winW) {
                                left = left - selfW + $(follow).width();
                        }
                        if (top + selfH > winH) {
                                top = winH - selfH;
                        }
                        this.alert.css({
                                width: 'auto',
                                left: left,
                                top: top
                        });
                } else {
                        if (this.width != '100%') {
                                this.alert.css({
                                        left: left
                                });
                        }
                }
        };
        Lightalert.prototype.show = function () {
                var that = this;
                this.alert.fadeIn(400);
                window.clearTimeout(this.timer);
                window.setTimeout(function () {
                        that.hide();
                }, this.timeout);
        };
        Lightalert.prototype.hide = function () {
                this.alert.fadeOut(400);
        };
        $.lightalert = function (options) {
                return new Lightalert(options);
        };
})(jQuery);

var global_event = {};
global_event.pspSet = function (obj) {
        var uuid = obj.uuid;
        var logtype = obj.logtype;
        var token = obj.token;
        var psp = uuid + '|||' + logtype + '|||' + token;
        $.cookie('psp', psp, {path: '/'});
};
global_event.pspGet = function () {
        var psp = $.cookie('psp');
        if (typeof (psp) === "undefined") {
                return false;
        }
        var pspArr = psp.split('|||');
        return {
                uuid: pspArr[0],
                logtype: pspArr[1],
                token: pspArr[2]
        }
};
//通用提示，重启并自动连接的。
$(global_event).on('reboot:connect', function (evt, data) {
        var online = data.online || function () {
        },
            offline = data.offline || function () {
            },
            imgUrl = data.img,
            time = 5000,
            timecounter = 0,
            wait = function () {
                    console.log('reboot:wait');
                    offline();
            },
            done = function () {
                    console.log('reboot:done');
                    window.clearInterval(timer);
                    online();
            },
            loadImg = function (onload, onerror) {
                    var img = new Image();
                    img.onload = onload;
                    img.onerror = onerror;
                    img.src = imgUrl + '?' + (+new Date());
            },
            timer = window.setInterval(function () {

                    if ('onLine' in navigator) {
                            if (navigator.onLine) {
                                    loadImg(function () {
                                            done();
                                    }, function () {
                                            wait();
                                    });
                            } else {
                                    wait();
                            }
                    } else {
                            loadImg(function () {
                                    done();
                            }, function () {
                                    wait();
                            });
                    }
            }, time);
});

$(global_event).on('reboot:wait', function (evt, data) {
        var action = data.action,
            ip = data.lanIp || window.location.host,
            refresh = data.refresh || false;

        global_event.reboot = {
                tStart: (+new Date())
        };

        global_event.dlgRebootWait = window.top.art.dialog({
                title: '重启中...',
                cancel: false,
                width: 400,
                content: action + '操作生效，等待设备重启...'
        }).lock();

        var waitCallback = {
                online: function () {
                        global_event.dlgRebootWait.content('操作生效,重启成功！').time(3 * 1000);
                        if (refresh) {
                                window.setTimeout('window.top.location.href="http://' + ip + '";', 3000);
                        }
                },
                offline: function () {
                        var tUse = Math.round(((+new Date()) - global_event.reboot.tStart) / 1000);
                        if (tUse > 150) {
                                global_event.dlgRebootWait.content('自动连接路由器失败，请检查无线或者网线是否连接正确。');
                                return;
                        }
                        global_event.dlgRebootWait.content(action + ", 等待自动跳转... 用时" + tUse + "秒");
                },
                img: 'http://' + ip + '/xiaoqiang/web/img/logo.png'
        };
        window.setTimeout(function () {
                $(global_event).trigger('reboot:connect', waitCallback);
        }, 1000 * 15);

});
$(global_event).on('needLogin', function (evt, data) {
        //api session 过期处理
        if (window.syslock && window.syslock == true) {
                return;
        }
        $(document).ajaxSuccess(function (evt, xhr, opt) {
                var rsp = jQuery.parseJSON(xhr.responseText);
                if (!window.location.origin) {
                        window.location.origin = window.location.protocol + "//" + window.location.host;
                }
                var logout = window.location.origin + '/cgi-bin/luci/web/logout';
                if (rsp.code && rsp.code == 401) {
                        if (/api\/xqsystem\/login/.test(opt.url)) {
                                return;
                        }
                        if (window.top) {
                                window.top.location.href = logout;
                        } else {
                                window.location.href = logout;
                        }
                }
                if (rsp.code && rsp.code == 403) {
                        if (window.top) {
                                window.top.location.href = window.location.origin;
                        } else {
                                window.location.href = window.location.origin;
                        }
                }
        });
        // $(document).ajaxError(function(evt, xhr, opt){
        //     alert('系统错误，HTTP状态：' + xhr.status);
        // });
});
//fix debug
if (!window.console) {
        window.console = {
                log: function () {
                }
        }
}
$(function () {
        // fillHeight();
        checkboxBeautify();
        window.setTimeout(function () {
                placeholder();
                $.selectBeautify();
        }, 100);
});

/* template */
(function () {

        'use strict';

// By default, Underscore uses ERB-style template delimiters, change the
// following template settings to use alternative delimiters.
        var settings = {
                evaluate: /{{([\s\S]+?)}}/g,
                interpolate: /{{=([\s\S]+?)}}/g,
                escape: /{{-([\s\S]+?)}}/g
        };

// When customizing `templateSettings`, if you don't want to define an
// interpolation, evaluation or escaping regex, we need one that is
// guaranteed not to match.
        var noMatch = /.^/;

// Certain characters need to be escaped so that they can be put into a
// string literal.
        var escapes = {
                '\\': '\\',
                "'": "'",
                'r': '\r',
                'n': '\n',
                't': '\t',
                'u2028': '\u2028',
                'u2029': '\u2029'
        };

        var entityMap = {
                escape: {
                        '&': '&amp;',
                        '<': '&lt;',
                        '>': '&gt;',
                        '"': '&quot;',
                        "'": '&#x27;',
                        '/': '&#x2F;'
                }
        };

        // Regexes containing the keys and values listed immediately above.
        var entityRegexes = {
                escape: new RegExp('[&<>"\'/]', 'g')
        };

        var escape = function (string) {
                if (string == null)
                        return '';
                return ('' + string).replace(entityRegexes['escape'], function (match) {
                        return entityMap['escape'][match];
                });
        };

        for (var p in escapes) {
                escapes[escapes[p]] = p;
        }

        var escaper = /\\|'|\r|\n|\t|\u2028|\u2029/g;
        var unescaper = /\\(\\|'|r|n|t|u2028|u2029)/g;

        var tmpl = function (text, data, objectName) {
                settings.variable = objectName;

                // Compile the template source, taking care to escape characters that
                // cannot be included in a string literal and then unescape them in code
                // blocks.
                var source = "__p+='" + text
                    .replace(escaper, function (match) {
                            return '\\' + escapes[match];
                    })
                    .replace(settings.escape || noMatch, function (match, code) {
                            return "'+\nescape(" + unescape(code) + ")+\n'";
                    })
                    .replace(settings.interpolate || noMatch, function (match, code) {
                            return "'+\n(" + unescape(code) + ")+\n'";
                    })
                    .replace(settings.evaluate || noMatch, function (match, code) {
                            return "';\n" + unescape(code) + "\n;__p+='";
                    }) + "';\n";

                // If a variable is not specified, place data values in local scope.
                if (!settings.variable) {
                        source = 'with(obj||{}){\n' + source + '}\n';
                }

                source = "var __p='';var print=function(){__p+=Array.prototype.join.call(arguments, '')};\n" + source + "return __p;\n";

                var render = new Function(settings.variable || 'obj', source);
                if (data) {
                        return render(data);
                }

                var template = function (data) {
                        return render.call(this, data);
                };

                // Provide the compiled function source as a convenience for build time
                // precompilation.
                template.source = 'function(' + (settings.variable || 'obj') + '){\n' + source + '}';
                return template;
        };

        window.tmpl = tmpl;

}());

