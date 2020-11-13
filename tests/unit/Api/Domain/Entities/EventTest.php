<?php

declare(strict_types=1);

namespace Tests\Unit\Api\Domain\Entities;

use Api\Domain\Entities\Event;
use Api\Domain\ValueObjs\Event\EventName;
use Api\Domain\ValueObjs\Event\EventPayload;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class EventTest extends TestCase
{
    /**
     * @test
     */
    public function should_create_by_name_constructor()
    {
        $eventTest = new EventInterfaceTest();

        $event = Event::create(
            Uuid::uuid4(),
            $eventTest
        );

        self::assertInstanceOf(Event::class, $event);
        self::assertInstanceOf(UuidInterface::class, $event->getUuid());
        self::assertInstanceOf(EventName::class, $event->getName());
        self::assertInstanceOf(EventPayload::class, $event->getPayload());
    }
}
