<?php

declare(strict_types=1);

namespace Api\Domain\Entities;

use Api\Domain\Entities\Shared\EntityEvent;
use Api\Domain\Event\Shared\EventInterface;
use Api\Domain\ValueObjs\Event\EventName;
use Api\Domain\ValueObjs\Event\EventPayload;
use Ramsey\Uuid\UuidInterface;

final class Event extends EntityEvent
{

    const ALIAS = 'ev';

    /** @var UuidInterface */
    private $uuid;

    /** @var EventName */
    private $name;

    /** @var EventPayload */
    private $payload;


    /**
     * @param UuidInterface $uuid
     * @param EventInterface $event
     * @return Event
     * @throws
     */
    public static function create(UuidInterface $uuid, EventInterface $event): self
    {
        $instance = new static();

        $instance->uuid      = $uuid;
        $instance->name      = EventName::fromString($event::eventName());
        $instance->payload   = EventPayload::fromJson($event->serialize());

        return $instance;
    }


    /**
     * @return UuidInterface
     */
    public function getUuid(): UuidInterface
    {
        return $this->uuid;
    }


    /**
     * @return EventName
     */
    public function getName(): EventName
    {
        return $this->name;
    }


    /**
     * @return EventPayload
     */
    public function getPayload(): EventPayload
    {
        return $this->payload;
    }
}