<?php
use \yii\web\Request;
$baseUrl = str_replace('/frontend/web', '', (new Request)->getBaseUrl());
/*$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);*/

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' =>['log',
        [
            'class' => 'common\components\LanguageSelector',
            'supportedLanguages' => ['en-UK', 'th-TH'], //กำหนดรายการภาษาที่ support หรือใช้ได้
        ]
    ],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        /*'request' => [
            'csrfParam' => '_csrf-frontend',
        ],*/
        'request' => [
            'baseUrl' => $baseUrl,
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'showScriptName' => false,   // Disable index.php
            'enablePrettyUrl' => true,   // Disable r= routes
            'enableStrictParsing' => true,
            'rules' => array(
                '' => 'site/index',
                // 'google73f535a0783b0f56.html' => 'site/google',
                // '<alias:index|story|homestay|cafe|restaurant|gallery|contact|sendnewsletter>' => 'site/<alias>',
                // 'accommodation' => 'accommodation/default/index',
                '<module:\w+>/<controller:\w+>/<action:\w+>' => '<module>/<controller>/<action>',

                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:[\w\-]+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:[\w\-]+>' => '<controller>/<action>',
            ),

        ],
    ],
   // 'params' => $params,
];
