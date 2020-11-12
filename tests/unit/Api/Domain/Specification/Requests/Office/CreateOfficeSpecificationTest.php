<?php

declare(strict_types=1);

namespace Tests\Api\Domain\Specification\Requests\Office;

use Api\Domain\Shared\Param;
use Api\Domain\Specification\Requests\Office\CreateOfficeSpecification;
use Exception;
use PHPUnit\Framework\TestCase;
use Tests\Mock\RequestFactory;
use Throwable;

final class CreateOfficeSpecificationTest extends TestCase
{

    /**
     * @test
     */
    public function should_satisfy_request()
    {
        $request = RequestFactory::make('POST', [
            Param::OFFICE_NAME => 'Office Name Test',
            Param::OFFICE_ADDRESS => [[
                Param::OFFICE_POSTALCODE   => '08840',
                Param::OFFICE_PROVINCE     => 'Barcelona',
                Param::OFFICE_CITY         => 'Gavà',
                Param::OFFICE_ADDRESS_LINE => 'Passeig Marítim, 15'
            ]]
        ]);

        $specification = new CreateOfficeSpecification();

        self::assertTrue($specification->isSatisfiedBy($request));
    }


    /**
     * @test
     * @throws Throwable
     */
    public function should_not_satisfy_request_with_invalid_params()
    {
        $request = RequestFactory::make('POST', [
            Param::OFFICE_ADDRESS => [[
                Param::OFFICE_POSTALCODE   => '08840',
                Param::OFFICE_PROVINCE     => 'Barcelona',
                Param::OFFICE_CITY         => 'Gavà',
                Param::OFFICE_ADDRESS_LINE => 'Passeig Marítim, 15'
            ]]
        ]);

        $specification = new CreateOfficeSpecification();

        self::assertFalse($specification->isSatisfiedBy($request));
    }
}