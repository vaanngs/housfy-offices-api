<?php

declare(strict_types=1);

namespace Tests\Api\Application\Commands\Office\Update;

use Api\Application\Commands\Office\Update\UpdateOfficeCommand;
use Api\Application\Commands\Office\Update\UpdateOfficeHandler;
use Api\Domain\Service\Finders\Office\OfficeFinderInterface;
use Api\Domain\ValueObjs\Office\OfficeAddress;
use Api\Domain\ValueObjs\Office\OfficeName;
use Mockery;
use PHPUnit\Framework\TestCase;
use Tests\Mock\FakeOfficeBuilder;
use Throwable;

final class UpdateOfficeHandlerTest extends TestCase
{
    /** @var OfficeFinderInterface */
    private $finder;


    /**
     * @test
     * @throws Throwable
     */
    public function should_update_an_office()
    {
        $fakeOffice        = FakeOfficeBuilder::makeCreate();
        $updatedFakeOffice = FakeOfficeBuilder::makeUpdate();

        $this->finder
            ->shouldReceive('findByUuid')
            ->once()
            ->andReturn($fakeOffice);

        $command = new UpdateOfficeCommand(
            $updatedFakeOffice->getUuid()->toString(),
            $updatedFakeOffice->getName()->toStr(),
            $updatedFakeOffice->getAddress()->toRender()
        );

        $handler = new UpdateOfficeHandler($this->finder);
        $stub    = $handler($command);

        self::assertTrue($stub);

        self::assertInstanceOf(OfficeName::class, $command->getName());
        self::assertInstanceOf(OfficeAddress::class, $command->getAddress());

        self::assertTrue($command->hasName());
        self::assertTrue($command->hasAddress());
    }


    /**
     * @test
     * @throws Throwable
     */
    public function should_return_false_when_office_uuid_does_not_exist()
    {
        $fakeOffice = FakeOfficeBuilder::makeCreate();

        $this->finder
            ->shouldReceive('findByUuid')
            ->once()
            ->andReturnNull();

        $command = new UpdateOfficeCommand(
            $fakeOffice->getUuid()->toString(),
            $fakeOffice->getName()->toStr(),
            $fakeOffice->getAddress()->toRender()
        );

        $handler = new UpdateOfficeHandler($this->finder);
        $stub    = $handler($command);

        self::assertFalse($stub);
    }



    public function setUp(): void
    {
        $this->finder     = Mockery::mock(OfficeFinderInterface::class);

        parent::setUp();
    }
}
