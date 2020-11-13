<?php

declare(strict_types=1);

namespace Api\Application\Commands\Office\Delete;

use Api\Application\Commands\CommandInterface;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class DeleteOfficeCommand implements CommandInterface
{
    /** @var UuidInterface */
    private $uuid;


    /**
     * @param string $uuid
     */
    public function __construct(string $uuid)
    {
        $this->uuid = Uuid::fromString($uuid);
    }


    /**
     * @return UuidInterface
     */
    public function getUuid(): UuidInterface
    {
        return $this->uuid;
    }
}
