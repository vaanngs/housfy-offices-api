<?php

declare(strict_types=1);

namespace Api\Infrastructure\Doctrine\Type\Office;

use Api\Domain\ValueObjs\Office\OfficeAddress;
use Api\Domain\ValueObjs\Office\OfficeAddressLine;
use Api\Domain\ValueObjs\Office\OfficeCity;
use Api\Domain\ValueObjs\Office\OfficePostalcode;
use Api\Domain\ValueObjs\Office\OfficeProvince;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\Type;
use Throwable;

final class OfficeAddressType extends Type
{
    const NAME = 'officeAddress';


    /** {@inheritdoc} */
    public function getName()
    {
        return static::NAME;
    }


    /** {@inheritdoc} */
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform): string
    {
        return 'varchar(255)';
    }


    /** {@inheritdoc}
     * @throws Throwable
     */
    public function convertToPHPValue($value, AbstractPlatform $platform): ?OfficeAddress
    {
        if (null == $value || $value instanceof OfficeAddress) {
            return $value;
        }

        $item = explode(':', $value);

        return OfficeAddress::build(
            ($item[0]) ? OfficePostalcode::fromString($item[0]) : null,
            ($item[1]) ? OfficeProvince::fromString($item[1]) : null,
            ($item[2]) ? OfficeCity::fromString($item[2]) : null,
            ($item[3]) ? OfficeAddressLine::fromString($item[3]) : null
        );
    }


    /**
     * {@inheritdoc}
     * @throws ConversionException
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        if (null === $value) {
            return null;
        }

        if ($value instanceof OfficeAddress) {
            return sprintf(
                '%s:%s:%s:%s',
                $value->getPostalcode(),
                $value->getProvince(),
                $value->getCity(),
                $value->getAddressLine()
            );
        }

        throw ConversionException::conversionFailedInvalidType($value, $this->getName(), ['null', OfficeAddress::class]);
    }


    /** {@inheritdoc} */
    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }
}
