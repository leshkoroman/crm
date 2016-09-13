<?php

return [
    'language' => 'ru-RU',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'db' => require(dirname(__FILE__) . '/database.php'),        
        'db2' => require(dirname(__FILE__) . '/merapoisk_settings.php'),
    ],
];
