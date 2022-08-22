<?php

namespace App\Lib\Amqb\Producer;

final class TopicProducer extends Producer
{
    public function __construct()
    {
        parent::__construct();
    }

    private function sendByTopic($messages)
    {
        foreach ($messages as $messageContent) {
            $message = $this->context->createMessage($messageContent);
            $this->context->createProducer()->send($this->topic, $message);
        }
    }

    protected function produce()
    {
        foreach ($this->messages as $messagesContents) {
            $this->sendByTopic($messagesContents);
        }
    }
}