<?php

declare(strict_types=1);

namespace Api\Domain\Event\Shared;

interface EventInterface
{
    public function serialize(): string;

    public static function eventName(): string;
}
