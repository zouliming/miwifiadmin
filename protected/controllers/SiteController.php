<?php

class SiteController extends Controller {

        public function filters() {
//                return array(
//                        'accessControl', // perform access control for CRUD operations
//                );
        }

        public function accessRules() {
                return array(
                        array('allow', // allow all users to perform 'index' and 'view' actions
                                'actions' => array('login', 'test', 'blank', 'status', 'index', 'equipments', 'content'),
                                'users' => array('*'),
                        ),
                        array('allow', // allow authenticated user to perform 'create' and 'update' actions
                                'actions' => array('indexView', 'logout'),
                                'users' => array('@'),
                        ),
                        array('deny', // deny all users
                                'users' => array('*'),
                        ),
                );
        }
        public function actionManage(){
                $this->layout = "column2";
                //二级菜单内容
                $this->asideMenu = array(
                        array(
                                'sub' => '一级菜单管理',
                                'children' => array(
                                        array(
                                                'title' => '查看内容',
                                                'href' => 'content',
                                                'url' => '/site/content',
                                        ),
                                        array(
                                                'title' => '没想好',
                                                'href' => '#',
                                                'url' => '#',
                                        )
                                )
                        ),
                        array(
                                'sub' => '二级菜单管理',
                                'children' => array(
                                        array(
                                                'title' => '没想好',
                                                'href' => '#',
                                                'url' => '#',
                                        ),
                                        array(
                                                'title' => '没想好',
                                                'href' => '#',
                                                'url' => '#',
                                        )
                                )
                        ),
                );
                $this->render('manage', array(
                ));
        }
        public function actionBlank() {
                $this->layout = "none";
                $this->render('blank');
        }
        //预览action
        public function actionPreview($view){
                $this->render($view);
        }

        public function actionIndex() {
                $this->layout = "column2";
                //二级菜单内容
                $this->asideMenu = array(
                        array(
                                'sub' => '路由器模块',
                                'children' => array(
                                        array(
                                                'title' => '查看内容',
                                                'href' => 'content',
                                                'url' => '/site/content',
                                        ),
                                        array(
                                                'title' => '没想好',
                                                'href' => '#',
                                                'url' => '#',
                                        )
                                )
                        ),
                        array(
                                'sub' => '系统设置',
                                'children' => array(
                                        array(
                                                'title' => '没想好',
                                                'href' => '#',
                                                'url' => '#',
                                        ),
                                        array(
                                                'title' => '没想好',
                                                'href' => '#',
                                                'url' => '#',
                                        )
                                )
                        ),
                );
                $this->render('index', array(
                ));
        }

        public function actionLogin() {
                $this->render('login');
        }

        public function actionLogout() {
                Yii::app()->user->logout();
                $this->redirect(Yii::app()->homeUrl);
        }
        
        //子页面
        public function actionContent() {
                $this->layout = "none";
                $this->render('content');
        }

        public function actionEquipments() {
                $this->layout = "column1";
                $this->render('equipments');
        }

        //路由状态
        public function actionStatus() {
                $this->layout = "column1";
                $this->render('status');
        }

        //view模块，以后会废弃
        public function actionIndexView() {
                $this->layout = "none";
                $this->render('indexView');
        }

        public function actionSetting() {
                $this->layout = "none";
                $this->render('setting');
        }

}
