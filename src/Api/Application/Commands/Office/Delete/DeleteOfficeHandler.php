<?php

declare(strict_types=1);

namespace Api\Application\Commands\Office\Delete;

use Api\Domain\Service\Finders\Office\OfficeFinderInterface;
use Api\Domain\Shared\WriteModelInterface;

final class DeleteOfficeHandler
{

    /** @var OfficeFinderInterface */
    private $finder;

    /** @var WriteModelInterface */
    private $writeModel;


    /**
     * @param OfficeFinderInterface $finder
     * @param WriteModelInterface $writeModel
     */
    public function __construct(
        OfficeFinderInterface $finder,
        WriteModelInterface $writeModel
    )
    {
        $this->finder     = $finder;
        $this->writeModel = $writeModel;
    }


    /**
     * @param DeleteOfficeCommand $command
     * @return bool
     */
    public function __invoke(DeleteOfficeCommand $command): bool
    {
        $office = $this->finder->findByUuid($command->getUuid());

        if (!$office) {
            return false;
        }

        $this->writeModel->delete($office);

        return true;
    }
}