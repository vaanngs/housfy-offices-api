<?php

declare(strict_types=1);

namespace Api\Infrastructure\Cache;

use Api\Domain\Shared\CacheInterface;
use Exception;
use Throwable;

abstract class AbstractCacheRepository
{
    const DEFAULT_TTL = 120;

    /** @var CacheInterface */
    private $cache;


    public function __construct(CacheInterface $cache)
    {
        $this->cache = $cache;
    }


    /**
     * @param string $key
     * @return string
     * @throws Exception
     */
    public function makeCacheKey(string $key): string
    {
        return $key;
    }


    /**
     * @param string $key
     * @return mixed
     */
    public function findInCache(string $key)
    {
        return $this->cache->get($key);
    }


    /**
     * @param string $key
     * @param array  $values
     * @param int    $ttl
     */
    public function setCachedContent(string $key, array $values, int $ttl = RedisCache::TTL_1_DAY): void
    {
        $this->cache->set($key, $values, 'EX', $ttl);
    }


    /**
     * @param array $keys
     * @throws Throwable
     * @return int
     */
    public function removeCacheKey(array $keys): int
    {
        return $this->cache->remove($keys);
    }
}