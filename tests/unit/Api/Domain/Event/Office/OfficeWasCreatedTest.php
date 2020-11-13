<?php

declare(strict_types=1);

namespace Tests\Api\Domain\Event\Office;

use Api\Domain\Event\Office\OfficeWasCreated;
use Api\Domain\Event\Shared\EventInterface;
use PHPUnit\Framework\TestCase;
use Tests\Mock\FakeOfficeBuilder;

final class OfficeWasCreatedTest extends TestCase
{
    /**
     * @test
     */
    public function should_build_event()
    {
        $office = FakeOfficeBuilder::makeUpdate();

        $event  = new OfficeWasCreated($office);

        self::assertInstanceOf(OfficeWasCreated::class, $event);
        self::assertInstanceOf(EventInterface::class, $event);

        self::assertIsString($event->index());
        self::assertIsArray($event->payload());

        self::assertIsString($event->serialize());
        self::assertIsString($event::eventName());
    }
}
