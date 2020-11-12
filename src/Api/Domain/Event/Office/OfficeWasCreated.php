<?php

declare(strict_types=1);

namespace Api\Domain\Event\Office;

use Api\Domain\Entities\Office;
use Api\Domain\Event\Shared\AbstractEvent;
use Api\Domain\Event\Shared\EventInterface;
use Api\Domain\Shared\Param;
use Api\Domain\ValueObjs\Office\OfficeAddress;
use Api\Domain\ValueObjs\Office\OfficeName;
use Ramsey\Uuid\UuidInterface;

final class OfficeWasCreated extends AbstractEvent implements EventInterface
{

    /** @var UuidInterface */
    private $uuid;

    /** @var OfficeName */
    private $name;

    /** @var OfficeAddress */
    private $address;


    /**
     * @param Office $office
     */
    public function __construct(Office $office)
    {
        $this->uuid    = $office->getUuid();
        $this->name    = $office->getName();
        $this->address = $office->getAddress();

        parent::__construct();
    }


    /** @inheritDoc */
    public function index(): string
    {
        return $this->uuid->toString();
    }


    /** @inheritDoc */
    public function payload(): array
    {
        return [
            Param::UUID           => $this->uuid->toString(),
            Param::OFFICE_NAME    => $this->name->toStr(),
            Param::OFFICE_ADDRESS => $this->address->toRender()
        ];
    }
}