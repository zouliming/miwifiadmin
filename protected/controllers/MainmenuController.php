<?php

class MainmenuController extends Controller {
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout = '//layouts/iframe';

	/**
	 * @return array action filters
	 */
	public function filters() {
		return array(
			//'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules() {
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions' => array('index', 'view'),
				'users' => array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions' => array('create', 'update'),
				'users' => array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions' => array('admin', 'delete'),
				'users' => array('admin'),
			),
			array('deny',  // deny all users
				'users' => array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate() {
		$model = new Mainmenu;
		$rp = array(
			'code'=>0
		);
		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Mainmenu'])) {
			$model->attributes = $_POST['Mainmenu'];
			if(!$model->save())
				$rp['msg'] = "保存失败";
		}
		echo json_encode($rp);
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id) {
		$model = $this->loadModel($id);
		$rp = array(
			'code'=>0
		);
		if(isset($_POST['Mainmenu'])) {
			$model->attributes = $_POST['Mainmenu'];
			if($model->save()){

			}else{
				$rp['msg'] = "保存失败";
			}
		}
		echo json_encode($rp);
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id) {
		$rp = array(
			'code' => 0,//0代表成功
			'msg' => ''
		);
		$model = $this->loadModel($id);
		$model->enable = 0;
		if($model->save()) {
		} else {
			$rp['code'] = 1;
			$rp['msg'] = "删除失败";
		}
		echo json_encode($rp);
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex() {
		$this->render('index', array(
		));
	}

	public function actionMenuInfo() {
		$dataProvider = new CActiveDataProvider('Mainmenu', array(
			'criteria' => array(
//				'condition' => '',
				'order' => 'id desc,enable asc',
			),
			'pagination' => array(
				'pageSize' => 5,
				'pageVar'=>'page'
			),
		));
		$data = $dataProvider->getData();
		echo CJSON::encode(Array(
			'code' => 0,
			'list' => $data,
		));
	}
	public function actionMenuCount(){
		$c = Mainmenu::model()->count();
		echo json_encode(array(
			'code'=>0,
			'itemCount'=>$c
		));
	}
	/**
	 * Manages all models.
	 */
	public function actionAdmin() {
		$model = new Mainmenu('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Mainmenu']))
			$model->attributes = $_GET['Mainmenu'];

		$this->render('admin', array(
			'model' => $model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Mainmenu the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id) {
		$model = Mainmenu::model()->findByPk($id);
		if($model === null)
			throw new CHttpException(404, 'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Mainmenu $model the model to be validated
	 */
	protected function performAjaxValidation($model) {
		if(isset($_POST['ajax']) && $_POST['ajax'] === 'mainmenu-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
