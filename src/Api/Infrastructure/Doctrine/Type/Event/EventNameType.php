<?php

declare(strict_types=1);

namespace Api\Infrastructure\Doctrine\Type\Event;

use Api\Domain\ValueObjs\Event\EventName;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\Type;

final class EventNameType extends Type
{
    const NAME = 'eventName';


    /** {@inheritdoc} */
    public function getName(): string
    {
        return static::NAME;
    }


    /** {@inheritdoc} */
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform): string
    {
        return sprintf('varchar(%d)', EventName::MAX_LENGTH);
    }


    /** {@inheritdoc} */
    public function convertToPHPValue($value, AbstractPlatform $platform): ?EventName
    {
        if (null == $value || $value instanceof EventName) {
            return $value;
        }

        return EventName::fromString($value);
    }


    /** {@inheritdoc} */
    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        if (null == $value) {
            return null;
        }

        if ($value instanceof EventName) {
            return $value->toStr();
        }

        throw ConversionException::conversionFailedInvalidType($value, $this->getName(), ['null', EventName::class]);
    }


    /** {@inheritdoc} */
    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }
}
