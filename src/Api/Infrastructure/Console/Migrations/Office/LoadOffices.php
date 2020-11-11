<?php

declare(strict_types=1);

namespace Api\Infrastructure\Console\Migrations\Office;

use Api\Domain\Entities\Office;
use Api\Domain\ValueObjs\OfficeAddress;
use Api\Domain\ValueObjs\OfficeAddressLine;
use Api\Domain\ValueObjs\OfficeCity;
use Api\Domain\ValueObjs\OfficeName;
use Api\Domain\ValueObjs\OfficePostalcode;
use Api\Domain\ValueObjs\OfficeProvince;
use Api\Infrastructure\Console\Migrations\MigrationInterface;
use Throwable;

final class LoadOffices implements MigrationInterface
{

    /**
     * @return iterable
     * @throws Throwable
     *
     * If we want to fake Address data we could create new methods on
     * each Value Object to select a random value choice.
     */
    public function load(): iterable
    {
        $result = [];
        for ($counter = 51; $counter >= 1; $counter--) {
            $officeName    = OfficeName::fromString("Office Test {$counter}");
            $officeAddress = OfficeAddress::build(
                OfficePostalcode::fromString('08840'),
                OfficeProvince::fromString('Barcelona'),
                OfficeCity::fromString('Viladecans'),
                OfficeAddressLine::fromString("C/ Miramar, nº{$counter}")
            );

            $office = Office::create($officeName, $officeAddress);
            $result[] = $office;
        }

        return $result;
    }
}