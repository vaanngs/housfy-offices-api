<?php

declare(strict_types=1);

namespace Tests\Api\Domain\Service\Finders\Office;

use Api\Domain\Entities\Office;
use Api\Domain\ReadModel\OfficeRepositoryInterface;
use Api\Domain\Service\Finders\Office\OfficeFinder;
use Api\Domain\Specification\Factory\Office\OfficeSpecificationFactoryInterface;
use Api\Domain\Specification\Factory\SpecificationFactoryInterface;
use Mockery;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use Tests\Mock\FakeOfficeBuilder;
use Throwable;

final class OfficeFinderTest extends TestCase
{
    /** @var OfficeSpecificationFactoryInterface */
    private $officeSpecFactory;

    /** @var OfficeRepositoryInterface */
    private $repository;

    /** @var SpecificationFactoryInterface */
    private $specification;


    /**
     * @test
     * @throws Throwable
     */
    public function should_build_to_find_all_offices()
    {
        $this->repository
            ->shouldReceive('findAll')
            ->once()
            ->andReturn([FakeOfficeBuilder::makeCreate()]);

        $finder = new OfficeFinder($this->officeSpecFactory, $this->repository);
        $stub   = $finder->findAll();

        self::assertIsArray($stub);

        foreach ($stub as $item) {
            self::assertInstanceOf(Office::class, $item);
        }
    }


    /**
     * @test
     * @throws Throwable
     */
    public function should_build_to_find_office_by_uuid()
    {
        $this->officeSpecFactory
            ->shouldReceive('createForFindWithUuid')
            ->once()
            ->andReturn($this->specification);

        $this->repository
            ->shouldReceive('getOneOrNull')
            ->once()
            ->andReturn(FakeOfficeBuilder::makeUpdate());

        $finder = new OfficeFinder($this->officeSpecFactory, $this->repository);
        $stub   = $finder->findByUuid(Uuid::uuid4());

        self::assertInstanceOf(Office::class, $stub);
    }


    public function setUp(): void
    {
        $this->officeSpecFactory = Mockery::mock(OfficeSpecificationFactoryInterface::class);
        $this->repository        = Mockery::mock(OfficeRepositoryInterface::class);
        $this->specification     = Mockery::mock(SpecificationFactoryInterface::class);

        parent::setUp();
    }
}
