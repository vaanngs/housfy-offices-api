<?php

declare(strict_types=1);

namespace Api\Infrastructure\Repositories;

use Api\Domain\Entities\Office;
use Api\Domain\ReadModel\OfficeRepositoryInterface;
use Api\Domain\Shared\CacheInterface;
use Api\Domain\Specification\Factory\SpecificationFactoryInterface;
use Api\Infrastructure\Doctrine\Model\ReadModel;
use Doctrine\ORM\EntityManagerInterface;

final class OfficeRepository extends ReadModel implements OfficeRepositoryInterface
{

    /**
     * @param EntityManagerInterface $entityManager
     * @param CacheInterface $cache
     */
    public function __construct(EntityManagerInterface $entityManager, CacheInterface $cache)
    {
        $this->class = Office::class;

        parent::__construct($entityManager, $cache);
    }


    /** @inheritDoc */
    public function findAll(): iterable
    {
        $cacheKey = $this->makeCacheKey('offices-find-all');
        $result   = $this->findInCache($cacheKey);

        if (!empty($result)) {
            return $result;
        }
        
        $builder = $this->createOrmQueryBuilder();

        $builder
            ->select(Office::ALIAS)
            ->from($this->class, Office::ALIAS);

        $query  = $builder->getQuery();
        $result = $query->getResult();

        $this->setCachedContent($cacheKey, $result, self::DEFAULT_TTL);

        return $result;
    }


    /** @inheritDoc */
    public function getOneOrNull(SpecificationFactoryInterface $specification): ?Office
    {
        $builder = $this->createOrmQueryBuilder();

        $builder
            ->select(Office::ALIAS)
            ->from($this->class, Office::ALIAS)
            ->where($specification->getConditions())
            ->setParameters($specification->getParameters());

        $query = $builder->getQuery();

        return $query->getOneOrNullResult();
    }
}