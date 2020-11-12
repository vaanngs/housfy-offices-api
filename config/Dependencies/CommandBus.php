<?php

declare(strict_types=1);

use Api\Application\Commands\Office\Create\CreateOfficeHandler;
use Api\Application\Commands\Office\Delete\DeleteOfficeHandler;
use Api\Application\Commands\Office\FindAll\FindAllOfficesHandler;
use Api\Application\Commands\Office\Update\UpdateOfficeHandler;
use Api\Infrastructure\CommandBus\HousfyHandlerLocator;
use League\Tactician\CommandBus;
use League\Tactician\Handler\CommandHandlerMiddleware;
use League\Tactician\Handler\CommandNameExtractor\ClassNameExtractor;
use League\Tactician\Handler\MethodNameInflector\InvokeInflector;
use League\Tactician\Plugins\LockingMiddleware;
use Psr\Container\ContainerInterface;

$container['CommandBus'] = function (ContainerInterface $c): CommandBus {
    return new CommandBus([
        new LockingMiddleware(),
        new CommandHandlerMiddleware(
            new ClassNameExtractor(),
            new HousfyHandlerLocator($c),
            new InvokeInflector()
        ),
    ]);
};


$container['CreateOfficeHandler'] = function (ContainerInterface $c): CreateOfficeHandler {
    return new CreateOfficeHandler();
};

$container['FindAllOfficesHandler'] = function (ContainerInterface $c): FindAllOfficesHandler {
    return new FindAllOfficesHandler(
        $c['OfficeRepository'],
        $c['CacheService']
    );
};

$container['UpdateOfficeHandler'] = function (ContainerInterface $c): UpdateOfficeHandler {
    return new UpdateOfficeHandler(
        $c['OfficeFinder']
    );
};

$container['DeleteOfficeHandler'] = function (ContainerInterface $c): DeleteOfficeHandler {
    return new DeleteOfficeHandler(
        $c['OfficeFinder'],
        $c['WriteModel']
    );
};

