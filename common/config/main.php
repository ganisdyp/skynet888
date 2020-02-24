<?php
return [
    // 'language' => 'en',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'name' => 'Safebox Siam',
    'modules' => [
        'stat' => [
            'class' => akiraz2\stat\Module::class,
            'yandexMetrika' => [ // false by default
                'id' => 13788753,
                'params' => [
                    'clickmap' => true,
                    'trackLinks' => true,
                    'accurateTrackBounce' => true,
                    'webvisor' => true
                ]
            ],
            'googleAnalytics' => [ // false by default
                'id' => 'UA-151865490-1',
            ],
            'ownStat' => true, //false by default
            'ownStatCookieId' => 'yii2_counter_id', // 'yii2_counter_id' default
            'onlyGuestUsers' => true, // true default
            'countBot' => false, // false default
            'appId' => ['app-frontend'], // by default count visits only from Frontend App (in backend app we dont need it)
            'blackIpList' => [], // ['127.0.0.1'] by default

            'controllerMap' => [
                'dashboard' => [
                    'class' => 'akiraz2\stat\controllers\DashboardController',
                    'as access' => [
                        'class' => \yii\filters\AccessControl::class,
                        'rules' => [
                            [
                                'allow' => true,
                                'roles' => ['@'],
                                'matchCallback' => function () {
                                    return Yii::$app->user->identity->getId();
                                },
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'i18n' => [
            'translations' => [
                'common*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                ],
                'language*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                ],
                'frontend*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                ],
                'backend*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                ],
                'akiraz2/stat*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                ],
            ],
        ],

    ],
];
