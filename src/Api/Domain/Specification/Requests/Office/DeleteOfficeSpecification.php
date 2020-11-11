<?php

declare(strict_types=1);

namespace Api\Domain\Specification\Requests\Office;

use Api\Domain\Shared\Param;
use Api\Domain\Specification\Requests\RequestSpecificationInterface;
use Psr\Http\Message\RequestInterface;
use Ramsey\Uuid\Uuid;

final class DeleteOfficeSpecification implements RequestSpecificationInterface
{

    /** @inheritDoc */
    public function isSatisfiedBy(RequestInterface $request): bool
    {
        $params = $request->getParsedBody();

        if (empty($params[Param::UUID])) {
            return false;
        }

        Uuid::fromString($params[Param::UUID]);

        return true;
    }
}