<?php

declare(strict_types=1);

namespace Api\Infrastructure\Specification\Shared\ORM;

use Api\Domain\Specification\Factory\SpecificationFactoryInterface;
use Doctrine\ORM\Query\Expr;

class OrmAndSpecification extends OrmSpecification
{
    /** @var SpecificationFactoryInterface */
    private $left;

    /** @var SpecificationFactoryInterface */
    private $right;


    /**
     * @param Expr $expr
     * @param SpecificationFactoryInterface $left
     * @param SpecificationFactoryInterface $right
     */
    public function __construct(
        Expr $expr,
        SpecificationFactoryInterface $left,
        SpecificationFactoryInterface $right
    ) {
        $this->left  = $left;
        $this->right = $right;

        $this->addParameters($left);
        $this->addParameters($right);

        parent::__construct($expr);
    }


    /**
     * @return Expr\Andx|mixed
     */
    public function getConditions()
    {
        return $this->expr->andX(
            $this->left->getConditions(),
            $this->right->getConditions()
        );
    }
}
