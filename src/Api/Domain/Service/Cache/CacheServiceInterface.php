<?php

namespace Api\Domain\Service\Cache;

interface CacheServiceInterface
{

    const FIVE_MINUTES_TTL = 300;
    const ONE_DAY_TTL      = 86400;
    const ONE_WEEK_TTL     = 604800;
    const ONE_MONTH_TTL    = 2629746;


    /**
     * @param string $key
     * @return mixed
     */
    public function find(string $key);


    /**
     * @param string $key
     * @param array  $values
     * @param int    $ttl
     * @return mixed
     */
    public function save(string $key, array $values, int $ttl = self::ONE_DAY_TTL);


    /**
     * @param array $keys
     * @return int
     */
    public function delete(array $keys): int;
}