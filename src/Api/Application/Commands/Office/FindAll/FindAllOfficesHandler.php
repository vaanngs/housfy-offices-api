<?php

declare(strict_types=1);

namespace Api\Application\Commands\Office\FindAll;

use Api\Application\Service\CacheService;
use Api\Domain\Service\Finders\Office\OfficeFinderInterface;
use Api\Domain\Shared\Param;
use Api\Infrastructure\RabbitMQ\RabbitMqMessage;

final class FindAllOfficesHandler
{
    /** @var OfficeFinderInterface */
    private $finder;

    /** @var CacheService */
    private $cacheService;


    /**
     * @param OfficeFinderInterface $finder
     * @param CacheService $cacheService
     */
    public function __construct(
        OfficeFinderInterface $finder,
        CacheService $cacheService
    ) {
        $this->finder       = $finder;
        $this->cacheService = $cacheService;
    }


    /**
     * @param FindAllOfficesCommand $command
     * @return iterable
     */
    public function __invoke(FindAllOfficesCommand $command): iterable
    {
        $cacheKey = $this->buildCacheKey();
        $offices  = $this->cacheService->find($cacheKey);

        if (!empty($offices)) {
            return $offices;
        }

        $offices = $this->finder->findAll();

        $result = [];
        foreach ($offices as $office) {
            $result[] = $office->toRender();
        }

        $this->cacheService->enQueue(new RabbitMqMessage([
            Param::CACHE_KEY   => $cacheKey,
            Param::CACHE_VALUE => $result,
            Param::CACHE_TTL   => CacheService::FIVE_MINUTES_TTL,
        ]));

        return $result;
    }


    /**
     * @return string
     */
    private function buildCacheKey(): string
    {
        $classPathName = strtolower(str_replace('Handler', '', static::class));
        $classNamePos  = strrpos($classPathName, '\\');

        return substr($classPathName, $classNamePos + 1);
    }
}
