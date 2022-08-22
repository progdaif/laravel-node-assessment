<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUniqueUntilProcessing;
use App\Services\Amqb\EmailMessageService;
use Modules\Reservations\Entities\Reservation;

class PaidEmailJob implements ShouldQueue, ShouldBeUniqueUntilProcessing
{
    use Dispatchable;
    use Queueable;
    use InteractsWithQueue;
    use SerializesModels;

    private Reservation $reservation;

    /**
     * Create a new job instance with reservation data
     *
     * @param Reservation $reservation
     *
     * @return void
     */
    public function __construct(Reservation $reservation)
    {
        // load reservation
        $this->reservation = $reservation;
    }

    /**
     * Execute the job, AMQB send reservation Data
     *
     * @param EmailMessageService $service
     *
     * @return void
     */
    public function handle(EmailMessageService $service)
    {
        $service->init($this->reservation);
        $service->produce();
    }
}