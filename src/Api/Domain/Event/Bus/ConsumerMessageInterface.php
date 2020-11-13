<?php

declare(strict_types=1);

namespace Api\Domain\Event\Bus;

use Closure;

interface ConsumerMessageInterface
{
    /**
     * @param Closure $callback
     */
    public function listenQueue(Closure $callback): void;
}
