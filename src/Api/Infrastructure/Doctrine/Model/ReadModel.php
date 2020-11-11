<?php

declare(strict_types=1);

namespace Api\Infrastructure\Doctrine\Model;

use Api\Domain\Shared\CacheInterface;
use Api\Infrastructure\Cache\AbstractCacheRepository;
use Api\Infrastructure\Cache\RedisCache;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder as OrmQueryBuilder;
use Doctrine\Persistence\ObjectRepository;

abstract class ReadModel extends AbstractCacheRepository
{

    /** @var string */
    protected $class;

    /** @var EntityManagerInterface */
    protected $entityManager;

    /** @var ObjectRepository */
    protected $repository;


    /**
     * @param EntityManagerInterface $entityManager
     * @param CacheInterface $cacheInt
     */
    public function __construct(EntityManagerInterface $entityManager, CacheInterface $cacheInt)
    {
        $this->entityManager = $entityManager;
        $this->repository    = $this->entityManager->getRepository($this->class);

        $cache               = new RedisCache($cacheInt->getConfig());

        parent::__construct($cache);

    }


    /**
     * @return OrmQueryBuilder
     */
    protected function createOrmQueryBuilder(): OrmQueryBuilder
    {
        return $this->entityManager->createQueryBuilder();
    }
}
