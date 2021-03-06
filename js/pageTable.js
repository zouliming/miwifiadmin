/**
 * Created by liming.zou on 2015/6/4.
 * 还没想好怎么写，丢人啊！
 * 例子
 <div id="pager" class="pager">
    <div class="page_info">
        <span class="show_label">第1页，第1条到5条数据</span>，<span class="total_label">共18条数据</span>
    </div>
    <ul>
         <li><a href="#" class="paginate_button first disabled">首页</a></li>
         <li><a href="#" class="paginate_button prev disabled">上一页</a></li>
         <li><a href="#" class="paginate_button next">下一页</a></li>
         <li><a href="#" class="paginate_button last">末页</a></li>
     </ul>
 </div>
 必须参数：
 @param infoUrl 获取数据的接口url，返回信息：比如{"code":0,"data":{"count":"18","list":[{"id":"19","title":"oo","url":"oo","enable":"1"}]}}
 code为0代表成功，data表示数据，count表示数量，list表示当前页的数据信息
 */
!function($){
    var Pager= function(element,options){
        this.init(element, options);
    }
    Pager.prototype = {
        constructor:Pager,
        //通用
        init:function(element,options){
            this.currentPage = 1;
            this.$element = $(element);
            this.options = this.getOptions(options);
            this.initPageTemplate();
            this.addPageEvent();
            this.jisuan();
        },
        jump:function(n){
            this.currentPage = n;
            this.jisuan();
        },
        jisuan:function(){
            var t=this;
            $.getJSON(this.options.infoUrl,{page:this.currentPage,pageSize:this.options.pageSize},function(rsp) {
                if (rsp.code == 0) {
                    t.itemCount = rsp.data.count;
                    var p = Math.ceil(t.itemCount / t.options.pageSize);
                    t.totalPage = p;
                    t.renderTables(rsp.data.list);
                    t.updatePageStatus();
                }
            });
        },
        getOptions: function (options) {
            options = $.extend({}, $.fn.pager.defaults, options);
            return options;
        },
        //分页相关
        initPageTemplate:function(){
            this.$element.after(this.options.pageHtml);
            this.pageEle = this.$element.next("#pager");
            var inHtml = "";
            inHtml += this.options.pageinfoTemplate;
            inHtml += this.options.paginationTemplate;
            this.pageEle.html(inHtml);
        },
        updatePageStatus:function(){
            var startIdx,endIdx,
                pageinfoEle = this.pageEle.find('.page_info'),
                ulEle = this.pageEle.find('ul');
            startIdx = this.options.pageSize*(this.currentPage-1)+1;
            endIdx = (this.options.pageSize*this.currentPage)>this.itemCount?this.itemCount:(this.options.pageSize*this.currentPage);

            pageinfoEle.find("span.show_label").html("第"+this.currentPage+"页，第"+startIdx+"条到"+endIdx+"条数据");
            pageinfoEle.find("span.total_label").html("共"+this.itemCount+"条数据");
            ulEle.find('a').removeClass('disabled');
            if(this.currentPage==1){
                ulEle.find('.first').addClass('disabled');
                ulEle.find('.prev').addClass('disabled');
            }
            if(this.currentPage==this.totalPage){
                ulEle.find('.last').addClass('disabled');
                ulEle.find('.next').addClass('disabled');
            }
        },
        addPageEvent:function(){
            var that = this;
            var ulEle = this.pageEle.find('ul');
            ulEle.find('.paginate_button').on('click',function(e){
                e.preventDefault();
                var ele = $(this);
                //如果已经disabled了，就停止
                if(ele.hasClass('disabled')){
                    return false;
                }
                if(ele.hasClass('first')){
                    that.currentPage = 1;
                }else if(ele.hasClass('prev')){
                    if(that.currentPage>1){
                        that.currentPage = that.currentPage-1;
                    }else{
                        that.currentPage = 1;
                    }
                }else if(ele.hasClass('next')){
                    if(that.currentPage<that.totalPage-1){
                        that.currentPage = that.currentPage+1;
                    }else{
                        that.currentPage = that.totalPage;
                    }
                }else if(ele.hasClass('last')){
                    that.currentPage = that.totalPage;
                }
                that.jisuan();
            });
        },
        //表格相关
        renderTables:function(data){
            if(this.options.renderData){
                this.options.renderData(data);
            }else{
                this.defaultRenderTables(data);
            }
        },
        defaultRenderTables:function(data){
            var strHtml = "";
            $.each(data,function(i,n){
                strHtml += '<tr>';
                $.each(n,function(j,k){
                    strHtml += '<td>'+k+'</td>';
                });
                strHtml += '</tr>';
            });
            this.$element.find('tbody').html(strHtml);
        }
    };
    $.fn.pager = function (option) {
        var firstEle = this.first();
        var options = typeof option == 'object' && option;
        return new Pager(firstEle,options);
    };
    $.fn.pager.Constructor = Pager;
    $.fn.pager.defaults = {
        pageSize: 5
        , pageHtml:'<div id="pager" class="pager"></div>'
        , pageinfoTemplate: '<div class="page_info"><span class="show_label"></span>，<span class="total_label"></span></div>'
        , paginationTemplate: '<ul>'+
        '<li><a href="#" class="paginate_button first">首页</a></li>'+
        '<li><a href="#" class="paginate_button prev">上一页</a></li>'+
        '<li><a href="#" class="paginate_button next">下一页</a></li>'+
        '<li><a href="#" class="paginate_button last">末页</a></li>'+
        '</ul>'
        , renderData: false
        , container: false
    };
}(window.jQuery);