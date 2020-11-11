<?php

declare(strict_types=1);

namespace Api\Domain\Event\Office;

use Api\Domain\Entities\Office;
use Api\Domain\Event\Shared\AbstractEvent;
use Api\Domain\Event\Shared\EventInterface;
use Api\Domain\Shared\Param;
use Api\Domain\ValueObjs\OfficeAddress;
use Api\Domain\ValueObjs\OfficeName;
use Ramsey\Uuid\UuidInterface;

final class OfficeWasUpdated extends AbstractEvent implements EventInterface
{

    /** @var UuidInterface */
    private $uuid;

    /** @var OfficeName */
    private $oldName;

    /** @var OfficeAddress */
    private $oldAddress;

    /** @var OfficeName */
    private $newName;

    /** @var OfficeAddress */
    private $newAddress;


    /**
     * OfficeWasUpdated constructor.
     * @param Office $oldOffice
     * @param Office $newOffice
     */
    public function __construct(Office $oldOffice, Office $newOffice)
    {
        $this->uuid = $newOffice->getUuid();

        $this->oldName    = $oldOffice->getName();
        $this->oldAddress = $oldOffice->getAddress();

        $this->newName    = $newOffice->getName();
        $this->newAddress = $newOffice->getAddress();

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
            Param::UUID => $this->uuid->toString(),
            'values' => [
                Param::OFFICE_NAME => [
                    'old' => $this->oldName->toStr(),
                    'new' => $this->newName->toStr()
                ],
                Param::OFFICE_ADDRESS => [
                    'old' => $this->oldAddress->toRender(),
                    'new' => $this->newAddress->toRender()
                ]
            ]
        ];
    }
}