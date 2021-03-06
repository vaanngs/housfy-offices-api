<?php

declare(strict_types=1);

namespace Api\Domain\ValueObjs\Base;

use Api\Domain\Exceptions\DateTimeException;
use Assert\Assertion;
use DateTime;
use DateTimeImmutable;
use Exception;
use Throwable;

trait DateTimeTrait
{
    /** @var DateTimeImmutable */
    private $dateTime;


    /**
     * @return static
     */
    public static function now(): self
    {
        return static::create();
    }


    /**
     * @param  string $time
     * @return static
     */
    public static function fromStr(string $time): self
    {
        return static::create($time);
    }


    /**
     * @param DateTime $dateTime
     * @return static
     */
    public static function fromDateTime(DateTime $dateTime): self
    {
        return static::create($dateTime->format(self::FORMAT));
    }


    /**
     * @param  string|DateTime $time
     * @return self
     */
    private static function create($time = ''): self
    {
        $instance = new static();

        try {
            $instance->dateTime = new DateTimeImmutable($time);
        } catch (Exception $e) {
            throw new DateTimeException($e->getMessage());
        }

        return $instance;
    }


    /**
     * @param string $time
     * @param string $format
     * @throws Throwable
     * @return bool
     */
    public static function checkAssertionByFormat(string $time, string $format): bool
    {
        Assertion::date($time, $format);

        return true;
    }


    /**
     * @param $format
     * @return string
     */
    public function toStr($format = self::FORMAT): string
    {
        return $this->dateTime->format($format);
    }


    /**
     * @return DateTimeImmutable
     */
    public function toDateTime(): DateTimeImmutable
    {
        return $this->dateTime;
    }


    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toStr();
    }


    protected function __construct()
    {
    }
}
