<?php

declare(strict_types=1);

namespace Api\Application\Commands\Office\Update;

use Api\Domain\Service\Finders\Office\OfficeFinderInterface;

final class UpdateOfficeHandler
{

    /** @var OfficeFinderInterface */
    private $finder;


    /**
     * @param OfficeFinderInterface $finder
     */
    public function __construct(OfficeFinderInterface $finder)
    {
        $this->finder = $finder;
    }


    /**
     * @param UpdateOfficeCommand $command
     * @return bool
     */
    public function __invoke(UpdateOfficeCommand $command): bool
    {
        $office = $this->finder->findByUuid($command->getUuid());

        if (!$office) {
            return false;
        }

        $office->update($command->getParams());

        return true;
    }
}