<?php

declare(strict_types=1);

namespace Api\Domain\ValueObjs\Office;

use Api\Domain\ValueObjs\Base\VarcharTrait;
use Throwable;

final class OfficeProvince
{
    const MAX_LENGTH = 75;

    use VarcharTrait;


    /**
     * @param string $province
     * @throws Throwable
     * @return OfficeProvince
     */
    public static function fromString(string $province): self
    {
        return self::fromStr($province);
    }
}
