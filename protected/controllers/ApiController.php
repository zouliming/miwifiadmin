<?php

class ApiController extends Controller {

	public function filters() {
		return array(//'accessControl', // perform access control for CRUD operations
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
		$username = $this->getPost("username");
		$password = $this->getPost('password');
		$logType = $this->getPost('logtype');
		$nonce = $this->getPost('nonce');
		$identity = new UserIdentity($username, $password,$logType,$nonce);
		$identity->authenticate();
		if($identity->errorCode === UserIdentity::ERROR_NONE) {
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

	//返回Qos的状态信息
	public function actionQos_info() {
		echo json_encode(array(
			'code' => 0,
			'band' => array(
				'upload' => 100,
				'download' => 100
			),
			'status' => array('on' => 1, 'mode' => 1),
			'bind' => array('download' => 0),
			'url' => '/site/index',
			'list' => array(
				array(
					'statistics' => array(
						'upspeed' => 100,
						'downspeed' => 100
					),
					'qos' => array(
						'upmax' => 100,
						'downmax' => 100,
						'upmaxper' => 100,
						'maxdownper=>100'
					),
					'ip' => '127.0.0.1',
					'mac' => '342343242',
					'name' => '怪我咯'
				),
				array(
					'statistics' => array(
						'upspeed' => 100,
						'downspeed' => 100
					),
					'qos' => array(
						'upmax' => 100,
						'downmax' => 100,
						'upmaxper' => 100,
						'maxdownper=>100'
					),
					'ip' => '127.0.0.1',
					'mac' => '342343242',
					'name' => '怪我咯'
				),
				array(
					'statistics' => array(
						'upspeed' => 100,
						'downspeed' => 100
					),
					'qos' => array(
						'upmax' => 100,
						'downmax' => 100,
						'upmaxper' => 100,
						'maxdownper=>100'
					),
					'ip' => '127.0.0.1',
					'mac' => '342343242',
					'name' => '怪我咯'
				)
			)
		));
	}

	//测速
	public function actionUploadspeed() {
		echo json_encode(array(
			'code' => 0,
			'bandwidth' => 100,
		));
	}

	public function actionNetspeed() {
		echo json_encode(array(
			'code' => 0,
			'bandwidth' => 180,
		));
	}

	public function actionSet_band() {
		echo json_encode(array(
			'code' => 0,
			'bandwidth' => 180,
		));
	}

	public function actionQos_mode() {
		echo json_encode(array(
			'code' => 0,
			'bandwidth' => 180,
		));
	}

	public function actionPassportBinded() {
		echo json_encode(array(
			'code'=>0,
			'info'=>array(
				'userId'=>'1',
				'miliaoIcon'=>'',
				'aliasNick'=>'小明'
			)
		));
	}

}
