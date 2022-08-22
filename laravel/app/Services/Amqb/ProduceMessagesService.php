<?php

namespace App\Services\Amqb;

use App\Services\Contracts\Producer;
use App\Lib\Amqb\Producer\TopicProducer;
use Modules\Reservations\Entities\Reservation;

final class EmailMessageService implements Producer
{
    /**
     * Producer object to publish the message
     *
     * @var TopicProducer
     */

    private TopicProducer $producer;

    /**
     * Reservation data to be processed
     *
     * @var Reservation
     */
    private Reservation $reservation;

    /**
     * Create a new service instance to initiale producer
     *
     * @return void
     */
    public function __construct()
    {
        $this->producer = new TopicProducer();
    }

    /**
     * Receive reservation data
     *
     * @param Reservation $reservation
     *
     * @return void
     */
    public function init(Reservation $reservation)
    {
        $this->reservation = $reservation;
    }

    /**
     * Produce reservation email message to specific topic
     *
     * @return void
     */
    public function produce()
    {
        $messages = [
            'paid-email' => [
                'emails' => [
                    $this->reservation->toJson()
                ]
            ]
        ];
        $this->producer->publish($messages);
    }
}