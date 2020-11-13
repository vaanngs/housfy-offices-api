<?php

declare(strict_types=1);

namespace Tests\Unit\Api\Domain\ValueObjs\Base;

use Api\Domain\ValueObjs\Event\EventPayload;
use PHPUnit\Framework\TestCase;

final class JsonTraitTest extends TestCase
{
    /** @var array */
    private $testArray;


    /**
     * @test
     */
    public function should_build_from_array()
    {
        $eventPayload = EventPayload::fromArray($this->testArray);

        self::assertIsArray($eventPayload->toArray());
        self::assertIsString($eventPayload->__toString());

        self::assertTrue($eventPayload->hasValues(['bar']));
        self::assertFalse($eventPayload->hasValues(['nobar']));
    }


    public function setUp(): void
    {
        $this->testArray = [
            'foo' => 'bar',
        ];

        parent::setUp();
    }
}
