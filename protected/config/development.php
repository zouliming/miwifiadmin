<?php

return array(
        'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
        'name' => 'm.viplux.com',
        'language' => 'zh_cn',
        // preloading 'log' component
        'preload' => array('log'),
        // autoloading model and component classes
        'import' => array(
                'application.models.*',
                'application.components.*',
                'application.extensions.*',
                'application.widgets.*',
                'application.extensions.redis.*'
        ),
        'modules' => array(
                'x',
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
                //'errorHandler' => array(
                        // use 'site/error' action to display errors
                        //'errorAction' => 'site/error',
                //),
                'db' => array(
                        'connectionString' => "mysql:host=10.199.168.255;dbname=vip_viplux",
                        'emulatePrepare' => true,
                        'username' => "vipshop",
                        'password' => "123456",
                        'charset' => 'utf8',
                ),
                'dbslave' => array(
                        'class'=>'CDbConnection',
                        'connectionString' => "mysql:host=10.199.168.255;dbname=vip_viplux",
                        'emulatePrepare' => true,
                        'username' => "vipshop",
                        'password' => "123456",
                        'charset' => 'utf8',
                ),
                'log' => array(
                        'class' => 'CLogRouter',
                        'routes' => array(
                                array(
                                        'class' => 'CFileLogRoute',
                                        'levels' => 'info,error, warning',
                                ),
                                array(
                                        'class' => 'CWebLogRoute',
                                ),
                        ),
                ),
                'cache' => array(
                        'class' => 'CMemCache',
                        'servers' => array(
                                array(
                                        'host' => "10.199.168.255",
                                        'port' => "11211",
                                )
                        )
                ),
                /*
                  "redis" => array(
                  "class" => "ext.redis.ARedisConnection",
                  "hostname" => "10.100.90.175",
                  "port" => 6379,
                  ),
                 */
                'filecache' => array(
                        'class' => 'system.caching.CFileCache',
                        //我们使用CFileCache实现缓存,缓存文件存放在runtime文件夹中
                        'directoryLevel' => '2', //缓存文件的目录深度
                ),
        ),
        'params' => array(
                'appid' => 10010,
                'mid' => 10010,
                'jsversion' => '20150312',
                'environment' => 'dist'
        )
);
