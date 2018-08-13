<?php

use app\modules\api\Api;
use yii\rest\UrlRule;

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'app\bootstrap\Bootstrap'],
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
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'K0Rly-7FP6bfx2WcmHG447aR0qVbz7Ud',
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
                ['class' => UrlRule::class, 'controller' => ['api/v1/post', 'api/v2/post'], 'only' => ['index', 'create', 'delete', 'update', 'view'], 'pluralize' => true],
                ['class' => UrlRule::class, 'controller' => 'api/[v1|v2]/category', 'only' => ['index'], 'pluralize' => true],
            ],
        ]
    ],
    'params' => $params,
];

return $config;
