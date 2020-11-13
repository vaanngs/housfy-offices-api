<?php

declare(strict_types=1);

namespace Api\Domain\Specification\Requests;

use Psr\Http\Message\RequestInterface;

interface RequestSpecificationInterface
{
    /**
     * @param RequestInterface $request
     * @return bool
     */
    public function isSatisfiedBy(RequestInterface $request): bool;
}
