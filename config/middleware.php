<?php

declare(strict_types=1);

use Api\Infrastructure\Middleware\LoggerMiddleware;
use Slim\HttpCache\Cache;

$app->add(new Cache('public', 86400));
#$app->add(new LoggerMiddleware($container['Logger']));
