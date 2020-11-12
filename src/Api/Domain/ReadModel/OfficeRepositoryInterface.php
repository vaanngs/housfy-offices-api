<?php

namespace Api\Domain\ReadModel;

use Api\Domain\Entities\Office;
use Api\Domain\Specification\Factory\SpecificationFactoryInterface;

interface OfficeRepositoryInterface
{

    /**
     * @return array
     */
    public function findAll(): array;


    /**
     * @param SpecificationFactoryInterface $specification
     * @return Office|null
     */
    public function getOneOrNull(SpecificationFactoryInterface $specification): ?Office;
}