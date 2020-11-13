<?php

declare(strict_types=1);

use Api\Domain\Event\Bus\ConsumerMessageInterface;
use Api\Domain\Event\Bus\PublisherMessageInterface;
use Api\Infrastructure\RabbitMQ\RabbitMqConsumer;
use Api\Infrastructure\RabbitMQ\RabbitMqPublisher;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use Psr\Container\ContainerInterface;

$container['AMQConnection'] = function (ContainerInterface $c) {
    $settings = $c['settings']['rabbitMQ'];

    return new AMQPStreamConnection(
        $settings['host'],
        $settings['port'],
        $settings['user'],
        $settings['pass']
    );
};


$container['FindAllOfficesPublisher'] = function (ContainerInterface $c): PublisherMessageInterface {
    $queues = $c['settings']['rabbitMQ']['queues'];

    return new RabbitMqPublisher(
        $c['AMQConnection'],
        $queues['findall-offices-query']
    );
};


$container['FindAllOfficesConsumer'] = function (ContainerInterface $c): ConsumerMessageInterface {
    $queues = $c['settings']['rabbitMQ']['queues'];

    return new RabbitMqConsumer(
        $c['AMQConnection'],
        $queues['findall-offices-query']
    );
};
