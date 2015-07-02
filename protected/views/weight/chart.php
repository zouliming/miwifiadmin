<?php
$jsUrl = Util::getJsUrl();
Yii::app()->clientScript
        ->registerCoreScript('jquery')
        ->registerScriptFile($jsUrl . 'Chart.js');
?>
<canvas id="myChart" width="800" height="400"></canvas>
<script type="text/javascript">
        var modelChart = {
                data:{
                        labels: [],
                        datasets: [{
                                        fillColor : "rgba(220,220,220,0.5)",
                                        strokeColor : "rgba(220,220,220,1)",
                                        pointColor : "rgba(220,220,220,1)",
                                        pointStrokeColor : "#fff",
                                        data: []
                                }]
                },
                fillData:function(){
                        var t = this;
                        $.get('/weight/apidata',function(rsp){
                                t.data.labels = rsp.labels;
                                t.data.datasets[0].data = rsp.data;
                                var ctx = document.getElementById("myChart").getContext("2d");
                                var myNewChart = new Chart(ctx).Line(t.data);
                        },'json');
                }
        };
        
        $(function(){
                modelChart.fillData();
        });
</script>