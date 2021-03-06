<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';



$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [

        'stripe' => [
            'class' => 'ruskid\stripe\Stripe',
            'publishable_key' => "pk_test_51JDLmaSISJWf35jDgR8xNZ755rFHpX7g4QeLfkj4V4hxvY0lWPLiJDWKQ4UcRCdOV7BZvYJPme2tllbbTzxcs3Ou00nxey15G6",
            'privateKey' => "sk_test_51JDLmaSISJWf35jDJWsrrFMpk6obQSW8dMqcKOomt2tuoDPKRamVzmKw1jqKEFzZiO3GFCuWOL7YcDOjvSadSYD400fTE6B9fU",
            
            
        ],
 


        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'kcoRG97VyZLFsEHKu__8RFgtkiFWsAV0',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'transport' => [
             'class' => 'Swift_SmtpTransport',
             'host' => 'localhost',  // e.g. smtp.mandrillapp.com or smtp.gmail.com
             'username' => 'ahirkp1997@gmail.com',
             'password' => '9974245206',
             'port' => '587', // Port 25 is a very common port too
             'encryption' => 'tls', // It is often used, check your provider or mail server specs
         ],
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
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
        'db' => $db,

        'authManager' => [

            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['guest'],            // role based Authorization

        ],
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
