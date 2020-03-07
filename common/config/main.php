<?php
return [
    'aliases'    => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache'       => [
            'class' => 'yii\caching\FileCache',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'mailer'      => [
            'class'            => 'yii\swiftmailer\Mailer',
            'viewPath'         => '@app/mail',
            'htmlLayout'       => 'layouts/html',
            'textLayout'       => 'layouts/text',
            'useFileTransport' => true, //for debug
            'messageConfig'    => [
                'charset' => 'UTF-8',
                'from'    => ['noreply@test.test' => 'test'],
            ],
        ],
        'i18n'                => [
            'translations' => [
                'app*' => [
                    'class'    => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                ],
            ],
        ],
    ],
    'timeZone'   => 'Asia/Novosibirsk',
    'language'   => 'ru-RU',
];
