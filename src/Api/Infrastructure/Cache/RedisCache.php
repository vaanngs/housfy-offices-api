<?php

declare(strict_types=1);

namespace Api\Infrastructure\Cache;

use Api\Domain\Exceptions\CacheException;
use Api\Domain\Shared\CacheInterface;
use Exception;
use Predis\Client as RedisClient;
use Predis\ClientInterface;

final class RedisCache implements CacheInterface
{

    /** @var RedisClient|null  */
    private static $redis = null;

    /** @var bool */
    private $available;

    /** @var iterable */
    private $config;


    /**
     * @param iterable $config
     */
    public function __construct(iterable $config)
    {
        self::$redis     = $this->getRedisInstance($config);

        $this->config    = $config;
        $this->available = true;
    }


    /**
     * @param iterable $config
     * @return RedisClient
     */
    private function getRedisInstance(iterable $config): ClientInterface
    {
        if (null == self::$redis) {
            self::$redis = new RedisClient($config);
        }

        return self::$redis;
    }


    /** @inheritDoc */
    public function set(string $key, $data, string $expireType, int $ttl): void
    {
        try {
            if ($this->available) {
                self::$redis->set($key, serialize($data), $expireType, $ttl);
            }
        } catch (Exception $exception) {
            throw new CacheException('Redis not available', $exception->getCode());
        }
    }


    /** @inheritDoc */
    public function get(string $key)
    {
        try {
            if ($this->available) {
                $cached = self::$redis->get($key);
                if ($cached) {
                    return unserialize($cached);
                }
            }
        } catch (Exception $exception) {
            $this->available = false;
            throw new CacheException('Redis not available', $exception->getCode());
        }

        return null;
    }


    /** @inheritDoc */
    public function remove(array $keys = []): int
    {
        if (empty($keys)) {
            throw new CacheException('Empty array values to remove cache elements');
        }

        return self::$redis->del($keys);
    }


    /**
     * @return iterable
     */
    public function getConfig(): iterable
    {
        return $this->config;
    }
}