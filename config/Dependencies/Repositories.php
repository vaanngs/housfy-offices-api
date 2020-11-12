<?php

declare(strict_types=1);

use Api\Domain\ReadModel\OfficeRepositoryInterface;
use Api\Infrastructure\Repositories\OfficeRepository;
use Psr\Container\ContainerInterface;

$container['OfficeRepository'] = function (ContainerInterface $c): OfficeRepositoryInterface {
    return new OfficeRepository(
        $c['EntityManager']
    );
};
