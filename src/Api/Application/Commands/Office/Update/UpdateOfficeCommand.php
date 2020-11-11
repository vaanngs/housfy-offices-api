<?php

declare(strict_types=1);

namespace Api\Application\Commands\Office\Update;

use Api\Application\Commands\CommandInterface;
use Api\Domain\Shared\Param;
use Api\Domain\ValueObjs\OfficeAddress;
use Api\Domain\ValueObjs\OfficeAddressLine;
use Api\Domain\ValueObjs\OfficeCity;
use Api\Domain\ValueObjs\OfficeName;
use Api\Domain\ValueObjs\OfficePostalcode;
use Api\Domain\ValueObjs\OfficeProvince;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Throwable;

final class UpdateOfficeCommand implements CommandInterface
{

    /** @var UuidInterface */
    private $uuid;

    /** @var OfficeName|null */
    private $name;

    /** @var OfficeAddress|null */
    private $address;

    /** @var iterable */
    private $params;


    /**
     * @param string $uuid
     * @param string|null $name
     * @param iterable|null $address
     * @throws Throwable
     */
    public function __construct(
        string $uuid,
        ?string $name,
        ?iterable $address
    )
    {
        $this->uuid    = Uuid::fromString($uuid);
        $this->name    = ($name) ? OfficeName::fromString($name) : null;
        $this->address = (!empty($address)) ? $this->buildAddress($address) : null;
        
        if (!empty($address)) {
            $this->buildAddress($address);
        }

        $this->params = [
           'name'    => $this->name,
           'address' => $this->address
        ];
    }


    /**
     * @return UuidInterface
     */
    public function getUuid(): UuidInterface
    {
        return $this->uuid;
    }


    /**
     * @return OfficeName|null
     */
    public function getName(): ?OfficeName
    {
        return $this->name;
    }


    /**
     * @return OfficeAddress|null
     */
    public function getAddress(): ?OfficeAddress
    {
        return $this->address;
    }


    /**
     * @return iterable
     */
    public function getParams(): iterable
    {
        return $this->params;
    }


    /**
     * @param iterable $address
     * @return OfficeAddress
     * @throws Throwable
     */
    private function buildAddress(iterable $address): OfficeAddress
    {
        $postalcode = (!empty($address[Param::OFFICE_POSTALCODE]))
            ? OfficePostalcode::fromString($address[Param::OFFICE_POSTALCODE])
            : null;

        $province = (!empty($address[Param::OFFICE_PROVINCE]))
            ? OfficeProvince::fromString($address[Param::OFFICE_PROVINCE])
            : null;

        $city = (!empty($address[Param::OFFICE_CITY]))
            ? OfficeCity::fromString($address[Param::OFFICE_CITY])
            : null;

        $addressLine = (!empty($address[Param::OFFICE_ADDRESS_LINE]))
            ? OfficeAddressLine::fromString($address[Param::OFFICE_ADDRESS_LINE])
            : null;

        return OfficeAddress::build(
            $postalcode,
            $province,
            $city,
            $addressLine
        );
    }


    /**
     * @return bool
     */
    public function hasName(): bool
    {
        return null !== $this->name;
    }


    /**
     * @return bool
     */
    public function hasAddress(): bool
    {
        return null !== $this->address;
    }
}