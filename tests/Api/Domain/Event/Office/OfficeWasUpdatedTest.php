<?php

declare(strict_types=1);

namespace Tests\Api\Domain\Event\Office;

use Api\Domain\Event\Office\OfficeWasUpdated;
use Api\Domain\Event\Shared\EventInterface;
use PHPUnit\Framework\TestCase;
use Tests\Mock\FakeOfficeBuilder;

final class OfficeWasUpdatedTest extends TestCase
{

    /**
     * @test
     */
    public function should_build_event()
    {
        $oldOffice = FakeOfficeBuilder::makeCreate();
        $newOffice = FakeOfficeBuilder::makeUpdate();

        $event  = new OfficeWasUpdated($oldOffice, $newOffice);

        self::assertInstanceOf(OfficeWasUpdated::class, $event);
        self::assertInstanceOf(EventInterface::class, $event);

        self::assertIsString($event->index());
        self::assertIsArray($event->payload());
    }
}