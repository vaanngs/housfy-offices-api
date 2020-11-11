<?php

declare(strict_types=1);

namespace Api\Domain\ValueObjs;

use Api\Domain\ValueObjs\Base\VarcharTrait;
use Throwable;

final class OfficeCity
{

    const MAX_LENGTH = 75;

    use VarcharTrait;


    /**
     * @param string $city
     * @return OfficeCity
     * @throws Throwable
     */
    public static function fromString(string $city): OfficeCity
    {
        return self::fromStr($city);
    }
}