<?php

declare(strict_types=1);

namespace Tests\Api\Domain\Entities;

use Api\Domain\Entities\Office;
use PHPUnit\Framework\TestCase;
use Tests\Mock\FakeOfficeBuilder;

final class OfficeTest extends TestCase
{

    /** @var Office */
    private $office;


    /**
     * @test
     */
    public function should_create_by_name_constructor()
    {
        self::assertInstanceOf(Office::class, $this->office);
    }




    protected function setUp(): void
    {
        $this->office = FakeOfficeBuilder::makeCreate();

        parent::setUp();
    }
}