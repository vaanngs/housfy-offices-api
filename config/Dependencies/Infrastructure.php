<?php

declare(strict_types=1);

use Api\Infrastructure\Cache\RedisCache;
use Psr\Container\ContainerInterface;

$container['RedisCache'] = function (ContainerInterface $c): RedisCache {
    return new RedisCache(
        $c['settings']['redis']
    );
};