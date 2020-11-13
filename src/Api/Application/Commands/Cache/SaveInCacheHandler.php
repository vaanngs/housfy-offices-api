<?php

declare(strict_types=1);

namespace Api\Application\Commands\Cache;

use Api\Application\Service\CacheService;

final class SaveInCacheHandler
{
    /** @var CacheService */
    private $cacheService;


    /**
     * @param CacheService $cacheService
     */
    public function __construct(CacheService $cacheService)
    {
        $this->cacheService = $cacheService;
    }


    /**
     * @param SaveInCacheCommand $command
     * @return bool
     */
    public function __invoke(SaveInCacheCommand $command): bool
    {
        try {
            $this->cacheService->save(
                $command->getCacheKey(),
                $command->getCacheValue(),
                $command->getCacheTtl()
            );

            return true;
        } catch (\Exception $exception) {
            return false;
        }
    }
}
