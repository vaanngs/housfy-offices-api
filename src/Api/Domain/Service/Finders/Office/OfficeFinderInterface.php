<?php

declare(strict_types=1);

namespace Api\Domain\Service\Finders\Office;

use Api\Domain\Entities\Office;
use Ramsey\Uuid\UuidInterface;

interface OfficeFinderInterface
{
    /**
     * @return iterable
     */
    public function findAll(): iterable;


    /**
     * @param UuidInterface $uuid
     * @return Office|null
     */
    public function findByUuid(UuidInterface $uuid): ?Office;
}
