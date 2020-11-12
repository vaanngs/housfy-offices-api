<?php

declare(strict_types=1);

namespace Tests\Api\Domain\ValueObjs;

use Api\Domain\Exceptions\DateTimeException;
use Api\Domain\ValueObjs\Base\CreatedAt;
use DateTime;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;

final class CreatedAtTest extends TestCase
{
    /**
     * @test
     */
    public function should_build_with_valid_datetime_with_now_function()
    {
        $createdAt = CreatedAt::now();
        self::assertInstanceOf(CreatedAt::class, $createdAt);
        self::assertInstanceOf(DateTimeImmutable::class, $createdAt->toDateTime());
        self::assertIsString((string)$createdAt);
    }


    /**
     * @test
     */
    public function should_build_from_valid_string()
    {
        $createdAt = CreatedAt::fromStr('2020-01-24 07:00:00');
        self::assertInstanceOf(CreatedAt::class, $createdAt);
        self::assertInstanceOf(DateTimeImmutable::class, $createdAt->toDateTime());
        self::assertIsString((string)$createdAt);
    }


    /**
     * @test
     */
    public function shoudl_build_from_valid_datetime()
    {
        $createdAt = CreatedAt::fromDateTime(new DateTime());
        self::assertInstanceOf(CreatedAt::class, $createdAt);
        self::assertInstanceOf(DateTimeImmutable::class, $createdAt->toDateTime());
        self::assertIsString((string)$createdAt);
    }


    /**
     * @test
     * @throws DateTimeException
     */
    public function should_throw_an_exception_when_format_specified_is_not_valid()
    {
        self::expectException(DateTimeException::class);
        CreatedAt::fromStr('ertyuio');
    }


    /**
     * @test
     */
    public function should_return_true_when_check_valid_format()
    {
        self::assertTrue(CreatedAt::checkAssertionByFormat('2019-01-01', 'Y-m-d'));
    }
}