<?php

declare(strict_types=1);

namespace Api\UI\Console\RabbitMQ;

use Api\Application\Commands\Cache\SaveInCacheCommand;
use Api\Domain\Event\Bus\ConsumerMessageInterface;
use Api\Domain\Shared\Param;
use Api\Infrastructure\Console\CliCommand;
use Closure;
use League\Tactician\CommandBus;
use PhpAmqpLib\Message\AMQPMessage;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class ConsumerFindAllOfficesCommand extends CliCommand
{
    /** @var ConsumerMessageInterface */
    private $consumer;

    /** @var CommandBus */
    private $commandBus;


    /**
     * @param ConsumerMessageInterface $consumer
     * @param CommandBus $commandBus
     */
    public function __construct(
        ConsumerMessageInterface $consumer,
        CommandBus $commandBus
    ) {
        $this->consumer   = $consumer;
        $this->commandBus = $commandBus;

        parent::__construct();
    }


    /** {@inheritdoc} */
    protected function configure()
    {
        $this
            ->setName('housfy:offices:rabbitmq:consumer:findalloffices')
            ->setDescription('Rabbit consumer find all offices queue');
    }


    /** {@inheritdoc} */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Listening messages...');

        $this->consumer->listenQueue(
            $this->buildCallback()
        );
    }


    /**
     * @return Closure
     */
    private function buildCallback(): Closure
    {
        $logger = $this->logger;

        return
            function (AMQPMessage $message) use ($logger) {
                $logger->info('New message arrived!');
                $item = json_decode($message->getBody(), true);

                try {
                    $saveInCacheCommand = new SaveInCacheCommand(
                        $item[Param::CACHE_KEY],
                        $item[Param::CACHE_VALUE],
                        $item[Param::CACHE_TTL]
                    );

                    $this->commandBus->handle($saveInCacheCommand);
                } catch (\Exception $exception) {
                    $logger->warning(
                        'Could not cache because commandBus could not be built',
                        $exception->getCode()
                    );
                }
            };
    }
}
