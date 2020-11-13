<?php

declare(strict_types=1);

use Api\Application\Service\CacheService;
use Api\Domain\Service\Cache\CacheServiceInterface;
use Api\Domain\Service\Finders\Office\OfficeFinder;
use Api\Domain\Service\Finders\Office\OfficeFinderInterface;
use Psr\Container\ContainerInterface;

$container['OfficeFinder'] = function (ContainerInterface $c): OfficeFinderInterface {
    return new OfficeFinder(
        $c['OfficeSpecificationFactory'],
        $c['OfficeRepository']
    );
};

$container['CacheService'] = function (ContainerInterface $c): CacheServiceInterface {
    return new CacheService(
        $c['RedisCache'],
        $c['FindAllOfficesPublisher']
    );
};
