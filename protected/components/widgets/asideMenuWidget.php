<?php

class asideMenuWidget extends CWidget {
    public $asideMenu = array();

    public function init() {
        //当视图中执行$this->beginWidget()时候会执行这个方法
        //可以在这里进行查询数据操作
    }
    protected function formatUrlMap(){
        $urlmap = array();
        if(!is_array($this->asideMenu)){
            $this->asideMenu = array();
        }
        foreach($this->asideMenu as $k=>$v){
            foreach($v['children'] as $menu){
                $urlmap[$menu['href']] = $menu['url'];
            }
        }
        return $urlmap;
    }

    public function run() {
        //当视图中执行$this->endWidget()的时候会执行这个方法
        //可以在这里进行渲染试图的操作，注意这里提到的视图是widget的视图
        //注意widget的视图是放在跟widget同级的views目录下面，例如下面的视图会放置在
        //  /<span style="font-family: Helvetica, Tahoma, Arial, sans-serif; font-size: 14px; line-height: 25.1875px;">components</span>/widgets/test/views/test.php
        $this->render('asideMenu', array(
            'menus' => $this->asideMenu,
            'urlMap'=>$this->formatUrlMap($this->asideMenu)
        ));
    }

}
