<?php
class SiteController extends Controller {
        public function filters() {
                return array(
                        'accessControl', // perform access control for CRUD operations
                );
        }
        public function accessRules() {
                return array(
                        array('allow', // allow all users to perform 'index' and 'view' actions
                                'actions' => array('login','test','blank','status','index'),
                                'users' => array('*'),
                        ),
                        array('allow', // allow authenticated user to perform 'create' and 'update' actions
                                'actions' => array('indexView','logout','content'),
                                'users' => array('@'),
                        ),
                        array('deny', // deny all users
                                'users' => array('*'),
                        ),
                );
        }
        public function actionBlank(){
                $this->layout = "none";
                $this->render('blank');
        }
        public function actionIndex(){
                $this->layout = "column2";
                $this->showSecondMenu = true;
                $this->render('index',array(
                        'asideMenuItems'=>array(
                                'aaa'=>'bbb'
                        )
                ));
        }
        //查看状态
        public function actionStatus(){
                $this->render('status');
        }
        //view模块，以后会废弃
        public function actionIndexView(){
                $this->layout = "none";
                $this->render('indexView');
        }
        public function actionContent(){
                $this->layout = "column1";
                $this->render('content');
        }
        public function actionLogin(){
                $this->render('login');
        }

        public function actionLogout(){
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}
