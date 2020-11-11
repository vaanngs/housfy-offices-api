<?php

declare(strict_types=1);

namespace Api\Application\Commands\Office\FindAll;

use Api\Domain\ReadModel\OfficeRepositoryInterface;

final class FindAllOfficesHandler
{

    /** @var OfficeRepositoryInterface */
    private $repository;


    /**
     * @param OfficeRepositoryInterface $repository
     */
    public function __construct(OfficeRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param FindAllOfficesCommand $command
     * @return iterable
     */
    public function __invoke(FindAllOfficesCommand $command): iterable
    {
        $result = [];
        
        foreach ($this->repository->findAll() as $office) {
            $result[] = $office->toRender();
        }

        return $result;
    }
}