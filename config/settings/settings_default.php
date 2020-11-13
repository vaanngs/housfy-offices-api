<?php

declare(strict_types=1);

use Monolog\Logger;

return [
    'settings' => [
        'displayErrorDetails'               => true, // set to false in production
        'addContentLengthHeader'            => false, // Allow the web server to send the content-length header
        'determineRouteBeforeAppMiddleware' => true,

        'logger' => [
            'name'  => 'housy',
            'path'  => 'php://stdout',
            'level' => Logger::INFO,
        ],

        'doctrine' => [
            'dev_mode'     => false,
            'cache_dir'    => __DIR__ . '/../../var/cache/doctrine/orm',
            'metadata_dir' => __DIR__ . '/../mapping/orm',
            'proxy_dir'    => __DIR__ . '/../../var/cache/doctrine/proxy',
            'connection'   => [
                'housfy_offices' => [
                    'driver'  => 'pdo_mysql',
                    'url'     => 'mysql://housfy:h0usfy@mariadb/housfy',
                    'charset' => 'utf8',
                ],
            ],
        ],

        'redis' => [
            'scheme' => 'tcp',
            'host'   => 'redis',
            'port'   => 6379,
            'prefix' => 'housfy:offices:',
        ],

        'rabbitMQ' => [
            'host'     => $_ENV['RABBIT_HOST'],
            'port'     => $_ENV['RABBIT_PORT'],
            'user'     => $_ENV['RABBIT_USER'],
            'pass'     => $_ENV['RABBIT_PASS'],
            'queues'   => [
                'findall-offices-query' => 'findall-offices-query',
            ],
        ],
    ],
];
