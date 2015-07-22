<?php

class WeightController extends Controller {

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
//			'accessControl', // perform access control for CRUD operations
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
                        array('allow', // allow all users to perform 'index' and 'view' actions
                                'actions' => array('index', 'view', 'alldata','door','chart'),
                                'users' => array('*'),
                        ),
                        array('allow', // allow authenticated user to perform 'create' and 'update' actions
                                'actions' => array('create', 'update', 'add','highChart'),
                                'users' => array('@'),
                        ),
                        array('allow', // allow admin user to perform 'admin' and 'delete' actions
                                'actions' => array('admin', 'delete'),
                                'users' => array('admin'),
                        ),
                        array('deny', // deny all users
                                'users' => array('*'),
                        ),
                );
        }
        public function actionHighChart(){
                $this->render('highChart');
        }
        public function actionDoor() {
                $this->layout = "column2";
                //设置菜单
                $this->menu = array(
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
                $this->render('door',array(
                        'active'=>'addWeight'
                ));
        }

        public function actionApiData() {
                $list = Weight::model()->findAll();
                $result = array();
                foreach ($list as $k => $v) {
                        $result['labels'][] = $v['date'];
                        $result['data'][] = floatval($v['weight']);
                }
                echo json_encode($result);
        }

        public function actionAlldata() {
                $page = $this->getGet('page');
                $pageSize = $this->getGet('pageSize');
                $pageSize = $pageSize ? $pageSize : 5;
                $page = $page ? $page : 1;

                $c = Weight::model()->count();
                $dataProvider = new CActiveDataProvider('Weight', array(
                        'criteria' => array(
                                //'condition' => '',
                                'order' => 'id desc',
                        ),
                        'pagination' => array(
                                'currentPage' => intval($page - 1),
                                'pageSize' => $pageSize,
                        ),
                ));
                $list = $dataProvider->getData();
                echo CJSON::encode(Array(
                        'code' => 0,
                        'data' => array(
                                'count' => $c,
                                'list' => $list
                        ),
                ));
        }

        public function actionAdd() {
                $model = new Weight;

                $rp = array(
                        'code' => 0
                );
                // Uncomment the following line if AJAX validation is needed
                $this->performAjaxValidation($model);

                if (isset($_POST['Weight'])) {
                        $model->attributes = $_POST['Weight'];
                        $model->date = date('Y-m-d H:i:s');
                        if (!$model->save()) {
                                $rp['msg'] = "保存失败";
                        }
                }
                echo json_encode($rp);
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
                $model = new Weight;

                // Uncomment the following line if AJAX validation is needed
                // $this->performAjaxValidation($model);

                if (isset($_POST['Weight'])) {
                        $model->attributes = $_POST['Weight'];
                        if ($model->save())
                                $this->redirect(array('view', 'id' => $model->id));
                }

                $this->render('create', array(
                        'model' => $model,
                ));
        }

        /**
         * Updates a particular model.
         * If update is successful, the browser will be redirected to the 'view' page.
         * @param integer $id the ID of the model to be updated
         */
        public function actionUpdate($id) {
                $model = $this->loadModel($id);
                $rp = array(
                        'code' => 0
                );
                if (isset($_POST['Weight'])) {
                        $model->attributes = $_POST['Weight'];
                        if ($model->save()) {
                                
                        } else {
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
                        'code' => 0, //0代表成功
                        'msg' => ''
                );
                $model = $this->loadModel($id);
                if ($model->delete()) {
                        
                } else {
                        $rp['code'] = 1;
                        $rp['msg'] = "删除失败";
                }
                echo json_encode($rp);
        }

        /**
         * Lists all models.
         */
        public function actionChart() {
                $dataProvider = new CActiveDataProvider('Weight');
                $this->render('Chart', array(
                        'dataProvider' => $dataProvider,
                ));
        }

        /**
         * Manages all models.
         */
        public function actionAdmin() {
                $model = new Weight('search');
                $model->unsetAttributes();  // clear any default values
                if (isset($_GET['Weight']))
                        $model->attributes = $_GET['Weight'];

                $this->render('admin', array(
                        'model' => $model,
                ));
        }

        /**
         * Returns the data model based on the primary key given in the GET variable.
         * If the data model is not found, an HTTP exception will be raised.
         * @param integer $id the ID of the model to be loaded
         * @return Weight the loaded model
         * @throws CHttpException
         */
        public function loadModel($id) {
                $model = Weight::model()->findByPk($id);
                if ($model === null)
                        throw new CHttpException(404, 'The requested page does not exist.');
                return $model;
        }

        /**
         * Performs the AJAX validation.
         * @param Weight $model the model to be validated
         */
        protected function performAjaxValidation($model) {
                if (isset($_POST['ajax']) && $_POST['ajax'] === 'weight-form') {
                        echo CActiveForm::validate($model);
                        Yii::app()->end();
                }
        }

}
