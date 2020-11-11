<?php

declare(strict_types=1);

namespace Api\Infrastructure\Specification\Shared\ORM;

use Api\Domain\Specification\Factory\SpecificationFactoryInterface;
use Doctrine\ORM\Query\Expr;

abstract class OrmSpecification implements SpecificationFactoryInterface
{
    /** @var Expr */
    protected $expr;

    /** @var array */
    protected $parameters = [];

    /** @var array */
    protected $types = [];


    /**
     * @param Expr $expr
     */
    public function __construct(Expr $expr)
    {
        $this->expr = $expr;
    }


    /** @inheritDoc */
    abstract public function getConditions();


    /** @inheritDoc */
    public function getParameters(): array
    {
        return $this->parameters;
    }


    /** @inheritDoc */
    public function getTypes(): array
    {
        return $this->types;
    }


    /** @inheritDoc */
    public function andX(SpecificationFactoryInterface $specification): SpecificationFactoryInterface
    {
        return new OrmAndSpecification($this->expr, $this, $specification);
    }


    /** @inheritDoc */
    public function orX(SpecificationFactoryInterface $specification): SpecificationFactoryInterface
    {
        return new OrmOrSpecification($this->expr, $this, $specification);
    }


    /**
     * @param SpecificationFactoryInterface $specification
     */
    protected function addParameters(SpecificationFactoryInterface $specification): void
    {
        $specTypes = $specification->getTypes();
        foreach ($specification->getParameters() as $key => $value) {
            $this->setParameter($key, $value, $specTypes[$key]);
        }
    }


    /**
     * @param string $key
     * @param $value
     * @param string|null $type
     */
    protected function setParameter(string $key, $value, string $type = null): void
    {
        $this->parameters[$key] = $value;
        $this->types[$key]      = $type;
    }
}
