<?php

declare(strict_types=1);

namespace Api\Domain\Shared;

final class Param
{
    const UUID                = 'uuid';
    const OFFICE_NAME         = 'name';
    const OFFICE_ADDRESS      = 'address';
    const OFFICE_POSTALCODE   = 'postalcode';
    const OFFICE_PROVINCE     = 'province';
    const OFFICE_CITY         = 'city';
    const OFFICE_ADDRESS_LINE = 'address_line';

    const CACHE_KEY   = 'key';
    const CACHE_VALUE = 'value';
    const CACHE_TTL   = 'ttl';
}
