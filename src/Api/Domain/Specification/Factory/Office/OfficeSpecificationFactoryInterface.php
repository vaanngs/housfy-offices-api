<?php

declare(strict_types=1);

namespace Api\Domain\Specification\Factory\Office;

use Api\Domain\Specification\Factory\SpecificationFactoryInterface;
use Ramsey\Uuid\UuidInterface;

interface OfficeSpecificationFactoryInterface
{
    /**
     * @param UuidInterface $uuid
     * @return SpecificationFactoryInterface
     */
    public function createForFindWithUuid(UuidInterface $uuid): SpecificationFactoryInterface;
}
