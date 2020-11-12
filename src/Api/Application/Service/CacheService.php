<?php

declare(strict_types=1);

namespace Api\Application\Service;

use Api\Domain\Service\Cache\CacheServiceInterface;
use Api\Domain\Shared\CacheInterface;

final class CacheService implements CacheServiceInterface
{

    /** @var CacheInterface */
    private $cache;


    /**
     * @param CacheInterface $cache
     */
    public function __construct(CacheInterface $cache)
    {
        $this->cache = $cache;
    }


    /** @inheritDoc */
    public function find(string $key)
    {
        return $this->cache->get($key);
    }


    /** @inheritDoc */
    public function save(string $key, array $values, int $ttl = self::FIVE_MINUTES_TTL)
    {
        $this->cache->set($key, $values, 'EX', $ttl);
    }


    /** @inheritDoc */
    public function delete(array $keys): int
    {
        return $this->cache->remove($keys);
    }
}