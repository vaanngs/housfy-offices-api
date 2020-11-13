<?php

declare(strict_types=1);

namespace Tests\Unit\Api\Application\Commands\Cache;

use Api\Application\Commands\Cache\SaveInCacheCommand;
use Api\Application\Commands\Cache\SaveInCacheHandler;
use Api\Application\Service\CacheService;
use Api\Domain\Exceptions\CacheException;
use Mockery;
use PHPUnit\Framework\TestCase;

final class SaveInCacheHandlerTest extends TestCase
{
    /** @var CacheService */
    private $cacheService;


    /**
     * @test
     */
    public function should_save_in_cache()
    {
        $this->cacheService
            ->shouldReceive('save')
            ->once()
            ->andReturnNull();

        $command = new SaveInCacheCommand('example-key', [], 300);
        $handler = new SaveInCacheHandler($this->cacheService);

        $stub = $handler($command);

        self::assertTrue($stub);
    }


    /**
     * @test
     */
    public function should_not_save_on_cache_when_redis_is_not_available()
    {
        $this->cacheService
            ->shouldReceive('save')
            ->once()
            ->andThrow(Mockery::mock(CacheException::class));

        $command = new SaveInCacheCommand('example-key', [], 300);
        $handler = new SaveInCacheHandler($this->cacheService);

        $stub = $handler($command);

        self::assertFalse($stub);
    }


    public function setUp(): void
    {
        $this->cacheService = Mockery::mock(CacheService::class);

        parent::setUp();
    }
}
