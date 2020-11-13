<?php

declare(strict_types=1);

namespace Api\Infrastructure\Doctrine\Type\Office;

use Api\Domain\ValueObjs\Office\OfficeName;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\Type;

final class OfficeNameType extends Type
{
    const NAME = 'officeName';


    /** {@inheritdoc} */
    public function getName(): string
    {
        return static::NAME;
    }


    /** {@inheritdoc} */
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform): string
    {
        return sprintf('varchar(%d)', OfficeName::MAX_LENGTH);
    }


    /** {@inheritdoc} */
    public function convertToPHPValue($value, AbstractPlatform $platform): ?OfficeName
    {
        if (null == $value || $value instanceof OfficeName) {
            return $value;
        }

        return OfficeName::fromString($value);
    }


    /**
     * {@inheritdoc}
     * @throws ConversionException
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        if (null == $value) {
            return null;
        }

        if ($value instanceof OfficeName) {
            return $value->toStr();
        }

        throw ConversionException::conversionFailedInvalidType($value, $this->getName(), ['null', OfficeName::class]);
    }


    /** {@inheritdoc} */
    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }
}
