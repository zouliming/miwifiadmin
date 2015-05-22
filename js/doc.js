/* 
 * 这个js用来记录小米内置的一些不错的js片段，方便日后复用
 */

//上传日志
$(global_event).on('set:uploadLog', function (evt, data) {
        var request_date = {};
        $.getJSON('api/xqsystem/upload_log', request_date, function (rsp)
        {
                if (rsp.code == 0) {
                        //亮点，lightalert这个插件
                        $.lightalert().setContent('日志上传成功').show();
                } else {
                        $.lightalert().setContent(rsp.msg).show();
                }
                global_event.isRequestUplog = false;
        })
});
//重启
$(global_event).on('set:downloadConfig', function (evt, data) {
        var request_date = {};
        $.getJSON('api/xqsystem/config_recovery', request_date, function (rsp)
        {
                if (rsp.code == 0) {
                        $.lightalert().setContent('成功重启后生效').show();
                } else {
                        $.lightalert().setContent(rsp.msg).show();
                }
        })
});

/*
 * 原来在set:navAnimate事件里面
 * 作用：就是让二级菜单在没有点击的情况下，自动收缩其他菜单，只展开当前这个菜单。
 * 但是效果做的貌似有点不全，还有点不够完美的地方
 */
$('.nav-item').on('mouseenter', function (e) {
        var root = $('.nav-list');
        var listIsOpen = $('ul.isopen', root);
        var list = $('ul', this);
        var listHieght = list.find('li').length * 40;
        var statusAll = $('.bt-onoff', root);
        var status = $('.bt-onoff', this);
        if ($('ul', this).hasClass('isopen')) {
                console.log('is open');
                return;
        }
        window.clearTimeout(timer);
        timer = window.setTimeout(function () {
                if (list.length > 0) {
                        listIsOpen.stop(1, 1).animate({
                                'height': 0,
                                'padding-top': 0,
                                'padding-bottom': 0,
                                'overflow': 'hidden'
                        }, 400).removeClass('isopen');
                        list.stop(1, 1).animate({
                                'height': listHieght,
                                'padding-top': 4,
                                'padding-bottom': 4,
                                'overflow': 'hidden'
                        }, 400);
                        list.addClass('isopen');

                        statusAll.each(function () {
                                this.className = 'bt-onoff bt-on';
                        });
                        status[0].className = 'bt-onoff bt-off';
                }
        }, 400);
});
