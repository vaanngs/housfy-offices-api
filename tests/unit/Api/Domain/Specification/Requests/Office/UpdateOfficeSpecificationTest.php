<?php

declare(strict_types=1);

namespace Tests\Api\Domain\Specification\Requests\Office;

use Api\Domain\Shared\Param;
use Api\Domain\Specification\Requests\Office\UpdateOfficeSpecification;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use Tests\Mock\RequestFactory;
use Throwable;

final class UpdateOfficeSpecificationTest extends TestCase
{
    /**
     * @test
     */
    public function should_satisfy_request()
    {
        $request = RequestFactory::make('POST', [
            Param::UUID           => Uuid::uuid4()->toString(),
            Param::OFFICE_NAME    => 'Office Name Test',
            Param::OFFICE_ADDRESS => [[
                Param::OFFICE_POSTALCODE   => '08840',
                Param::OFFICE_PROVINCE     => 'Barcelona',
                Param::OFFICE_CITY         => 'Gavà',
                Param::OFFICE_ADDRESS_LINE => 'Passeig Marítim, 15',
            ]],
        ]);

        $specification = new UpdateOfficeSpecification();

        self::assertTrue($specification->isSatisfiedBy($request));
    }


    /**
     * @test
     * @throws Throwable
     */
    public function should_not_satisfy_request_when_uuid_is_invalid()
    {
        $request = RequestFactory::make('POST', [
            Param::UUID => 'this is not an uuid',
        ]);

        $specification = new UpdateOfficeSpecification();

        self::assertFalse($specification->isSatisfiedBy($request));
    }


    /**
     * @test
     * @throws Throwable
     */
    public function should_not_satisfy_request_when_uuid_is_empty()
    {
        $request = RequestFactory::make('POST', [
            Param::UUID => null,
        ]);

        $specification = new UpdateOfficeSpecification();

        self::assertFalse($specification->isSatisfiedBy($request));
    }
}
