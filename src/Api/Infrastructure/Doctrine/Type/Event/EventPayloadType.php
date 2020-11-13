<?php

declare(strict_types=1);

namespace Api\Infrastructure\Doctrine\Type\Event;

use Api\Domain\ValueObjs\Event\EventPayload;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\Type;

final class EventPayloadType extends Type
{
    const NAME = 'eventPayload';


    /**
     * {@inheritdoc}
     */
    public function getName(): string
    {
        return static::NAME;
    }


    /**
     * {@inheritdoc}
     */
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return 'JSONB';
    }


    /**
     * {@inheritdoc}
     */
    public function convertToPHPValue($value, AbstractPlatform $platform): ?EventPayload
    {
        if (null === $value || $value instanceof EventPayload) {
            return $value;
        }

        if ('' === $value) {
            return null;
        }

        if (\is_resource($value)) {
            $value = stream_get_contents($value);
        }

        return EventPayload::fromJson($value);
    }


    /**
     * {@inheritdoc}
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        if (null === $value) {
            return null;
        }

        if ($value instanceof EventPayload) {
            return $value->toJson();
        }

        throw ConversionException::conversionFailedInvalidType($value, $this->getName(), ['null', EventPayload::class]);
    }


    /**
     * {@inheritdoc}
     */
    public function requiresSQLCommentHint(AbstractPlatform $platform)
    {
        return !$platform->hasNativeJsonType();
    }
}
