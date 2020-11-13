<?php

declare(strict_types=1);

namespace Tests\Unit\Api\Application\Service;

use Api\Application\Service\CacheService;
use Api\Domain\Event\Bus\PublisherMessageInterface;
use Api\Domain\Shared\CacheInterface;
use Api\Infrastructure\RabbitMQ\RabbitMqMessage;
use PHPUnit\Framework\TestCase;

final class CacheServiceTest extends TestCase
{
    /** @var CacheInterface */
    private $cache;

    /** @var PublisherMessageInterface */
    private $publisher;


    /**
     * @test
     */
    public function should_find()
    {
        $this->cache
            ->shouldReceive('get')
            ->once();

        $service = new CacheService($this->cache, $this->publisher);
        $service->find('example-key');

        self::assertInstanceOf(CacheService::class, $service);
    }


    /**
     * @test
     */
    public function should_save()
    {
        $this->cache
            ->shouldReceive('set')
            ->once();

        $service = new CacheService($this->cache, $this->publisher);
        $service->save('example-key', [], 300);

        self::assertInstanceOf(CacheService::class, $service);
    }


    /**
     * @test
     */
    public function should_delete()
    {
        $this->cache
            ->shouldReceive('remove')
            ->once();

        $service = new CacheService($this->cache, $this->publisher);
        $stub    = $service->delete(['example-key']);

        self::assertInstanceOf(CacheService::class, $service);
        self::assertIsInt($stub);
    }


    /**
     * @test
     */
    public function should_publish_message_in_queue()
    {
        $fakeMessage = \Mockery::mock(RabbitMqMessage::class);

        $this->publisher
            ->shouldReceive('publish')
            ->once();

        $service = new CacheService($this->cache, $this->publisher);
        $stub    = $service->enQueue($fakeMessage);

        self::assertInstanceOf(CacheService::class, $service);
        self::assertTrue($stub);
    }


    /**
     * @test
     */
    public function should_not_publish_message_in_queue_when_rabbit_is_not_available()
    {
        $fakeMessage = \Mockery::mock(RabbitMqMessage::class);

        $this->publisher
            ->shouldReceive('publish')
            ->once()
            ->andThrow(\Exception::class);

        $service = new CacheService($this->cache, $this->publisher);
        $stub    = $service->enQueue($fakeMessage);

        self::assertInstanceOf(CacheService::class, $service);
        self::assertFalse($stub);
    }



    public function setUp(): void
    {
        $this->cache     = \Mockery::mock(CacheInterface::class);
        $this->publisher = \Mockery::mock(PublisherMessageInterface::class);

        parent::setUp();
    }
}
