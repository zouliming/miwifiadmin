<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController {

        /**
         * @var string the default layout for the controller view. Defaults to 'column1',
         * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
         */
        public $layout = 'none';

        /**
         * @var array context menu items. This property will be assigned to {@link CMenu::items}.
         */
        public $menu = array();

        /**
         * @var array the breadcrumbs of the current page. The value of this property will
         * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
         * for more details on how to specify this property.
         */
        public $breadcrumbs = array();
        public $asideMenu = array();
        protected $request = array();

        public function __construct($id, $module = null) {
                $this->trimRequest();
                parent::__construct($id, $module);
        }

        //过滤参数的前后空格
        private function trimParam($param) {
                $r = array();
                if (is_array($param)) {
                        foreach ($param as $k => $v) {
                                $r[$k] = $this->trimParam($v);
                        }
                        return $r;
                } else {
                        return trim($param);
                }
        }

        public function trimRequest() {
                $this->request['post'] = $this->trimParam($_POST);
                $this->request['get'] = $this->trimParam($_GET);
        }

        protected function getPost($param = null) {
                if ($param === null) {
                        return $this->request['post'];
                } else {
                        return $this->request['post'][$param];
                }
        }

        protected function getGet($param = null) {
                if ($param === null) {
                        return $this->request['get'];
                } else {
                        return $this->request['get'][$param];
                }
        }

        protected function isPost() {
                return Yii::app()->request->requestType == 'POST';
        }

}
