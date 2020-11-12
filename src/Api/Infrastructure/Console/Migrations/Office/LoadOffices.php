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
use Tests\Mock\FakeOfficeBuilder;
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
        for ($counter = 50; $counter >= 0; $counter--) {
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

        // This office is created only for running Functional test
        Office::create(
            OfficeName::fromString("Office for Functional Testing"),
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