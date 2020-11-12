<?php

declare(strict_types=1);

namespace Api\Infrastructure\Doctrine\Model;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder as OrmQueryBuilder;
use Doctrine\Persistence\ObjectRepository;

abstract class ReadModel
{

    /** @var string */
    protected $class;

    /** @var EntityManagerInterface */
    protected $entityManager;

    /** @var ObjectRepository */
    protected $repository;


    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository    = $this->entityManager->getRepository($this->class);

        //$cache               = new RedisCache($cacheInt->getConfig());
    }


    /**
     * @return OrmQueryBuilder
     */
    protected function createOrmQueryBuilder(): OrmQueryBuilder
    {
        return $this->entityManager->createQueryBuilder();
    }
}
