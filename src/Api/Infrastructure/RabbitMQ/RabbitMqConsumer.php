<?php

declare(strict_types=1);

namespace Api\Infrastructure\RabbitMQ;

use Api\Domain\Event\Bus\ConsumerMessageInterface;
use Closure;
use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;

final class RabbitMqConsumer implements ConsumerMessageInterface
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
    public function listenQueue(Closure $callback): void
    {
        $this->channel->basic_consume($this->queue, '', false, false, false, false, $callback);

        while ($this->channel->is_consuming()) {
            $this->channel->wait();
        }
    }
}
