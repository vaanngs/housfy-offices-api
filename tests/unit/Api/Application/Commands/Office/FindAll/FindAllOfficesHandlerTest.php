<?php

declare(strict_types=1);

namespace Tests\Api\Application\Commands\Office\FindAll;

use Api\Application\Commands\Office\FindAll\FindAllOfficesCommand;
use Api\Application\Commands\Office\FindAll\FindAllOfficesHandler;
use Api\Domain\ReadModel\OfficeRepositoryInterface;
use Mockery;
use PhpCsFixer\Tests\TestCase;
use Tests\Mock\FakeOfficeBuilder;

final class FindAllOfficesHandlerTest extends TestCase
{

    private $repository;

    /**
     * @test
     */
    public function should_return_all_offices()
    {
        $this->repository
            ->shouldReceive('findAll')
            ->once()
            ->andReturn([FakeOfficeBuilder::makeCreate()]);

        $command = new FindAllOfficesCommand();
        $handler = new FindAllOfficesHandler($this->repository);
        $stub    = $handler($command);

        self::assertIsArray($stub);
    }


    public function setUp(): void
    {
        $this->repository = Mockery::mock(OfficeRepositoryInterface::class);

        parent::setUp();
    }
}