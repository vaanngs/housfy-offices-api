<?php

declare(strict_types=1);

namespace Api\Application\Service;

use Api\Domain\Event\Bus\MessageToEnqueueInterface;
use Api\Domain\Event\Bus\PublisherMessageInterface;
use Api\Domain\Service\Cache\CacheServiceInterface;
use Api\Domain\Shared\CacheInterface;
use Exception;

class CacheService implements CacheServiceInterface
{
    /** @var CacheInterface */
    private $cache;

    /** @var PublisherMessageInterface */
    private $publisher;


    /**
     * @param CacheInterface $cache
     * @param PublisherMessageInterface $publisher
     */
    public function __construct(
        CacheInterface $cache,
        PublisherMessageInterface $publisher
    ) {
        $this->cache     = $cache;
        $this->publisher = $publisher;
    }


    /** {@inheritdoc} */
    public function find(string $key)
    {
        return $this->cache->get($key);
    }


    /** {@inheritdoc} */
    public function save(string $key, array $values, int $ttl = self::FIVE_MINUTES_TTL)
    {
        $this->cache->set($key, $values, 'EX', $ttl);
    }


    /** {@inheritdoc} */
    public function delete(array $keys): int
    {
        return $this->cache->remove($keys);
    }

    /** {@inheritdoc} */
    public function enQueue(MessageToEnqueueInterface $message): bool
    {
        try {
            $this->publisher->publish($message);

            return true;
        } catch (Exception $exception) {
            return false;
        }
    }
}
