<?php
class menuWidget extends CWidget {
        public $menuConfig = array();
        public function init() {
                //当视图中执行$this->beginWidget()时候会执行这个方法  
                //可以在这里进行查询数据操作
                $this->menuConfig = Yii::app()->params['mainMenu'];
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
