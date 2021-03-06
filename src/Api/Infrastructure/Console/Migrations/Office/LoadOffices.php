<?php

declare(strict_types=1);

namespace Api\Infrastructure\Console\Migrations\Office;

use Api\Domain\Entities\Office;
use Api\Domain\ValueObjs\Office\OfficeAddress;
use Api\Domain\ValueObjs\Office\OfficeAddressLine;
use Api\Domain\ValueObjs\Office\OfficeCity;
use Api\Domain\ValueObjs\Office\OfficeName;
use Api\Domain\ValueObjs\Office\OfficePostalcode;
use Api\Domain\ValueObjs\Office\OfficeProvince;
use Api\Infrastructure\Console\Migrations\MigrationInterface;
use Throwable;

final class LoadOffices implements MigrationInterface
{
    /**
     * @throws throwable
     *
     * If we want to fake Address data we could create new methods on
     * each Value Object to select a random value choice
     * @return iterable
     */
    public function load(): iterable
    {
        $result = [];
        for ($counter = 49; $counter > 0; --$counter) {
            $officeName    = OfficeName::fromString("Office Test {$counter}");
            $officeAddress = OfficeAddress::build(
                OfficePostalcode::fromString('08840'),
                OfficeProvince::fromString('Barcelona'),
                OfficeCity::fromString('Viladecans'),
                OfficeAddressLine::fromString("C/ Miramar, nº{$counter}")
            );

            $office   = Office::create($officeName, $officeAddress);
            $result[] = $office;
        }

        // This office is created only for running Functional test
        Office::create(
            OfficeName::fromString('Office for Functional Testing'),
            OfficeAddress::build(
                OfficePostalcode::fromString('08840'),
                OfficeProvince::fromString('Barcelona'),
                OfficeCity::fromString('Viladecans'),
                OfficeAddressLine::fromString("C/ Miramar, nº{$counter}")
            ),
            '002e4d13-a119-4cf4-a67b-11ef08c46088'
        );

        return $result;
    }
}
