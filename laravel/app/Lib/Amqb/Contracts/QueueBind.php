<?php

namespace App\Lib\Amqb\Contracts;

interface QueueBind
{
    public function bind(string $topic, array $queues): void;
}