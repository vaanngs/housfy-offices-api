<?php

declare(strict_types=1);

namespace Api\Infrastructure\Middleware;

use Closure;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

final class SlimLogger
{
    /**
     * @return Closure
     */
    public static function containerLoader(): Closure
    {
        return function (ContainerInterface $container): LoggerInterface {
            $settings = $container->get('settings')['logger'];
            $logger   = new Logger($settings['name']);
            $logger->pushProcessor(new UidProcessor());
            $logger->pushHandler(new StreamHandler($settings['path'], $settings['level']));

            return $logger;
        };
    }
}
