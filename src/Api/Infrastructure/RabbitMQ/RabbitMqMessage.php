<?php

declare(strict_types=1);

namespace Api\Infrastructure\RabbitMQ;

use Api\Domain\Event\Bus\MessageToEnqueueInterface;
use PhpAmqpLib\Message\AMQPMessage;

class RabbitMqMessage implements MessageToEnqueueInterface
{
    /** @var AMQPMessage */
    private $message;


    /**
     * @param array $values
     */
    public function __construct(array $values)
    {
        $this->message = new AMQPMessage(json_encode($values));
    }


    /**
     * @return AMQPMessage
     */
    public function getMessage(): AMQPMessage
    {
        return $this->message;
    }
}
