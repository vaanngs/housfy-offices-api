<?php

declare(strict_types=1);

namespace Tests\Api\Domain\Event;

use Api\Domain\Event\DomainEvent;
use Api\Domain\Event\DomainEventSubscriberInterface;
use Api\Domain\Event\Shared\EventInterface;
use Api\Domain\Exceptions\DomainEventException;
use PHPUnit\Framework\TestCase;

class DomainEventTest extends TestCase implements DomainEventSubscriberInterface, EventInterface
{
    private $spyCounter = 0;


    /**
     * @test
     */
    public function it_should_satisfy_singleton_pattern()
    {
        $oneInstance  = DomainEvent::instance();
        $sameInstance = DomainEvent::instance();

        self::assertSame($sameInstance, $oneInstance);
    }


    /**
     * @test
     */
    public function it_should_throw_an_exception_when_trying_to_clone_instance()
    {
        $this->expectException(DomainEventException::class);

        $oneInstance  = DomainEvent::instance();

        $otherInstance = clone $oneInstance;
    }


    /**
     * @test
     */
    public function it_should_allow_to_add_and_remove_subscribers()
    {
        $publisher = DomainEvent::instance();
        $publisher->addSubscribers('*', [$this]);
        $publisher->removeSubscriber($this);

        self::assertTrue(true);
    }


    /**
     * @test
     */
    public function it_should_allow_remove_all_subscribers()
    {
        $publisher = DomainEvent::instance();
        $publisher->addSubscribers('*', [$this]);
        $publisher->removeAllSubscribers();

        self::assertTrue(true);
    }


    /**
     * @test
     */
    public function it_should_allow_publish_events()
    {
        $publisher = DomainEvent::instance();
        $publisher->addSubscribers('*', [$this]);
        $publisher->publish($this);

        self::assertSame(1, $this->spyCounter);
    }


    /**
     * {@inheritdoc}
     * @interface DomainEventSubscriberInterface
     */
    public function handle($event, $emitterObj): void
    {
        ++$this->spyCounter;
    }


    /**
     * @interface EventInterface
     */
    public function serialize(): string
    {
        return json_encode([]);
    }


    /**
     * @interface EventInterface
     */
    public static function eventName(): string
    {
        return 'TestEvent';
    }
}
