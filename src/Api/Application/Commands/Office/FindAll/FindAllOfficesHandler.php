<?php

declare(strict_types=1);

namespace Api\Application\Commands\Office\FindAll;

use Api\Application\Service\CacheService;
use Api\Domain\Entities\Office;
use Api\Domain\ReadModel\OfficeRepositoryInterface;

final class FindAllOfficesHandler
{

    /** @var OfficeRepositoryInterface */
    private $repository;

    /** @var CacheService */
    private $cacheService;


    /**
     * @param OfficeRepositoryInterface $repository
     * @param CacheService $cacheService
     */
    public function __construct(
        OfficeRepositoryInterface $repository,
        CacheService $cacheService
    )
    {
        $this->repository   = $repository;
        $this->cacheService = $cacheService;
    }


    /**
     * @param FindAllOfficesCommand $command
     * @return iterable
     */
    public function __invoke(FindAllOfficesCommand $command): iterable
    {
        $result   = [];
        $cacheKey = $this->buildCacheKey();

        $offices = $this->cacheService->find($cacheKey);

        if (empty($cache)) {
            $offices = $this->repository->findAll();

            // todo publish to rabbitmq
            //$rabbimq->publish($cacheKey, $offices, CacheService::FIVE_MINUTES_TTL);
            //$this->cacheService->save();
        }

        /** @var Office $office */
        foreach ($offices as $office) {
            $result[] = $office->toRender();
        }

        return $result;
    }


    /**
     * @return string
     */
    private function buildCacheKey(): string
    {
        $classPathName = strtolower(str_replace('Handler', '', get_class($this)));
        $classNamePos  = strrpos($classPathName, '\\');

        return substr($classPathName, $classNamePos + 1);
    }
}