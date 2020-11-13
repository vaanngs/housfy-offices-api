<?php

declare(strict_types=1);

namespace Api\Domain\ValueObjs\Office;

use Api\Domain\Shared\Param;

final class OfficeAddress
{
    /** @var OfficePostalcode|null */
    private $postalcode;

    /** @var OfficeProvince|null */
    private $province;

    /** @var OfficeCity|null */
    private $city;

    /** @var OfficeAddressLine|null */
    private $addressLine;


    /**
     * @param OfficePostalcode  $postalcode
     * @param OfficeProvince    $province
     * @param OfficeCity        $city
     * @param OfficeAddressLine $addressLine
     * @return OfficeAddress
     */
    public static function build(
        ?OfficePostalcode $postalcode,
        ?OfficeProvince $province,
        ?OfficeCity $city,
        ?OfficeAddressLine $addressLine
    ): self {
        $instance = new static();

        $instance->postalcode  = $postalcode;
        $instance->province    = $province;
        $instance->city        = $city;
        $instance->addressLine = $addressLine;

        return $instance;
    }


    /**
     * @return iterable
     *
     * Note: I use method name "toRender()" when I want to only show
     * non-sensitive info to the frontend user. If I dont mine, I use
     * method name "toArray()" (mainly for business logic).
     * In this case there is no sensitive info so...
     */
    public function toRender(): iterable
    {
        return [
            Param::OFFICE_POSTALCODE   => $this->getPostalcode()->toStr(),
            Param::OFFICE_PROVINCE     => $this->getProvince()->toStr(),
            Param::OFFICE_CITY         => $this->getCity()->toStr(),
            Param::OFFICE_ADDRESS_LINE => $this->getAddressLine()->toStr(),
        ];
    }


    /**
     * @return OfficePostalcode|null
     */
    public function getPostalcode(): ?OfficePostalcode
    {
        return $this->postalcode;
    }


    /**
     * @return OfficeProvince|null
     */
    public function getProvince(): ?OfficeProvince
    {
        return $this->province;
    }


    /**
     * @return OfficeCity|null
     */
    public function getCity(): ?OfficeCity
    {
        return $this->city;
    }


    /**
     * @return OfficeAddressLine|null
     */
    public function getAddressLine(): ?OfficeAddressLine
    {
        return $this->addressLine;
    }
}
