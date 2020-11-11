<?php

declare(strict_types=1);

namespace Api\Domain\Event;

use Api\Domain\Event\Shared\EventInterface;

interface DomainEventSubscriberInterface
{
    /**
     * @param EventInterface $event
     * @param object|null    $emitterObj
     */
    public function handle($event, $emitterObj): void;
}
