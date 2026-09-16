<?php
use kartik\datecontrol\Module;

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';
$routes = require __DIR__ . '/routes.php';

$config = [
    'id' => 'simasganteng-2-User',
    'name' => 'simasganteng 2.0',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'timeZone' => 'Asia/Jakarta',
    'language' => 'id-ID',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => env('APP_KEY'),
            'csrfParam' => '_csrf-app',
            'enableCsrfCookie'=>false,
            'enableCsrfValidation'=>true,
            'enableCookieValidation'=>true,
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'class' => 'yii\web\Session',
            'name' => 'bkpsdmd-brebeskab-app',
            'cookieParams' => ['httponly' => true, 'lifetime' => 3600],
            'timeout' => 3600, //session expire
            'useCookies' => true,
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => false,
            'identityCookie' => ['name' => '_identity-app', 'httpOnly' => true],
            'authTimeout' => 3600,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'viewPath' => '@app/mail',
            // send all mails to a file by default.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db['db1'],
        'db2' => $db['db2'],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => $routes,
        ],
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'thousandSeparator' => '.',
            'decimalSeparator' => ',',
            //'currencyCode' => 'Rp. ',
            'dateFormat' => 'php:d-m-Y',
            'datetimeFormat' => 'php:d-m-Y H:i:s',
            'timeFormat' => 'php:H:i:s',
            'nullDisplay' => '',
        ],
    ],
    'params' => $params,
    'as beforeRequest' => [  //if guest user access site so, redirect to login page.
        'class' => 'yii\filters\AccessControl',
        'rules' => [
            [
                'actions' => ['login', 'captcha'],
                'allow' => true,
                'roles' => ['?'],
            ],
            [
                'actions' => ['update-password'],
                'allow' => true,
                'roles' => ['@'],
                'matchCallback'=>function(){
                    return (
                        Yii::$app->user->identity->flag==0
                    );
                },
            ],
            [
                'allow' => true,
                'roles' => ['@'],
                /*'matchCallback'=>function(){
                    return (
                        Yii::$app->user->identity->flag==1
                    );
                },*/
            ],            
        ],
    ],
    'modules' => [
        'generator' => [
            'class' => 'app\modules\gen\Module',
            'allowedIPs' => ['127.0.0.1', '::1', '192.168.21.*', '*'],
        ],
        'sitampan' => [
            'class' => 'app\modules\sitampan\Sitampan',
        ],
        'datecontrol' =>  [
            'class' => 'kartik\datecontrol\Module',
            'displaySettings' => [
                Module::FORMAT_DATE => 'php:d F Y',
                Module::FORMAT_TIME => 'php:H:i',
                Module::FORMAT_DATETIME => 'php:d F Y H:i', 
            ],
            'saveSettings' => [
                Module::FORMAT_DATE => 'php:Y-m-d',
                Module::FORMAT_TIME => 'php:H:i:s',
                Module::FORMAT_DATETIME => 'php:Y-m-d H:i:s',
            ],
            'displayTimezone' => 'Asia/Jakarta',
            'autoWidget' => true,
            'ajaxConversion' => true,
            'autoWidgetSettings' => [
                Module::FORMAT_DATE => [
                    'type'=>3, 
                    'pluginOptions'=>[
                        'autoclose'=>true, 'todayHighlight' => true,
                    ]
                ], 
                Module::FORMAT_DATETIME => [
                    'type'=>3, 
                    'pluginOptions'=>[
                        'autoclose'=>true, 'todayHighlight' => true,
                    ]
                ], 
                Module::FORMAT_TIME => [
                    'type'=>3, 
                    'pluginOptions'=>[
                        'autoclose'=>true, 'todayHighlight' => true,
                    ]
                ], 
            ],
            'widgetSettings' => [
                Module::FORMAT_DATE => [
                    'class' => 'yii\jui\DatePicker', // example
                    'options' => [
                        'dateFormat' => 'php:d-M-Y',
                        'options' => ['class'=>'form-control'],
                    ],
                    'value'=>time(),
                ],
            ],
        ],
        'gridview' =>  [
            'class' => '\kartik\grid\Module',
        ],
    ],
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1', '192.168.21.*', '*'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '::1', '192.168.21.*', '*'],
    ];
}

return $config;
