<?php

declare(strict_types=1);

namespace Tests\Mock;

use Api\Domain\Entities\Office;
use Api\Domain\ValueObjs\OfficeAddress;
use Api\Domain\ValueObjs\OfficeAddressLine;
use Api\Domain\ValueObjs\OfficeCity;
use Api\Domain\ValueObjs\OfficeName;
use Api\Domain\ValueObjs\OfficePostalcode;
use Api\Domain\ValueObjs\OfficeProvince;
use Throwable;

final class FakeOfficeBuilder
{

    /**
     * @return Office
     * @throws Throwable
     */
    public static function makeCreate()
    {
        return Office::create(
            OfficeName::fromString('Office Fake Name'),
            OfficeAddress::build(
                OfficePostalcode::fromString('08840'),
                OfficeProvince::fromString("Barcelona"),
                OfficeCity::fromString('Gavà'),
                OfficeAddressLine::fromString('Av. Passeig Maritim, 105')
            )
        );
    }


    /**
     * @return Office
     * @throws Throwable
     */
    public static function makeUpdate()
    {
        return Office::create(
            OfficeName::fromString('Office Fake Name Updated'),
            OfficeAddress::build(
                OfficePostalcode::fromString('08841'),
                OfficeProvince::fromString("Barcelona Updated"),
                OfficeCity::fromString('Gavà Updated'),
                OfficeAddressLine::fromString('Av. Passeig Maritim, 105 Updated')
            )
        );
    }
}