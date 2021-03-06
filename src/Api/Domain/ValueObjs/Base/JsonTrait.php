<?php

declare(strict_types=1);

namespace Api\Domain\ValueObjs\Base;

use Assert\Assertion;
use Throwable;

trait JsonTrait
{
    /** @var string[] */
    private $values;


    /**
     * @param string[] $vars
     * @throws Throwable
     * @return self
     */
    public static function fromArray(array $vars): self
    {
        $json = json_encode($vars);

        return self::fromJson($json);
    }


    public static function fromJson(string $json): self
    {
        self::checkAssertion($json);

        $instance         = new static();
        $instance->values = json_decode($json, true);

        return $instance;
    }


    public static function checkAssertion(string $json): bool
    {
        Assertion::isJsonString($json, 'Invalid JSON format');

        return true;
    }


    public function hasValues(array $elements): bool
    {
        foreach ($elements as $element) {
            if (!\in_array($element, $this->values)) {
                return false;
            }
        }

        return true;
    }


    public function toArray(): array
    {
        return $this->values;
    }


    public function toJson(): string
    {
        return json_encode($this->values);
    }


    public function __toString()
    {
        return $this->toJson();
    }


    private function __construct()
    {
    }
}
