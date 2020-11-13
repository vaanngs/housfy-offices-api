<?php

declare(strict_types=1);

namespace Api\Infrastructure\Specification\ORM\Office;

use Api\Domain\Entities\Office;
use Api\Infrastructure\Specification\Shared\ORM\OrmSpecification;
use Doctrine\ORM\Query\Expr;
use Ramsey\Uuid\UuidInterface;

final class OfficeWithUuid extends OrmSpecification
{
    /**
     * OfficeWithUuid constructor.
     * @param Expr $expr
     * @param UuidInterface $uuid
     */
    public function __construct(Expr $expr, UuidInterface $uuid)
    {
        $this->setParameter('uuid', $uuid->toString());

        parent::__construct($expr);
    }


    /** {@inheritdoc} */
    public function getConditions()
    {
        return $this->expr->eq(Office::ALIAS . '.uuid', ':uuid');
    }
}
