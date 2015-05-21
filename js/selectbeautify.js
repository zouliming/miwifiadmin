$.fn.extend({
    locate: function (x, y) {
        if (this.css("position") == "fixed") {
            y -= $(document).scrollTop();
        }
        return this.css({ left: x, top: y });
    },
    locateBeside: function (el, adjustX) {
        var p = $(el).offset(),
            w1 = $(el).outerWidth(),
            w2 = this.outerWidth(),
            h2 = this.outerHeight(),
            x = p.left + w1 + 5 + (adjustX || 0),
            y = p.top;
        if ($(document).width() < x + w2) {
            x = p.left - w2 - 5 - (adjustX || 0);
        }
        if ($(document).height() < y + h2) {
            y = p.top - (y + h2 + 15 - $(document).height());
        }
        return this.locate(x, y);
    },
    locateBelow: function (el, adjustY) {
        var p = $(el).offset();
        return this.locate(p.left, p.top + $(el).outerHeight() + 3 + (adjustY || 0));
    },
    locateCenter: function () {
        return this.locate(
            ($(window).width() - this.width()) / 2,
            ($(window).height() - this.height()) / 2 + $(document).scrollTop()
        );
    }
});

$.selectBeautify = function(){
    // 找出需要美化的<select>标记，我们用一个class名称 "beautify" 来确定，没有这个样式的<select>则将被忽略
    var selects = $("select.beautify");
    if (selects.length > 0) {

        //先在代码底部增加一个<div>，用来承载和显示下拉框选项
        $("body").append("<div id='dummydata' style='position:absolute; display:none'></div>");

        //挨个美化呗
        selects.each(function () {

            //给本函数下的 this (也就是 <select>) 设置一个别名，在下面的匿名函数中将会被用到
            var select = this;

            //创建一个 <input> ，  .dummy 将用于我们对此类 <input> 进行专门样式定义
            //同时将 <select> 的部分属性和样式复制给这个 dummy input
            //创建完后，将这个 <input> 插入 dom， 紧跟原 <select>
            var input = $("<input type='text' readonly='readonly' class='input-select dummy' />")
                .attr("disabled", this.disabled)
                .css("width", parseInt(this.style.width) + "px")
                .css("display", this.style.display)
                .insertAfter(this)
                .val(this.options[this.selectedIndex].text);

            //将 <select> 藏掉，不要在 .beautify 中去定义 display:none， 因为js加载失败时，我们还得用上它
            this.style.display = "none";

            // 当 <input class='dummy'> 被点击时
            input.click(function () {
                //调出前面创建的 <div id='dummydata'>，并清空内容
                //将 <select> 的样式表传递给它，当需要对这个 <div> 进行修饰时，就靠这些样式定义
                var div = $("#dummydata")
                    .empty()
                    .attr("class", select.className);

                //设置 <div> 的宽度
                //在这里我们判断一个特殊的class名 "extend"
                //如果带有 .extend，表示宽度将受额外自定义控制；否则，宽度将默认与 <input> 一致
                $(select).hasClass("extend")
                    ? div.css("width", "")
                    : div.css("width", $(this).innerWidth());

                //将 <option> 复制到 <div id='dummydata'> 里面，一个 <option> 对应一个 <a> 标记
                for (var i = 0; i < select.options.length; i++) {
                    var item = select.options[i];
                    var a = $("<a href='javascript:void(0);' class='nowrap'></a>")
                        .css("color", item.style.color)
                        .addClass(item.className)
                        .html(item.text)
                        .appendTo(div);
                    if (i == select.selectedIndex) {
                        a.addClass("selected");
                    }
                    //当选项被点击时，<input> 内容显示为对应 <option>，关闭 <div> 层，同时将事件冒泡给原来的 <select>
                    a.click(function () {
                        var n = $(this).index();
                        select.selectedIndex = n;
                        input.val(select.options[n].text);
                        div.hide();
                        $(select).change();
                    });
                }

                //在这里我们判断一个特殊的class名 "noscroll"
                //当选项过多时，默认会让选项列表出现滚动条；但如果有 .noscroll 修饰，则强制不出现滚动条
                var noscroll = (select.options.length < 10 || $(select).hasClass("noscroll"));
                if (/msie 6/i.test(window.navigator.userAgent)) {
                    div.css("height", noscroll ? "auto" : "215px").css("overflow-y", noscroll ? "hidden" : "scroll");
                } else {
                    div.css("max-height", noscroll ? "10000px" : "215px");
                }

                //在这里我们判断一个特殊的class名 "onside"
                //如果有 .onside 修饰，弹出的选项层将在侧面，否则是在下面
                //注： 此处用到2个函数 locateBeside 和 locateBelow 是本人js库中的方法，稍等另外给出
                $(select).hasClass("onside")
                    ? div.locateBeside(this, -2)
                    : div.locateBelow(this, -4);

                //对反复点击 <input> 之类的事情，做一些智能调节
                if (window.activeDummySelect == select) {
                    div.slideToggle(100);
                } else {
                    div.hide().slideDown(100);
                    window.activeDummySelect = select;
                }

                //在有滚动条的情况下，我们需要将滚动条滚动到当前选中项的位置
                if (!select.selectedIndex > 6 && div[0].scrollHeight > div.height()) {
                    div.scrollTop((select.selectedIndex - 3) * div[0].firstChild.offsetHeight);
                }
            });
        });

        //最后别忘了：点击网页上的游离区域时，应该隐藏<div #dummydata>
        $(document).click(function (e) {
            if (!$(e.target).is(".dummy") && !$(e.target).is("#dummydata")) {
                $("#dummydata").hide();
            }
        });
    }
};