<?php

declare(strict_types=1);

namespace Api\Domain\ValueObjs\Event;

use Api\Domain\ValueObjs\Base\VarcharTrait;
use Throwable;

final class EventName
{
    const MAX_LENGTH = 255;

    use VarcharTrait;


    /**
     * @param string $name
     * @throws Throwable
     * @return static
     */
    public static function fromString(string $name): self
    {
        return self::fromStr($name);
    }
}
