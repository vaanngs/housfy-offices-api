<?php

declare(strict_types=1);

namespace Tests\Api\Application\Commands\Office\Create;

use Api\Application\Commands\Office\Create\CreateOfficeCommand;
use Api\Application\Commands\Office\Create\CreateOfficeHandler;
use PHPUnit\Framework\TestCase;
use Tests\Mock\FakeOfficeBuilder;
use Throwable;

final class CreateOfficeHandlerTest extends TestCase
{
    /**
     * @test
     * @throws Throwable
     */
    public function should_create_an_office()
    {
        $fakeOffice = FakeOfficeBuilder::makeCreate();

        $command = new CreateOfficeCommand(
            $fakeOffice->getName()->toStr(),
            $fakeOffice->getAddress()->toRender()
        );

        $handler = new CreateOfficeHandler();
        $stub    = $handler($command);

        self::assertIsArray($stub);
    }
}
