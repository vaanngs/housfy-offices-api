<?php

declare(strict_types=1);

namespace Api\Infrastructure\Subscribers;

use Api\Domain\Entities\Event;
use Api\Domain\Event\DomainEventSubscriberInterface;
use Api\Domain\Event\Office\OfficeWasCreated;
use Api\Domain\Event\Shared\EventInterface;
use Api\Domain\Shared\WriteModelInterface;
use Exception;
use Ramsey\Uuid\Uuid;

final class PersistEntity implements DomainEventSubscriberInterface
{

    /** @var WriteModelInterface  */
    private $writeModel;


    /**
     * @param WriteModelInterface $writeModel
     */
    public function __construct(WriteModelInterface $writeModel)
    {
        $this->writeModel = $writeModel;
    }


    /**
     * @param EventInterface $event
     * @param object|null $entity
     * @throws Exception
     * @see OfficeWasCreated
     */
    public function handle($event, $entity): void
    {
        $this->persistEvent($event);
        $this->writeModel->save($entity);
    }


    /**
     * @param EventInterface $event
     * @throws Exception
     */
    private function persistEvent(EventInterface $event): void
    {
        $entityEvent = Event::create(Uuid::uuid4(), $event);
        $this->writeModel->save($entityEvent);
    }
}