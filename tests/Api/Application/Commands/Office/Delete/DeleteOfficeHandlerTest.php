<?php

declare(strict_types=1);

namespace Tests\Api\Application\Commands\Office\Delete;

use Api\Application\Commands\Office\Delete\DeleteOfficeCommand;
use Api\Application\Commands\Office\Delete\DeleteOfficeHandler;
use Api\Domain\Service\Finders\Office\OfficeFinderInterface;
use Api\Domain\Shared\WriteModelInterface;
use Mockery;
use PHPUnit\Framework\TestCase;
use Tests\Mock\FakeOfficeBuilder;
use Throwable;

final class DeleteOfficeHandlerTest extends TestCase
{

    /** @var OfficeFinderInterface */
    private $finder;

    /** @var WriteModelInterface */
    private $repository;


    /**
     * @test
     * @throws Throwable
     */
    public function should_delete_an_office()
    {
        $fakeOffice = FakeOfficeBuilder::makeCreate();

        $this->finder
            ->shouldReceive('findByUuid')
            ->once()
            ->andReturn($fakeOffice);

        $this->repository
            ->shouldReceive('delete')
            ->once();

        $command = new DeleteOfficeCommand($fakeOffice->getUuid()->toString());
        $handler = new DeleteOfficeHandler($this->finder, $this->repository);
        $stub    = $handler($command);

        self::assertTrue($stub);
    }


    /**
     * @test
     * @throws Throwable
     */
    public function should_return_false_if_office_uuid_does_not_exist()
    {
        $fakeOffice = FakeOfficeBuilder::makeCreate();

        $this->finder
            ->shouldReceive('findByUuid')
            ->once()
            ->andReturnNull();

        $command = new DeleteOfficeCommand($fakeOffice->getUuid()->toString());
        $handler = new DeleteOfficeHandler($this->finder, $this->repository);
        $stub    = $handler($command);

        self::assertFalse($stub);
    }


    public function setUp(): void
    {
        $this->finder     = Mockery::mock(OfficeFinderInterface::class);
        $this->repository = Mockery::mock(WriteModelInterface::class);

        parent::setUp();
    }
}