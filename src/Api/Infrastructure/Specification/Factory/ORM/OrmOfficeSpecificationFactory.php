<?php

declare(strict_types=1);

namespace Api\Infrastructure\Specification\Factory\ORM;

use Api\Domain\Specification\Factory\Office\OfficeSpecificationFactoryInterface;
use Api\Domain\Specification\Factory\SpecificationFactoryInterface;
use Api\Infrastructure\Specification\ORM\Office\OfficeWithUuid;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query\Expr;
use Ramsey\Uuid\UuidInterface;

final class OrmOfficeSpecificationFactory implements OfficeSpecificationFactoryInterface
{

    /** @var Expr */
    private $expr;

    /**
     * OrmCampaignSpecificationFactory constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->expr = $entityManager->getExpressionBuilder();
    }


    /** @inheritDoc */
    public function createForFindWithUuid(UuidInterface $uuid): SpecificationFactoryInterface
    {
        return new OfficeWithUuid($this->expr, $uuid);
    }
}