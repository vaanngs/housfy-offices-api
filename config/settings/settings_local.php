<?php

declare(strict_types=1);

return [
    'settings' => [
        'app_env'             => $_ENV['APP_ENV'],
        'displayErrorDetails' => $_ENV['APP_DEBUG'], // set to false in production


        'doctrine' => [
            'dev_mode'     => true,
            'cache_dir'    => __DIR__ . '/../../var/cache/doctrine/orm',
            'metadata_dir' => __DIR__ . '/../mapping/orm',
            'proxy_dir'    => __DIR__ . '/../../var/cache/doctrine/proxy',
            'connection'   => [
                'housfy_offices' => [
                    'driver'  => 'pdo_mysql',
                    'url'     => 'mysql://housfy:h0usfy@local_housfy_mariadb/housfy',
                    'charset' => 'utf8',
                ],
            ],
        ],

        'redis' => [
            'scheme' => 'tcp',
            'host'   => $_ENV['REDIS_HOST'],
            'port'   => 6379,
            'prefix' => 'housfy:offices:'
        ],
    ],
];
