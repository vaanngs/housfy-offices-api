<?php

declare(strict_types=1);

use Api\Domain\Event\DomainEvent;
use Api\Domain\Event\Office\OfficeWasCreated;
use Api\Domain\Event\Office\OfficeWasUpdated;

$domainEvent = DomainEvent::instance()
    ->addSubscribers(OfficeWasCreated::class, [
        $container['PersistEntity']
    ])
    ->addSubscribers(OfficeWasUpdated::class, [
        $container['PersistEntity']
    ]);