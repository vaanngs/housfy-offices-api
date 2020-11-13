<?php

declare(strict_types=1);

namespace Api\Domain\ValueObjs\Office;

use Api\Domain\ValueObjs\Base\VarcharTrait;
use Throwable;

final class OfficeCity
{
    const MAX_LENGTH = 75;

    use VarcharTrait;


    /**
     * @param string $city
     * @throws Throwable
     * @return OfficeCity
     */
    public static function fromString(string $city): self
    {
        return self::fromStr($city);
    }
}
