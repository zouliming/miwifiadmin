<?php
//$yii = dirname(__FILE__) . '/../yiiframework/yii.php';
$yii = dirname(__FILE__) . '/../yiiframework/yii.php';

//初始化为上线产品
$environment = 'production';

//开发模式，请改成develop，上线模式请改成production
/**
 * 修改部分
 */
defined('YII_MODE') or define('YII_MODE', 'development');

if(YII_MODE!='production'){
    defined('YII_DEBUG') or define('YII_DEBUG', true);
    $environment = 'development';
}

defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 3);

require_once($yii);
$config = dirname(__FILE__) . '/protected/config/' . $environment . '.php';

Yii::createWebApplication($config)->run();