<?php

declare(strict_types=1);

namespace Api\UI\Http\Controllers;

use Api\Application\Commands\CommandInterface;
use Api\Domain\Specification\Requests\RequestSpecificationInterface;
use League\Tactician\CommandBus;
use Psr\Http\Message\RequestInterface;
use Throwable;

/**
 * @OA\Info(title="Housfy's Offices", version="0.1")
 */
abstract class AbstractController
{

    /** @var CommandBus */
    private $commandBus;

    /** @var RequestSpecificationInterface|null  */
    private $specification;


    /**
     * @param CommandBus $commandBus
     * @param RequestSpecificationInterface $specification
     */
    public function __construct(
        CommandBus $commandBus,
        ?RequestSpecificationInterface $specification = null
    )
    {
        $this->commandBus    = $commandBus;
        $this->specification = $specification;
    }


    /**
     * @param CommandInterface $command
     * @return mixed
     */
    public function handler(CommandInterface $command)
    {
        return $this->commandBus->handle($command);
    }


    /**
     * @param RequestInterface $request
     * @throws Throwable
     * @return bool
     */
    public function isRequestValid(RequestInterface $request): bool
    {
        return $this->specification->isSatisfiedBy($request);
    }
}
