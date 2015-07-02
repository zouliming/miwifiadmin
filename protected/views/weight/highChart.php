<?php
$jsUrl = Util::getJsUrl();
Yii::app()->clientScript
        ->registerCoreScript('jquery')
        ->registerScriptFile($jsUrl . 'highcharts/highcharts.js',CClientScript::POS_END)
        ->registerScriptFile($jsUrl . 'highcharts/modules/exporting.js',CClientScript::POS_END);
?>
<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
<script type="text/javascript">
        var modelChart = {
                options:{
                        title: {
                                text: '体重走势图',
                                x: -20 //center
                        },
                        subtitle: {
                                text: 'Source: WorldClimate.com',
                                x: -20
                        },
                        xAxis: {
                                categories: ['2015-07-01 14:31:50','2015-06-30 00:00:00','2015-06-29 00:00:00']
                        },
                        yAxis: {
                                title: {
                                        text: '重量 (kg)'
                                },
                                plotLines: [{
                                                value: 0,
                                                width: 1,
                                                color: '#808080'
                                        }]
                        },
                        tooltip: {
                                valueSuffix: '公斤'
                        },
                        legend: {
                                layout: 'vertical',
                                align: 'right',
                                verticalAlign: 'middle',
                                borderWidth: 0
                        },
                        series: [{
                                        name: 'zouliming',
                                        data: [88.50, 88.00, 89.00]
                                }]
                },
                fillData:function(){
                        var t = this;
                        $.get('/weight/apidata',function(rsp){
                                t.options.xAxis.categories = rsp.labels;
                                t.options.series[0].data = rsp.data;
                                $('#container').highcharts(t.options);
                        },'json');
                }
        };
        $(function(){
                modelChart.fillData();
        });
</script>