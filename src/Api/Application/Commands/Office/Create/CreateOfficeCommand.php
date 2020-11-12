<?php

declare(strict_types=1);

namespace Api\Application\Commands\Office\Create;

use Api\Application\Commands\CommandInterface;
use Api\Domain\Shared\Param;
use Api\Domain\ValueObjs\Office\OfficeAddress;
use Api\Domain\ValueObjs\Office\OfficeAddressLine;
use Api\Domain\ValueObjs\Office\OfficeCity;
use Api\Domain\ValueObjs\Office\OfficeName;
use Api\Domain\ValueObjs\Office\OfficePostalcode;
use Api\Domain\ValueObjs\Office\OfficeProvince;
use Throwable;

final class CreateOfficeCommand implements CommandInterface
{

    /** @var OfficeName */
    private $name;

    /** @var OfficeAddress */
    private $address;


    /**
     * @param string $name
     * @param iterable $address
     * @throws Throwable
     */
    public function __construct(string $name, iterable $address)
    {
        $this->name    = OfficeName::fromString($name);
        $this->address = OfficeAddress::build(
            OfficePostalcode::fromString($address[Param::OFFICE_POSTALCODE]),
            OfficeProvince::fromString($address[Param::OFFICE_PROVINCE]),
            OfficeCity::fromString($address[Param::OFFICE_CITY]),
            OfficeAddressLine::fromString($address[Param::OFFICE_ADDRESS_LINE])
        );
    }

    /**
     * @return OfficeName
     */
    public function getName(): OfficeName
    {
        return $this->name;
    }


    /**
     * @return OfficeAddress
     */
    public function getAddress(): OfficeAddress
    {
        return $this->address;
    }
}