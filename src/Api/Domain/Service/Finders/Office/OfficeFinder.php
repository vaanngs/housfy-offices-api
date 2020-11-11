<?php

declare(strict_types=1);

namespace Api\Domain\Service\Finders\Office;

use Api\Domain\Entities\Office;
use Api\Domain\ReadModel\OfficeRepositoryInterface;
use Api\Domain\Specification\Factory\Office\OfficeSpecificationFactoryInterface;
use Ramsey\Uuid\UuidInterface;

final class OfficeFinder implements OfficeFinderInterface
{

    /** @var OfficeSpecificationFactoryInterface */
    private $officeSpecFactory;

    /** @var OfficeRepositoryInterface */
    private $repository;


    /**
     * @param OfficeSpecificationFactoryInterface $officeSpecFactory
     * @param OfficeRepositoryInterface $repository
     */
    public function __construct(
        OfficeSpecificationFactoryInterface $officeSpecFactory,
        OfficeRepositoryInterface $repository
    )
    {
        $this->officeSpecFactory = $officeSpecFactory;
        $this->repository        = $repository;
    }


    /** @inheritDoc */
    public function findByUuid(UuidInterface $uuid): ?Office
    {
        $specification = $this->officeSpecFactory->createForFindWithUuid($uuid);

        return $this->repository->getOneOrNull($specification);
    }
}