<?php

return array(
        'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
        'name' => 'miwifiadmin.com',
        'language' => 'zh_cn',
        // preloading 'log' component
        'preload' => array('log'),
        // autoloading model and component classes
        'import' => array(
                'application.models.*',
                'application.components.*',
//        'application.extensions.*',
//        'application.widgets.*',
//        'application.extensions.redis.*'
        ),
        'modules' => array(
                'gii' => array(
                        'class' => 'system.gii.GiiModule',
                        'password' => 'zouliming',
                        // If removed, Gii defaults to localhost only. Edit carefully to taste.
                        'ipFilters' => array('127.0.0.1', '::1'),
                ),
        ),
        'defaultController' => 'site',
        // application components
        'components' => array(
                'user' => array(
                        // enable cookie-based authentication
                        'allowAutoLogin' => true,
                        'loginUrl' => array('site/login'),
                ),
                'session' => array(
                        'autoStart' => true,
                        'CookieParams' => array('domain' => '.zouliming.com')
                ),
                // uncomment the following to enable URLs in path-format
                'urlManager' => array(
                        'urlFormat' => 'path',
                        'showScriptName' => false, //注意false不要用引号括上
                        'rules' => array(
                                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                        ),
                ),
                'errorHandler' => array(
//            'errorAction' => 'site/error',
                ),
                'db' => array(
                        'connectionString' => "mysql:host=127.0.0.1;dbname=miwifiadmin",
                        'emulatePrepare' => true,
                        'username' => "root",
                        'password' => "",
                        'charset' => 'utf8',
                ),
                'log' => array(
                        'class' => 'CLogRouter',
                        'routes' => array(
                                array(
                                        'class' => 'CFileLogRoute',
                                        'levels' => 'info,error, warning',
                                ),
//                array(
//                    'class' => 'CWebLogRoute',
//                ),
                        ),
                ),
				/*
                'cache' => array(
                        'class' => 'CMemCache',
                        'servers' => array(
                                array(
                                        'host' => "10.199.168.255",
                                        'port' => "11211",
                                )
                        )
                ),*/
                /*
                  "redis" => array(
                  "class" => "ext.redis.ARedisConnection",
                  "hostname" => "10.100.90.175",
                  "port" => 6379,
                  ),
                 */
                'clientScript' => array(
                        'scriptMap' => array(
                                'jquery.js' => '/js/jquery-1.8.3.js',
                                'jquery.min.js' => '/js/jquery-1.8.3.js',
                                //'jquery-ui.min.js' => '/js/jquery-ui.js',
                                //'jquery-ui.js' => '/js/jquery-ui.js',
                                //'jquery-ui.css' => 'jquery-ui.css'
                        )
                ),
        ),
        'params' => array(
                //一级菜单
                'mainMenu' => array(
                        array(
                                'class' => 'index',
                                'url' => '/site/index',
                                'title' => '首页',
                        ),
                        array(
                                'class' => 'manage',
                                'url' => '/site/manage',
                                'title' => '后台设置',
                        ),
                        array(
                                'class' => 'status',
                                'url' => '/site/status',
                                'title' => '没用',
                        ),
                        array(
                                'class' => 'equipments',
                                'url' => '/site/equipments',
                                'title' => '设备',
                        ),
                        array(
                                'class' => 'weightdoor',
                                'url' => '/weight/door',
                                'title' => '体重模块',
                        ),
                )
        )
);
