<?php

declare(strict_types=1);

namespace Api\Infrastructure\RabbitMQ;

use Api\Domain\Event\Bus\MessageToEnqueueInterface;
use Api\Domain\Event\Bus\PublisherMessageInterface;
use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;

final class RabbitMqPublisher implements PublisherMessageInterface
{
    /** @var AMQPChannel */
    private $channel;

    /** @var string */
    private $queue;


    /** {@inheritdoc} */
    public function __construct(AMQPStreamConnection $AMQConn, string $queue)
    {
        $this->channel = $AMQConn->channel();
        $this->queue   = $queue;

        $this->channel->queue_declare($queue);
    }


    /** {@inheritdoc} */
    public function publish(MessageToEnqueueInterface $message): void
    {
        $this->channel->basic_publish($message->getMessage(), '', $this->queue);
    }
}
