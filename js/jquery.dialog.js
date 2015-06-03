(function ($) {
    var _isIE6 = !!($.browser.msie && $.browser.version == '6.0'),
        _isFixed = !_isIE6,
        tmpl = function (sTmpl, opts) {
            return sTmpl.replace(/\{\$(\w+)\}/g, function (a, b) {
                return opts[b]
            });
        },
        _mix = function (des, src, override) {
            for (var i in src) {
                if (override || !(i in des)) {
                    des[i] = src[i];
                }
            }
            return des;
        },
        version = '1.0.0',
        defaults = {
            // 消息内容
            content: '<div class="d-loading"><span>加载中..</span></div>',
            // 标题
            title: '消息框',
            // 自定义按钮
            button: null,
            // 确定按钮回调函数
            ok: null,
            // 取消按钮回调函数
            cancel: null,
            // 对话框初始化后执行的函数
            initialize: null,
            // 对话框关闭前执行的函数
            beforeunload: null,
            // 确定按钮文本
            okValue: '确认',
            // 取消按钮文本
            cancelValue: '取消',
            // 内容宽度
            width: '400',
            // 内容高度
            height: 'auto',
            // 内容与边界填充距离
            padding: '20px 25px',
            // 自动关闭时间(毫秒)
            time: null,
            // 初始化后是否显示对话框
            visible: true,
            // 是否锁屏
            lock: false,
            // 是否固定定位
            fixed: false,
            // 对话框叠加高度值(重要：此值不能超过浏览器最大限制)
            zIndex: 1000
        },
        tplMask = '<div class="panel-mask" style="position:absolute;left:0;top:0;style:none;"><iframe style="width:100%;height:100%;filter:alpha(opacity=0);"></div>',
        tplDialog = ''
            + '<div class="panel panel-dialog" style="position:absolute;left:0;top:0;style:none;">'
            + '<div class="panel-content">'
            + '<div class="hd">'
            + '<h3 class="d-hd"></h3>'
            + '</div>'
            + '<div class="bd">'
            + '<div class="d-bd"></div>'
            + '</div>'
            + '<div class="ft">'
            + '<div class="d-ft"></div>'
            + '</div>'
            + '</div>'
            + '<span class="d-close" title="关闭">&times;</span>'
            + '</div>';
    //构造类
    function Dialog(opt) {
        var _opt = _mix(opt, defaults);
        if (!_isFixed) {
            _opt.fixed = false;
        }
        ;
        if (!_opt.button || !$.isArray(_opt.button)) {
            _opt.button = [];
        }
        if (_opt.ok) {
            _opt.button.push({
                id: 'ok',
                value: _opt.okValue,
                callback: _opt.ok,
                focus: true
            });
        }
        ;
        if (_opt.cancel) {
            _opt.button.push({
                id: 'cancel',
                value: _opt.cancelValue,
                callback: _opt.cancel,
                focus: false
            });
        }
        ;

        //update zIndex
        defaults.zIndex = _opt.zIndex;

        this.options = _opt;
        this.initialize();
    }

    Dialog.prototype = {
        // 属性
        _dom: null,
        _islock: false,
        _lockMask: null,
        // 初始化
        initialize: function () {
            this._creat();
            this.show();
            this._addEvent();
        },
        // 标题
        title: function (str) {
            var dom = this._dom,
                title = dom['hd'],
                classname = 'd-is-notitle';
            if (str === false) {
                title.hide();
                dom['self'].addClass(classname);
            } else {
                title.html(str).show();
                dom['self'].removeClass(classname);
            }
            return this;
        },
        // 内容
        content: function (str) {
            var str = str || '';
            this._dom['bd'].html(str);
            return this;
        },
        // 锁屏
        lock: function () {
            if (this._isLock) {
                return this;
            }
            ;

            var that = this,
                options = this.options,
                dom = this._dom,
                $mask = $(tplMask),
                index = defaults.zIndex - 1;

            this.zIndex();
            $mask.css({
                zIndex: index,
                position: 'fixed',
                left: 0,
                top: 0,
                width: '100%',
                height: '100%',
                overflow: 'hidden'
            });
            if (!_isFixed) {
                $mask.css({
                    position: 'absolute',
                    width: $(window).width() + 'px',
                    height: $(document).height() + 'px'
                });
            }
            ;
            $mask.appendTo(document.body);
            $mask.show();
            this._lockMask = $mask;
            this._isLock = true;

            return this;
        },
        // 解锁
        unlock: function () {
            if (this._isLock) {
                this._lockMask.remove();
                this._lockMask = null;
                this._isLock = false;
            } else {
                return this;
            }
        },
        // 打开
        show: function () {
            var dom = this._dom;
            this.zIndex();
            this.position();
            dom['self'].show();
            dom['self'].focus();
            dom['self'].addClass('d-is-open');
            return this;
        },
        // 关闭
        close: function () {
            var onbeforeunload = this.options['beforeunload'],
                dom = this._dom;

            if (onbeforeunload && onbeforeunload.call(this) === false) {
                return this;
            }
            if (Dialog.focus === this) {
                Dialog.focus = null;
            }
            dom['self'].remove();
            this._removeEvent();
            this.unlock();
            delete Dialog.list[this.options.id];

            return this;
        },
        // 定时关闭
        time: function (time) {

            var that = this,
                timer = this._timer;

            timer && clearTimeout(timer);

            if (time) {
                this._timer = setTimeout(function () {
                    that.close();
                }, time);
            }
            ;

            return this;
        },
        //  设置对话框大小
        size: function (w, h) {
            var dom = this._dom;
            dom['self'].width(w).height(h);
            this.position();
            return this;
        },
        // 设置对话框位置
        position: function () {
            var dom = this._dom,
                wrap = dom['self'],
                el = wrap[0],
                $window = $(window),
                $document = $(document),
                fixed = this.options.fixed,
                dl = fixed ? 0 : $document.scrollLeft(),
                dt = fixed ? 0 : $document.scrollTop(),
                ww = $window.width(),
                wh = $window.height(),
                ow = el.offsetWidth,
                oh = el.offsetHeight,
                left = (ww - ow) / 2 + dl,
                top = (wh - oh) * 382 / 1000 + dt,
                style = el.style,
                zindex = defaults.zIndex;
            if (fixed) {
                style.position = fixed ? 'fixed' : 'absolute';
            }

            style.left = Math.max(parseInt(left), dl) + 'px';
            style.top = Math.max(parseInt(top), dt) + 'px';
            style.zIndex = zindex;

            return this;
        },
        // 按钮
        button: function () {
            var dom = this._dom,
                that = this,
                ft = dom['ft'],
                primary = 'btn-primary',
                btns = [].slice.call(arguments),
                buttons = this._buttons = this._buttons || {},
                value,
                id,
                button,
                isNewBtn,
                btn;

            for (var i = 0; i < btns.length; i++) {
                btn = btns[i];
                value = btn.value;
                id = btn.id;
                isNewBtn = !this._buttons[id];
                if (isNewBtn) {
                    if (!buttons[id]) {
                        buttons[id] = {};
                    }
                    button = $('<a href="#" data-id="' + id + '" class="btn"><span>' + value + '</span></a>');
                    buttons[id].elem = button;
                    if (btn.callback) {
                        buttons[id].callback = btn.callback;
                    }
                    if (btn.disabled) {
                        button.prop('disabled', true);
                        button.addClass('btn-disabeld')
                    }
                    if (btn.focus) {
                        button.addClass(primary);
                    }
                    ft.append(button);
                }
            }
            ft[0].style.display = btns.length ? '' : 'none';
            return this;
        },
        // 置顶当前对话框
        zIndex: function () {
            var dom = this._dom,
                index = defaults.zIndex++;

            // 设置叠加高度
            dom['self'].css('zIndex', index);
            this._lockMask && this._lockMask.css('zIndex', index - 1);

            Dialog.focus = this;

            return this;
        },
        // 创建对话框
        _creat: function () {
            var dom = this._buildHTML(),
                initialize = this.options.initialize,
                title = this.options.title,
                content = this.options.content,
                width = this.options.width,
                height = this.options.height,
                time = this.options.time,
                lock = this.options.lock,
                padding = this.options.padding,
                cancel = this.options.cancel;

            this._dom = dom;

            dom['bd'].css('padding', padding);

            this.title(title)
                .content(content)
                .size(width, height);

            if (time) {
                this.time(time);
            }
            if (lock) {
                this.lock();
            }
            if (cancel === false) {
                dom['close'].hide();
            }
            this.button.apply(this, this.options.button);

            if (initialize && typeof ( initialize ) === 'function') {
                initialize.call(this);
            }
        },
        _addEvent: function () {
            var that = this,
                dom = this._dom;
            $(window).on('resize', function () {
                that.position();
            });
            dom['close'].on('click', function (e) {
                that.close();
            });
            dom['ft'].find('.btn').on('click', function (e) {
                e.preventDefault();
                var id = $(this).attr('data-id');
                id && that._btnCallback(id);
            });
            dom['self'].on('mousedown', function () {
                that.zIndex();
            });
            // 全局快捷键
            $(document).on('keydown', function (event) {
                var target = event.target,
                    nodeName = target.nodeName,
                    rinput = /^input|textarea$/i,
                    dom = that._dom,
                    top = Dialog.focus,
                    keyCode = event.keyCode;

                if (!top || rinput.test(nodeName) && target.type !== 'button') {
                    return;
                }

                // ESC
                if (top.options.cancel !== false) {
                    keyCode === 27 && top.close();
                }
            });
        },
        _removeEvent: function () {
            $(window).unbind();
            $(document).unbind();
            this._dom['close'].unbind();
        },
        _buildHTML: function () {
            var body = document.body,
                dom = {},
                elem;

            if (!body) {
                throw new Error('artDialog: "documents.body" not ready');
            }
            ;
            elem = $(tplDialog);
            body.insertBefore(elem[0], body.firstChild);

            dom['hd'] = elem.find('.d-hd');
            dom['bd'] = elem.find('.d-bd');
            dom['ft'] = elem.find('.d-ft');
            dom['close'] = elem.find('.d-close');
            dom['self'] = elem;
            return dom;
        },
        // 按钮回调函数
        _btnCallback: function (id) {
            var fn = this._buttons[id] && this._buttons[id].callback;
            return typeof fn !== 'function' || fn.call(this) !== false ?
                this.close() : this;
        }
    };

    Dialog.version = version;

    Dialog.list = {};

    Dialog.focus = null;

    Dialog.get = function (id) {
        return id == undefined ? Dialog.list : Dialog.list[id];
    };

    window.art = {};

    window.art.dialog = $.dialog = function (opt) {
        var _dialog
        _id = opt.id;
        if (!_id) {
            _id = opt.id = 'id' + new Date().getTime();
        }

        if (_id && Dialog.list[_id]) {
            _dialog = Dialog.list[_id];
            _dialog.zIndex();
        } else {
            _dialog = Dialog.list[_id] = new Dialog(opt);
        }
        return _dialog;
    };
    window.art.dialog.get = $.dialog.get = Dialog.get;
    window.art.dialog.version = $.dialog.version = Dialog.version;

})(jQuery);