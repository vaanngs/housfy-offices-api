<?php

declare(strict_types=1);

use Api\Domain\Event\DomainEventSubscriberInterface;
use Api\Infrastructure\Subscribers\PersistEntity;
use Psr\Container\ContainerInterface;

$container['PersistEntity'] = function (ContainerInterface $c): DomainEventSubscriberInterface {
    return new PersistEntity(
        $c['WriteModel']
    );
};