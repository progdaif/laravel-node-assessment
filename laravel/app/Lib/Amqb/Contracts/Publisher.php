<?php

namespace App\Lib\Amqb\Contracts;

interface Publisher
{
    public function publish(array $messages);
}