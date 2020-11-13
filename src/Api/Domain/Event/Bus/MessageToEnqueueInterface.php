<?php

declare(strict_types=1);

namespace Api\Domain\Event\Bus;

interface MessageToEnqueueInterface
{
    public function getMessage();
}
