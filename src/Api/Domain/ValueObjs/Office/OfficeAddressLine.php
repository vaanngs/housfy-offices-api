<?php

declare(strict_types=1);

namespace Api\Domain\ValueObjs\Office;

use Api\Domain\ValueObjs\Base\VarcharTrait;
use Throwable;

final class OfficeAddressLine
{

    const MAX_LENGTH = 175;

    use VarcharTrait;


    /**
     * @param string $addresLine
     * @return OfficeAddressLine
     * @throws Throwable
     */
    public static function fromString(string $addresLine): OfficeAddressLine
    {
        return self::fromStr($addresLine);
    }
}