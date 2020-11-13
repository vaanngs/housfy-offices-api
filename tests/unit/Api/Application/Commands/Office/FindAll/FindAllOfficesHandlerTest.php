<?php

declare(strict_types=1);

namespace Tests\Api\Application\Commands\Office\FindAll;

use Api\Application\Commands\Office\FindAll\FindAllOfficesCommand;
use Api\Application\Commands\Office\FindAll\FindAllOfficesHandler;
use Api\Application\Service\CacheService;
use Api\Domain\Service\Finders\Office\OfficeFinderInterface;
use Mockery;
use PhpCsFixer\Tests\TestCase;
use Tests\Mock\FakeOfficeBuilder;

final class FindAllOfficesHandlerTest extends TestCase
{
    /** @var OfficeFinderInterface */
    private $finder;

    /** @var CacheService */
    private $cacheService;


    /**
     * @test
     */
    public function should_receive_all_offices_from_repository_and_then_cache_results()
    {
        $this->cacheService
            ->shouldReceive('find')
            ->once()
            ->andReturn([]);

        $this->finder
            ->shouldReceive('findAll')
            ->once()
            ->andReturn([FakeOfficeBuilder::makeCreate()]);

        $this->cacheService
            ->shouldReceive('enQueue')
            ->once()
            ->andReturnTrue();

        $command = new FindAllOfficesCommand();
        $handler = new FindAllOfficesHandler($this->finder, $this->cacheService);

        $stub = $handler($command);

        self::assertIsArray($stub);
    }


    /**
     * @test
     */
    public function should_receive_all_offices_from_cache()
    {
        $this->cacheService
            ->shouldReceive('find')
            ->once()
            ->andReturn([FakeOfficeBuilder::makeCreate()]);

        $command = new FindAllOfficesCommand();
        $handler = new FindAllOfficesHandler($this->finder, $this->cacheService);

        $stub = $handler($command);

        self::assertIsArray($stub);
    }


    public function setUp(): void
    {
        $this->finder       = Mockery::mock(OfficeFinderInterface::class);
        $this->cacheService = Mockery::mock(CacheService::class);

        parent::setUp();
    }
}
