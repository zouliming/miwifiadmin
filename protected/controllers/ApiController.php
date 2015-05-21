<?php

class ApiController extends Controller {

        public function filters() {
                return array(
                        //'accessControl', // perform access control for CRUD operations
                );
        }

        public function accessRules() {
                return array(
                        array('allow', // allow all users to perform 'index' and 'view' actions
                                'actions' => array('login'),
                                'users' => array('*'),
                        ),
                        array('allow', // allow authenticated user to perform 'create' and 'update' actions
                                'actions' => array('index', 'logout'),
                                'users' => array('@'),
                        ),
                        array('deny', // deny all users
                                'users' => array('*'),
                        ),
                );
        }

        public function actionLogin() {
                $password = $this->getPost('password');
                $identity = new UserIdentity('zouliming', $password);
                $identity->authenticate();
                if ($identity->errorCode === UserIdentity::ERROR_NONE) {
                        Yii::app()->user->login($identity);
                        echo json_encode(array(
                                'code' => 0,
                                'url' => '/site/index'
                        ));
                } else {
                        echo json_encode(array(
                                'code' => 1,
                        ));
                }
        }

        public function actionQos_info() {
                echo json_encode(array(
                        'code' => 0,
                        'status' => array('on' => 1),
                        'bind'=>array('download'=>0),
                        'url' => '/site/index'
                ));
        }

}
