<?php

declare(strict_types=1);

namespace Api\Domain\Shared;

interface CacheInterface
{
    /**
     * @param string $key
     * @param        $data
     * @param string $expireType
     * @param int    $ttl
     */
    public function set(string $key, $data, string $expireType, int $ttl): void;


    /**
     * @param string $key
     * @return mixed
     */
    public function get(string $key);


    /**
     * @param array $keys
     * @return int
     */
    public function remove(array $keys = []): int;
}
