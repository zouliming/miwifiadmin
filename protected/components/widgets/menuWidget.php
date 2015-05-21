<?php
class menuWidget extends CWidget {
        public static $menuConfig = array(
                array(
                        'class'=>'status',
                        'url'=>'/site/status',
                        'title'=>'路由状态',
                ),
                array(
                        'class'=>'manager',
                        'url'=>'#',
                        'title'=>'内容',
                ),
                array(
                        'class'=>'equipments',
                        'url'=>'/site/equipments',
                        'title'=>'设备',
                ),
                array(
                        'class'=>'index',
                        'url'=>'/site/index',
                        'title'=>'首页',
                ),
        );
        public function init() {
                //当视图中执行$this->beginWidget()时候会执行这个方法  
                //可以在这里进行查询数据操作                 
        }

        public function run() {
                //当视图中执行$this->endWidget()的时候会执行这个方法  
                //可以在这里进行渲染试图的操作，注意这里提到的视图是widget的视图  
                $url = Yii::app()->request->requestUri;
                $this->render('menu', array(
                        'url' => $url,
                ));
        }

}
