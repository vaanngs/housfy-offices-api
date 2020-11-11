<?php

namespace Api\Domain\Service\Finders\Office;

use Api\Domain\Entities\Office;
use Ramsey\Uuid\UuidInterface;

interface OfficeFinderInterface
{

    /**
     * @param UuidInterface $uuid
     * @return Office|null
     */
    public function findByUuid(UuidInterface $uuid): ?Office;
}