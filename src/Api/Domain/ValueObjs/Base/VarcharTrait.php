<?php

declare(strict_types=1);

namespace Api\Domain\ValueObjs\Base;

use Assert\Assertion;
use Throwable;

trait VarcharTrait
{

    /** @var string  */
    protected $value;


    /**
     * @param string $string
     * @return self
     * @throws Throwable
     */
    protected static function fromStr(string $string): self
    {
        self::checkAssertion($string);

        $instance = new static();
        $instance->value = $string;

        return $instance;
    }


    /**
     * @param string $string
     * @return bool
     * @throws Throwable
     */
    public static function checkAssertion(string $string): bool
    {
        Assertion::notEmpty($string, 'Is empty');
        Assertion::string($string, 'Must be string');
        Assertion::maxLength($string, static::MAX_LENGTH, 'Is too long');

        return true;
    }


    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toStr();
    }


    /**
     * @return string
     */
    public function toStr(): string
    {
        return $this->value;
    }
}