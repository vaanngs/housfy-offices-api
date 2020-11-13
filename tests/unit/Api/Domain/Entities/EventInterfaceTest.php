<?php

declare(strict_types=1);

namespace Tests\Unit\Api\Domain\Entities;

use Api\Domain\Event\Shared\EventInterface;

final class EventInterfaceTest implements EventInterface
{
    /** {@inheritdoc} */
    public function serialize(): string
    {
        return json_encode([]);
    }

    /** {@inheritdoc} */
    public static function eventName(): string
    {
        return 'Test Event';
    }
}
