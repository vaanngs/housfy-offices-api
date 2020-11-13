<?php

declare(strict_types=1);

namespace Api\UI\Console;

use Api\Infrastructure\Console\CliCommand;
use Api\Infrastructure\Console\Migrations\MigrationInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class LoadMigrationsCommand extends CliCommand
{
    /** @var MigrationInterface */
    private $officeLoader;


    /**
     * @param MigrationInterface $officeLoader
     */
    public function __construct(MigrationInterface $officeLoader)
    {
        $this->officeLoader = $officeLoader;

        parent::__construct();
    }


    /** {@inheritdoc} */
    protected function configure()
    {
        $this
            ->setName('housfy:offices:migrations:load')
            ->setDescription('Load init fake data into db.');
    }


    /** {@inheritdoc} */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        exec('./bin/console orm:schema-tool:drop --force');
        exec('./bin/console orm:schema-tool:create');

        $this->officeLoader->load();

        $output->writeln('Offices were loaded!');

        return 0;
    }
}
