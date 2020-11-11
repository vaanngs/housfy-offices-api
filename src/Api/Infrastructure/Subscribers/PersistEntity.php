<?php

declare(strict_types=1);

namespace Api\Infrastructure\Subscribers;

use Api\Domain\Event\DomainEventSubscriberInterface;
use Api\Domain\Event\Office\OfficeWasCreated;
use Api\Domain\Event\Shared\EventInterface;
use Api\Domain\Shared\WriteModelInterface;

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
     * @see OfficeWasCreated
     */
    public function handle($event, $entity): void
    {
        $this->writeModel->save($entity);
    }
}