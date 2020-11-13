<?php

declare(strict_types=1);

namespace Api\Application\Commands\Cache;

use Api\Application\Commands\CommandInterface;

final class SaveInCacheCommand implements CommandInterface
{
    /** @var string */
    private $key;

    /** @var array */
    private $value;

    /** @var int */
    private $ttl;


    /**
     * @param string $key
     * @param string $value
     * @param int $ttl
     */
    public function __construct(
        string $key,
        array $value,
        int $ttl
    ) {
        $this->key   = $key;
        $this->value = $value;
        $this->ttl   = $ttl;
    }


    /**
     * @return string
     */
    public function getCacheKey(): string
    {
        return $this->key;
    }


    /**
     * @return array
     */
    public function getCacheValue(): array
    {
        return $this->value;
    }


    /**
     * @return int
     */
    public function getCacheTtl(): int
    {
        return $this->ttl;
    }
}
