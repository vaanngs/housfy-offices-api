<?php

declare(strict_types=1);

namespace Api\Domain\ValueObjs\Office;

use Api\Domain\ValueObjs\Base\VarcharTrait;
use Throwable;

final class OfficeName
{
    const MAX_LENGTH = 75;

    use VarcharTrait;


    /**
     * @param string $name
     * @throws Throwable
     * @return OfficeName
     */
    public static function fromString(string $name): self
    {
        return self::fromStr($name);
    }
}
