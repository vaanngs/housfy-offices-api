<?php

namespace Api\Domain\ReadModel;

use Api\Domain\Entities\Office;
use Api\Domain\Specification\Factory\SpecificationFactoryInterface;

interface OfficeRepositoryInterface
{

    /**
     * @return iterable
     */
    public function findAll(): iterable;


    /**
     * @param SpecificationFactoryInterface $specification
     * @return Office|null
     */
    public function getOneOrNull(SpecificationFactoryInterface $specification): ?Office;
}