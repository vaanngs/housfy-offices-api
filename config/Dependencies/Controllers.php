<?php

declare(strict_types=1);

use Api\UI\Http\Controllers\Office\CreateOfficeController;
use Api\UI\Http\Controllers\Office\DeleteOfficeController;
use Api\UI\Http\Controllers\Office\GetAllOfficesController;
use Api\UI\Http\Controllers\Office\UpdateOfficeController;
use Psr\Container\ContainerInterface;

$container['GetAllOfficesController'] = function (ContainerInterface $c) {
    return new GetAllOfficesController(
        $c['CommandBus']
    );
};

$container['CreateOfficeController'] = function (ContainerInterface $c) {
    return new CreateOfficeController(
        $c['CommandBus'],
        $c['CreateOfficeSpecification']
    );
};

$container['UpdateOfficeController'] = function (ContainerInterface $c) {
    return new UpdateOfficeController(
        $c['CommandBus'],
        $c['UpdateOfficeSpecification']
    );
};

$container['DeleteOfficeController'] = function (ContainerInterface $c) {
    return new DeleteOfficeController(
        $c['CommandBus'],
        $c['DeleteOfficeSpecification']
    );
};