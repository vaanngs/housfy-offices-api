<?php

declare(strict_types=1);

namespace Api\Application\Commands\Office\Create;

use Api\Domain\Entities\Office;
use Throwable;

final class CreateOfficeHandler
{

    /**
     * @param CreateOfficeCommand $command
     * @return iterable
     * @throws Throwable
     */
    public function __invoke(CreateOfficeCommand $command)
    {
        return Office::create(
            $command->getName(),
            $command->getAddress()
        )->toRender();
    }
}