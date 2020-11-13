<?php

declare(strict_types=1);

namespace Tests\Api\Domain\Entities;

use Api\Domain\Entities\Office;
use PHPUnit\Framework\TestCase;
use Tests\Mock\FakeOfficeBuilder;

final class OfficeTest extends TestCase
{
    /**
     * @test
     */
    public function should_create_by_name_constructor()
    {
        self::assertInstanceOf(Office::class, FakeOfficeBuilder::makeCreate());
    }
}
