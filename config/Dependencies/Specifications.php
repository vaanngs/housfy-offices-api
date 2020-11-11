<?php

declare(strict_types=1);

use Api\Domain\Specification\Factory\Office\OfficeSpecificationFactoryInterface;
use Api\Domain\Specification\Requests\Office\CreateOfficeSpecification;
use Api\Domain\Specification\Requests\Office\DeleteOfficeSpecification;
use Api\Domain\Specification\Requests\Office\UpdateOfficeSpecification;
use Api\Domain\Specification\Requests\RequestSpecificationInterface;
use Api\Infrastructure\Specification\Factory\ORM\OrmOfficeSpecificationFactory;
use Psr\Container\ContainerInterface;

// REQUESTS
$container['CreateOfficeSpecification'] = function (): RequestSpecificationInterface {
    return new CreateOfficeSpecification();
};

$container['UpdateOfficeSpecification'] = function (): RequestSpecificationInterface {
    return new UpdateOfficeSpecification();
};

$container['DeleteOfficeSpecification'] = function (): RequestSpecificationInterface {
    return new DeleteOfficeSpecification();
};




// FACTORIES
$container['OfficeSpecificationFactory'] = function (ContainerInterface $c): OfficeSpecificationFactoryInterface {
    return new OrmOfficeSpecificationFactory(
        $c['EntityManager']
    );
};