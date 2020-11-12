<?php

declare(strict_types=1);

namespace Api\Domain\ValueObjs\Office;

use Assert\Assertion;
use Throwable;

final class OfficePostalcode
{

    const POSTAL_CODE_PATTERN = '~^\d{5}$~';

    /** @var string */
    private $postalcode;


    /**
     * @param string $postalcode
     * @return OfficePostalcode
     * @throws Throwable
     */
    public static function fromString(string $postalcode): OfficePostalcode
    {
        self::checkAssertion($postalcode);

        $instance = new static();
        $instance->postalcode = $postalcode;

        return $instance;
    }


    /**
     * @param string $postalcode
     * @return bool
     * @throws Throwable
     */
    public static function checkAssertion(string $postalcode): bool
    {
        Assertion::regex($postalcode, self::POSTAL_CODE_PATTERN);

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
        return $this->postalcode;
    }
}