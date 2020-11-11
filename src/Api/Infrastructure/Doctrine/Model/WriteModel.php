<?php

declare(strict_types=1);

namespace Api\Infrastructure\Doctrine\Model;

use Api\Domain\Shared\WriteModelInterface;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;

class WriteModel implements WriteModelInterface
{

    /** @var EntityManagerInterface */
    private $manager;


    /**
     * @param EntityManagerInterface $manager
     */
    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }


    /** @inheritDoc */
    public function preSave($entity): void
    {
        $this->manager->persist($entity);
    }


    /** @inheritDoc */
    public function save($entity = null): void
    {
        if ($entity) {
            $this->preSave($entity);
        }

        $this->manager->flush();
    }


    /** @inheritDoc */
    public function update($entity = null): void
    {
        if ($entity) {
            $this->preSave($entity);
        }

        $this->manager->flush();
    }


    /** @inheritDoc */
    public function delete($entity): void
    {
        $this->manager->remove($entity);
        $this->manager->flush();
    }
}
