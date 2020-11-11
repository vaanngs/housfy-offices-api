<?php

declare(strict_types=1);

namespace Api\Domain\ValueObjs\Base;

class CreatedAt
{
    const FORMAT = 'Y-m-d H:i:s.uP';

    use DateTimeTrait;
}
