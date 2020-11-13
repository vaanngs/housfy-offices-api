<?php

declare(strict_types=1);

namespace Api\Application\Commands\Office\Create;

use Api\Domain\Entities\Office;
use Throwable;

final class CreateOfficeHandler
{
    /**
     * @param CreateOfficeCommand $command
     * @throws Throwable
     * @return iterable
     */
    public function __invoke(CreateOfficeCommand $command)
    {
        return Office::create(
            $command->getName(),
            $command->getAddress()
        )->toRender();
    }
}
