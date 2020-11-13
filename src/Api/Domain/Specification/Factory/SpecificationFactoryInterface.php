<?php

declare(strict_types=1);

namespace Api\Domain\Specification\Factory;

interface SpecificationFactoryInterface
{
    /**
     * @return mixed
     */
    public function getConditions();


    /**
     * @return array
     */
    public function getParameters(): array;


    /**
     * @return array
     */
    public function getTypes(): array;


    /**
     * @param SpecificationFactoryInterface $specification
     * @return $this
     */
    public function andX(self $specification): self;


    /**
     * @param SpecificationFactoryInterface $specification
     * @return $this
     */
    public function orX(self $specification): self;
}
