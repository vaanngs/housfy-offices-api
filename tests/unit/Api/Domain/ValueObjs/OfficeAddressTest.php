<?php

declare(strict_types=1);

namespace Tests\Api\Domain\ValueObjs;

use Api\Domain\ValueObjs\Office\OfficeAddress;
use Api\Domain\ValueObjs\Office\OfficeAddressLine;
use Api\Domain\ValueObjs\Office\OfficeCity;
use Api\Domain\ValueObjs\Office\OfficePostalcode;
use Api\Domain\ValueObjs\Office\OfficeProvince;
use PHPUnit\Framework\TestCase;

final class OfficeAddressTest extends TestCase
{
    /**
     * @test
     */
    public function should_create_from_name_constructor()
    {
        $address = OfficeAddress::build(
            OfficePostalcode::fromString('08840'),
            OfficeProvince::fromString('Barcelona'),
            OfficeCity::fromString('Gavà'),
            OfficeAddressLine::fromString('Av. Passeig Maritim, 105')
        );

        self::assertInstanceOf(OfficeAddress::class, $address);

        self::assertInstanceOf(OfficePostalcode::class, $address->getPostalcode());
        self::assertInstanceOf(OfficeProvince::class, $address->getProvince());
        self::assertInstanceOf(OfficeCity::class, $address->getCity());
        self::assertInstanceOf(OfficeAddressLine::class, $address->getAddressLine());

        self::assertIsString($address->getPostalcode()->__toString());
        self::assertIsString($address->getProvince()->__toString());
    }
}
