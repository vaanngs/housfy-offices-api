<?php

namespace Api\Domain\Shared;

interface WriteModelInterface
{

    /**
     * @param $entity
     */
    public function preSave($entity): void;


    /**
     * @param null $entity
     */
    public function save($entity = null): void;


    /**
     * @param null $entity
     */
    public function update($entity = null): void;


    /**
     * @param $entity
     */
    public function delete($entity): void;
}