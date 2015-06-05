/**
 * Created by liming.zou on 2015/6/4.
 * 还没想好怎么写，丢人啊！
 * 例子
<div id="pager" class="pager">
    <div id="pageno" style="height: 20px;"></div>
    <ul>
    <li><a href="#" class="paginate_button first">首页</a></li>
    <li><a href="#" class="paginate_button prev">上一页</a></li>
    <li><a href="#" class="paginate_button next">下一页</a></li>
    <li><a href="#" class="paginate_button last">末页</a></li>
    </ul>
</div>
 */
(function(){
    var DataPage =function(element,options){
        this.options = options;
        this.$element = element;
    }
    DataPage.prototype = {
        constructor:DataPage,
        init: function () {

        }
    };
    $.fn.datapage = function(options){
        var itemCount,pageSize=10,pageCount,currentPage,link;
        var defaults = {
        };
        var opts = $.extend(defaults,options);

    }
}(jQuery));