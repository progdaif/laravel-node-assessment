<?php

namespace App\Lib\Amqb\Producer;

abstract class Producer extends Publisher
{
    protected array $messages = [];

    public function __construct()
    {
        parent::__construct();
    }

    abstract protected function produce();

    public function publish(array $messages): void
    {
        foreach ($messages as $topic => $queuesMessages) {
            // bind queues to topic
            $this->bind($topic, array_keys($queuesMessages));

            // publish messages to topic / queue
            $this->messages = $queuesMessages;
            $this->produce();
        }
    }
}