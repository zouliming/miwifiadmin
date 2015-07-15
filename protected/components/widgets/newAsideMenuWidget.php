<?php

class newAsideMenuWidget extends CWidget {

        public $asideMenu = array();

        public function init() {
                //当视图中执行$this->beginWidget()时候会执行这个方法
                //可以在这里进行查询数据操作
                $this->asideMenu = array(
                        'chart' => array(
                                'label' => '体重走势图',
                                'href' => '/weight/chart'
                        ),
                        'addWeight' => array(
                                'label' => '记录体重',
                                'href' => '/weight/create'
                        ),
                        'highchart' => array(
                                'label' => 'HighChart走势图',
                                'href' => '/weight/highchart'
                        ),
                );
        }

        public function run() {
                $this->render('newAsideMenu', array(
                        'menu' => $this->asideMenu,
                ));
        }

}
