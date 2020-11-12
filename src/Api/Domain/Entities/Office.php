<?php

declare(strict_types=1);

namespace Api\Domain\Entities;

use Api\Domain\Entities\Shared\EntityEvent;
use Api\Domain\Event\Office\OfficeWasCreated;
use Api\Domain\Event\Office\OfficeWasUpdated;
use Api\Domain\Shared\Param;
use Api\Domain\ValueObjs\OfficeAddress;
use Api\Domain\ValueObjs\OfficeName;
use Exception;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Throwable;

final class Office extends EntityEvent
{

    const ALIAS = 'o';

    /** @var UuidInterface */
    private $uuid;

    /** @var OfficeName */
    private $name;

    /** @var OfficeAddress */
    private $address;


    /**
     * @param OfficeName $name
     * @param OfficeAddress $address
     * @param string|null $uuid
     * @return static
     * @throws Exception
     */
    public static function create(
        OfficeName $name,
        OfficeAddress $address,
        ?string $uuid = null
    )
    {
        $instance = new static();

        $instance->uuid    = (!empty($uuid)) ? Uuid::fromString($uuid) : Uuid::uuid4();
        $instance->name    = $name;
        $instance->address = $address;

        $instance->publish(new OfficeWasCreated($instance));

        return $instance;
    }


    /**
     * @param iterable $params
     * @return $this
     */
    public function update(iterable $params): Office
    {
        $oldOffice  = clone $this;
        $properties = get_object_vars($this);

        foreach ($params as $keyParam => $param) {
            foreach ($properties as $keyProperty => $property) {
                if ($keyParam == $keyProperty && Param::OFFICE_ADDRESS === $keyParam) {
                    $this->setAddress($param);

                    continue;
                }

                if ($keyProperty == $keyParam && !empty($param)) {
                    $this->$keyProperty = $param;
                }
            }
        }

        $this->publish(new OfficeWasUpdated($oldOffice, $this));

        return $this;
    }


    /**
     * @return UuidInterface
     */
    public function getUuid(): UuidInterface
    {
        return $this->uuid;
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


    /**
     * @return iterable
     */
    public function toRender(): iterable
    {
        return [
            Param::UUID => $this->getUuid()->toString(),
            Param::OFFICE_NAME => $this->getName()->toStr(),
            Param::OFFICE_ADDRESS => $this->getAddress()->toRender()
        ];
    }


    /**
     * @param OfficeAddress $address
     * @return $this
     */
    public function setAddress(OfficeAddress $address): Office
    {
        $postalcode = ($address->getPostalcode())
            ? $address->getPostalcode()
            : $this->address->getPostalcode();

        $province = ($address->getProvince())
            ? $address->getProvince()
            : $this->address->getProvince();

        $city = ($address->getCity())
            ? $address->getCity()
            : $this->address->getCity();

        $addressLine = ($address->getAddressLine())
            ? $address->getAddressLine()
            : $this->address->getAddressLine();

        $this->address = OfficeAddress::build(
            $postalcode,
            $province,
            $city,
            $addressLine
        );
        
        return $this;
    }


    private function __construct()
    {
    }
}