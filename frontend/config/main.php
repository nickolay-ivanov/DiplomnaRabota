<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
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
                    'class' => \yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'my-account' => 'site/my-account',
                'chat' => 'site/chat',
                'favourites' => 'site/favourites',
                'notifications' => 'site/notifications',
                'create-listing' => 'site/create-listing',
                'site/listing/<id:\d+>' => 'site/listing',
                'listing/<id:\d+>' => 'site/listing',
                'listing/0' => 'site/listing',
                'bookshelf/<username:\w+>' => 'site/user-listings',
                'edit-listing/<id:\d+>' => 'site/edit-listing',
            ],
        ],
        'assetManager' => [
            'basePath' => '@webroot/assets',
            'baseUrl' => '@web/assets',
        ],
        'fileStorage' => [
            'class' => 'yii\base\Component',
            'basePath' => '@webroot/uploads',
            'baseUrl' => '@web/uploads',
        ],
    ],
    'params' => $params,
];
