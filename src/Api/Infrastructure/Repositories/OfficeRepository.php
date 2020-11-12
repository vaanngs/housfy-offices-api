<?php

declare(strict_types=1);

namespace Api\Infrastructure\Repositories;

use Api\Domain\Entities\Office;
use Api\Domain\ReadModel\OfficeRepositoryInterface;
use Api\Domain\Specification\Factory\SpecificationFactoryInterface;
use Api\Infrastructure\Doctrine\Model\ReadModel;
use Doctrine\ORM\EntityManagerInterface;

final class OfficeRepository extends ReadModel implements OfficeRepositoryInterface
{

    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->class = Office::class;

        parent::__construct($entityManager);
    }


    /** @inheritDoc */
    public function findAll(): array
    {
        $builder = $this->createOrmQueryBuilder();

        $builder
            ->select(Office::ALIAS)
            ->from($this->class, Office::ALIAS);

        $query  = $builder->getQuery();
        $result = $query->getResult();

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