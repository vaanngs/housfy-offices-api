<?php

declare(strict_types=1);

namespace Api\Domain\ValueObjs;

use Api\Domain\ValueObjs\Base\VarcharTrait;
use Throwable;

final class OfficeProvince
{

    const MAX_LENGTH = 75;

    use VarcharTrait;


    /**
     * @param string $province
     * @return OfficeProvince
     * @throws Throwable
     */
    public static function fromString(string $province): OfficeProvince
    {
        return self::fromStr($province);
    }
}