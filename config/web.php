<?php

use app\modules\api\Api;
use yii\rest\UrlRule;

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'app\bootstrap\Bootstrap'],
    'controllerNamespace' => 'app\controllers',
    'defaultRoute' => 'site/index',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'modules' => [
        'api' => [
            'class' => Api::class,
        ]
    ],
    'components' => [
        'request' => [
            'enableCookieValidation' => false,
            'parsers' => ['application/json' => 'yii\web\JsonParser'],
        ],
        'response' => [
            'format' =>  \yii\web\Response::FORMAT_JSON
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => \yii\web\User::class,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
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
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                '' => 'site/index',
                ['class' => UrlRule::class, 'controller' => ['api/v1/post', 'api/v2/post'], 'only' => ['index', 'create', 'delete', 'update', 'view'], 'pluralize' => true],
                ['class' => UrlRule::class, 'controller' => ['api/v1/category', 'api/v2/category'], 'only' => ['index'], 'pluralize' => true],
            ],
        ]
    ],
    'params' => $params,
];

return $config;
