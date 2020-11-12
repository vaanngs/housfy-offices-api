<?php

declare(strict_types=1);

namespace Tests\Api\Domain\Specification\Requests\Office;

use Api\Domain\Shared\Param;
use Api\Domain\Specification\Requests\Office\DeleteOfficeSpecification;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use Tests\Mock\RequestFactory;
use Throwable;

final class DeleteOfficeSpecificationTest extends TestCase
{

    /**
     * @test
     */
    public function should_satisfy_request()
    {
        $request = RequestFactory::make('POST', [
            Param::UUID => Uuid::uuid4()->toString()
        ]);

        $specification = new DeleteOfficeSpecification();

        self::assertTrue($specification->isSatisfiedBy($request));
    }


    /**
     * @test
     */
    public function should_not_satisfy_request_when_uuid_is_invalid()
    {
        $request = RequestFactory::make('POST', [
            Param::UUID => 'this is not an uuid'
        ]);

        $specification = new DeleteOfficeSpecification();

        self::assertFalse($specification->isSatisfiedBy($request));
    }

    /**
     * @test
     * @throws Throwable
     */
    public function should_not_satisfy_request_when_uuid_is_empty()
    {
        $request = RequestFactory::make('POST', [
            Param::UUID => null
        ]);

        $specification = new DeleteOfficeSpecification();

        self::assertFalse($specification->isSatisfiedBy($request));
    }
}