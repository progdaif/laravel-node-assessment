<?php

namespace App\Lib\Amqb\Producer;

use Enqueue\AmqpExt\AmqpContext;
use Interop\Amqp\Impl\AmqpQueue;
use Interop\Amqp\Impl\AmqpTopic;
use Interop\Amqp\Impl\AmqpBind;

use App\Lib\Amqb\Contracts\Publisher as PublisherContract;
use App\Lib\Amqb\Contracts\QueueBind;

use App\Lib\Amqb\Broker;

abstract class Publisher implements QueueBind, PublisherContract
{
    protected AmqpContext $context;
    protected AmqpTopic $topic;
    protected array $queues = [];

    public function __construct()
    {
        $broker = new Broker();
        $factory = $broker->connect();
        $this->context = $factory->createContext();
    }

    private function declareTopic(string $topic)
    {
        // exchange goes here
        $this->topic = $this->context->createTopic($topic);
        $this->topic->setType(AmqpTopic::TYPE_FANOUT);
        $this->context->declareTopic($this->topic);
    }

    private function declareQueue(string $queueName)
    {
        $queue = $this->context->createQueue($queueName);
        $queue->addFlag(AmqpQueue::FLAG_DURABLE);
        $this->context->declareQueue($queue);
        $this->queues[$queueName] = $queue;
    }

    public function bind(string $topic, array $queues): void
    {
        $this->declareTopic($topic);
        foreach ($queues as $queue) {
            $this->declareQueue($queue);
        }

        foreach ($this->queues as $queue) {
            $this->context->bind(new AmqpBind($this->topic, $queue));
        }
    }
}