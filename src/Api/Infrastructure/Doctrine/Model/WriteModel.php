<?php

declare(strict_types=1);

namespace Api\Infrastructure\Doctrine\Model;

use Api\Domain\Shared\WriteModelInterface;
use Doctrine\ORM\EntityManagerInterface;

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


    /** {@inheritdoc} */
    public function preSave($entity): void
    {
        $this->manager->persist($entity);
    }


    /** {@inheritdoc} */
    public function save($entity = null): void
    {
        if ($entity) {
            $this->preSave($entity);
        }

        $this->manager->flush();
    }


    /** {@inheritdoc} */
    public function update($entity = null): void
    {
        if ($entity) {
            $this->preSave($entity);
        }

        $this->manager->flush();
    }


    /** {@inheritdoc} */
    public function delete($entity): void
    {
        $this->manager->remove($entity);
        $this->manager->flush();
    }
}
