<?php

declare(strict_types=1);

namespace Api\Infrastructure\Console\Migrations;

interface MigrationInterface
{
    /**
     * @return iterable
     */
    public function load(): iterable;
}
