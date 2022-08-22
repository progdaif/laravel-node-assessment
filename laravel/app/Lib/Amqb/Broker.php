<?php

namespace App\Lib\Amqb;

use App\Lib\Contracts\Connection;
use Enqueue\AmqpExt\AmqpConnectionFactory;

final class Broker implements Connection
{
    public function connect(): AmqpConnectionFactory
    {
        // connect to AMQP broker
        return new AmqpConnectionFactory(env('CLOUDAMQP_URL'));
    }
}