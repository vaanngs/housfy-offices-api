<?php

declare(strict_types=1);

namespace Api\Domain\Entities\Shared;

use Api\Domain\Event\DomainEvent;
use Api\Domain\Event\Shared\EventInterface;

abstract class EntityEvent
{
    public function publish(EventInterface $event): void
    {
        DomainEvent::instance()->publish($event, $this);
    }
}