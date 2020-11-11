<?php

namespace Api\Infrastructure\Console\Migrations;

interface MigrationInterface
{

    /**
     * @return iterable
     */
    public function load(): iterable;
}